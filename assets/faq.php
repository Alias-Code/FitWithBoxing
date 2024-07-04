<?php

$title = "FitWithBoxing - FAQ";
$active = "faq";

require("inc/init.inc.php");

require('inc/utils.inc.php');

?>

<main>

    <!-- HAUT DE PAGE -->

    <div class="text-center mt-5 mb-5">
        <h1>Foire aux questions</h1>
        <hr class="custom-hr">
    </div>

    <!-- FAQ -->

    <div class="accordion container" id="accordionExample">

        <!-- FAQ 1 -->

        <div class="accordion-item mt-5">
            <h3 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed fw-bold fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Comment puis-je contacter le service clientèle ?
                </button>
            </h3>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body fs-5">
                    Notre équipe du service clientèle est là pour vous aider et répondre à toutes vos questions. Vous pouvez nous contacter par e-mail à support@fitwithboxing.com ou en remplissant le formulaire de contact disponible sur notre site web. Nous nous efforçons de répondre à toutes les demandes dans les plus brefs délais, du lundi au vendredi, de 9h à 18h (heure locale). Votre satisfaction est notre priorité, et nous sommes là pour vous fournir l'assistance dont vous avez besoin.
                </div>
            </div>
        </div>

        <!-- FAQ 2 -->

        <div class="accordion-item mt-5">
            <h3 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed fw-bold fs-5"" type=" button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Comment puis-je annuler ou modifier ma commande ?
                </button>
            </h3>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body fs-5">
                    Si vous souhaitez annuler ou modifier votre commande, veuillez nous contacter dès que possible. Si votre commande n'a pas encore été traitée pour l'expédition, nous ferons de notre mieux pour répondre à votre demande. Cependant, une fois que votre commande a été expédiée, nous ne pourrons plus la modifier. Dans ce cas, vous pouvez toujours retourner les articles conformément à notre politique de retour pour obtenir un remboursement ou un échange.
                </div>
            </div>
        </div>

        <!-- FAQ 3 -->

        <div class="accordion-item mt-5">
            <h3 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed fw-bold fs-5"" type=" button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Quels modes de paiement acceptez-vous ?
                </button>
            </h3>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body fs-5">
                    Nous proposons plusieurs options de paiement pour rendre votre expérience d'achat pratique et sécurisée. Vous pouvez régler votre commande par carte de crédit, PayPal ou virement bancaire. Toutes les informations de paiement sont traitées de manière sécurisée et confidentielle, garantissant ainsi la sécurité de vos transactions.
                </div>
            </div>
        </div>

        <!-- FAQ 4 -->

        <div class="accordion-item mt-5">
            <h3 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed fw-bold fs-5"" type=" button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Comment puis-je suivre ma commande ?
                </button>
            </h3>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body fs-5">
                    Pour suivre l'état de votre commande, vous pouvez accéder à la section "Suivi de commande" sur notre site web. Une fois votre commande expédiée, vous recevrez un e-mail de confirmation contenant un lien de suivi. Ce lien vous permettra de suivre votre colis en temps réel et de connaître sa progression jusqu'à sa livraison.
                </div>
            </div>
        </div>
    </div>
</main>
<?php

require("inc/footer.inc.php");

?>