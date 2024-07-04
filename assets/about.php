<?php

$title = "FitWithBoxing - A Propos";
$active = "about";

require("inc/init.inc.php");

require('inc/utils.inc.php');

?>

<main>

    <!-- HAUT DE PAGE -->

    <div class="text-center mt-5 mb-5">
        <h1>A PROPOS</h1>
        <hr class="custom-hr">
    </div>

    <!-- A PROPOS -->

    <div class="text-center row d-flex justify-content-center">

        <!-- QUI SOMMES NOUS -->

        <div class="col-10 col-md-3 m-4 card">
            <img src="medias/logos/brand.png" class="card-img-top" alt="Qui sommes-nous">
            <div class="card-body">
                <h2 class="card-title">Qui sommes-nous</h2>
                <p class="card-text fs-3 mt-4">FitWithBoxing est une référence dans le domaine de la vente en ligne d'équipements de boxe de haute qualité depuis 10 années. Depuis notre lancement, nous nous sommes engagés à fournir à nos clients une large gamme de produits de boxe haut de gamme, soigneusement sélectionnés pour répondre aux besoins des amateurs et des professionnels du sport.</p>
            </div>
        </div>

        <!-- NOTRE HISTOIRE -->

        <div class="col-10 col-md-3 m-4 card">
            <img src="medias/logos/brand.png" class="card-img-top" alt="Notre histoire">
            <div class="card-body">
                <h2 class="card-title">Notre histoire</h2>
                <p class="card-text fs-3 mt-4">Au fil des années, FitWithBoxing a bâti une solide réputation grâce à notre engagement envers l'excellence et notre passion pour le sport de la boxe. Nous sommes fiers d'avoir établi des partenariats avec les principales marques de l'industrie, ce qui nous permet d'offrir à nos clients un accès exclusif aux dernières innovations et aux meilleurs équipements de boxe disponibles sur le marché.</p>
            </div>
        </div>

        <!-- NOS VALEURS -->

        <div class="col-10 col-md-3 m-4 card">
            <img src="medias/logos/brand.png" class="card-img-top" alt="Nos valeurs">
            <div class="card-body">
                <h2 class="card-title">Nos valeurs</h2>
                <p class="card-text fs-3 mt-4">Chez FitWithBoxing, nous croyons fermement en la valeur du travail acharné, de la détermination et du dévouement. Que vous soyez un débutant cherchant à améliorer vos compétences ou un athlète professionnel en quête de succès sur le ring, nous sommes là pour vous accompagner à chaque étape de votre parcours.</p>
            </div>
        </div>

    </div>
</main>

<?php

require("inc/footer.inc.php");

?>