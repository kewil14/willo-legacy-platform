<?php include 'header.php';

if (isset($_GET['id']) && !empty($_GET['id'])){
    require_once 'db_connect.php';

    $id= $_GET['id'];
    $etat=1;

    $sql = "UPDATE devis_dem SET deleted=? WHERE id=?";
    $stmt= $dbh->prepare($sql);
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
                        <h3 class="card-title">Coordonnées des clients : Demande de devis pour déménagement</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 414px;">ID</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 414px;">Date demande</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 520px;">Nom</th>

                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 520px;">Email</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 466px;">Téléphone</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 466px;">Adresse</th>

                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 357px;">Adresse de départ - code postale</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 357px;">Adresse d'arrivée - code postale</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 357px;">Volume</th>

                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 357px;">Date de déménagement</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 357px;">Action</th>


                                 </thead>
                                <tbody>

                                <?php
                                require_once 'db_connect.php';
                                $result = $dbh->query("SELECT *, DATE_FORMAT(date_devis, '%d/%m/%Y') AS date_formattee FROM devis_dem where deleted= 0 ORDER BY  id desc ");

                                while ($client = $result->fetch()) {
                                    $dateMySQL=$client['date_devis'];

                                    $dateMySQL2=$client['date_dem'];





                                    ?>




                                    <tr role="row" class="odd">
                                        <td class="sorting_1"><?= $client['id'];?></td>
                                        <td class="sorting_1"><?= $client['date_formattee'];?></td>
                                        <td><?= $client['nom']; ?></td>
                                        <td><?= $client['email']; ?></td>

                                        <td><?= $client['tel']; ?></td>
                                        <td><?= $client['adresse']; ?></td>
                                        <td><?= $client['ville_depart']; ?></td>
                                        <td><?= $client['ville_arrivee']; ?></td>
                                        <td><?= $client['Volume']; ?>m<sup>3</sup></td>

                                        <td><?=  date("d/m/Y", strtotime($dateMySQL2));?></td>
                                        <td>


                                             <a onclick="return confirm('Etes-vous sûr de vouloir supprimer le devis ?');" href="devisdem.php?id=<?= $client['id'];?>" class="btn btn-outline bg-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
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
