<?php

require_once 'admin/db_connect.php';

//Récupération du nombre de clics sur le bouton
$reponse = $dbh->query('SELECT phone AS nb_clics FROM clicks');
$donnees = $reponse->fetch();

$nbre_phone=$donnees['nb_clics']+1;


$sql = "UPDATE clicks SET phone=?WHERE id=1";
$stmt= $dbh->prepare($sql);
$stmt->execute([$nbre_phone]);


?>