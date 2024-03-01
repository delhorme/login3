<?php
define('HOST', 'localhost');
define('DB_NAME', 'u789471193_site');
define('USER', 'u789471193_admin');
define('PASS', '12756428Ld38!');

try {
    $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "connection OK !";

} catch (PDOException $e) {
    echo $e;
}
