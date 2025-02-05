<?php
session_start();


function login($email, $password2){

    $host='';
    $db = '';
    $username = '';
    $password = '';


    $dsn = "mysql:host=$host;dbname=$db";

    try {


        $dbh = new PDO($dsn, $username, $password);

        $result = $dbh->query("SELECT * FROM admin WHERE email= " . $dbh->quote($email) . " AND password=" . $dbh->quote($password2) ."LIMIT 1");

        $row_cnt = $result->rowCount();






        if ($row_cnt >0 ) {
            $clients = array();
            $clients = $result->fetch(PDO::FETCH_ASSOC);
            $_SESSION['admin'] = array();
            $_SESSION['admin']['id'] = $clients['id'];
            $_SESSION['admin']['nom'] = $clients['nom'];
            $_SESSION['admin']['email'] = $clients['email'];



            return true;
        }
        return false;

    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}
function logout(){
    unset($_SESSION['admin']);
    session_destroy();


}
function islogged(){
    if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])){
        return true;
    }
    return false;
}
?>