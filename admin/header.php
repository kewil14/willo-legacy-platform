<?php

require_once 'auth.php';

if (!islogged()){
    header('Location : login.php');
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="css/uPlot.min.css">


    <link rel="stylesheet" href="css/adminlte.min.css?v=3.2.0">
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index.php" class="nav-link">Tableau de board</a>
            </li>

        </ul>


    </nav>


    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="index.php" class="brand-link">
             <span class="brand-text font-weight-light">Espace Admin</span>
        </a>

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="../avis/img/avatar/avatar_1.png"  alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Rodrigue</a>
                </div>
            </div>



            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link active">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>
                                Statistiques
                            </p>
                        </a>
                    </li>

                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file"></i>
                            <p>
                                Mes devis
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="devisdem.php" class="nav-link">
                                    <i class="nav-icon fas fa-truck"></i>
                                    <p>Déménagement</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-file-archive nav-icon"></i>
                                    <p>Bricolage</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a href="contact.php" class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                Messages
                             </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="avis.php" class="nav-link">
                            <i class="nav-icon fas fa-star"></i>
                            <p>
                                Avis
                             </p>
                        </a>
                    </li>


                </ul>
            </nav>

        </div>

    </aside>


