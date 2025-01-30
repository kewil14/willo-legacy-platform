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

        global $dbh, $msg;
        $client_email = $_POST['email'];
        $client_tel = $_POST['tel'];

        $client_name = $_POST['nom'];
         $client_prenom = $_POST['prenom'];
        $client_message = $_POST['message'];

        $client_date_msg = date('c');


        $req = $dbh->prepare("INSERT INTO contact (nom, prenom, email, tel, message, date_msg) VALUES(:nom,:prenom,:email, :tel, :message, :date_msg)");

        $req->bindParam(':nom', $client_name, PDO::PARAM_STR_CHAR);
        $req->bindParam(':prenom', $client_prenom, PDO::PARAM_STR_CHAR);
        $req->bindParam(':email',  $client_email);
        $req->bindParam(':tel',  $client_tel);

        $req->bindParam(':message',  $client_message);
         $req->bindParam(':date_msg', $client_date_msg);

        $req->execute();


        if ($req) {

            $msg = '<div class="alert alert-success">Votre message a bien été envoyé!<br/>Nous vous contacterons dans les plus brefs délais</div>';

            $destinataires = "willo3233@yahoo.com";
            $sujet = "Vous avez reçu un nouveau message! ";

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
            $message = file_get_contents('email_contact.html');

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

			<section class="page_breadcrumbs template_breadcrumbs ds parallax">
				<div class="container-fluid">
					<div class="row">
						<div class="breadcrumbs_wrap col-lg-5 col-md-7 col-sm-8 text-right to_animate" data-animation="fadeInLeftLong">
							<div class="to_animate" data-animation="fadeInLeft" data-delay="500">
								<h2>Contact</h2>
							</div>

							<ol class="breadcrumb greylinks to_animate" data-animation="fadeInLeft" data-delay="400">
								<li>
									<a href="./">
										Accueil
									</a>
								</li>

								<li class="active">Contact</li>
							</ol>
						</div>
					</div>
				</div>
			</section>

			<section class="ls section_padding_100">
				<div class="container">
					<div class="row">

						<div class="col-sm-12 text-center">

							<div class="to_animate" data-animation="fadeInDown">

								<div class="framed-heading">
									<h2 class="section_header">
									 ENTRER EN CONTACT
									</h2>
								</div>

								<p>
                                    Vous cherchez une information ? Besoin de nous contacter? On vous explique tout.

                                </p>

                                <center><b>
                                        <?php if (!empty($msg)) {

                                            echo $msg;
                                        }?></b></center>

							</div>

							<form  method="post" data-animation="fadeInUp" action="<?=$_SERVER['PHP_SELF']?>">


								<div class="col-sm-6">
									<div class="form-group">

										<div class="input-group">
											<i class="flaticon-avatar highlight"></i>
											<input type="text" aria-required="true" size="30" value name="nom" id="name" class="form-control" placeholder="Nom">
										</div>
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-group">

										<div class="input-group">
											<i class="flaticon-avatar highlight"></i>
											<input type="text" aria-required="true" size="30" value name="prenom" id="name2" class="form-control" placeholder="Prénom">
										</div>
									</div>
								</div>

								<div class="col-sm-12">
									<div class="form-group">

										<div class="input-group">
											<i class="flaticon-envelope highlight"></i>
											<input type="email" aria-required="true" size="30" value name="email" id="email" class="form-control" placeholder="E-mail">
										</div>
									</div>
								</div>
                                <div class="col-sm-12">
                                    <div class="form-group">

                                        <div class="input-group">
                                            <i class="flaticon-phone-call highlight"></i>
                                            <input type="text" aria-required="true" size="30" value name="tel" id="email" class="form-control" placeholder="Téléphone (Facultatif)">
                                        </div>
                                    </div>
                                </div>
								<div class="col-sm-12">

									<div class="form-group">

										<div class="input-group">
											<i class="flaticon-edit highlight"></i>
											<textarea aria-required="true" rows="8" cols="45" name="message" id="message" class="form-control" placeholder="Votre message"></textarea>
										</div>
									</div>
								</div>

								<div class="col-sm-12">

									<div>
										<button type="submit" name="envoyer" class="theme_button color2">ENVOYER</button>
									</div>
								</div>


							</form>
						</div>

					</div>
				</div>
			</section>

 
			<section id="map" class="ls" data-address="sydney, australia, Liverpool street">
				<!-- marker description and marker icon goes here -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2829.6746459603737!2d-0.6723806837846228!3d44.82819248367431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd54d98ce2a802cd%3A0xcf2306b253e25c83!2s153%20Av.%20de%20la%20Somme%2C%2033700%20M%C3%A9rignac!5e0!3m2!1sfr!2sfr!4v1676457333875!5m2!1sfr!2sfr" width="100%" height="800" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </section>


<?php require_once 'footer.php'; ?>