<?php require_once 'header.php';


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

        global $dbh, $msgiso;
        $client_email = $_POST['email'];
        $client_name = $_POST['nom'];
        $client_tel = $_POST['tel'];
        $client_cp = '00000';
        $client_date_dem = $_POST['date_dem'];
        $client_volume = $_POST['volume'];
        $client_villeDepart = $_POST['villeDepart'];
        $client_villeArrivee = $_POST['villeArrivee'];
        $client_adresse = $_POST['adresse'];

        $client_devis = date('c');


        $req = $dbh->prepare("INSERT INTO devis_dem (nom, date_devis, date_dem, email, tel, adresse, ville_depart, ville_arrivee, volume, cp) VALUES(:nom,:date_devis,:date_dem, :email,:tel,:adresse,:villeDepart,:villeArrivee, :volume, :cp)");

        $req->bindParam(':nom', $client_name, PDO::PARAM_STR_CHAR);
        $req->bindParam(':date_devis', $client_devis);

        $req->bindParam(':email', $client_email);
        $req->bindParam(':tel', $client_tel);
        $req->bindParam(':cp', $client_cp);
        $req->bindParam(':volume', $client_volume);
        $req->bindParam(':adresse', $client_adresse);
        $req->bindParam(':villeDepart', $client_villeDepart);
        $req->bindParam(':villeArrivee', $client_villeArrivee);

        $req->bindParam(':date_dem', $client_date_dem);

        $req->execute();


        if ($req) {

            $msgiso = '<div class="alert alert-success">Votre demande de devis a bien été envoyé!<br/>Nous vous contacterons dans les plus brefs délais</div>';
            $destinataires = "willo3233@yahoo.com";
            $sujet = "Vous avez reçu une demande de devis! ";

            // Version MINE
            $entetes = "MIME-Version: 1.0\n";

            // en-têtes expéditeur
            $entetes .= "From : radhouene-b@hotmail.fr\n";


            // priorité urgente
            $entetes .= "X-Priority : 1\n";

            // type de contenu HTML
            $entetes .= "Content-type: text/html; charset=utf-8\n";

            // code de transportage
            $entetes .= "Content-Transfer-Encoding: 8bit\n";

            // message HTML
            $message = file_get_contents('email_devis.html');

            mail($destinataires, $sujet, $message, $entetes);
        } else {
            $msgiso = '<span style="color: red">Error</span>';

        }

        // Fermeture du curseur
        $req->closeCursor();


    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

}
$m3='m<sup>3</sup>';
?>




			<section class="page_breadcrumbs template_breadcrumbs ds parallax">
				<div class="container-fluid">
					<div class="row">
						<div class="breadcrumbs_wrap col-lg-5 col-md-7 col-sm-8 text-right to_animate" data-animation="fadeInLeftLong">
							<div class="to_animate" data-animation="fadeInLeft" data-delay="500">
								<h2>Demande de devis</h2>
							</div>

							<ol class="breadcrumb greylinks to_animate" data-animation="fadeInLeft" data-delay="400">
								<li>
									<a href="./">
										Accueil
									</a>
								</li>
								<li>
									<a href="#">Déménagement</a>
								</li>
								<li class="active">Devis</li>
							</ol>
						</div>
					</div>
				</div>
			</section>

			<section class="ls section_padding_top_100 section_padding_bottom_75 columns_margin_bottom_30">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<div class="framed-heading">
								<h2 class="section_header">
									Devis pour un déménagement
								</h2>
							</div>
							<p>
                                Veuillez remplir les informations suivantes et appuyer sur le bouton ENVOYER. Il n'est pas nécessaire de remplir le formulaire en entier ; cependant,
                                cela aide à améliorer l'exactitude du devis que vous recevrez</p>


                            <center><b>
                                    <?php if (!empty($msgiso)) {

                                        echo $msgiso;
                                    }?></b></center>

							<form class="quote-form row topmargin_40" method="post">

								<div class="col-sm-6">

									<h3 class="entry-title">Vos informations</h3>

									<div class="bottommargin_10">
										<label for="quote-first-name" class="sr-only">Nom et prénom
											<span class="required">*</span>
										</label>
										<div class="input-group">
											<i class="flaticon-avatar highlight"></i>
											<input type="text" aria-required="true" size="30" name="nom" value  id="quote-first-name" class="form-control" required placeholder="Nom et prénom">
										</div>
									</div>

									<div class="bottommargin_10">
										<label for="quote-last-name" class="sr-only">Date de déménagement
											<span class="required">*</span>
										</label>
										<div class="input-group">
											<i class="flaticon-paper-plane highlight"></i>
											<input type="text" aria-required="true" size="30" value name="date_dem" id="quote-last-name" class="form-control" required onfocus="(this.type='date')" placeholder="Date de déménagement">
										</div>
									</div>

									<div class="bottommargin_10">
										<label for="quote-email" class="sr-only">E-mail
											<span class="required">*</span>
										</label>
										<div class="input-group">
											<i class="flaticon-envelope highlight"></i>
											<input type="text" aria-required="true" size="30" value name="email" id="quote-email" class="form-control" required placeholder="E-mail">
										</div>
									</div>



									<div class="bottommargin_10">
										<label for="quote-mobile-phone" class="sr-only">Téléphone</label>
										<div class="input-group">
											<i class="flaticon-phone-call highlight"></i>
											<input type="text" size="30" value name="tel" id="quote-mobile-phone" class="form-control" required placeholder="Téléphone">
										</div>
									</div>





								</div>

								<div class="col-sm-6">

									<h3 class="entry-title">Informations de déménagement</h3>
                                    <div class="bottommargin_10">
                                        <label for="quote-sender-place" class="sr-only">Adresse Actuelle</label>
                                        <div class="input-group">
                                            <i class="flaticon-truck highlight"></i>
                                            <input type="text" size="30" value name="adresse" id="quote-sender-place" class="form-control" placeholder="Adresse Actuelle" required>
                                        </div>
                                    </div>

									<div class="bottommargin_10">
										<label for="quote-sender-place" class="sr-only">Ville de départ</label>
										<div class="input-group">
											<i class="flaticon-truck highlight"></i>
											<input type="text" size="30" value name="villeDepart" id="quote-sender-place" class="form-control" placeholder="Adresse de départ - Code Postale" required>
										</div>
									</div>

									<div class="bottommargin_10">
										<label for="quote-receiver-place" class="sr-only">Ville d'arrivée</label>
										<div class="input-group">
											<i class="flaticon-truck-1 highlight"></i>
											<input type="text" size="30" value name="villeArrivee" id="quote-receiver-place" class="form-control" placeholder="Adresse d'arrivée  - Code Postale" required>
										</div>
									</div>



									<div class="bottommargin_10">
										<label for="quote-town" class="sr-only">Volume (m<sup>3</sup>)</label>
										<div class="input-group">
											<i class="flaticon-package highlight"></i>
											<input type="text" size="30" value name="volume" id="quote-town" class="form-control" placeholder="Volume (m3) (Facultatif)">
										</div>
									</div>




								</div>


								<div class="col-sm-12 text-center">
									<button type="submit" id="quote_submit"  name="envoyer" class="theme_button color2 topmargin_10">ENVOYER</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</section>

	<?php require_once 'footer.php'; ?>