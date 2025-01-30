<?php include("count_visitors_class.php");

$stats = new Count_visitors;
require_once 'db_connect.php';

$liste_ip=array('2a01:cb18:a79:8','2a01:e0a:517:59','10.5.33.2','88.124.93.101','2a01:cb19:3f:6c',
    '2a01:cb19:3f:6c00:24d8:ff8b:22b3:811b','2a01:cb1a:4051:40fc:4cc6:db85:4777:9344','2a01:cb01:3020:f5e5:3f68:5a2a:622e:f23b','2a01:cb19:3f:6c00:25b3:d216:a156:1497','2a01:cb19:3f:6c00:5a1:aea1:45d1:909d');

$liste_ip_str ="";

foreach ($liste_ip as $ip) {
    $liste_ip_str .= "'" . $ip . "',";
}

$liste_ip_str = rtrim($liste_ip_str, ',');

$mois_precedent = date('m', strtotime('-1 month'));

$annee_precedente = date('Y', strtotime('-1 year'));


switch ($mois_precedent) {
    case 1:
        $nom_mois = "Janvier";
        break;
    case 2:
        $nom_mois = "Février";
        break;
    case 3:
        $nom_mois = "Mars";
        break;
    case 4:
        $nom_mois = "Avril";
        break;
    case 5:
        $nom_mois = "Mai";
        break;
    case 6:
        $nom_mois = "Juin";
        break;
    case 7:
        $nom_mois = "Juillet";
        break;
    case 8:
        $nom_mois = "Août";
        break;
    case 9:
        $nom_mois = "Septembre";
        break;
    case 10:
        $nom_mois = "Octobre";
        break;
    case 11:
        $nom_mois = "Novembre";
        break;
    case 12:
        $nom_mois = "Décembre";
        break;
    default:
        $nom_mois = "Mois inconnu";
}

/*
$stmt = $dbh->prepare("SELECT  SUM(total_sales) as total, wp_885844_wc_customer_lookup.customer_id, wp_885844_wc_order_stats.date_created
FROM wp_885844_wc_customer_lookup, wp_885844_wc_order_stats
WHERE CAST(date_created AS DATE) = CAST( curdate() AS DATE) and wp_885844_wc_order_stats.customer_id=1");


$stmt->execute();
$recette = $stmt->fetch(PDO::FETCH_ASSOC);*/

// Fetch data from the database
$query = $dbh->prepare("SELECT  DAYOFWEEK(visit_date) as label, count(*) as nbre_visite, ip_adr
FROM visits
WHERE visit_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) and ip_adr NOT IN ($liste_ip_str) GROUP BY DAY(visit_date)");
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);

// Convert the data into a format that the chart can use
$labels = [];
$chartData = [];


foreach ($data as $row) {

    switch ($row['label']) {


        case 1:
            $row['label'] = 'Dimanche';
            break;
        case 2:
            $row['label'] = 'Lundi';
            break;
        case 3:
            $row['label'] = 'Mardi';
            break;
        case 4:
            $row['label'] = 'Mercredi';
            break;
        case 5:
            $row['label'] = 'Jeudi';
            break;
        case 6:
            $row['label'] = 'Vendredi';
            break;
        case 7:
            $row['label'] = 'Samedi';
            break;

    }

    array_push($labels, $row['label']);
    array_push($chartData, $row['nbre_visite']);




}


// Fetch data from the database
$query = $dbh->prepare("SELECT HOUR(time) AS hour, COUNT(*) AS total_visits, client, ip_adr 
FROM visits WHERE CAST((visit_date) AS DATE) = CAST( curdate() AS DATE) and ip_adr NOT IN ($liste_ip_str)  GROUP BY hour;");
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);

// Convert the data into a format that the chart can use
$labelss = [];
$chartDatas = [];



foreach ($data as $row) {

    if ($row['hour']=='0'){
        $hour='00';
    array_push($labelss, $hour.'h');
    array_push($chartDatas, $row['total_visits']);
    }
    else{
        array_push($labelss, $row['hour'].'h');
        array_push($chartDatas, $row['total_visits']);

    }


}

