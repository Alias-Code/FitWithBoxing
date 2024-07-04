<?php

$title = "FitWithBoxing - Produits";
$active = "";

require("inc/init.inc.php");

$products = $fwbBDD->query("SELECT * FROM fwb_produits WHERE id_produit = $_GET[id_produit]");

$productInformations = $products->fetch(PDO::FETCH_ASSOC);

$comments = $fwbBDD->query("SELECT * FROM fwb_commentaires WHERE id_produit = $_GET[id_produit]");

// COMMENTAIRES

if (isset($_POST["action"]) && $_POST["action"] === "ajouter_commentaire") {

    // TRAITEMENT DES CHAMPS

    $_POST["titre"] = treatmentText($_POST["titre"]);
    $_POST["commentaire"] = treatmentText($_POST["commentaire"]);

    // VERIFICATIONS

    if (empty($_POST["commentaire"]) || empty($_POST["titre"])) {
        $contenu .= "<div class=\"alert alert-danger\">" . MISS_FIELD . "</div>";
    }

    if (!isOnline()) {
        $contenu .= "<div class=\"alert alert-danger\">" . NEED_ONLINE . "</div>";
    }

    // AJOUT DU COMMENTAIRE

    if (empty($contenu)) {

        $insertComment = $fwbBDD->prepare("INSERT INTO fwb_commentaires (id_produit, id_membre, titre, commentaire, date_commentaire, note) VALUES (:id_produit, :id_membre, :titre, :commentaire, :date_commentaire, :note)");

        $insertComment->execute([
            ":id_produit" => $_GET["id_produit"],
            ":id_membre" => $_SESSION["membres"]["id_membre"],
            ":titre" => $_POST["titre"],
            ":commentaire" => $_POST["commentaire"],
            ":date_commentaire" => getCurrentDate(),
            ":note" => $_POST["note"],
        ]);

        if ($insertComment) {
            $contenu .= "<div class=\"alert alert-success\">" . COMMENT_ADD . "</div>";
            header("location:product.php?id_produit={$_GET['id_produit']}");
            exit();
        } else {
            $contenu .= "<div class=\"alert alert-danger\">" . ERROR . "</div>";
        }
    }
}

// SUPPRESSION COMMENTAIRE

if (isset($_GET['id_commentaire'])) {

    $delete = $fwbBDD->query("DELETE FROM fwb_commentaires WHERE id_commentaire = $_GET[id_commentaire]");

    if ($delete) {
        $contenu .= "<div class=\"alert alert-success\">" . SUCCESS_DELETE . "</div>";
        header("location:product.php?id_produit={$_GET['id_produit']}");
        exit();
    } else {
        $contenu .= "<div class=\"alert alert-danger\">" . ERROR . "</div>";
    }
}

// MOYENNE DES ETOILES

$commentsList = $fwbBDD->query("SELECT * FROM fwb_commentaires WHERE id_produit = $_GET[id_produit]");

$totalStars = 0;

while ($commentInformations = $commentsList->fetch(PDO::FETCH_ASSOC)) {
    $totalStars += $commentInformations["note"];
}

if ($totalStars > 0) {
    $moyenne = ceil($totalStars / $commentsList->rowCount());
} else {
    $moyenne = 0;
}


// PANIER

