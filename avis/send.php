<?php

ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

$destinataire = "jaweijake@yahoo.com";
$sujet = "Sujet de l'email";
$message = file_get_contents('email_avis.html');
$entetes = "From: ne-pas-repondre@raddev.fr\r\n";

if (mail($destinataire, $sujet, $message, $entetes)) {
    echo "Email envoyé avec succès !";
} else {
    echo "Echec de l'envoi de l'email.";
}
