<?php

require_once 'admin/db_connect.php';

//Récupération du nombre de clics sur le bouton
$reponse = $dbh->query('SELECT facebook AS nb_clics FROM clicks');
$donnees = $reponse->fetch();

echo 'Le bouton a été cliqué ' . $donnees['nb_clics'] . ' fois !';


$nbre_fb=$donnees['nb_clics']+1;


$sql = "UPDATE clicks SET facebook=?WHERE id=1";
$stmt= $dbh->prepare($sql);
$stmt->execute([$nbre_fb]);


?>