$isMobile = $dbh->query("select count(*) from visits where ip_adr  NOT IN ($liste_ip_str) and client LIKE '%Mobile%'")->fetchColumn();

$isTablette = $dbh->query("select count(*) from visits where ip_adr  NOT IN ($liste_ip_str) and client  NOT LIKE '%Mobile%' and  client  NOT LIKE '%windows%'")->fetchColumn();

$isDesktop = $dbh->query("select count(*), ip_adr from visits where ip_adr  NOT IN ($liste_ip_str) and client LIKE '%windows%'")->fetchColumn();


//Stats instagram
$insta = $dbh->query("select instagram from clicks")->fetchColumn();

//stats facebook
$fb = $dbh->query("select facebook from clicks")->fetchColumn();

//stats phone:
$phone = $dbh->query("select phone from clicks")->fetchColumn();









//stats par mois

// Fetch data from the database
$query2 = $dbh->prepare("SELECT DAYOFMONTH(visit_date) as label, COUNT(*) as nbre_visite, ip_adr
FROM visits
WHERE MONTH(visit_date) = MONTH(CURDATE()) AND YEAR(visit_date) = YEAR(CURDATE()) AND ip_adr NOT IN ($liste_ip_str)
GROUP BY DAYOFMONTH(visit_date)");

$query2->execute();
$data2 = $query2->fetchAll(PDO::FETCH_ASSOC);

// Convert the data into a format that the chart can use
$label_month = [];
$chartData_month = [];

 foreach ($data2 as $row) {



     if ($row['label'] == date('d')) {
         $row['label'] = 'Aujourd\'hui';
     }

    array_push($label_month, $row['label']);
    array_push($chartData_month, $row['nbre_visite']);




}


 // stat dernier mois :

// Fetch data from the database
$queryLastMonth = $dbh->prepare("SELECT DAYOFMONTH(visit_date) as label, COUNT(*) as nbre_visite, ip_adr
FROM visits
WHERE
    (MONTH(visit_date) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)) AND YEAR(visit_date) = YEAR(CURDATE()))
    AND ip_adr NOT IN ($liste_ip_str)
GROUP BY DAYOFMONTH(visit_date)");

$queryLastMonth->execute();
$data = $queryLastMonth->fetchAll(PDO::FETCH_ASSOC);

// Convert the data into a format that the chart can use
$labelsLastMonth = [];
$chartDataLastMonth = [];


foreach ($data as $row) {



    array_push($labelsLastMonth, $row['label']);
    array_push($chartDataLastMonth, $row['nbre_visite']);




}


// stat année dernière :

// Fetch data from the database
$queryLastYear = $dbh->prepare("SELECT MONTH(visit_date) as label, COUNT(*) as nbre_visite, ip_adr
FROM visits
WHERE
    (YEAR(visit_date) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR)))
    AND ip_adr NOT IN ($liste_ip_str)
GROUP BY MONTH(visit_date)");


$queryLastYear->execute();
$dataLastYear = $queryLastYear->fetchAll(PDO::FETCH_ASSOC);

// Convert the data into a format that the chart can use
$labelsLastYear = [];
$chartDataLastYear = [];


foreach ($dataLastYear as $row) {



    array_push($labelsLastYear, $row['label']);
    array_push($chartDataLastYear, $row['nbre_visite']);




}

require_once 'header.php';

?>

<style>
    .chart-container {
        width: 50%;
        height: 50%;
        margin: auto;
    }
</style>

