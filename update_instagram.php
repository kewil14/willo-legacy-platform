<?php

require_once 'admin/db_connect.php';

//Récupération du nombre de clics sur le bouton
$reponse = $dbh->query('SELECT instagram AS nb_clics FROM clicks');
$donnees = $reponse->fetch();


$nbre_insta=$donnees['nb_clics']+1;


$sql = "UPDATE clicks SET instagram=?WHERE id=1";
$stmt= $dbh->prepare($sql);
$stmt->execute([$nbre_insta]);

header('Location: https://www.instagram.com/willywillo33/');
?>