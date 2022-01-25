<?php
include_once '../include/config.php'; 
include_once '../include/fonctions.php'; 

header('Content-Type: application/json;');
header('Access-Control-Allow-Origin: *'); 

$mysqli = new mysqli($host, $username, $password, $database); // Établissement de la connexion à la base de données
if ($mysqli -> connect_errno) { // Affichage d'une erreur si la connexion échoue
  echo 'Échec de connexion à la base de données MySQL: ' . $mysqli -> connect_error;
  exit();
} 

$resultat_requete = $mysqli->query("SELECT * FROM meteo ORDER BY date_jour"); 
$donnees_tableau = $resultat_requete->fetch_all(MYSQLI_ASSOC); 
echo json_encode($donnees_tableau, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);	

$mysqli->close(); 



?>