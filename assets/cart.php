<?php

$title = "FitWithBoxing - Panier";
$active = "cart";

require("inc/init.inc.php");

// SUPPRESSION DU PANIER

if (isset($_GET['action']) && $_GET['action'] === 'suppression') {
    $_SESSION['panier'] = [];
    header("location:cart.php");
    exit();
}

require('inc/utils.inc.php');

?>

<main>

    <!-- HAUT DE PAGE -->

    <div class="text-center mt-5 mb-5">
        <h1>Panier</h1>
        <hr class="custom-hr">
    </div>

    <!-- AFFICHAGE DU PANIER -->

    <?php if (!isOnline() || empty($_SESSION["panier"])) {
        $contenu .= "<div class=\"alert alert-danger w-50 mx-auto text-center\">" . EMPTY_CART . "</div>";
    } else { ?>

        <div class="row container mx-auto d-flex justify-content-center align-items-center card">
            <div class="card-body row">

                <!-- DETAILS DU PANIER -->

                <div class="col-lg-7">
                    <h5 class="mb-3 fs-3"><a href="all-products.php" class="text-body"><i class="bi bi-arrow-left text-black me-2"></i>Continuer mes achats</a></h5>
                    <hr>

                    <div class="d-flex justify-content-between mb-4">
                        <p class="mb-1 fs-4 fw-bold">Panier</p>
                        <p class="mb-0 fw-bold fs-4">Vous avez <?php echo count($_SESSION["panier"]); ?> articles dans votre panier</p>
                    </div>

                    <!-- AFFICHAGE DES PRODUITS -->

                    <?php

                    $total_panier = 0;

                    foreach ($_SESSION["panier"] as $id_produit => $details_produit) {

                        // RECUPERATION DU PRODUIT

                        $query = $fwbBDD->prepare("SELECT nom, prix, image FROM fwb_produits WHERE id_produit = :id_produit");
                        $query->bindParam(':id_produit', $id_produit);
                        $query->execute();

                        $produit = $query->fetch(PDO::FETCH_ASSOC);

                        // CALCUL DU PRIX

                        $prix_total_produit = $details_produit["quantite"] * $produit["prix"];
                        $total_panier += $prix_total_produit;
                    ?>
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-2">
                                    <img src="<?php echo $produit["image"]; ?>" class="rounded-start" alt="Image du produit">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title fs-4 fw-bold mb-4"><?php echo $produit["nom"]; ?></h5>
                                        <p class="card-text"><strong>Quantité :</strong> <?php echo $details_produit["quantite"]; ?></p>
                                        <p class="card-text"><strong>Prix unitaire :</strong> <?php echo $produit["prix"]; ?>€</p>
                                        <p class="card-text"><strong>Prix total :</strong> <?php echo $prix_total_produit; ?>€</p>
                                        <p class="card-text"><strong>Couleur :</strong> <?php echo $details_produit["couleur"]; ?></p>
                                        <p class="card-text"><strong>Taille :</strong> <?php echo $details_produit["taille"]; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- SUPPRESSION DU PANIER -->

                    <form action="cart.php?action=suppression" method="POST">
                        <button type="submit" class="btn custom-button-2">Supprimer le panier</button>
                    </form>

                </div>

                <!-- DETAILS DU PAIEMENT -->

                <div class="col-lg-5">

                    <div class="card custom-bgc text-white rounded-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="mb-4 mt-2 fs-4 fw-bold">Détails de paiement</h5>
                            </div>

                            <form class="mt-4">
                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="typeName">Nom sur la carte</label>
                                    <input type="text" id="typeName" class="form-control form-control-lg" siez="17" placeholder="Nom du propriétaire" />
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="typeText">Numéro de carte</label>
                                    <input type="text" id="typeText" class="form-control form-control-lg" siez="17" placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-outline form-white">
                                            <label class="form-label" for="typeExp">Expiration</label>
                                            <input type="text" id="typeExp" class="form-control form-control-lg" placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-outline form-white">
                                            <label class="form-label" for="typeText">CVV</label>
                                            <input type="password" id="typeText" class="form-control form-control-lg" placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                                        </div>
                                    </div>
                                </div>

                            </form>

                            <hr class="my-4">

                            <!-- RESUME DU PANIER -->

                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Sous-total</p>
                                <p><?php echo $total_panier; ?>€</p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Livraison</p>
                                <p class="mb-2"><?php echo $livraion = "20.00" ?>€</p>
                            </div>

                            <div class="d-flex justify-content-between mb-4">
                                <p class="mb-2">Total</p>
                                <p class="mb-2"><?php echo $total_panier + $livraion ?>€</p>
                            </div>

                            <button type="button" class="btn custom-button-2 btn-block btn-lg">
                                <div class="d-flex justify-content-center">
                                    <span>FINALISER LE PAIEMENT <i class="bi bi-arrow-right"></i></span>
                                </div>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>

    <!-- AFFICHAGE DU CONTENU -->

    <?php echo $contenu; ?>
</main>


<?php

require("inc/footer.inc.php");

?>