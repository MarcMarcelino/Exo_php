<?php
include "Config.php";

// Requetes 

$query = $mysqlClient->prepare("SELECT * FROM `100`;");
$query->execute();

$data = $query->fetchAll(PDO::FETCH_ASSOC);
var_dump($data);

// Fermeture de la connexion
$mysqlClient = null;
$dBhost = null;
?>