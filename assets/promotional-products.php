<?php

$title = "FitWithBoxing - Articles Promotionnel";
$active = "";

require("inc/init.inc.php");

// REQUETE

$query = $fwbBDD->query("SELECT * FROM fwb_produits WHERE prix_promotion IS NOT NULL");

require("inc/utils.inc.php");

?>

<main>

    <!-- HAUT DE PAGE -->

    <div class="text-center mt-5 mb-5">
        <h1>Articles en promotion</h1>
        <hr class="custom-hr">
    </div>

    <!-- PRODUITS EN PROMOTION -->

    <div class="articles container mx-auto row">

        <?php

        echo $contenu;

        while ($productInformations = $query->fetch(PDO::FETCH_ASSOC)) {

        ?>

            <div class="col-lg-3 col-md-4 col-sm-6 mt-5">
                <div class="prix fw-bold fs-4"><i class="bi bi-cash"></i>
                    <p class="text-decoration-line-through"><?php echo $productInformations["prix"] ?>€</p>
                    <p>‎ <?php echo $productInformations["prix_promotion"] ?>€</p>
                </div>
                <img src="<?php echo $productInformations["image"] ?>" class="card-img-top">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-3"><?php echo $productInformations["nom"] ?></h3>
                        <div class="informations d-flex justify-content-between">
                            <p><i class="bi bi-box-seam"></i>‎ Stock : <?php echo $productInformations["stock"] ?></p>
                            <p><i class="bi bi-tag"></i> Marque : <?php echo $productInformations["marque"] ?></p>
                            <p><i class="bi bi-person"></i> Genre : <?php echo $productInformations["genre"] ?></p>
                        </div>
                        <p class="card-text fs-5 mb-3"><?php echo substr($productInformations['description'], 0, 150); ?> [...]
                        <p>
                            <a href="product.php?id_produit=<?php echo $productInformations["id_produit"] ?>" class="btn custom-button-2 mt-2">CONSULTER L'ARTICLE</a>

                    </div>
                </div>

            </div>

        <?php } ?>
</main>

<?php

require("inc/footer.inc.php");

?>