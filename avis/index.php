<?php

$msg = '';
$result = false;

if(isset($_POST['envoyer'])) {



    $host='localhost';
    $db = '';
    $username = 'root';
    $password = '';

    $dsn = "mysql:host=$host;dbname=$db";

    try {
        // create a PDO connection with the configuration data
        $dbh = new PDO($dsn, $username, $password);


    extract($_POST);

        global $dbh, $msg;
         $client_nom = $_POST['nom'];
        $client_ville = $_POST['ville'];
        $client_avis = $_POST['avis'];
        $client_avatar = $_POST['avatar'];

        $qualite = $_POST['qualite'];
        $service = $_POST['service'];
        $support = $_POST['support'];
        $sg = $_POST['sg'];
        $prestation  = $_POST['prestation'];

        $client_date_avis = date('c');


        $req = $dbh->prepare("INSERT INTO avis (date_avis, nom, avis, etat, avatar, service, qualite, support, sg, ville, prestation) VALUES(:date_avis,:nom,:avis,'0', :avatar, :service, :qualite, :support, :sg, :ville, :prestation)");

        $req->bindParam(':date_avis', $client_date_avis);
        $req->bindParam(':nom', $client_nom);
        $req->bindParam(':avis', $client_avis);
        $req->bindParam(':avatar', $client_avatar);
        $req->bindParam(':service', $service);
        $req->bindParam(':qualite', $qualite);
        $req->bindParam(':support', $support);
        $req->bindParam(':sg', $sg);
        $req->bindParam(':ville', $client_ville);
        $req->bindParam(':prestation', $prestation);

        $req->execute();


        if ($req) {

            $msg = '<div class="alert alert-success">Votre avis a bien été envoyé!<br/>Merci!</div>';

            $destinataires = "willo3233@yahoo.com";
            $sujet = "Vous avez reçu un nouveau avis";

            // Version MINE
            $entetes = "MIME-Version: 1.0\n";

            // en-têtes expéditeur
            $entetes .= "From : ne-pas-repondre@xn--dmnagementetbrico-btbb.fr\n";


            // priorité urgente
            $entetes .= "X-Priority : 1\n";

            // type de contenu HTML
            $entetes .= "Content-type: text/html; charset=utf-8\n";

            // code de transportage
            $entetes .= "Content-Transfer-Encoding: 8bit\n";

            // message HTML
            $message = file_get_contents('email_avis.html');

            mail($destinataires, $sujet, $message, $entetes);
        } else {
            $msg = '<span style="color: red">Error</span>';

        }

        // Fermeture du curseur
        $req->closeCursor();


    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }


}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Avis des client</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.html">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.html">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.html">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.html">

    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="fontello/css/fontello.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body>

<!--  end Preloader -->