if (isset($_POST["action"]) && $_POST["action"] === "ajouter_panier") {

    if (!isOnline()) {
        $contenu .= "<div class=\"alert alert-danger\">" . NEED_ONLINE . "</div>";
    } else {

        if (!isset($_SESSION["panier"])) {

            // SI LE PANIER N'EXISTE PAS

            $cle_produit = $_GET["id_produit"] . '_' . $_POST["couleur"] . '_' . $_POST["taille"];

            $_SESSION["panier"] = [
                $cle_produit => [
                    "quantite" => $_POST["quantity"],
                    "taille" => $_POST["taille"],
                    "couleur" => $_POST["couleur"]
                ]
            ];

            $contenu .= "<div class=\"alert alert-success\">" . PRODUCT_ADD . "</div>";
        } else {

            // SI LE PRODUIT EXISTE AVEC LES MEMES PARAMETRES

            $produit_existe = false;

            foreach ($_SESSION["panier"] as $id_produit_panier => $details_produit) {

                if ($id_produit_panier == $_GET["id_produit"] && $details_produit["couleur"] == $_POST["couleur"] && $details_produit["taille"] == $_POST["taille"]) {

                    $cle_produit = $_GET["id_produit"] . '_' . $_POST["couleur"] . '_' . $_POST["taille"];

                    $_SESSION["panier"][$cle_produit]["quantite"] += $_POST["quantity"];
                    $produit_existe = true;

                    $contenu .= "<div class=\"alert alert-success\">" . PRODUCT_ADD . "</div>";
                    break;
                }
            }

            // SI LE PRODUIT EXISTE SANS LES MEMES PARAMETRE

            $cle_produit = $_GET["id_produit"] . '_' . $_POST["couleur"] . '_' . $_POST["taille"];

            if (!$produit_existe) {

                $_SESSION["panier"][$cle_produit] = [
                    "quantite" => $_POST["quantity"],
                    "taille" => $_POST["taille"],
                    "couleur" => $_POST["couleur"]
                ];

                $contenu .= "<div class=\"alert alert-success\">" . PRODUCT_ADD . "</div>";
            }
        }
    }
}


require("inc/utils.inc.php");

?>

