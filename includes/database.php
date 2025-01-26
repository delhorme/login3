<?php
define('HOST', 'localhost');
define('DB_NAME', 'u789471193_site');
define('USER', 'root');
define('PASS', '~Vd!ustR7*2G');

try {
    $db = new PDO('mysql:host=localhost;dbname=your_database', 'email', 'password');

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo $e;
}
