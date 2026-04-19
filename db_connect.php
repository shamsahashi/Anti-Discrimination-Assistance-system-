<?php
/* ══════════════════════════════════════════════
   DATABASE CONNECTION
   Update credentials before deploying.
══════════════════════════════════════════════ */
define('DB_HOST', 'localhost');
define('DB_USER', 'root');       // ← change on production
define('DB_PASS', '');           // ← change on production
define('DB_NAME', 'antidiscrimination_db');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    error_log("DB Connection failed: " . $conn->connect_error);
    die("A database error occurred. Please try again later.");
}

$conn->set_charset("utf8mb4");
?>