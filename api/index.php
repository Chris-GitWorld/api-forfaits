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

switch($_SERVER['REQUEST_METHOD'])
{
case 'GET':  // GESTION DES DEMANDES DE TYPE GET
	if(isset($_GET['id'])) { 
		if ($requete = $mysqli->prepare("SELECT * FROM forfaits WHERE id=?")) {  
		  $requete->bind_param("i", $_GET['id']); 
		  $requete->execute(); 

		  $resultat_requete = $requete->get_result(); 
		  $hotelSQL = $resultat_requete->fetch_assoc(); 

		  // Conversion de l'objet au format JSON désiré
		  $hotelObj = ConversionHotelSQLEnObjet($hotelSQL);

		  echo json_encode($hotelObj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

		  $requete->close(); 
		}
	} else {
		$requete = $mysqli->query("SELECT * FROM forfaits");
		$listeHotelsObj = [];

		while ($hotelSQL = $requete->fetch_assoc()) {
			// Conversion de l'objet au format JSON désiré
			$hotelObj = ConversionHotelSQLEnObjet($hotelSQL);

			// Ajout d'hotel à la liste
			array_push($listeHotelsObj, $hotelObj);
		}

		echo json_encode($listeHotelsObj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		$requete->close();
	}
	break;

case 'POST':  // GESTION DES DEMANDES DE TYPE POST
	$reponse = new stdClass();
	$reponse->message = "Ajout d'un forfait: ";
	
	$corpsJSON = file_get_contents('php://input');
	$data = json_decode($corpsJSON, TRUE); 

    $destination = $data['destination'];
    $ville_depart = $data['ville_depart'];
    $hotel_nom = $data['hotel']['hotel_nom'];
    $hotel_coordonnees = $data['hotel']['hotel_coordonnees'];
    $hotel_etoiles = $data['hotel']['hotel_etoiles'];
    $hotel_chambres = $data['hotel']['hotel_chambres'];
    $hotel_caracteristiques = $data['hotel']['hotel_caracteristiques'];
    $date_depart = $data['date_depart'];
    $date_retour = $data['date_retour'];
    $prix = $data['prix'];
    $rabais = $data['rabais'];
	$vedette = $data['vedette'];


    if(isset($destination) 
        && isset($ville_depart) 
        && isset($hotel_nom) 
        && isset($hotel_coordonnees)  
        && isset($hotel_etoiles) 
        && isset($hotel_chambres) 
        && isset($hotel_caracteristiques) 
        && isset($date_depart) 
        && isset($date_retour) 
        && isset($prix) 
        && isset($rabais) 
        && isset($vedette)) {
    
        $hotel_caracteristiques_str = implode(';', $hotel_caracteristiques);

        if ($requete = $mysqli->prepare("INSERT INTO forfaits (destination, ville_depart, hotel_nom, hotel_coordonnees, hotel_etoiles, hotel_chambres, hotel_caracteristiques, date_depart, date_retour, prix, rabais, vedette) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);")) {      
            $requete->bind_param("ssssiisssddi", 
                            $destination, 
                            $ville_depart, 
                            $hotel_nom, 
                            $hotel_coordonnees, 
                            $hotel_etoiles, 
                            $hotel_chambres, 
                            $hotel_caracteristiques_str, 
                            $date_depart, 
                            $date_retour, 
                            $prix, 
                            $rabais, 
                            $vedette);

            if($requete->execute()) { 
                $reponse->message .= "Succès";  
            } else {
                $reponse->message .=  "Erreur dans l'exécution de la requête";  
            }

            $requete->close(); 
        } else  {
        $reponse->message .=  "Erreur dans la préparation de la requête";  
        } 
    } else {
		    $reponse->message .=  "Erreur dans le corps de l'objet fourni";  
	}
	echo json_encode($reponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	
break;
case 'PUT': // GESTION DES DEMANDES DE TYPE PUT 
    $reponse = new stdClass(); 
    $reponse->message = "Édition d'un forfait': "; 

    if(isset($_GET['id'])) { 

              
            // CODE PERMETTANT DE METTRE À JOUR L'ENREGISTREMENT CORRESPONDANT À L'IDENTIFIANT PASSÉ EN PARAMÈTRE 
            

            $corpsJSON = file_get_contents('php://input'); 
            $data = json_decode($corpsJSON, TRUE); 

            $destination = $data['destination'];
            $ville_depart = $data['ville_depart'];
            $hotel_nom = $data['hotel']['hotel_nom'];
            $hotel_coordonnees = $data['hotel']['hotel_coordonnees'];
            $hotel_etoiles = $data['hotel']['hotel_etoiles'];
            $hotel_chambres = $data['hotel']['hotel_chambres'];
            $hotel_caracteristiques = $data['hotel']['hotel_caracteristiques'];
            $date_depart = $data['date_depart'];
            $date_retour = $data['date_retour'];
            $prix = $data['prix'];
            $rabais = $data['rabais'];
            $vedette = $data['vedette'];
        
            $hotel_caracteristiques_str = implode(';', $hotel_caracteristiques);
           

                if(isset($destination) 
                    && isset($ville_depart)
                    && isset($hotel_nom)
                    && isset($hotel_coordonnees)
                    && isset($hotel_etoiles)
                    && isset($hotel_chambres)
                    && isset($hotel_caracteristiques_str)
                    && isset($date_depart)
                    && isset($date_retour)
                    && isset($prix)
                    && isset($rabais)
                    && isset($vedette)) {
                    // $hotel_caracteristiques = implode(';', $hotel_caracteristiques_str);

                        if ($requete = $mysqli->prepare("UPDATE forfaits SET destination=?, ville_depart=?, hotel_nom=?, hotel_coordonnees=?, hotel_etoiles=?, hotel_chambres=?, hotel_caracteristiques=?, date_depart=?, date_retour=?, prix=?, rabais=?, vedette=? WHERE id=?")) 
                            {
                                $requete->bind_param("ssssiisssddii", 
                                $destination, 
                                $ville_depart, 
                                $hotel_nom, 
                                $hotel_coordonnees, 
                                $hotel_etoiles, 
                                $hotel_chambres, 
                                $hotel_caracteristiques_str, 
                                $date_depart, 
                                $date_retour, 
                                $prix, 
                                $rabais, 
                                $vedette,
                                $_GET['id']); 

                                if($requete->execute()) { $reponse->message .= "Succès"; }

                                else { $reponse->message .= "Erreur dans l'exécution de la requête :" .$requete->error; }
                                $requete->close();
                            } else { $reponse->message .= "Erreur dans la préparation de la requête";
                        } 
                        } else {$reponse->message .= "Erreur dans le corps de l'objet fourni";} 
                } else {$reponse->message .= "Erreur dans les paramètres (aucun identifiant fourni)"; } 
                
            echo json_encode($reponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); 

        
        break; 
case 'DELETE':  // GESTION DES DEMANDES DE TYPE DELETE
    $reponse = new stdClass(); 
    $reponse->message = "Suppression d'un forfait': "; 

    if(isset($_GET['id'])) { 
        // CODE PERMETTANT DE SUPPRIMER L'ENREGISTREMENT CORRESPONDANT À L'IDENTIFIANT PASSÉ EN PARAMÈTRE 


        
        if(isset($_GET['id'])) { 
            if ($requete = $mysqli->prepare("DELETE FROM forfaits WHERE id=?")) { 
                $requete->bind_param("i", $_GET['id']); 
                
                    if($requete->execute()) { $reponse->message .= "Succès"; }

                    else { $reponse->message .= "Erreur dans l'exécution de la requête :" .$requete->error; }
                    $requete->close();
                } else { $reponse->message .= "Erreur dans la préparation de la requête";
            } 
            } else {$reponse->message .= "Erreur dans le corps de l'objet fourni";} 
    } else {$reponse->message .= "Erreur dans les paramètres (aucun identifiant fourni)"; }
        echo json_encode($reponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            
break;
default:
	$reponse = new stdClass();
	$reponse->message = "Opération non supportée";	
	echo json_encode($reponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

$mysqli->close(); 



?>