<div class="stretchMe" data-stretch="img/main-bg.jpg">
	<header>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 col-xs-3" id="logo">
 			</div>
			<div class="btn-responsive-menu">
				<span class="bar"></span><span class="bar"></span><span class="bar"></span>
			</div>
			<nav class="col-md-8 col-xs-9" id="top-nav">
			<ul>
				<li><a href="../index.php">Retourner au site</a></li>
				<li><a href="../devis.php">Demander un devis pour déménagement </a></li>
 			</ul>
			</nav><!-- End Nav -->
		</div><!-- End row -->
	</div><!-- End container -->
	</header><!-- End header -->

			<div class="col-md-12 main-title">
				<h1>Nous apprécions  <span>Votre avis</span></h1><br/>
				<p>
                    Aidez-nous à améliorer notre service et la satisfaction de nos clients
				</p>
			</div>

			<section class="container" id="main">
			<!-- Start Review container -->
			<div id="review_container">
				<div id="top-wizard">
					<strong>Progres <span id="location"></span></strong>
					<div id="progressbar"></div>
					<div class="shadow"></div>
				</div><!-- end top-wizard -->

				<form method="POST">
					<div id="middle-wizard">

						<div class="step">
							<div class="row">
								<div class="col-md-3">
									<p class="visible-lg visible-md">
										<img src="img/step_1.png" width="90" height="90" alt="" data-retina="true">
									</p>
									<p class="lead">
										Votre avis nous intéresse!.
									</p>
									<p>
 									</p>
								</div>

								<div class="col-md-4 col-md-offset-1">
									<h4>Vos informations</h4>
									<ul class="data-list">
										<li>
										<li><input type="text" name="nom" id="fullname" class="required form-control" placeholder="Votre Nom*"></li>

										<li><input type="text" name="ville" id="city" class="required form-control" placeholder="Votre ville *"></li>

                                        <li>
                                            <div class="styled-select">
                                                <select class="form-control required" name="prestation">
                                                    <option value="" disabled selected>Service *</option>
                                                    <option value="Déménagement">Déménagement</option>
                                                    <option value="Bricolage">Bricolage</option>
                                                </select>
                                            </div>
                                        </li>
									</ul>
                                    <input id="website" name="website" type="text" value=""><!-- Leave for security protection, read docs for details -->

                                    <center><b>
                                            <?php if (!empty($msg)) {

                                                echo $msg;
                                            }?></b></center>
								</div>

								<div class="col-md-4">
									<h4>Choisir votre avatar</h4>
									<div class="avatar-selector">
										<ul class="data-list-2">
											<li><input id="avatar_1" type="radio" name="avatar" value="avatar_1" class="required"><label class="avatar-img avatar_1" for="avatar_1" data-retina="true"></label></li>
											<li><input id="avatar_2" type="radio" name="avatar" value="avatar_2" class="required"><label class="avatar-img avatar_2" for="avatar_2" data-retina="true"></label></li>
											<li><input id="avatar_3" type="radio" name="avatar" value="avatar_3" class="required"><label class="avatar-img avatar_3" for="avatar_3" data-retina="true"></label></li>
											<li><input id="avatar_4" type="radio" name="avatar" value="avatar_4" class="required"><label class="avatar-img avatar_4" for="avatar_4" data-retina="true"></label></li>
											<li><input id="avatar_5" type="radio" name="avatar" value="avatar_5" class="required"><label class="avatar-img avatar_5" for="avatar_5" data-retina="true"></label></li>
											<li><input id="avatar_6" type="radio" name="avatar" value="avatar_6" class="required"><label class="avatar-img avatar_6" for="avatar_6" data-retina="true"></label></li>
											<li><input id="avatar_7" type="radio" name="avatar" value="avatar_7" class="required"><label class="avatar-img avatar_7" for="avatar_7" data-retina="true"></label></li>
											<li><input id="avatar_8" type="radio" name="avatar" value="avatar_8" class="required"><label class="avatar-img avatar_8" for="avatar_8" data-retina="true"></label></li>
											<li><input id="avatar_9" type="radio" name="avatar" value="avatar_9" class="required"><label class="avatar-img avatar_9" for="avatar_9" data-retina="true"></label></li>
											<li><input id="avatar_10" type="radio" name="avatar" value="avatar_10" class="required"><label class="avatar-img avatar_10" for="avatar_10" data-retina="true"></label></li>
											<li><input id="avatar_11" type="radio" name="avatar" value="avatar_11" class="required"><label class="avatar-img avatar_11" for="avatar_11" data-retina="true"></label></li>
											<li><input id="avatar_12" type="radio" name="avatar" value="avatar_12" class="required"><label class="avatar-img avatar_12" for="avatar_12" data-retina="true"></label></li>
											<li><input id="avatar_13" type="radio" name="avatar" value="avatar_13" class="required"><label class="avatar-img avatar_13" for="avatar_13" data-retina="true"></label></li>
											<li><input id="avatar_14" type="radio" name="avatar" value="avatar_14" class="required"><label class="avatar-img avatar_14" for="avatar_14" data-retina="true"></label></li>
											<li><input id="avatar_15" type="radio" name="avatar" value="avatar_15" class="required"><label class="avatar-img avatar_15" for="avatar_15" data-retina="true"></label></li>
											<li><input id="avatar_16" type="radio" name="avatar" value="avatar_16" class="required"><label class="avatar-img avatar_16" for="avatar_16" data-retina="true"></label></li>
										</ul>
									</div>
								</div>

							</div><!-- end row -->
						</div><!-- end step-->

						<div class="step">
							<div class="row">

								<div class="col-md-3">
                                <p class="visible-lg visible-md">
										<img src="img/step_2.png" width="90" height="90" alt="" data-retina="true">
									</p>
									<p class="lead">
										Votre avis nous intéresse!.
									</p>
									<p>

									</p>
								</div>

								<div class="col-md-8 col-md-offset-1">
									<div class="rating_wp clearfix">
										<label class="rating_type">Service</label>
										<span class="rating">
										<input type="radio" class="required rating-input" id="rating-input-1-5" name="service" value="5"><label for="rating-input-1-5" class="rating-star"></label>
										<input type="radio" class="required rating-input" id="rating-input-1-4" name="service" value="4"><label for="rating-input-1-4" class="rating-star"></label>
										<input type="radio" class="required rating-input" id="rating-input-1-3" name="service" value="3"><label for="rating-input-1-3" class="rating-star"></label>
										<input type="radio" class="required rating-input" id="rating-input-1-2" name="service" value="2"><label for="rating-input-1-2" class="rating-star"></label>
										<input type="radio" class="required rating-input" id="rating-input-1-1" name="service" value="1"><label for="rating-input-1-1" class="rating-star"></label>
										</span>
									</div>
									<div class="rating_wp clearfix">
										<label class="rating_type">Qualité</label>
										<span class="rating">
										<input type="radio" class="required rating-input" id="rating-input-2-5" name="qualite" value="5 Stars"><label for="rating-input-2-5" class="rating-star"></label>
										<input type="radio" class="required rating-input" id="rating-input-2-4" name="qualite" value="4 Stars"><label for="rating-input-2-4" class="rating-star"></label>
										<input type="radio" class="required rating-input" id="rating-input-2-3" name="qualite" value="3 Stars"><label for="rating-input-2-3" class="rating-star"></label>
										<input type="radio" class="required rating-input" id="rating-input-2-2" name="qualite" value="2 Stars"><label for="rating-input-2-2" class="rating-star"></label>
										<input type="radio" class="required rating-input" id="rating-input-2-1" name="qualite" value="1 Star"><label for="rating-input-2-1" class="rating-star"></label>
										</span>
									</div>
									<div class="rating_wp clearfix">
										<label class="rating_type">Support</label>
										<span class="rating">
										<input type="radio" class="required rating-input" id="rating-input-3-5" name="support" value="5"><label for="rating-input-3-5" class="rating-star"></label>
										<input type="radio" class="required rating-input" id="rating-input-3-4" name="support" value="4"><label for="rating-input-3-4" class="rating-star"></label>
										<input type="radio" class="required rating-input" id="rating-input-3-3" name="support" value="3"><label for="rating-input-3-3" class="rating-star"></label>
										<input type="radio" class="required rating-input" id="rating-input-3-2" name="support" value="2"><label for="rating-input-3-2" class="rating-star"></label>
										<input type="radio" class="required rating-input" id="rating-input-3-1" name="support" value="1"><label for="rating-input-3-1" class="rating-star"></label>
										</span>
									</div>
									<div class="rating_wp clearfix">
										<label class="rating_type">Satisfaction générale</label>
										<span class="rating">
										<input type="radio" class="required rating-input" id="rating-input-4-5" name="sg" value="5"><label for="rating-input-4-5" class="rating-star"></label>
										<input type="radio" class="required rating-input" id="rating-input-4-4" name="sg" value="4"><label for="rating-input-4-4" class="rating-star"></label>
										<input type="radio" class="required rating-input" id="rating-input-4-3" name="sg" value="3"><label for="rating-input-4-3" class="rating-star"></label>
										<input type="radio" class="required rating-input" id="rating-input-4-2" name="sg" value="2"><label for="rating-input-4-2" class="rating-star"></label>
										<input type="radio" class="required rating-input" id="rating-input-4-1" name="sg" value="1"><label for="rating-input-4-1" class="rating-star"></label>
										</span>
									</div>
								</div>
							</div><!-- end row -->
						</div><!-- end step-->

						<div class="step">
							<div class="row">
								<div class="col-md-3">
                                <p class="visible-lg visible-md">
										<img src="img/step_3.png" width="90" height="90" alt="" data-retina="true">
									</p>
									<p class="lead">
										Votre avis nous intéresse!.
									</p>
									<p>


									</p>
								</div>
								<div class="col-md-8 col-md-offset-1">
									<h4>Votre avis</h4>
									<div style="position:relative">
										<textarea name="avis" id="review" class="form-control required" style="height:250px;" placeholder="Ecrire ici votre avis..."></textarea>
									</div>
								</div>
							</div><!-- end row -->
						</div><!-- end step-->

						<div class="submit step" id="complete">
							<i class="icon-check"></i>
							<h3>Merci pour votre temps!.</h3>
							<button type="submit" name="envoyer" class="submit">Envoyer votre avis</button>
						</div><!-- end submit step -->

					</div><!-- end middle-wizard -->

					<div id="bottom-wizard">
						<button type="button" name="backward" class="backward">Précédent</button>
						<button type="button" name="forward" class="forward">Suivant </button>
					</div><!-- end bottom-wizard -->

				</form>
			</div><!-- end Review container -->
			<div class="bt_more"><a href="#anchor_1" class="animated flash"><i class="icon-angle-double-down"></i></a></div>
			</section><!-- end section main container -->


