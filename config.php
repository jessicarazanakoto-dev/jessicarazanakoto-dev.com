<?php
//connexion a la base de donne
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'gestion_utilisateur');

$connexion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 

if($connexion === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>