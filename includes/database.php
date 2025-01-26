<?php
define('HOST', 'sitedetest.store');
define('DB_NAME', 'u789471193_site');
define('USER', 'u789471193_admin');
define('PASS', '~Vd!ustR7*2G');

try {
    // Connexion à la base de données
    $db = new PDO('mysql:host=' . HOST . ';dbname=' . DB_NAME, USER, PASS);
    
    // Définir le mode d'erreur sur exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Exemple d'une requête SELECT sur une table existante
    $query = $db->query("SELECT * FROM votre_table LIMIT 1");
    if ($query) {
        $row = $query->fetch(PDO::FETCH_ASSOC);
        echo "Connexion réussie. Exemple de donnée : " . print_r($row, true);
    }
} catch (PDOException $e) {
    // En cas d'erreur, afficher un message
    echo 'Échec de la connexion : ' . $e->getMessage();
}
?>
