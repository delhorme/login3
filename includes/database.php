<?php
define('HOST', 'sitedetest.store');
define('DB_NAME', 'u789471193_site');
define('USER', 'u789471193_admin');
define('PASS', '~Vd!ustR7*2G');

try {
    // Utilisation des constantes définies pour la configuration de la connexion
    $db = new PDO('mysql:host=' . HOST . ';dbname=' . DB_NAME, USER, PASS);
    
    // Définir le mode d'erreur sur exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Vous pouvez vérifier si la connexion a réussi ici
    echo "Connexion réussie";
} catch (PDOException $e) {
    // Affichage du message d'erreur (il est préférable de le consigner dans un fichier de log en production)
    echo 'Échec de la connexion : ' . $e->getMessage();
}
?>
