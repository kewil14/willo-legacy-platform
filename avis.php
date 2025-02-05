<?php require_once 'header.php';

$msg = '';
$result = false;

if(isset($_POST['envoyer'])) {

    $host = 'localhost';
    $db = 'willo';
    $username = 'root';
    $password = '';


    $dsn = "mysql:host=$host;dbname=$db";

    try {
        // create a PDO connection with the configuration data
        $dbh = new PDO($dsn, $username, $password);

        global $dbh, $msg;
        $client_email = $_POST['email'];
        $client_name = $_POST['nom'];
        $client_prenom = $_POST['prenom'];
        $client_message = $_POST['message'];

        $client_date_msg = date('c');


        $req = $dbh->prepare("INSERT INTO contact (nom, prenom, email, message, date_msg) VALUES(:nom,:prenom,:email, :message, :date_msg)");

        $req->bindParam(':nom', $client_name, PDO::PARAM_STR_CHAR);
        $req->bindParam(':prenom', $client_prenom, PDO::PARAM_STR_CHAR);
        $req->bindParam(':email',  $client_email);
        $req->bindParam(':message',  $client_message);
        $req->bindParam(':date_msg', $client_date_msg);

        $req->execute();


        if ($req) {

            $msg = '<div class="alert alert-success">Votre message a bien été envoyé!<br/>Nous vous contacterons dans les plus brefs délais</div>';

            $destinataires = "radhouene-b@hotmail.fr";
            $sujet = "Vous avez reçu un test d\éligibilité pour isolation! ";

            // Version MINE
            $entetes = "MIME-Version: 1.0\n";

            // en-têtes expéditeur
            $entetes .= "From : hkayne70@gmail.com\n";


            // priorité urgente
            $entetes .= "X-Priority : 1\n";

            // type de contenu HTML
            $entetes .= "Content-type: text/html; charset=utf-8\n";

            // code de transportage
            $entetes .= "Content-Transfer-Encoding: 8bit\n";

            // message HTML
            $message = file_get_contents('form_iso_email.html');

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
                        <h2>AVIS</h2>
                    </div>

                    <ol class="breadcrumb greylinks to_animate" data-animation="fadeInLeft" data-delay="400">
                        <li>
                            <a href="./">
                                Accueil
                            </a>
                        </li>

                        <li class="active">Avis des clients</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>







<?php require_once 'footer.php'; ?>