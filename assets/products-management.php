<?php

require("inc/init.inc.php");

$title = "FitWithBoxing - Gestion des produits";
$active = "products-management";

// REQUETE

$query = $fwbBDD->query("SELECT * FROM produits");

// SUPPRESSION DU PRODUIT

if (isset($_GET['id_produit']) && !empty($_GET['id_produit'])) {

    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {

        $query = $fwbBDD->query("DELETE FROM fwb_produits WHERE id_produit = $_GET[id_produit]");

        if ($query) {
            header("location:products-management.php");
            exit();
        } else {
            $contenu .= "<div class=\"alert alert-danger\">" . ERROR . "</div>";
        }
    }
}

require("inc/utils.inc.php");

?>

<main>

    <!-- HAUT DE PAGE -->

    <div class="text-center mt-5 mb-5">
        <h1>Gestion des produits</h1>
        <hr class="custom-hr">
    </div>

    <!-- PRODUITS -->

    <div class="articles container mx-auto row">

        <?php

        echo $contenu;

        while ($productInformations = $query->fetch(PDO::FETCH_ASSOC)) {

        ?>

            <!-- INFORMATIONS DU PRODUIT -->

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

                <img src="<?php echo $productInformations["image"] ?>" class="card-img-top">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-3 fw-bold"><?php echo $productInformations["nom"] ?></h3>
                        <div class="row">
                            <button onclick="confirmDelete(<?php echo $productInformations["id_produit"] ?>)" class="btn custom-button-2 mt-2">SUPPRIMER LE PRODUIT</button>
                            <a href="edit-product.php?id_produit=<?php echo $productInformations["id_produit"] ?>" class=" btn custom-button-1 mt-2">MODIFIER LE PRODUIT</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
</main>

<script>
    // VERIFICATION DE SUPPRESSION

    function confirmDelete(id_produit) {
        if (confirm("Êtes-vous sûr de vouloir supprimer ce produit ?")) {
            window.location.href = "products-management.php?id_produit=" + id_produit + "&confirm=true";
        }
    }
</script>

<?php

require("inc/footer.inc.php");

?>