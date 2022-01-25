<?php

// Cette fonction prend l'object au format tablulaire SQL 
// et retourne un objet dont la structure correspond au format
// devant être retourné par l'API. 
function ConversionHotelSQLEnObjet($hotelSQL) {
    $hotelOBJ = new stdClass();
    $hotelOBJ->destination = $hotelSQL["destination"];
    $hotelOBJ->ville_depart = $hotelSQL["ville_depart"];

    $hotelOBJ->hotel = new stdClass();
    $hotelOBJ->hotel->hotel_nom = $hotelSQL["hotel_nom"];
    $hotelOBJ->hotel->hotel_coordonnees = $hotelSQL["hotel_coordonnees"];
    $hotelOBJ->hotel->hotel_etoiles = $hotelSQL["hotel_etoiles"];
    $hotelOBJ->hotel->hotel_chambres = $hotelSQL["hotel_chambres"];
    $hotelOBJ->hotel->hotel_caracteristiques = explode(";", $hotelSQL["hotel_caracteristiques"]);

    
    $hotelOBJ->date_depart = $hotelSQL["date_depart"];
    $hotelOBJ->date_retour = $hotelSQL["date_retour"];
    $hotelOBJ->prix = $hotelSQL["prix"];
    $hotelOBJ->rabais = $hotelSQL["rabais"];
    $hotelOBJ->vedette = $hotelSQL["vedette"];

    return $hotelOBJ;
}   

?>