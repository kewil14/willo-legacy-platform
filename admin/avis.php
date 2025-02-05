<?php include 'header.php';


if (isset($_GET['app']) && !empty($_GET['app'])){
    require_once 'db_connect.php';

    $id= $_GET['app'];
    $etat=1;

    $sql = "UPDATE avis SET etat=? WHERE id=?";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([$etat, $id]);



}
 else if (isset($_GET['dec']) && !empty($_GET['dec'])) {

     require_once 'db_connect.php';

     $id = $_GET['dec'];
     $etat = 3;

     $sql = "UPDATE avis SET etat=? WHERE id=?";
     $stmt = $dbh->prepare($sql);
     $stmt->execute([$etat, $id]);


 }

?>











<!-- Content Wrapper. Contains page content -->
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
            <div class="row">



                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Avis de clients</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <table   class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th   aria-controls="example1" rowspan="1" colspan="1"   style="width: 414px;">#ID</th>

                                    <th   aria-controls="example1" rowspan="1" colspan="1"   style="width: 414px;">Date avis</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 520px;">Nom</th>

                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 520px;">Avis</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 466px;">Score</th>


                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                require_once 'db_connect.php';

                                $result = $dbh->query("SELECT *, DATE_FORMAT(date_avis, '%d/%m/%Y') AS date_formattee FROM avis where etat!=3 ORDER BY id desc");

                                while ($client = $result->fetch()) {

                                    $dateMySQL=$client['date_avis'];


                                    ?>




                                    <tr role="row" class="odd">
                                        <td><?= $client['id']; ?></td>
                                        <td><?= $client['date_formattee'];?></td>
                                        <td><?= $client['nom']; ?></td>
                                        <td><?= $client['avis']; ?></td>
                                        <td><?= $client['sg']; ?></td>



                                        <td>


                                            <?php if ($client['etat']!=1){ ?>
                                            <a href="avis.php?app=<?= $client['id'];?>" class="btn btn-outline bg-success">
                                                 <i class="fas fa-heart"></i>
                                            </a>

                                            <a href="avis.php?dec=<?= $client['id'];?>" class="btn btn-outline bg-danger">
                                                 <i class="fas fa-heart-broken"></i>
                                            </a>
                                        <?php }?>
                                        </td>
                                    </tr>
                                <?php }?>

                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
            </div>
        </div>
    </div>
</div>




<?php include 'footer.php'; ?>
