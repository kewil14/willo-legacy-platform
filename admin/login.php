<?php
require_once('auth.php');

if(islogged()){

    header('location:index.php');
}




$msg='';

$i=3;

if(isset($_POST) && !empty($_POST)) {

    $email='';
    extract($_POST);
    $email=$_POST['email'];

    if (login($email, $password2)) {

        header('location: index.php?page=home');


    }

    else {

        while ($i != 0) {

            $i--;

            $msg .= '<p style="color: red">Votre email ou mot de passe est incorrect! </p> 

                 <p style="color: red">Il vous reste <b>' . $i . '</b> tentatives </p> ';

            if ($i==0){
                $msg .= '<p style="color: red">Votre accès est bloqué! </p> ';

            }

        }


    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Se connecter</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/floating-labels/">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <meta name="theme-color" content="#563d7c">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/floating-labels.css" rel="stylesheet">
</head>
<body>
<form class="form-signin" action="<?php $_SERVER['PHP_SELF']?>" method="post" >
    <div class="text-center mb-4">
        <img class="mb-4" src="../img/logo.png" height="65%" width="65%" alt="">
        <h1 class="h3 mb-3 font-weight-normal">Se connecter</h1>
        <p>
            <?php if (!empty($msg)){
                echo $msg;
            }

            ?></p>
    </div>


    <div class="form-label-group">
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
        <label for="inputEmail">Email address</label>
    </div>

    <div class="form-label-group">
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password2" required>
        <label for="inputPassword">Password</label>
    </div>


    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">SE CONNECTER</button>
    <p class="mt-5 mb-3 text-muted text-center">&copy; 2023 Willo Déménagement & Brico</p>
</form>
</body>
</html>