</div><!-- End background image -->

<div class="container">

	<div class="row add_top_60">
		<div class="col-md-12">
			<h3>Les avis de nos clients<span>

 		</div>
	</div><!-- end row -->


    <?php
    require_once 'db_connect.php';

    $limit =5;
    $start = 0;
    $page=1;

    if(isset($_GET['page']))
    {
        $page = intval($_GET['page']);
        $start=($page-1)*$limit;
    }

    $result = $dbh->query("SELECT * FROM avis where etat=1 ORDER BY  date_avis desc LIMIT $start, $limit ");




    $row_count = $dbh->query("SELECT * FROM avis where etat=1 ");
    $nbre_avis=$row_count->rowCount();

    $total=ceil($nbre_avis/$limit);
    if (is_numeric($page) && $page>0 && $page<=$total){

    while ($avis = $result->fetch()) {


    ?>
	<div class="row add_bottom_30">
    	<div class="col-md-3" >
        <div class="review_summary_wp">
        	<div class="review_summary">
            	<h3><span><?= $avis['sg']; ?><small>/5</small></span>Score</h3>
                <?php {
                    switch ($avis['sg']) {

                        case 1 : echo '<i class = "icon-star"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i></span>';break;
                        case 2 : echo '<i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i></span>';break;
                        case 3 : echo '<i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i></span>';break;
                        case 4 : echo '<i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star-empty"></i></span>';break;
                        case 5 : echo '<i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i></span>';break;


                    } }?>            </div>
            </div>
        </div>
        <div class="col-md-9" >
        <div class="review_desc">
        	<div class="row">
            <div class="col-lg-9 col-md-8">
                <div class="media">
                	<img src="img/avatar/<?= $avis['avatar']; ?>" width="60" height="60" alt="Avatar" class="pull-left">
                 <div class="media-body">
                 		<h4><?= $avis['nom']; ?><small> <?= $avis['ville']; ?></small></h4>
                 	<span class="date_posted"><i class=" icon-calendar-3"></i> <?php
                        $dateMySQL=$avis['date_avis'];
                        echo date("d/m/Y", strtotime($dateMySQL)); ?></span>
                     </div>
                   </div>
                 <blockquote>"<?= $avis['avis']; ?>"</blockquote>
                </div>

                <div class="col-lg-3 col-md-4">
                		<div class="review_details">
                        	<span><h6>Service</h6>

                                <?php {
                                    switch ($avis['service']) {

                                        case 1 : echo '<i class = "icon-star"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i></span>';break;
                                        case 2 : echo '<i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i></span>';break;
                                        case 3 : echo '<i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i></span>';break;
                                        case 4 : echo '<i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star-empty"></i></span>';break;
                                        case 5 : echo '<i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i></span>';break;


                                    } }?>
                                    <span><h6>Qualité</h6>

        <?php {
        switch ($avis['qualite']) {

            case 1 : echo '<i class = "icon-star"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i></span>';break;
            case 2 : echo '<i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i></span>';break;
            case 3 : echo '<i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i></span>';break;
            case 4 : echo '<i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star-empty"></i></span>';break;
            case 5 : echo '<i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i></span>';break;


        } }?>

        <span class="last"><h6>Support</h6>

        <?php {
        switch ($avis['support']) {

            case 1 : echo '<i class = "icon-star"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i></span>';break;
            case 2 : echo '<i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i></span>';break;
            case 3 : echo '<i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star-empty"></i><i class = "icon-star-empty"></i></span>';break;
            case 4 : echo '<i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star-empty"></i></span>';break;
            case 5 : echo '<i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i><i class = "icon-star"></i></span>';break;


        }} ?>                        </div>
                </div>
            </div><!-- end row -->
        </div>
        </div>
		</div><!-- end row -->




    <?php } ?>

            <center>
    <!-- paginator -->
    <div class="col-12">
        <ul class="pagination">


            <?php if ($page>1){ ?>
                <li class="page-item">
                    <a href="index.php?page=<?= $page-1 ?>"><i class="icon ion-ios-arrow-back"></i><< Précédent</a>
                </li>
            <?php } ?>
            <?php    for ($i=1; $i <= $total ; $i++){

                ?>

                <li <?php if ($page==$i){echo 'class="active"';} else {echo 'class="page-item"'; } ?>><a href="index.php?page=<?= $i ?>"><?= $i?></a></li>


            <?php }?>
            <?php if ($page<$total){ ?>
                <li class="page-item">
                    <a href="index.php?page=<?= $page+1 ?>"><i class="icon ion-ios-arrow-forward">Suivant >></i></a>
                </li>

            <?php }?>

        </ul>
    </div>
    <!-- end paginator -->

            </center>

    <?php } ?>


	<div class="divider"></div>





    </div><!-- end container -->


    <div class="container">






        </div><!-- End container -->
    </section><!-- End main_content -->
	</div><!-- end container -->

