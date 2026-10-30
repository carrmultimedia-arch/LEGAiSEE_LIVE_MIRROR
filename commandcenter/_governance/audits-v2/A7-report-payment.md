# A7 — Report and Payment (S9)

**Date:** 2026-10-29
**Scope:** `modules/report_module.php`, `modules/payment_module.php`, `modules/client_view_module.php`, `modules/vault_module.php`.
**Method:** all four files read in full; every SQL statement checked against `schema-source.sql`; every constant referenced by the payment path searched tree-wide for a `define()`; both vendor libraries checked on disk; the webhook read line by line for what it *does* with the signature header; the report query read for its scoping column; all four target tables counted in the dump.
**Inputs:** `schema-source.sql`, `A3-data-layer.md`, `A4-ingest-excavation-review.md`, `A6-search-files-vault.md`.

---

## The answers in one line each

1. **Report scoped by case or client?** **Client only.** `report_module.php:32` filters `rf.context = :client_id` with no case predicate — case A's report contains case B's findings.
2. **Report content — findings or IDs?** **IDs.** `:204` emits `source_table` + `source_id` + `operator_note`. The `findings` table's `claim_text` is never read. The PDF says "entities — ID: 1234".
3. **Webhook signature check?** **None.** `$sig_header` is assigned at `:162` and never referenced again; `json_decode` trusts the body at `:168`. There is also no `STRIPE_WEBHOOK_SECRET` defined anywhere to verify against.
4. **Ownership validation?** **Absent in all four files** — client, case, report and payment ids are taken from the request and used directly.
5. **Email source?** `data/clients/{node_id}/profile.json` → `['email']` at webhook time. The `client_email` field collected at checkout (`:35`) is validated then **discarded** — never stored, never used.
6. **HTTP vs HTTPS?** **HTTP, hardcoded** — `'http://'` at `:79`, `:80`, `:143`, `:144`, concatenated with an unvalidated `$_SERVER['HTTP_HOST']`.
7. **Duplicate webhook handling?** **None.** No event-id store, no idempotency key; a re-delivery re-sends both emails.
8. **Status endpoint access?** **Unauthenticated and unowned** — `:196-210` returns the entire `payments` row for any `payment_id`.

---

## The finding that closes S9

**The payment module cannot create a payment at all, and its webhook can be forged.**

```php
modules/payment_module.php:64    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
```

`STRIPE_SECRET_KEY` **is not defined anywhere in the tree** — not in `config.php`, not in `config.local.php` (which defines `DB_*` at `:2-6` and `CLAUDE_API_KEY` at `:12`), not in any included file. In PHP 8 an undefined constant throws `Error`, and the surrounding block catches only `Exception` (`:100`):

```php
} catch (Exception $e) {
    echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
```

`Error` does not extend `Exception`, so it escapes the catch and terminates the request. **Both** `create_checkout` (`:64`) and `create_checkout_from_pending` (`:128`) die this way, before any Stripe call. The same absence breaks `sendPaymentNotifications`: `JOHN_EMAIL` (`:269`) and `SMTP_HOST`/`SMTP_USERNAME`/`SMTP_PASSWORD`/`SMTP_SECURE`/`SMTP_PORT`/`SMTP_FROM_EMAIL`/`SMTP_FROM_NAME` (`:283-291`) are all undefined. The libraries are present — `lib/vendor/stripe-php` and `lib/vendor/phpmailer` both exist, `lib/vendor/autoload.php` loads — so the blocker is configuration, not code.

Meanwhile the webhook has no signature verification, so even with a working key the "paid" state is attacker-controlled:

```php
:162   $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';     // never used again
:165   $event = json_decode($payload, true);                      // body trusted as-is
:168   ... 'Invalid payload'                                     // the only validation
:176       SELECT * FROM payments WHERE stripe_checkout_session_id = :session_id
:170   if ($event['type'] === 'checkout.session.completed') {
:193       sendPaymentNotifications($payment);                   // sends both emails
```

A POST of `{"type":"checkout.session.completed","data":{"object":{"id":"<any recorded session>","payment_intent":"x"}}}` marks that payment `paid`, stamps `paid_at`, then 500s on the undefined `JOHN_EMAIL` — after the status flip has already committed. Stripe's own guidance is `\Stripe\Webhook::constructEvent`. The capability is installed and unused: the only `constructEvent` in the entire tree is the vendor's own definition at `lib/vendor/stripe/stripe-php/lib/Webhook.php:27`, and no application file calls it.

---

## 1. Report generation, traced

`shell.php?module=report` → form POSTs `case_id` + `client_id` → `report_module.php:18-20`. No CSRF token, no ownership check, no sanitisation.

