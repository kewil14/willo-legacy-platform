<?php require_once 'header.php';

$clientid='Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)';

if ($_SERVER['HTTP_USER_AGENT']==$clientid){

    header('Location :https://google.com');
}

include("count_visitors_class.php"); //classes is the map where the class file is stored

// create a new instance of the count_visitors class.
$my_visitors = new Count_visitors;

$my_visitors->delay = 1; // how often (in hours) a visitor is registered in the database (default = 1 hour)
$my_visitors->insert_new_visit(); // That's all, the validation is with this method, too.
// Votre clé secrète reCAPTCHA


?>

			<section class="intro_section page_mainslider">
				<div class="flexslider">
					<ul class="slides">
						<li class="cs">
							<img src="img/slide01.jpg" alt>
							<div class="bg_overlay">
								<div class="frame"></div>
							</div>
							<div class="container">
								<div class="row">
									<div class="col-sm-12">
										<div class="slide_description_wrapper">
											<div class="slide_description">
												<div class="intro-layer to_animate" data-animation="fadeInLeft">
													<p class="big">
                                                        Déménagement à partir de 35€ le m3 distance et temps de trajet inclus.
													</p>
												</div>
												<div class="intro-layer to_animate" data-animation="fadeInLeft">
													<p class="divider_20">
                                                        Lorsqu'il est temps de quitter votre domicile ou votre entreprise, il est temps d'appeler Willo déménagement et Brico.
                                                        Nous vous facilitons la tâche et nous la rendons plus rapide que les autres.

                                                    </p>
												</div>
												<div class="intro-layer to_animate" data-animation="fadeInLeft">
													<a href="devis.php" class="theme_button color2">Demander un devis</a>
												</div>
											</div>
											<!-- eof .slide_description -->
										</div>
										<!-- eof .slide_description_wrapper -->
									</div>
									<!-- eof .col-* -->
								</div>
								<!-- eof .row -->
							</div>
							<!-- eof .container -->
						</li>
						<li class="cs">
							<img src="img/slide02.jpg" alt>
							<div class="bg_overlay">
								<div class="frame"></div>
							</div>
							<div class="container">
								<div class="row">
									<div class="col-sm-12">
                                        <div class="slide_description_wrapper">
                                            <div class="slide_description">
                                                <div class="intro-layer to_animate" data-animation="fadeInLeft">
                                                    <p class="big">
                                                        Vous déménagez?
                                                    </p>
                                                </div>
                                                <div class="intro-layer to_animate" data-animation="fadeInLeft">
                                                    <p class="divider_20">
                                                        Lorsqu'il est temps de quitter votre domicile ou votre entreprise, il est temps d'appeler notre entreprise.
                                                        Nous vous facilitons la tâche et nous la rendons plus rapide que les autres.

                                                    </p>
                                                </div>
                                                <div class="intro-layer to_animate" data-animation="fadeInLeft">
                                                    <a href="devis.php" class="theme_button color2">Demander un devis</a>
                                                </div>
                                            </div>
                                            <!-- eof .slide_description -->
                                        </div>
										<!-- eof .slide_description_wrapper -->
									</div>
									<!-- eof .col-* -->
								</div>
								<!-- eof .row -->
							</div>
							<!-- eof .container -->
						</li>


					</ul>
				</div>
				<!-- eof flexslider -->
			</section>

			<section class="ls section_padding_top_65 section_padding_bottom_100 columns_margin_bottom_30 page_about">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-7">
							<div class="framed-heading">
								<h2 class="section_header">
                                    Bienvenue sur le site
									<span class="highlight2">Déménagement & Brico</span>
									<br>
 								</h2>
							</div>


                            <p> Située à la zone de Mérignac, Willo déménagement et Brico
                                est une entreprise de déménagement <b>professionnelle</b> et <b>compétente</b> œuvrant pour le compte des particuliers et des entreprises. </p>

                            <p>  NOUS PRENDRONS BIEN SOIN DE VOS AFFAIRES
                                Nous prenons en charge tout type de déménagement. Dotés d’une large expérience et de solides compétences en la matière,
                                nous vous assurons un travail fait dans le respect entier de la sécurité de vos biens. </p>

                            <p> Des objets fragiles ou délicats à déplacer ? N’ayez aucun souci, notre équipe de déménageurs professionnels les manipulera avec le plus grand soin.</p>

                            <p>    N'hésitez pas à nous contacter pour en savoir plus sur nos services de déménagement et pour obtenir un devis personnalisé aujourd'hui.</p>




                                <?php
                                $msg = '';
                                $result = false;

                                if(isset($_POST['envoyer'])) {

                                    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
                                        // Réponse CAPTCHA soumise par l'utilisateur
                                        $captchaResponse = $_POST['g-recaptcha-response'];

                                        // Vérification du CAPTCHA
                                        $verifyCaptcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcnwrEqAAAAAFwVhIiOmjiRYvPHDfnZg5O5HktJ&response={$captchaResponse}");
                                        $response = json_decode($verifyCaptcha);

                                        if ($response->success) {
                                            $host = 'ojrh.myd.infomaniak.com';
                                            $db = 'ojrh_willo';
                                            $username = 'ojrh_RAD';
                                            $password = '23564092R';

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
                                                $req->bindParam(':email', $client_email);
                                                $req->bindParam(':tel', $client_tel);

                                                $req->bindParam(':message', $client_message);
                                                $req->bindParam(':date_msg', $client_date_msg);

                                                $req->execute();


                                                if ($req) {

                                                    $msg = '<div class="alert alert-success">Votre message a bien été envoyé!<br/>Nous vous contacterons dans les plus brefs délais</div>';

                                                    $destinataires = "willo3233@yahoo.com";
                                                    $sujet = "Vous avez reçu un nouveau message! ";

                                                    // Version MINE
                                                    $entetes = "MIME-Version: 1.0\n";

                                                    // en-têtes expéditeur
                                                    $entetes .= "From : no-reply@déménagementetbrico.fr\n";


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


                                            } catch (Exception $e) {
                                                die('Erreur : ' . $e->getMessage());
                                            }
                                        }
                                        else {
                                            $msg = '<div class="alert alert-danger">Pour mesure de sécurité, ce forumulaire ne peut pas être soumi.</div>';
                                         }
                                    } else {
                                        $msg = '<div class="alert alert-danger">Le reCAPTCHA n\'est pas valide. Veuillez cocher la case.</div>';

                                    }


                                }


                                ?>

 							<a href="devis.php" class="theme_button topmargin_30">Demander un devis</a>
						</div>
						<div class="col-md-5 col-lg-offset-1">
							<div class="content-card with_background offset-card">
								<h3 class="bold text-uppercase inverse_bg_color text-center">Contactez-Nous</h3>
								<div class="with_padding">
                                    <b>
                                            <?php if (!empty($msg)) {

                                                echo $msg;
                                            }?></b>
									<form class="quote-form" method="post">
										<div class="form-group">
											<label for="quote-name" class="sr-only">Nom
												<span class="required">*</span>
											</label>
											<div class="input-group">
												<i class="flaticon-avatar highlight"></i>
												<input type="text" aria-required="true" size="30" value name="nom" id="quote-name" class="form-control" required placeholder="Nom">
											</div>
										</div>
                                        <div class="form-group">
                                            <label for="quote-name" class="sr-only">Prénom
                                                <span class="required">*</span>
                                            </label>
                                            <div class="input-group">
                                                <i class="flaticon-avatar highlight"></i>
                                                <input type="text" aria-required="true" size="30" value name="prenom" id="quote-name" class="form-control" required placeholder="Prénom">
                                            </div>
                                        </div>

										<div class="form-group">
											<label for="quote-email" class="sr-only">E-mail
												<span class="required">*</span>
											</label>
											<div class="input-group">
												<i class="flaticon-envelope highlight"></i>
												<input type="text" aria-required="true" size="30" value name="email" id="quote-email" class="form-control" required placeholder="E-mail">
											</div>
										</div>

										<div class="form-group">
											<label for="quote-phone" class="sr-only">Téléphone
												<span class="required">*</span>
											</label>
											<div class="input-group">
												<i class="flaticon-phone-call highlight"></i>
												<input type="text" aria-required="true" size="30" value name="tel" id="quote-phone" class="form-control" placeholder="Téléphone">
											</div>
										</div>

										<div class="form-group">
											<label for="quote-description" class="sr-only">Message
												<span class="required">*</span>
											</label>
											<div class="input-group">
												<i class="flaticon-edit highlight"></i>
												<textarea aria-required="true" rows="5" cols="45" name="message" id="quote-description" class="form-control" required placeholder="Votre message"></textarea>
											</div>
										</div>

                                        <div class="g-recaptcha" data-sitekey="6LcnwrEqAAAAAHBLdTUO7K9s-lSZvV1rAwmjI6m_" style="display: inline-block"></div>
                                        <br/>

										<div class="text-center topmargin_40">
											<button type="submit" id="quote_submit" name="envoyer" class="theme_button color2">Envoyer votre message</button>
										</div>
									</form>

								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="section_padding_140 page_services intro_section2">
				<div class="container-fluid">
					<div class="row columns_margin_bottom_20">
						<div class="col-md-8 content-block-left ls to_animate" data-animation="fadeInLeft">
							<div class="row">
								<div class="col-sm-6 to_animate" data-animation="pullDown">
									<div class="media teaser">
										<div class="media-left">
											<div class="teaser_icon size_normal">
												<i class="flaticon-trolley grey"></i>
											</div>
										</div>
										<div class="media-body">
											<h4 class="text-uppercase fontsize_20 extrabold bottommargin_20">Déménagement</h4>
											<p>
                                                Emballage, démontage et remontage des meubles si besoin
                                                Nous vous proposons une visite gratuite afin de mieux évaluer votre volume et vos accès si besoin
                                                différentes formules de déménagement ( super économique, économique, standard et confort ) 	 </p>
										</div>
									</div>
								</div>

								<div class="col-sm-6 to_animate" data-animation="pullDown">
									<div class="media teaser">
										<div class="media-left">
											<div class="teaser_icon size_normal">
												<i class="flaticon-package grey"></i>
											</div>
										</div>
										<div class="media-body">
											<h4 class="text-uppercase fontsize_20 extrabold bottommargin_20">Bricolage</h4>
											<p>
                                                * Bricolage basique:
                                                - Démontage et remontage de vos biens( meubles à tiroir, armoire, table, Canapé, lits...)<br/>
                                                - Fixation des tringles à rideaux, tableaux, cadres, téléviseurs.etc.<br/>
                                                - Changement d'ampoule, installation des Lustres. etc<br/>
                                                - Jardinage (Tondre des pelouses)											</p>
										</div>
									</div>
								</div>




							</div>
						</div>
						<div class="col-md-4 content-block-right cs to_animate" data-animation="fadeInRightLong">
							<div class="to_animate" data-animation="fadeInRight" data-delay="300">
								<div class="framed-heading side-frame">
									<h2 class="section_header">
										Nos
										<br> services
									</h2>
								</div>
								<p>
 							</div>
						</div>
					</div>
				</div>
			</section>


			<section class="cs section_padding_25">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center topmargin_0">
							<div class="framed-heading top-offset-frame bottommargin_5">
								<h2 class="section_header small">
									Gallerie
								</h2>
							</div>

						</div>
					</div>
				</div>
			</section>

			<section class="ls columns_padding_5 section_padding_5">
				<div class="container">
					<div class="isotope_container isotope row masonry-layout" data-filters=".isotope_filters">

						<div class="col-md-3 col-sm-4 isotope-item margin_0"></div>

						<div class="col-md-3 col-sm-4 isotope-item margin_0"></div>

						<div class="col-md-3 col-sm-4 isotope-item margin_0"></div>

                        <div class="isotope-item col-md-6 col-sm-8 col-md-push-6 nursery">

                            <div class="vertical-item gallery-item content-absolute vertical-center text-center square-item">
                                <div class="item-media">
                                    <img src="img/will1.jpeg" alt>
                                    <div class="media-links">
                                        <div class="links-wrap">
                                            <a class="p-view prettyPhoto " title data-gal="prettyPhoto[gal]" href="img/will1.jpeg"></a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="isotope-item col-md-6 col-sm-8 col-md-push-6 kitchen">

                            <div class="vertical-item gallery-item content-absolute vertical-center text-center square-item">
                                <div class="item-media">
                                    <img src="img/will2.jpeg" alt>
                                    <div class="media-links">
                                        <div class="links-wrap">
                                            <a class="p-view prettyPhoto " title data-gal="prettyPhoto[gal]" href="img/will2.jpeg"></a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="isotope-item col-md-6 col-sm-8 col-md-push-6 kitchen">

                            <div class="vertical-item gallery-item content-absolute vertical-center text-center square-item">
                                <div class="item-media">
                                    <img src="img/will3.jpeg" alt>
                                    <div class="media-links">
                                        <div class="links-wrap">
                                            <a class="p-view prettyPhoto " title data-gal="prettyPhoto[gal]" href="img/will3.jpeg"></a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

						<div class="isotope-item col-md-6 col-sm-8 col-md-push-6 kitchen">

							<div class="vertical-item gallery-item content-absolute vertical-center text-center square-item">
								<div class="item-media">
									<img src="img/15.jpg" alt>
									<div class="media-links">
										<div class="links-wrap">
											<a class="p-view prettyPhoto " title data-gal="prettyPhoto[gal]" href="img/15.jpg"></a>
										</div>
									</div>
								</div>

							</div>

						</div>

						<div class="isotope-item col-md-3 col-sm-4 col-md-push-6 bathroom">

							<div class="vertical-item gallery-item content-absolute vertical-center text-center square-item">
								<div class="item-media">
									<img src="img/11.jpg" alt>
									<div class="media-links">
										<div class="links-wrap">
											<a class="p-view prettyPhoto " title data-gal="prettyPhoto[gal]" href="img/11.jpg"></a>
										</div>
									</div>
								</div>

							</div>

						</div>

						<div class="isotope-item col-md-3 col-sm-4 hallway">

							<div class="vertical-item gallery-item content-absolute vertical-center text-center square-item">
								<div class="item-media">
									<img src="img/05.jpg" alt>
									<div class="media-links">
										<div class="links-wrap">
											<a class="p-view prettyPhoto " title data-gal="prettyPhoto[gal]" href="img/05.jpg"></a>
										</div>
									</div>
								</div>

							</div>

						</div>

						<div class="isotope-item col-md-3 col-sm-4 livingroom">

							<div class="vertical-item gallery-item content-absolute vertical-center text-center square-item">
								<div class="item-media">
									<img src="img/17.jpg" alt>
									<div class="media-links">
										<div class="links-wrap">
											<a class="p-view prettyPhoto " title data-gal="prettyPhoto[gal]" href="img/17.jpg"></a>
										</div>
									</div>
								</div>

							</div>

						</div>

						<div class="isotope-item col-md-3 col-sm-4 nursery">

							<div class="vertical-item gallery-item content-absolute vertical-center text-center square-item">
								<div class="item-media">
									<img src="img/16.jpg" alt>
									<div class="media-links">
										<div class="links-wrap">
											<a class="p-view prettyPhoto " title data-gal="prettyPhoto[gal]" href="img/16.jpg"></a>
										</div>
									</div>
								</div>

							</div>

						</div>

					</div>
				</div>
			</section>







<?php require_once 'footer.php';?>
