# RUNBOOK — What you need to do on the server

For **WO-001 · Move all LEGAiSEE data access onto MySQL** (see `WORKORDER-JSON-SQLite-to-MySQL.md`).

No prior knowledge assumed. Each step says what to run, what you should see, and what to send back to me. Steps 1–5 are safe and change nothing. Nothing in this list deletes data.

You only need **two kinds of access**:
- **cPanel** (or whatever hosting panel you have) — for phpMyAdmin and the file manager.
- **SSH / Terminal** — for running commands. If you don't have SSH, use the cPanel **Terminal** icon. If neither exists, tell me and I will give you a browser-based runner for every step.

Write down the answers as you go; §13 is the single list of everything to send me.

---

## Step 1 — Make a backup (do not skip)

**1a. Back up the database.** In cPanel → **phpMyAdmin** → click your database on the left → **Export** tab → **Go**. Save the `.sql` file to your computer and name it `db-before-migration-YYYY-MM-DD.sql`.

**1b. Back up the code and the `data/` folder.** In cPanel → **File Manager** → go to your home folder (usually `/home/carrmulti`) → select `commandcenter` → **Compress** → choose **Zip** → download the zip.

✅ **Success:** you have both a `.sql` file and a `.zip` on your own computer.

> Why: every later step can be undone only if these two files exist.

---

## Step 2 — Tell me your versions

Run these three commands (SSH or cPanel Terminal) and paste the output:

```bash
php -v
mysql --version
php -m | grep -i -E "pdo|mysql|json"
```

✅ **Success:** you see something like `PHP 8.1.x`, `mysql Ver 8.0.x`, and the words `pdo_mysql` and `json` in the module list.

⚠️ **If `pdo_mysql` is missing:** the whole application cannot work. Ask your host to enable it, or in cPanel → **Select PHP Version** → **Extensions** → tick `pdo_mysql`. Tell me if you had to do this.

---

## Step 3 — Create a database and a database user

Skip this step if your site already connects to MySQL successfully (it does, because `shell.php` currently loads).

Otherwise: cPanel → **MySQL® Databases**.
1. **Create New Database** — name it, e.g. `carrmulti_legaisee`. Write down the **full** name (hosting prefixes it: `accountname_dbname`).
2. **Add New User** — username + a strong password. Write both down.
3. **Add User To Database** — select the user and the database, click **Add**, then tick **ALL PRIVILEGES**, then **Make Changes**.

✅ **Success:** the database appears in the list with the user attached.

**Send me the database name and username** (never the password in chat — put the password only into the config file in Step 6).

---

## Step 4 — Let me see the current table structure

This is the most important step. The code already uses tables named `cases`, `clients`, `entities`, `documents`, `files`, `payments`, and others. I must know their **real** columns before I write new SQL, or I will break what already works.

**4a.** In cPanel → **phpMyAdmin** → select your database → **Export** tab → choose **Custom** → set **Format: SQL** → under *Output*, tick **"Structure" only** (or set *Dump* to *Structure only*) → **Go**. Save as `schema-before.sql`.

**4b.** Also run this in phpMyAdmin's **SQL** tab and click **Go**:

```sql
SELECT TABLE_NAME, TABLE_ROWS, ROUND(DATA_LENGTH/1024/1024,2) AS mb, ENGINE, TABLE_COLLATION
FROM information_schema.TABLES
WHERE TABLE_SCHEMA = DATABASE()
ORDER BY TABLE_NAME;
```

**4c.** And this one, to check the two critical tables:

```sql
SHOW CREATE TABLE cases;
SHOW CREATE TABLE clients;
SELECT COUNT(*) AS cases_rows FROM cases;
SELECT COUNT(*) AS clients_rows FROM clients;
```

✅ **Success:** you have `schema-before.sql` plus two result tables on screen.

**Send me:** `schema-before.sql` (as a file) and the results of 4b and 4c.

> If `cases` or `clients` do not exist, the result will say *"Table doesn't exist"*. That is fine and useful — tell me which ones are missing.

---

## Step 5 — Create a staging copy to test on

Never test a migration on live data.

**5a.** cPanel → **MySQL Databases** → **Create New Database** → `carrmulti_legaisee_staging`. Add the same user with ALL PRIVILEGES.

**5b.** phpMyAdmin → select the **live** database → **Export** → **Go** → save `live-copy.sql`.

**5c.** phpMyAdmin → select `carrmulti_legaisee_staging` → **Import** tab → **Choose File** → `live-copy.sql` → **Go**.

**5d.** Copy the code so you can test without touching the live site:

```bash
cp -a ~/commandcenter ~/commandcenter_staging
cp -a ~/commandcenter/data ~/commandcenter_staging/data
```

(for cPanel File Manager: select `commandcenter` → **Copy** → paste as `commandcenter_staging`.)

✅ **Success:** `..._staging` appears in phpMyAdmin's left sidebar with the same tables as live, and `~/commandcenter_staging` exists.

