<?php

/**
 * create_findings_tables.php
 *
 * One-time setup script — same pattern as create_review_flags.php.
 * Creates the two tables needed for real Hierarchy-of-Truth
 * confidence scoring (REAL V1 CHECKPOINT gaps #1 and #2):
 *
 * - findings: one row per excavated claim/fact about a client,
 *   keyed to tree_nodes.node_id per the Identity Layer rule
 *   (Master System Law Part II).
 *
 * - finding_sources: one row per source backing a finding. A
 *   finding can have several. Each source is graded 1-4 against
 *   the Hierarchy of Truth (Master System Law Part I.4). This is
 *   the table that was missing — without it, no real confidence
 *   score can ever be computed, only guessed at or faked.
 *
 * Visit this file directly once in a browser to run it, same as
 * create_review_flags.php. Safe to run more than once (CREATE
 * TABLE IF NOT EXISTS).
 */

header('Content-Type: text/plain');
require_once __DIR__ . '/kernel/db.php';

try {
    $pdo = kernel_db();

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS findings (
            id              INT PRIMARY KEY AUTO_INCREMENT,
            node_id         INT UNSIGNED NOT NULL,
            claim_text      TEXT NOT NULL,
            channel         VARCHAR(100) DEFAULT NULL,
            evidence_class  VARCHAR(50) DEFAULT NULL,
            status          VARCHAR(50) NOT NULL DEFAULT 'pending',
            created_at      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
                ON UPDATE CURRENT_TIMESTAMP,

            INDEX idx_findings_node (node_id),
            INDEX idx_findings_evidence_class (evidence_class),

            CONSTRAINT fk_findings_node
                FOREIGN KEY (node_id) REFERENCES tree_nodes(node_id)
                ON DELETE CASCADE

        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "findings table created successfully.\n";

    // Note: no CHECK constraint on tier (1-4) below — this server
    // runs MySQL 5.7, which parses CHECK but never enforces it
    // (real enforcement only arrived in MySQL 8.0.16+). Validate
    // tier is between 1 and 4 in application code instead, wherever
    // a finding_sources row gets inserted.
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS finding_sources (
            id           INT PRIMARY KEY AUTO_INCREMENT,
            finding_id   INT NOT NULL,
            document_id  INT DEFAULT NULL,
            source_url   VARCHAR(1000) DEFAULT NULL,
            tier         TINYINT NOT NULL,
            notes        TEXT DEFAULT NULL,
            created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

            INDEX idx_finding_sources_finding (finding_id),
            INDEX idx_finding_sources_document (document_id),

            CONSTRAINT fk_finding_sources_finding
                FOREIGN KEY (finding_id) REFERENCES findings(id)
                ON DELETE CASCADE,

            CONSTRAINT fk_finding_sources_document
                FOREIGN KEY (document_id) REFERENCES documents(id)
                ON DELETE SET NULL

        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "finding_sources table created successfully.\n";

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}