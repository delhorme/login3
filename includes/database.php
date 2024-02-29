<?php
define('HOST', 'localhost');
define('DB_NAME', 'u789471193_siteweb');
define('USER', 'u789471193_root');
define('PASS', '12756428Ld');

try {
    $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "connection OK !";

} catch (PDOException $e) {
    echo $e;
}
