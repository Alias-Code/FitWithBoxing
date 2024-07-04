<?php

require("inc/init.inc.php");

$title = "FitWithBoxing - Produits";
$active = strtolower(getTitle($_GET["nom_categorie"]));

// REQUETE

$query = $fwbBDD->query("SELECT * FROM fwb_produits WHERE nom_categorie = '$_GET[nom_categorie]'");

require("inc/utils.inc.php");

?>

<main>

    <!-- HAUT DE PAGE -->

    <div class="text-center mt-5 mb-5">
        <h1><?php echo getTitle($_GET["nom_categorie"]) ?> - <?php echo getSubTitle($_GET["nom_categorie"]) ?></h1>
        <hr class="custom-hr">
    </div>

    <!-- PRODUITS -->

    <div class="products container mx-auto row">

        <?php

        echo $contenu;

        while ($productInformations = $query->fetch(PDO::FETCH_ASSOC)) {

        ?>

            <div class="col-lg-3 col-md-4 col-sm-6 mt-5">
                <div class="prix fw-bold fs-4"><i class="bi bi-cash"></i>
                    <p><?php echo $productInformations["prix"] ?>€</p>
                </div>
                <img src="<?php echo $productInformations["image"] ?>" class="card-img-top" alt="Image du produit">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-3 fw-bold"><?php echo $productInformations["nom"] ?></h3>
                        <div class="informations d-flex justify-content-between">
                            <p><i class="bi bi-box-seam"></i>‎ Stock : <?php echo $productInformations["stock"] ?></p>
                            <p><i class="bi bi-tag"></i> Marque : <?php echo $productInformations["marque"] ?></p>
                            <p><i class="bi bi-person"></i> Genre : <?php echo $productInformations["genre"] ?></p>
                        </div>
                        <p class="card-text fs-5 mb-3"><?php echo substr($productInformations["description"], 0, 150); ?><span class="fw-bold">...</span></p>
                        <a href="product.php?id_produit=<?php echo $productInformations["id_produit"] ?>" class="btn custom-button-2 mt-2">CONSULTER L'ARTICLE</a>

                    </div>
                </div>

            </div>

        <?php } ?>



</main>

<?php

require("inc/footer.inc.php");

?>