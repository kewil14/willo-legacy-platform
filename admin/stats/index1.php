<?php 
include("count_visitors_class.php");

$stats = new Count_visitors;
require_once '../header.php';
require_once '../db_connect.php';

/*
$stmt = $dbh->prepare("SELECT  SUM(total_sales) as total, wp_885844_wc_customer_lookup.customer_id, wp_885844_wc_order_stats.date_created  
                               FROM wp_885844_wc_customer_lookup, wp_885844_wc_order_stats 
                               WHERE CAST(date_created AS DATE) = CAST( curdate() AS DATE) and wp_885844_wc_order_stats.customer_id=1");


$stmt->execute();
$recette = $stmt->fetch(PDO::FETCH_ASSOC);*/

// Fetch data from the database
$query = $dbh->prepare("SELECT  DAYOFWEEK(visit_date) as label, count(*) as nbre_visite  
                               FROM visits 
                               WHERE visit_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) GROUP BY DAY(visit_date) order by label asc");
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);

// Convert the data into a format that the chart can use
$labels = [];
$chartData = [];


foreach ($data as $row) {

    switch ($row['label']) {


        case 1:
            $row['label'] = 'Dim';
            break;
        case 2:
            $row['label'] = 'Lun';
            break;
        case 3:
            $row['label'] = 'Mar';
            break;
        case 4:
            $row['label'] = 'Mer';
            break;
        case 5:
            $row['label'] = 'Jeu';
            break;
        case 6:
            $row['label'] = 'Ven';
            break;
        case 7:
            $row['label'] = 'Sam';
            break;

    }

    array_push($labels, $row['label']);
    array_push($chartData, $row['nbre_visite']);
}
?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

                <center>
                    <div class="col-lg-6">
                        <div class="callout callout-danger">

                            <h5 class="card-title">Bonjour <b><?= $_SESSION['admin']['nom'];?></b></h5><br/><br/>

                            <a href="logout.php" style="color:red;float: left"> <i class="nav-icon fas fa-sign-out-alt"></i>
                                Se déconnecté</a>
                            <a href="../index.php" target="_blank" style="color:royalblue;"> <i class="nav-icon fas fa-eye"></i>
                                Voir mon site</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                        </div>


                    </div></center>






                <section class="content">
                    <div class="container-fluid">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Area Chart</h3>
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
                                <div class="chart">
                                    <div id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"><div class="uplot u-hz"><div class="u-wrap" style="width: 656px; height: 250px;"><div class="u-under" style="left: 50px; top: 17px; width: 581px; height: 183px;"></div><canvas width="656" height="250"></canvas><div class="u-over" style="left: 50px; top: 17px; width: 581px; height: 183px;"><div class="u-cursor-x u-off" style="transform: translate(-10px, 0px);"></div><div class="u-cursor-y u-off" style="transform: translate(0px, -10px);"></div><div class="u-select" style="left: 0px; width: 0px; top: 0px; height: 0px;"></div><div class="u-cursor-pt u-off" style="width: 5px; height: 5px; margin-left: -2.5px; margin-top: -2.5px; transform: translate(-10px, -10px); background: rgb(60, 141, 188); border-color: rgb(60, 141, 188);"></div><div class="u-cursor-pt u-off" style="width: 5px; height: 5px; margin-left: -2.5px; margin-top: -2.5px; transform: translate(-10px, -10px); background: rgb(193, 199, 209); border-color: rgb(193, 199, 209);"></div></div><div class="u-axis" style="top: 200px; height: 50px; left: 50px; width: 581px;"></div><div class="u-axis" style="left: 0px; width: 50px; top: 17px; height: 183px;"></div></div><table class="u-legend u-inline u-live"><tr class="u-series"><th><div class="u-marker"></div><div class="u-label">Value</div></th><td class="u-value">--</td></tr><tr class="u-series"><th><div class="u-marker" style="border: 2px solid rgb(60, 141, 188); background: rgba(60, 141, 188, 0.7);"></div><div class="u-label">Value</div></th><td class="u-value">--</td></tr><tr class="u-series"><th><div class="u-marker" style="border: 2px solid rgb(193, 199, 209); background: rgba(210, 214, 222, 0.7);"></div><div class="u-label">Value</div></th><td class="u-value">--</td></tr></table></div></div>
                                </div>
                            </div>

                        </div>


                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Line Chart</h3>
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
                                <div class="chart">
                                    <div id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"><div class="uplot u-hz"><div class="u-wrap" style="width: 656px; height: 250px;"><div class="u-under" style="left: 50px; top: 17px; width: 581px; height: 183px;"></div><canvas width="656" height="250"></canvas><div class="u-over" style="left: 50px; top: 17px; width: 581px; height: 183px;"><div class="u-cursor-x u-off" style="transform: translate(-10px, 0px);"></div><div class="u-cursor-y u-off" style="transform: translate(0px, -10px);"></div><div class="u-select" style="left: 0px; width: 0px; top: 0px; height: 0px;"></div><div class="u-cursor-pt u-off" style="width: 8.2px; height: 8.2px; margin-left: -4.1px; margin-top: -4.1px; transform: translate(-10px, -10px); background: rgb(60, 141, 188); border-color: rgb(60, 141, 188);"></div><div class="u-cursor-pt u-off" style="width: 8.2px; height: 8.2px; margin-left: -4.1px; margin-top: -4.1px; transform: translate(-10px, -10px); background: rgb(193, 199, 209); border-color: rgb(193, 199, 209);"></div></div><div class="u-axis" style="top: 200px; height: 50px; left: 50px; width: 581px;"></div><div class="u-axis" style="left: 0px; width: 50px; top: 17px; height: 183px;"></div></div><table class="u-legend u-inline u-live"><tr class="u-series"><th><div class="u-marker"></div><div class="u-label">Value</div></th><td class="u-value">--</td></tr><tr class="u-series"><th><div class="u-marker" style="border: 2px solid rgb(60, 141, 188); background: transparent;"></div><div class="u-label">Value</div></th><td class="u-value">--</td></tr><tr class="u-series"><th><div class="u-marker" style="border: 2px solid rgb(193, 199, 209); background: transparent;"></div><div class="u-label">Value</div></th><td class="u-value">--</td></tr></table></div></div>
                                </div>
                            </div>

                        </div>

                    </div>
                </section>









            </div>

        </div>
    </div>

    </div>

<?php require_once '../footer.php'; ?>