<main>

    <!-- AFFICHAGE DES ERREURS -->

    <?php echo $contenu; ?>

    <!-- PRODUIT -->

    <div class="py-5 container mx-auto row">

        <!-- IMAGE DU PRODUIT -->

        <aside class="col-lg-6 d-flex justify-content-center">
            <img class="rounded-4" src="<?php echo $productInformations["image"] ?>" />
        </aside>

        <!-- INFORMATIONS DU PRODUIT -->

        <div class="col-lg-6">
            <img class="mb-4" src="medias/logos/logo.png" alt="logo de marque" class="img-fluid" />

            <div class="ps-lg-3">
                <h3 class="fw-bold mb-3">
                    <?php echo $productInformations["nom"] ?> </h3>
                <div class="d-flex flex-row my-3 mb-4">
                    <div class="mb-1 me-2">
                        <?php
                        $base = 5;
                        $difference = $base - $moyenne;

                        // Affichage des étoiles jaunes (moyenne arrondie)
                        for ($i = 1; $i <= $moyenne; $i++) {
                            echo '<i class="bi bi-star-fill text-warning fs-4"></i>';
                        }

                        // Affichage des étoiles grises (différence)
                        for ($i = 1; $i <= $difference; $i++) {
                            echo '<i class="bi bi-star text-black fs-4"></i>';
                        }
                        ?>
                    </div>


                    <span class="text-success ms-2 d-flex align-items-center">En stock (<?php echo $productInformations["stock"] ?>)</span>
                </div>

                <div class="mb-3 d-flex">
                    <h4 class="<?php if (!is_null($productInformations["prix_promotion"])) {
                                    echo "text-decoration-line-through";
                                } ?>"><?php echo $productInformations["prix"] ?>€</h4>
                    <?php if (!is_null($productInformations["prix_promotion"])) { ?>
                        <h4>‎ <?php echo $productInformations["prix_promotion"] ?>€</h4>
                    <?php } ?>
                </div>

                <p class="mb-3 fs-5">
                    <?php echo $productInformations["description"] ?>
                </p>

                <div class="row mt-5">
                    <p class="col-3 fw-bold fs-5">Marque :</p>
                    <p class="col-9 fs-5"><?php echo $productInformations["marque"] ?></p>
                    <p class="col-3 fw-bold fs-5">Matiere :</p>
                    <p class="col-9 fs-5"><?php echo $productInformations["matiere"] ?></p>
                    <p class="col-3 fw-bold fs-5">Genre :</p>
                    <p class="col-9 fs-5"><?php echo $productInformations["genre"] ?></p>

                    <p class="mt-4 fw-bold fs-5">Date de publication : <?php echo $productInformations["date"] ?></p>
                </div>

                <hr class="custom-hr w-100 my-3">

                <form action="#" method="POST">
                    <div class="row mb-4">
                        <div class="col-md-4 col-6">
                            <label class="mb-2">Taille</label>
                            <select name="taille" class="form-select border border-secondary">
                                <option value="XS">XS</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="TU">TU</option>
                            </select>
                        </div>

                        <div class="col-md-4 col-6">
                            <label class="mb-2">Couleur</label>
                            <select name="couleur" class="form-select border border-secondary">
                                <option value="Rouge">Rouge</option>
                                <option value="Vert">Vert</option>
                                <option value="Noir">Noir</option>
                                <option value="Blanc">Blanc</option>
                                <option value="Bleu">Bleu</option>
                                <option value="Beige">Beige</option>
                            </select>
                        </div>

                    </div>

                    <div class="row mb-5">
                        <div class="col-md-8 col-6">
                            <label class="mb-2">Quantité</label>

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button" id="btnMin">-</button>
                                </div>
                                <input type="text" class="form-control text-center h-auto" value="1" id="quantity" name="quantity">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="btnPlus">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-cart-plus-fill fs-3 text-black"></i></span>
                        <input type="hidden" name="action" value="ajouter_panier">
                        <button type="submit" class="custom-button-2">AJOUTER AU PANIER</button>
                    </div>
                </form>

            </div>

        </div>

        <hr class="custom-hr mt-5 w-100">

        <!-- FORM DU COMMENTAIRE -->

        <form action="#" method="POST">
            <div class="col-md-12 mt-5 mb-3 pb-2">

                <div class="form-outline">
                    <label class="form-label" for="titre">Titre du commentaire</label>
                    <input type="text" id="titre" name="titre" class="form-control form-control-lg" />
                </div>

            </div>
            <div class="col-md-12 mb-4 pb-2">
                <div class="form-outline">
                    <label class="form-label">Commentaire</label>
                    <textarea id="commentaire" name="commentaire" class="form-control form-control-lg" rows="6"></textarea>
                </div>
            </div>

            <div class="col-md-12 fs-1">
                <div class="rating">
                    <span class="star" number="1">&#9733;</span>
                    <span class="star" number="2">&#9733;</span>
                    <span class="star" number="3">&#9733;</span>
                    <span class="star" number="4">&#9733;</span>
                    <span class="star" number="5">&#9733;</span>
                </div>
            </div>

            <input type="hidden" id="note" name="note" value="1">
            <input type="hidden" name="action" value="ajouter_commentaire">

            <button type="submit" class="btn custom-button-1 mt-4 ms-4">AJOUTER UN COMMENTAIRE</button>
        </form>

        <h2 class="my-5 text-center">Commentaires du produit</h2>


        <!-- AFFICHAGE DES COMMENTAIRES -->

        <?php

        if ($comments->rowCount() === 0) {
            echo "<p class=fs-3>" . NO_COMMENT . "</p>";
        } else {

            while ($commentInformations = $comments->fetch(PDO::FETCH_ASSOC)) { ?>>

        <div class="row d-flex justify-content-center">
            <div class="border col-md-8 my-5 pb-2">
                <h3 class="p-3"><?php echo $commentInformations["titre"] ?> - <?php echo $commentInformations["date_commentaire"] ?> </h3>
                <p class="p-3 fs-3"><?php echo $commentInformations["commentaire"] ?></p>

                <!-- AFFICHER LES ETOILES -->

                <div class="p-3">
                    <?php
                    $note = $commentInformations["note"];
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $note) {
                            echo '<i class="bi bi-star-fill text-warning fs-2"></i>';
                        } else {
                            echo '<i class="bi bi-star text-warning fs-2"></i>';
                        }
                    }
                    ?>
                </div>

                <?php if (isAdmin()) { ?>

                    <?php $idProduct = $_GET["id_produit"]; ?>

                    <a href="product.php?id_produit=<?php echo $idProduct ?>&id_commentaire=<?php echo $commentInformations["id_commentaire"] ?>" class="btn custom-button-2 mt-2">SUPPRIMER LE COMMENTAIRE</a>
                <?php } ?>
            </div>
        </div>


<?php }
        } ?>
    </div>

</main>

<?php

require("inc/footer.inc.php");

?>