<footer>
<section class="container">
<div class="row">
	<div class="col-md-4">
		<h3>Qui sommes nous</h3>
		<p>
            Située à la zone de Mérignac, Willo déménagement et Brico est une entreprise de déménagement professionnelle et compétente œuvrant pour le compte des particuliers et des entreprises.
	</p>
	</div>
	<div class="col-md-4" id="contact">
		<h3>Nos coordonnées</h3>

		<ul>
			<li><i class="icon-home"></i> 153 avenue de la somme, 33700 Mérignac </li>
			<li><i class="icon-phone"></i> Téléphone: 06 50 21 11 97 </li>
			<li><i class="icon-email"></i> Email: <a href="mailto:willo3233@yahoo.com">willo3233@yahoo.com </a></li>
 		</ul>
	</div>

</div><!-- end row -->
</section>


</footer><!-- End footer -->

    <!-- Scroll to top -->
	<div id="toTop"><i class="icon-up-open"></i></div>

    <!-- Jquery -->
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui-1.8.22.min.js"></script>
    <script src="js/jquery.anystretch.min.js"></script>

    <!-- OTHER JS -->
    <script src="js/jquery.wizard.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/jquery.placeholder.js"></script>
    <script src="js/jquery.tweet.min.js"></script>
	<script src="js/jquery.bxslider.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/retina-replace.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/functions.js"></script>
  </body>
</html>