---

## Step 6 — Point the staging copy at the staging database

Open `~/commandcenter_staging/config.local.php` in the File Manager editor. It contains `define(...)` lines with the database name, user, password, host.

Change **only** the database-name line to your staging database. Leave everything else. Save.

Then **mask the passwords** before sending me the file:

```bash
cd ~/commandcenter_staging && sed -E "s/(define\('[A-Z_]*PASS[A-Z_]*',).*/\1 '***');/" config.local.php > /tmp/config.masked.php && cat /tmp/config.masked.php
```

✅ **Success:** the output shows your constant names with `***` where passwords were.

**Send me:** that masked output. I need the exact **names** of the constants (e.g. `DB_HOST`, `DB_NAME`) so the new code reads the right ones.

⚠️ Also tell me: does the password contain `$`, `#`, `"` or `\`? Those break PHP strings and I need to know whether to escape them.

---

## Step 7 — Close the web root holes

Right now `config.local.php` and the whole `data/` folder are downloadable by anyone with the URL.

**7a.** In cPanel → **File Manager** → enable **Show Hidden Files** → open `~/commandcenter/.htaccess`.

**7b.** Add these lines at the very bottom (if the file does not exist, create it):

```apache
# --- LEGAiSEE: block direct access to data and internals
<Files "config.local.php">
    Require all denied
</Files>
RedirectMatch 403 ^/commandcenter/(data|tools|cli)/
RedirectMatch 403 ^/commandcenter/.*\.(db|bak|sql|log)$
RedirectMatch 403 ^/commandcenter/.*\.phpbak.*$
```

**7c.** Test in a browser: `https://yoursite.com/commandcenter/config.local.php`

✅ **Success:** you get **403 Forbidden**. If you see PHP source code or a blank page with `define(...)`, the rule did not apply — tell me.

> Do this **after** Step 5's copies, or the staging copy will be blocked too (harmless, but confusing).

---

## Step 8 — Turn off writes during the switch (maintenance window)

While I move the code, nothing may write new JSON files, or those records are lost.

**8a.** Pick a quiet time (10–15 minutes is enough for a small dataset).

**8b.** Post a notice on the site if you have public visitors.

**8c.** Stop the background worker if it is scheduled. cPanel → **Cron Jobs** → look for any entry containing `cli/worker.php` or `run_worker` → **temporarily disable** (note what it said; you will re-enable in Step 11).

✅ **Success:** no cron job references `worker` while the migration runs.

---

## Step 9 — Run the migration

I will give you three things when the code is ready:
1. `database/schema/001_store.sql` — creates the new tables.
2. `tools/import_json_to_mysql.php` — copies existing JSON records into MySQL.
3. The updated code files.

**9a. Create the tables.** phpMyAdmin → select the **staging** database → **Import** → choose `001_store.sql` → **Go**.

✅ **Success:** "Import has been successfully finished" and the new tables (`networks`, `prospects`, `case_insights`, …) appear in the sidebar. **Nothing existing is dropped.**

**9b. Dry run the importer** (reads only, changes nothing):

```bash
cd ~/commandcenter_staging && php tools/import_json_to_mysql.php --dry-run
```

✅ **Success:** a table listing each data folder with counts, e.g. `cases: 23 files, 23 rows to insert`.

**Send me this output before continuing.**

**9c. Import for real:**

```bash
php tools/import_json_to_mysql.php
```

✅ **Success:** ends with `Done. 0 errors.` and no `json_decode` failures.

**9d. Verify it matches the files:**

```bash
php tools/import_json_to_mysql.php --verify
```

✅ **Success:** `0 mismatches`.

⚠️ **If you get "Command not found" or a blank page:** you have no CLI PHP. Tell me and I will give you a token-protected `tools/import_web.php` you open once in a browser instead. Do not paste database passwords into a browser URL.

---

## Step 10 — Check the numbers yourself

In phpMyAdmin, on the **staging** database, **SQL** tab:

```sql
SELECT 'clients' AS t, COUNT(*) AS n FROM clients
UNION ALL SELECT 'cases', COUNT(*) FROM cases
UNION ALL SELECT 'prospects', COUNT(*) FROM prospects
UNION ALL SELECT 'networks', COUNT(*) FROM networks
UNION ALL SELECT 'network_nodes', COUNT(*) FROM network_nodes
UNION ALL SELECT 'network_edges', COUNT(*) FROM network_edges
UNION ALL SELECT 'case_insights', COUNT(*) FROM case_insights
UNION ALL SELECT 'case_clusters', COUNT(*) FROM case_clusters
UNION ALL SELECT 'brain_sessions', COUNT(*) FROM brain_sessions;
```

Expected, from the files currently on disk:

| Table | Expected (minimum) |
|---|---|
| clients | 5 flat + 5 profile files, so **≥ 5** |
| cases | 17 flat + 6 `meta.json` → **≥ 17** |
| prospects | **27** |
| networks | 9 in `data/network` + 6 `network.json` → **≥ 9** |
| network_nodes / edges | 0 is acceptable if the network files have no `nodes` key — tell me if 0 |
| brain_sessions | **3** |
| case_insights / clusters | only if the per-case files existed — check `ls data/clients/*/cases/*/insights.json` |

If a count is lower than expected, **stop** and send me the number. Do not proceed to Step 11.

---

## Step 11 — Switch the live site over

Only after Step 10 matches.

**11a.** Upload the updated code to `~/commandcenter` (File Manager → Upload the zip → **Extract** → overwrite). **Do not** upload over `config.local.php`.

**11b.** Upload `database/schema/001_store.sql` to `~/commandcenter/database/schema/`, then import it into the **live** database via phpMyAdmin → Import.

**11c.** Run the importer against live, in this order:

```bash
cd ~/commandcenter
php tools/import_json_to_mysql.php --dry-run     # look at the counts
php tools/import_json_to_mysql.php
php tools/import_json_to_mysql.php --verify
```

**11d.** Open the site and check these pages (they are the ones being changed):

`shell.php?module=dashboard` · `?module=cases` · `?module=relations` · `?module=dig_review` · `?module=client_view` · `?module=report` · `?module=search` · `?module=graph` · `?module=executive`

✅ **Success:** each page loads, shows records (not "0 total"), and shows **no** line beginning with `Warning:` or `Fatal error:`.

**11e.** Re-enable the cron job you disabled in Step 8.

---

## Step 12 — Keep the JSON folder as evidence, do not delete it

Do **not** delete `data/`. I need it until the final verification passes.

**12a.** Make it read-only so nothing writes to it anymore:

```bash
chmod -R a-w ~/commandcenter/data
```

**12b.** After two weeks of normal operation, rename it:

```bash
mv ~/commandcenter/data ~/commandcenter/_archive_data
```

Keep it for at least one month, then delete with your Step 1b zip as the permanent record.

**12c.** Delete the dead SQLite files (safe — no code uses them):

```bash
cd ~/commandcenter && rm -f legaisee.db kernel/legaisee.db
```

---

## Step 13 — Everything to send me

Copy this list and fill it in:

1. Output of `php -v` and `mysql --version` (Step 2).
2. Whether `pdo_mysql` appeared in `php -m` (Step 2).
3. Your **database name** and **database username** — *not* the password (Step 3).
4. `schema-before.sql` as a file (Step 4a).
5. The results of the `information_schema` query (Step 4b) and `SHOW CREATE TABLE cases/clients` (Step 4c).
6. Tell me which of `cases` / `clients` **do not exist**.
7. The **masked** `config.local.php` output, so I know your constant names (Step 6).
8. Whether your DB password contains `$`, `#`, `"` or `\` (Step 6).
9. Confirmation that `config.local.php` returns 403 in a browser (Step 7).
10. Whether you have **SSH**, cPanel **Terminal**, or **neither** (decides Step 9c).
11. The `--dry-run` output from Step 9b.
12. The row counts from Step 10, and any that are lower than the table in Step 10.

---

## Troubleshooting

| Symptom | Cause | Fix |
|---|---|---|
| `Access denied for user` | Wrong password or user not attached to the DB | Step 3.3 — re-add the user to the database with ALL PRIVILEGES |
| `Unknown database` | DB name missing the `accountname_` prefix | Use the full name shown in cPanel |
| `SQLSTATE[HY000] [1045]` | Password has `$` and PHP ate it | Wrap the password in **single** quotes in `config.local.php` |
| `The MySQL server is running with the --read-only option` | Hosting is in maintenance mode | Retry later, or ask the host |
| Blank white page | PHP fatal error, display off | cPanel → **Errors** or the `error_log` in the folder; send me the last 20 lines |
| `json_decode` error during import | One malformed file | The importer names the file and stops; send me the filename, I will fix that record |
| Counts in Step 10 are lower than the table | A JSON file has a duplicate `id` | Send me the counts; the importer's `--verify` will name the colliding file |
| `403` on the whole site after Step 7 | The `RedirectMatch` pattern caught `shell.php` | Remove the `data|tools|cli` line, tell me, I will narrow it |
| `php: command not found` | No CLI PHP | Tell me; I will supply the browser-based importer |

---

## What I need from you vs. what I do

| I do (code) | You do (server) |
|---|---|
| Write `kernel/store.php`, the schema file, the importer | Back up, create staging DB, import the schema |
| Rewrite 85 PHP files to use MySQL | Run the importer and paste the counts |
| Remove the SQLite probe and dead files | `rm` the two `.db` files |
| Add the `.htaccess` deny rules | Paste them, confirm 403 |
| Verify with grep + curl | Click through the 9 module pages and report anything broken |

I cannot reach your database, so steps 1–13 are the only part that needs you. Everything in the left column I do without further input, once you send back items 1–11 of Step 13.