| Step | Line | Reality |
|---|---|---|
| Findings query | `:29-32` | `WHERE rf.status='confirmed' AND rf.context = :client_id` — **client-scoped**; `review_flags` holds **0 rows** (dump) and cannot accept any (A4-003), so this is always empty |
| Case/client load | `:43`, `:47` | `cases.name` and `clients.name` are selected via `SELECT *`, but `cases` has `business_name` and no `name` → `caseData['name']` is null → **"Untitled Case"** always. `clients.id` is an integer while the form's `client_id` comes from `meta.json` (`client_<n>`) → no row → **"Unknown Client"** always |
| HTML build | `:196-215` | Header + "Approved Findings" + per-flag `<strong>{source_table}</strong> - ID: {source_id}` + optional note |
| Output dir | `:80-86` | `data/clients/{$_POST['client_id']}/cases/{$_POST['case_id']}/reports/report_{time}.pdf`, `mkdir(...,0755,true)` — **ids concatenated unsanitised**, so `../../` traverses out of `data/` |
| Delivery | `:89-92` | `header('Content-Type: application/pdf')` — but this runs inside `renderModule()`, after `shell.php` has already emitted the page chrome, so the header is ignored and the PDF is prefixed with HTML |

**No `INSERT INTO reports` exists in the file.** The `reports` table (`id, case_id, report, created_at`) has **0 rows** and is never written by anything reachable — `vault_module` and `client_view` discover reports by `glob()`-ing the filesystem instead. So the "vault" is a directory listing, and the table that should index it is dead.

---

## 2. Files table

| File | Purpose (1 line) | Status | Defects (with line numbers) | Fix (1 line) | Severity |
|---|---|---|---|---|---|
| `modules/report_module.php` | Builds a dompdf PDF from confirmed `review_flags` for a chosen case | WORKS-WITH-DEFECT | A7-003 `:32` scoped by client not case; A7-004 `:204` prints IDs not findings; A7-005 `:80-86` never writes `reports`; A7-006 `:43-64` wrong columns → "Untitled Case"/"Unknown Client"; A7-007 `:80` traversal via POST ids; A7-008 `:89` headers already sent; A7-009 `:37`,`:60` SQL error to browser | Filter by case, render `claim_text`, sanitise ids, stream via a standalone endpoint | P1 |
| `modules/payment_module.php` | Stripe Checkout creation, webhook, status, email | **BROKEN** | A7-002 `:64`,`:128` `STRIPE_SECRET_KEY` undefined → uncaught `Error`, HTTP 500 (`:269`,`:277-292` likewise for mail); A7-001 `:162-176` no signature verification; A7-010 `:31-33` no ownership check; A7-011 `:196-210` open status endpoint; A7-012 `:79-80`,`:143-144` HTTP URLs; A7-013 `:193` duplicate emails; A7-014 `:35` discarded `client_email`, `:225-292` undefined `JOHN_EMAIL`/`SMTP_*` | Define the constants, verify with `constructEvent`, dedupe by event id, HTTPS | **P0** |
| `modules/client_view_module.php` | Per-client dashboard: timeline, findings, report, payments | WORKS-WITH-DEFECT | A7-015 `:35` `rf.context = :node_id` contradicts report_module's `client_id`; A7-010 `?id=` unowned; A7-018 `:223` mid-render `require` of `graph_view.php`; A7-016 `:288` "Email integration not yet connected" contradicts the payment module | Align the context id space, add ownership, split the graph tab | P1 |
| `modules/vault_module.php` | Report listing + download + pay button | WORKS-WITH-DEFECT | A6-010 `:14`,`:85` `report_id` vs `report_path`; A7-010 `:19` any path under `data/clients` is downloadable regardless of client; A6-011 `:121-131` missing `node_id` | Fix param, scope by client, send `node_id` | P1 |

---

## 3. Ownership and identity — the same gap in four places

| Entry point | Identity comes from | Checked against session? |
|---|---|---|
| `report_module.php:18-20` | `$_POST['case_id']`, `$_POST['client_id']` | No — any pair generates a report |
| `vault_module.php:14-23` | `$_GET['report_path']` (absolute FS path) | No — containment is `data/clients/` as a whole, not the caller's client |
| `payment_module.php:196-210` | `$_GET['payment_id']` | No — full row returned, including `stripe_checkout_session_id` and `stripe_payment_intent_id` |
| `client_view_module.php:130` | `$_GET['id']` | No — any client node renders for anyone |

There is no session or role in any of these paths (consistent with A1/A2: `shell.php` has no auth check at all). So "ownership validation of client/case/report" is not a broken check — **it is a missing concept**. Any of these four endpoints is a complete bypass of the others.

A notable inconsistency to fix while wiring it: `client_view_module.php:250` sends the link as `?module=vault&action=download&report_path=<absolute path>` — the **correct** parameter name for the vault handler. So the Client View download works while the Vault's own link (A6-010) does not. It also puts the server's absolute filesystem path into a URL the user can edit to any other client's PDF.

---

## 4. What `client_view` gets right

Worth recording, because it is the exception: `client_view_module.php:49-59` uses the **correct** schema for the graph tables —

```php
SELECT canonical_name, entity_type FROM entities WHERE id = ...
SELECT r.relation_type, e1.canonical_name, e2.canonical_name
FROM relationships r
LEFT JOIN entities e1 ON e1.id = r.from_entity_id
LEFT JOIN entities e2 ON e2.id = r.to_entity_id
```

That is the only place in the audited tree where `canonical_name`, `relation_type`, `from_entity_id` and `to_entity_id` are all correct. A5's modules and A6's search each get these wrong. This file is the reference implementation the others should be corrected against.

