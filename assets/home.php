<?php

$title = "FitWithBoxing - Accueil";
$active = "home";

require("inc/init.inc.php");

// PRODUITS PROMOTION

$queryPromotions = $fwbBDD->query("SELECT * FROM fwb_produits WHERE prix_promotion IS NOT NULL LIMIT 4");

// PRODUITS NOUVEAUX

$queryNews = $fwbBDD->query("SELECT * FROM fwb_produits ORDER BY date DESC LIMIT 4");

// NEWSLETTER

if (!empty($_POST)) {

    // TRAITEMENT DES CHAMPS

    $_POST["email"] = treatmentText($_POST["email"]);

    // REQUETE

    if (empty($_POST["email"])) {
        $contenu .= "<div class=\"alert alert-danger\">" . MISS_FIELD . "</div>";
    }

    // VERIFICATION SI DEJA INSCRIT

    $checkEmail = $fwbBDD->prepare("SELECT COUNT(*) FROM fwb_newsletter WHERE email = :email");
    $checkEmail->execute([':email' => $_POST["email"]]);
    $emailCount = $checkEmail->fetchColumn();

    if ($emailCount > 0) {
        $contenu .= "<div class=\"alert alert-danger\">Cet e-mail est déjà inscrit à la newsletter.</div>";
    }

    // INSCRIPTION A LA NEWSLETTER

    if (empty($contenu)) {

        $verifNewsletter = $fwbBDD->prepare("INSERT INTO fwb_newsletter (email, type_inscription) VALUES (:email, :type_inscription)");

        $verifNewsletter->execute([
            ":email" => $_POST["email"],
            ":type_inscription" => $_POST["type_inscription"],
        ]);

        if ($verifNewsletter) {
            $contenu .= "<div class=\"alert alert-success\">" . FIELD_VALID . "</div>";
        } else {
            $contenu .= "<div class=\"alert alert-danger\">" . ERROR . "</div>";
        }
    }
}

require("inc/utils.inc.php");

?>

<!-- HEADER -->

<header>

    <!-- VIDEO FOND  -->

    <video autoplay muted playsinline loop class="video blur-background">
        <source src="medias/videos/video.mp4" type="video/mp4" />
        <source src="medias/videos/video.webm" type="video/webm" />

    </video>

    <!-- TEXTE PRINCIPAL -->

    <div class="text-uppercase d-flex justify-content-center flex-column align-items-center text-overlay text-center">
        <h1 class="mb-4">Un coup de poing pour chaque besoin.</h1>
        <h2>LEADER EN <span>PERFORMANCE.</span></h2>
    </div>

</header>

<!-- MAIN -->

