<section class="cs section_padding_40">
    <div class="container">
        <div class="row">
             
            <div class="col-md-3 col-sm-6">
                <a class="media inline-block small-teaser text-left teaser-link" href="contact.php">
								<span class="media-left media-middle">
									<span class="teaser_icon border_icon round">
										<i class="flaticon-house"></i>
									</span>
								</span>
                    <span class="media-body media-middle semibold">
									<span class="bold grey"> 45 avenue Jean Monnet</span>
									<br> 33700, Mérignac
								</span>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="media inline-block small-teaser text-left teaser-link">
								<span class="media-left media-middle">
									<span class="teaser_icon border_icon round dark">
										<i class="flaticon-paper-plane"></i>
									</span>
								</span>
                    <span class="media-body media-middle semibold">
									<span class="bold grey">Lundi à Dimanche</span>
									<br> 08:00-20:00
								</span>
                </div>
            </div>

             <div class="col-md-3 col-sm-6">
                <a class="media inline-block small-teaser text-left teaser-link" href="mailto:willo3233@yahoo.com">
								<span class="media-left media-middle">
									<span class="teaser_icon border_icon round">
										<i class="flaticon-envelope grey bold"></i>
									</span>
								</span>
                    <span class="media-body media-middle semibold">
									<span class="bold grey">Envoyez votre courrier à</span>
									<br> <span class="__cf_email__">willo3233@yahoo.com</span>
								</span>
                </a>


            </div>


        </div>


        <div class="col-md-4 col-sm-6">

        <ul>
            <li>Déménagement bordeaux</li>
            <li>Déménagement gradignan</li>
            <li>Déménagement pessac</li>
            <li>Déménagement eysines</li>
            <li>Déménagement saint medard en jalle</li>


        </ul>
        </div>
        <div class="col-md-4 col-sm-6">

            <ul>
                <li>Déménagement talence</li>
                <li>Déménagement le haillan</li>
                <li>Déménagement villenave d'ornon</li>
                <li>Déménagement le bouscat </li>
                <li>Déménagement bruges</li>


            </ul>
        </div>
    
    </div>

</section>

<section class="page_copyright cs main_color2 section_padding_15 columns_margin_0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <p> Willo Déménagement & Brico - 2024 | &copy; tous les droits réservés |
                    <a href="mentions_legales.php">Mentions légales</a> | <a href="conditions_generales_des_ventes.php">Conditions générales des ventes</a> | <a href="protections_des_donnees.php">Protections des données </a>
                </p>

            </div>
        </div>
    </div>
</section>

</div>
<!-- eof #box_wrapper -->
</div>
<!-- eof #canvas -->

<script data-cfasync="false" src="js/email-decode.min.js"></script><script src="js/compressed.js"></script>
<script src="js/main.js"></script>
<script src="js/switcher.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#phone').click(function(){
            $.ajax({
                type: "POST",
                url: "update_phone.php",
                data: {},
                success: function(){

                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#phone_footer').click(function(){
            $.ajax({
                type: "POST",
                url: "update_phone.php",
                data: {},
                success: function(){

                }
            });
        });
    });
</script>
<script>
    const phoneAnchor = document.querySelector("#phone");

    phoneAnchor.addEventListener("click", function() {
        phoneAnchor.classList.toggle("blur");
        if (phoneAnchor.getAttribute("href") === "tel:0650211197") {
            phoneAnchor.setAttribute("href", "#");
        } else {
            phoneAnchor.setAttribute("href", "tel:0650211197");
        }
    });
</script>
<script id="sbinit" src="https://xn--dmnagementetbrico-btbb.fr/chat/js/main2.js?lang=fr"></script>


</body>

</html>