<body>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <center>
                <div class="col-lg-6 ">
                    <div class="callout callout-danger">

                        <h5 class="card-title">Bonjour <b><?= $_SESSION['admin']['nom'];?></b></h5><br/><br/>

                        <a href="logout.php" style="color:red;float: left"> <i class="nav-icon fas fa-sign-out-alt"></i>
                            Se déconnecté</a>
                        <a href="../../index.php" target="_blank" style="color:royalblue;"> <i class="nav-icon fas fa-eye"></i>
                            Voir mon site</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                    </div>





                </div>



            <div class="row">


                <div class="col-lg-3 col-6">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $stats->show_visits_today(); ?></h3>
                            <p>Visiteurs Aujourd'hui</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-eye"></i>
                        </div>
                        <a href="#" class="small-box-footer"> </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $stats->show_all_visits(); ?></h3>
                            <p>Nombre total de visiteurs</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer"> </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $insta ; ?></h3>
                            <p>Instagram</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-instagram"></i>
                        </div>
                        <a href="#" class="small-box-footer"> </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $phone ?></h3>
                            <p>Téléphone</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-iphone"></i>
                        </div>
                        <a href="#" class="small-box-footer"> </a>
                    </div>
                </div>



            </div>
            </center>

            <div class="row">

                <div class="col-md-6">



                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Nombre de visiteurs par heure pour <b>Aujourd'hui</b></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas id="chart2"></canvas>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">



                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Nombre de visiteus pour la <b>semaine dernière</b></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">

                            <canvas id="chart"></canvas>
                        </div>

                    </div>

                </div>

                <div class="col-md-6">



                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Appareil utilisé</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">

                            <canvas id="chart3"></canvas>
                        </div>

                    </div>

                </div>

                <div class="col-md-6">



                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Nombre de visiteurs  pour <b>Ce mois</b></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas id="chart4"></canvas>
                        </div>

                    </div>
                </div>





            </div>

             





        </div>
    </div>



    <script
            src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js">
    </script>
    <script>
        const ctx = document.getElementById("chart").getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Visiteurs par jour',
                    backgroundColor: 'rgba(161, 198, 247, 1)',
                    borderColor: 'rgb(47, 128, 237)',
                    borderWidth: 1,

                    data: <?php echo json_encode($chartData); ?>
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                }
            },
        });

    </script>

    <script>
        const ctxx = document.getElementById("chart2").getContext('2d');
        const myChartx = new Chart(ctxx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labelss); ?>,
                datasets: [{
                    label: 'Visiteurs par heure',
                    backgroundColor: 'rgba(161, 198, 247, 1)',
                    borderColor: 'rgb(47, 128, 237)',
                    borderWidth: 1,

                    data: <?php echo json_encode($chartDatas); ?>
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                }
            },
        });

    </script>

    <script>
        const ctx2 = document.getElementById("chart3").getContext('2d');
        const myChart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ["Mobile", "Tablette", "Bureau"],
                datasets: [{
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    data: [<?= $isMobile; ?>, <?= $isTablette; ?>, <?= $isDesktop; ?>],
                }]
            },
        });
    </script>

    <script>
        const ctx_m = document.getElementById("chart4").getContext('2d');
        const myChart_mois = new Chart(ctx_m, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($label_month); ?>,
                datasets: [{
                    label: 'Visiteurs',
                    backgroundColor: 'rgba(161, 198, 247, 1)',
                    borderColor: 'rgb(47, 128, 237)',
                    borderWidth: 1,

                    data: <?php echo json_encode($chartData_month); ?>
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                }
            },
        });

    </script>


    <script>
        const ctx3 = document.getElementById("chartLastMonth").getContext('2d');
        const myChartLastMonth = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labelsLastMonth); ?>,
                datasets: [{
                    label: 'Visiteurs par jour',
                    backgroundColor: 'rgba(161, 198, 247, 1)',
                    borderColor: 'rgb(47, 128, 237)',
                    borderWidth: 1,

                    data: <?php echo json_encode($chartDataLastMonth); ?>
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                }
            },
        });

    </script>

    <script>
        const ctx4 = document.getElementById("chartLastYear").getContext('2d');
        const myChartLastYear = new Chart(ctx4, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labelsLastYear); ?>,
                datasets: [{
                    label: 'Visiteurs par mois',
                    backgroundColor: 'rgba(161, 198, 247, 1)',
                    borderColor: 'rgb(47, 128, 237)',
                    borderWidth: 1,

                    data: <?php echo json_encode($chartDataLastYear); ?>
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                }
            },
        });

    </script>


    <?php require_once 'footer.php'; ?>


