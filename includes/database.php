<?php
define('HOST', 'localhost');
define('DB_NAME', 'u789471193_site');
define('USER', 'u789471193_admin');
define('PASS', '12756428Ld38!');

try {
    $db = new PDO('mysql:host=localhost;dbname=your_database', 'email', 'password');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
