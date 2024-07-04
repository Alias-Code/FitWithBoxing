<?php

require("inc/init.inc.php");

$title = "FitWithBoxing - Produits";
$active = "all-products";

$message = "";

// TOUT LES PRODUITS

$query = $fwbBDD->query("SELECT * FROM fwb_produits");
$products = $query->fetchAll(PDO::FETCH_ASSOC);

// BARRE DE RECHERCHE

if (!empty($_POST['search'])) {

    // TRAITEMENT DE TEXTE

    $_POST['search'] = treatmentText($_POST['search']);

    // REQUETE

    $searchContent = "%" . $_POST['search'] . "%";
    $query = $fwbBDD->prepare("SELECT * FROM fwb_produits WHERE nom LIKE :searchContent");
    $query->execute([":searchContent" => $searchContent]);
    $message = "Résultats pour la recherche '{$_POST['search']}' : " . $query->rowCount();

    $products = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    $message = "Nombre total de produits : " . count($products);
}

require("inc/utils.inc.php");

?>

<main>

    <!-- HAUT DE PAGE -->

    <div class="text-center mt-5 mb-5">
        <h1>Afficher tout les produits</h1>
        <hr class="custom-hr">
    </div>

    <!-- PRODUITS -->

    <div class="articles container mx-auto row">

        <!-- BARRE DE RECHERCHE -->

        <div class="input-group rounded">
            <form method="POST" action="#" class="input-group rounded mb-4">
                <span class="input-group-text"> <i class="bi bi-search fs-3 text-black"></i></span>
                <input type="search" name="search" id="search" for="search" class="form-control rounded" placeholder="Rechercher..." aria-label="Search" aria-describedby="search-addon" />
                <button type="submit" class="btn custom-button-1">Rechercher</button>
            </form>

            <!-- AFFICHAGE DU NOMBRE DE RESULTAT -->

            <h5><?php echo $message; ?></h5>
        </div>

        <?php

        echo $contenu;

        foreach ($products as $productInformations) {

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

                <img src="medias/images/articles-image.jpg" class="card-img-top" alt="Image du produit">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-3 fw-bold"><?php echo $productInformations["nom"] ?></h3>
                        <div class="informations d-flex justify-content-between">
                            <p><i class="bi bi-box-seam"></i>‎ Stock : <?php echo $productInformations["stock"] ?></p>
                            <p><i class="bi bi-tag"></i> Marque : <?php echo $productInformations["marque"] ?></p>
                            <p><i class="bi bi-person"></i> Genre : <?php echo $productInformations["genre"] ?></p>
                        </div>
                        <p class="card-text fs-5 mb-3"><?php echo substr($productInformations['description'], 0, 150); ?><span class="fw-bold">...</span></p>
                        <a href="product.php?id_produit=<?php echo $productInformations["id_produit"] ?>" class="btn custom-button-2 mt-2">CONSULTER LE PRODUIT</a>
                    </div>
                </div>

            </div>

        <?php } ?>

</main>

<?php

require("inc/footer.inc.php");

?>