<main>

    <!-- AFFICHAGE DES ERREURS -->

    <?php echo $contenu ?>

    <!-- HAUT DE PROMOTIONS -->

    <div class="text-center mt-5 mb-5">
        <h2 class="fs-1">Articles en promotion</h2>
        <hr class="custom-hr">
    </div>

    <!-- PRODUITS EN PROMOTION -->

    <div class="articles container mx-auto row">

        <?php

        while ($productInformations = $queryPromotions->fetch(PDO::FETCH_ASSOC)) {

        ?>

            <div class="col-lg-3 col-md-4 col-sm-6 mt-5">
                <div class="prix fw-bold fs-4"><i class="bi bi-cash"></i>
                    <p class="text-decoration-line-through"><?php echo $productInformations["prix"] ?>€</p>
                    <p>‎ <?php echo $productInformations["prix_promotion"] ?>€</p>
                </div>
                <img src="medias/images/articles-image.jpg" class="card-img-top" alt="Produit en promotion">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-3 fw-bold"><?php echo $productInformations["nom"] ?></h3>
                        <p class="card-text fs-5 mb-3"><?php echo substr($productInformations['description'], 0, 150); ?><span class="fw-bold">...</span></p>
                        <a href="product.php?id_produit=<?php echo $productInformations["id_produit"] ?>" class="btn custom-button-2 mt-2">CONSULTER L'ARTICLE</a>

                    </div>
                </div>

            </div>

        <?php } ?>

        <!-- BUTTON -->

        <div class="text-center">
            <a href="promotional-products.php" class="btn custom-button-1 mt-5">VOIR TOUT LES ARTICLES EN PROMOTION</a>
        </div>
    </div>

    <!-- HAUT DE NOUVEAUTES -->

    <div class="text-center mt-5 mb-5">
        <h2 class="fs-1">Nos nouveautés</h2>
        <hr class="custom-hr">
    </div>

    <!-- NOUVEAUTES -->

    <div class="articles container mx-auto row">

        <?php

        while ($productInformations = $queryNews->fetch(PDO::FETCH_ASSOC)) {

        ?>

            <div class="col-lg-3 col-md-4 col-sm-6 mt-5">

                <!-- VERIFICATION DE PROMOTION -->

                <div class="prix fw-bold fs-4"><i class="bi bi-cash"></i>
                    <p class="<?php if (!is_null($productInformations["prix_promotion"])) {
                                    echo "text-decoration-line-through";
                                } ?>"><?php echo $productInformations["prix"] ?>€</p>
                    <?php if (!is_null($productInformations["prix_promotion"])) { ?>
                        <p>‎ <?php echo $productInformations["prix_promotion"] ?>€</p>
                    <?php } ?>
                </div>

                <!-- INFORMATIONS DU PRODUIT -->

                <img src="medias/images/articles-image.jpg" class="card-img-top" alt="Produit en promotion">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-3 fw-bold"><?php echo $productInformations["nom"] ?></h3>
                        <p class="card-text fs-5 mb-3"><?php echo substr($productInformations['description'], 0, 150); ?><span class="fw-bold">...</span></p>
                        <p class="fw-bold fs-5">Date de publication : <?php echo $productInformations["date"] ?></p>
                        <a href="product.php?id_produit=<?php echo $productInformations["id_produit"] ?>" class="btn custom-button-2 mt-2">CONSULTER L'ARTICLE</a>

                    </div>
                </div>

            </div>

        <?php } ?>

        <!-- BUTTON -->

        <div class="text-center">
            <a href="all-products.php" class="btn custom-button-1 mt-5 mb-5">VOIR TOUT LES ARTICLES</a>
        </div>
    </div>

    <!-- POURQUOI NOUS-->

    <section class="row why-us container mx-auto d-flex justify-content-center">
        <div class="col-8">

            <!-- HAUT -->

            <div>
                <h2 class="fs-1">Pourquoi nous ?</h2>
                <p class="fs-4 mt-3 why-us-text">
                    Chez FitWithBoxing, nous nous engageons à fournir les meilleurs équipements et accessoires de boxe pour vous aider à atteindre vos objectifs de fitness. Voici pourquoi vous devriez nous choisir :
                </p>
            </div>

            <!-- BAS -->

            <div class="row">
                <div class="col-12 col-md-6 fs-5">
                    <div class="mb-5">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-truck"></i>
                            <h4 class="fw-bold mx-3 mb-0">Livraison Rapide & Fiable</h4>
                        </div>
                        <p class="mt-3">
                            Votre satisfaction est notre priorité absolue. Nous nous engageons à expédier rapidement toutes les commandes afin que vous puissiez commencer votre entraînement dès que possible.
                        </p>
                    </div>
                    <div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-gear"></i>
                            <h4 class="fw-bold mx-3 mb-0">Support 7/7</h4>
                        </div>
                        <p class="mt-3">
                            Que vous ayez des questions sur nos produits, besoin de conseils d'entraînement ou d'assistance après-vente, nous sommes là pour vous fournir le soutien dont vous avez besoin, 24/24 et 7/7.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 fs-5">
                    <div class="mb-5">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-bag"></i>
                            <h4 class="fw-bold mx-3 mb-0">Produit Qualitatif</h4>
                        </div>
                        <p class="mt-3">
                            Nous vous proposons des produits de haute qualité conçus pour résister à l'usure quotidienne et vous offrir des performances optimales lors de vos séances d'entraînement.
                        </p>
                    </div>
                    <div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-arrow-counterclockwise"></i>
                            <h4 class="fw-bold mx-3 mb-0">Retour Facile</h4>
                        </div>
                        <p class="mt-3">
                            Si vous n'êtes pas entièrement satisfait, nous offrons des retours faciles. Notre processus de retour est simple et sans tracas, pour que vous puissiez acheter en toute confiance.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NEWSLETTER -->

    <div class="container">
        <h2 class="mb-5 text-center mt-5">Abonnez-vous à notre newsletter</h2>

        <div class="row justify-content-center">
            <div class="col-8">
                <form action="#" method="POST">
                    <div class="mb-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope text-black"></i></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Adresse Email">
                        </div>
                    </div>  
                    <div class="mb-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-gear text-black"></i></span>
                            <select class="form-select" id="type_inscription" name="type_inscription">
                                <option value="promotions">Promotions</option>
                                <option value="actualites">Actualités</option>
                                <option value="promotions_actualites">Promotions et Actualités</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="S'ABONNER" class="btn custom-button-2">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php

require("inc/footer.inc.php");

?>