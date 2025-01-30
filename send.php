<?php
function envoyerEmail($destinataire, $sujet, $contenu)
{
    // Configurer les paramètres de l'e-mail
    $headers = "From: Willo\r\n";
    $headers .= "Reply-To: ne-pas-repondre@xn--dmnagementetbrico-btbb.fr <ne-pas-repondre@xn--dmnagementetbrico-btbb.fr>\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Envoyer l'e-mail
    mail($destinataire, $sujet, $contenu, $headers);
}

$destinataire = "email@gmail.com";

$sujet = "Vous avez reçu un nouveau avis";
$message = 'Objet';

envoyerEmail($destinataire, $sujet, $message);
