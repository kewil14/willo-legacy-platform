<?php
require_once 'auth.php';

if (islogged()){
    logout();
    header('location:login.php');
}
?>