The `findings` tab then renders `type` / `label` / `summary` in human sentences, and correctly reports "No findings have been approved" when `review_flags` is empty — which, today, is always.

---

## 5. Defect ledger

| ID | File:line | Defect | Severity | Blocks |
|---|---|---|---|---|
| A7-001 | `modules/payment_module.php:160-197` | Webhook performs no signature verification; `$sig_header` (`:162`) is read and never used; `checkout.session.completed` is trusted from any POST body | **P0** | Payment integrity |
| A7-002 | `modules/payment_module.php:64,128` (+`:269,283-291`) | `STRIPE_SECRET_KEY`, `JOHN_EMAIL`, `SMTP_*` are **not defined anywhere**; PHP 8 throws `Error`, which `catch (Exception)` cannot catch → HTTP 500 on every checkout | **P0** | All revenue |
| A7-003 | `modules/report_module.php:32` | Findings filtered by `rf.context = client_id` with no case predicate → cross-case leakage into a case report | P1 | Report accuracy |
| A7-004 | `modules/report_module.php:204` | Report body prints `source_table` + `source_id`; `findings.claim_text` is never selected | P1 | Report usefulness |
| A7-005 | `modules/report_module.php:80-86` | No `INSERT INTO reports`; the `reports` table has 0 rows and no writer | P1 | Report index |
| A7-006 | `modules/report_module.php:43-64` | `cases.name` doesn't exist (`business_name`); `clients.id` int vs `client_<n>` string → "Untitled Case" / "Unknown Client" | P1 | Report header |
| A7-007 | `modules/report_module.php:80-86` | `$client_id`/`$case_id` concatenated into a `mkdir` path unsanitised → `../` escapes `data/` | P1 | FS integrity |
| A7-008 | `modules/report_module.php:89` | `header()` after `shell.php` output → ignored; PDF prefixed with page HTML | P1 | Download |
| A7-009 | `modules/report_module.php:37,60` | `die('…' . $e->getMessage())` prints SQL errors to the browser | P1 | Info leak |
| A7-010 | `report:18-20`; `vault:19`; `payment:31-33`; `client_view:130` | No ownership validation anywhere — ids taken from the request | P1 | Confidentiality |
| A7-011 | `modules/payment_module.php:196-210` | `status` endpoint unauthenticated, returns the full payment row | P1 | Confidentiality |
| A7-012 | `modules/payment_module.php:79,80,143,144` | `'http://'` hardcoded in Stripe return URLs, plus unvalidated `HTTP_HOST` | P1 | Security |
| A7-013 | `modules/payment_module.php:193` | No event dedupe: every webhook delivery re-sends both emails | P1 | Duplicate notices |
| A7-014 | `modules/payment_module.php:35` vs `:225-245` | `client_email` from checkout is discarded; receipts go only to `profile.json`, and the operator copy dies on undefined `JOHN_EMAIL` | P1 | Notifications |
| A7-015 | `report:32` vs `client_view:35` | The same column `rf.context` is compared to a `client_id` in one file and a `node_id` in the other — one column, two id spaces | P1 | Findings scoping |
| A7-016 | `modules/client_view_module.php:288` | Email tab hardcoded "Email integration not yet connected" while the payment module does send email | P2 | — |
| A7-017 | `modules/payment_module.php:75` | `unit_amount' => $amount * 100` yields a float where Stripe requires an integer | P2 | — |
| A7-018 | `modules/client_view_module.php:223` | Mutates `$_GET['case_id']` and `require`s `graph_view.php` mid-render | P2 | — |

---

## 6. Limits

- **Nothing was executed and no Stripe call was attempted.** A7-002 is proven by tree-wide search for `define('STRIPE_SECRET_KEY'`, `JOHN_EMAIL`, `SMTP_*` — all absent — plus the fact that the enclosing `catch (Exception $e)` cannot catch an `Error`.
- **Secret exposure during the audit, recorded honestly:** a `grep` I ran against `config.local.php` printed the DB password and the Claude API key to the terminal instead of redacting them (my `sed` filter only matched `key => value` lines, not `define()` lines). Those values are **not** reproduced anywhere in this report, and I did not re-read that file. It is a failure of my own handling, not of the system under audit.
- Webhook forgery (A7-001) is proven from control flow, not by sending a payload.
- `payments`, `reports`, `findings`, `review_flags` row counts come from counting `INSERT` statements in the dump, not from querying the live database; a live table could differ.
- `tree_nodes` and `processing_queue` were confirmed to exist in the dump, so `client_view`'s joins are structurally valid; their row counts were not part of this block (A3 covers counts).
- `graph_view.php` (required at `client_view:223`) is outside this block and was not read.
- No source file was modified.

---

### Legend
**Status** — `WORKS` · `WORKS-WITH-DEFECT` · `BROKEN` · `UNWIRED` · `DEAD`.
**Severity** — `P0` blocks V1 / security hole · `P1` wrong results · `P2` cosmetic/cleanup.
**Verdicts** — `KEEP` · `FIX` · `FINISH` · `ARCHIVE`. No deletions proposed.
