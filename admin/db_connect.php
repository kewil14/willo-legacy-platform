<?php
$host='';
$db = '';
$username = '';
$password = '';


$dsn = "mysql:host=$host;dbname=$db";

try {


    $dbh = new PDO($dsn, $username, $password);
}

catch(Exception $e)
{
    die('Impossible de se connecter à la base de donnée : '.$e->getMessage());
}



?>