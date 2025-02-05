<?php include 'header.php';

if (isset($_GET['id']) && !empty($_GET['id'])){
    require_once 'db_connect.php';

    $id= $_GET['id'];
    $etat=1;

    $sql = "UPDATE contact SET deleted=? WHERE id=?";
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
                        <h3 class="card-title">Liste des contacts</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <table  class="table table-bordered table-striped dataTable" role="grid">
                                <thead>
                                <tr role="row"><th style="width: 414px;">Date message</th>
                                    <th  style="width: 520px;">Nom</th>
                                    <th  style="width: 520px;">Prénom</th>

                                    <th style="width: 520px;">Email</th>
                                    <th style="width: 520px;">Message</th>
                                    <th  style="width: 357px;">Action</th>



                                </thead>
                                <tbody>

                                <?php
                                require_once 'db_connect.php';
                                $result = $dbh->query("SELECT * FROM contact where deleted= 0 ORDER BY id desc ");

                                while ($client = $result->fetch()) {
                                    $dateMySQL=$client['date_msg'];




                                    ?>




                                    <tr role="row">
                                        <td><?= date("d/m/Y", strtotime($dateMySQL));?></td>
                                        <td><?= $client['nom']; ?></td>
                                        <td><?= $client['prenom']; ?></td>
                                        <td><?= $client['email']; ?></td>
                                        <td><?= $client['message']; ?></td>
                                        <td>


                                            <a onclick="return confirm('Etes-vous sûr de vouloir supprimer ce message ?');" href="contact.php?id=<?= $client['id'];?>" class="btn btn-outline bg-danger">
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
