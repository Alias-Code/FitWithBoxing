<?php

$title = "FitWithBoxing - Modification Produit";
$active = "edit-product";

require("inc/init.inc.php");

// REDIRECTION SI NON EN-LIGNE OU NON ADMIN

if (!isOnline() || !isAdmin()) {
    header("location:login.php");
    exit();
}

// RECUPERATION DES INFORMATIONS DU PRODUIT A MODIFIER

$id_produit = $_GET["id_produit"];

$query = $fwbBDD->prepare("SELECT * FROM fwb_produits WHERE id_produit = :id_produit");

$query->execute([
    ':id_produit' => $id_produit
]);

$produit = $query->fetch(PDO::FETCH_ASSOC);

// MODIFICATION DU PRODUIT

if (!empty($_POST)) {

    // TRAITEMENT DES CHAMPS

    $_POST['nom'] = treatmentText($_POST['nom']);
    $_POST['description'] = treatmentText($_POST['description']);
    $_POST['image'] = treatmentText($_POST['image']);
    $_POST['prix'] = treatmentText($_POST['prix']);
    $_POST['prix_promotion'] = treatmentText($_POST['prix_promotion']);
    $_POST['stock'] = treatmentText($_POST['stock']);
    $_POST['taille'] = treatmentText($_POST['taille']);
    $_POST['couleur'] = treatmentText($_POST['couleur']);
    $_POST['genre'] = treatmentText($_POST['genre']);
    $_POST['marque'] = treatmentText($_POST['marque']);
    $_POST['matiere'] = treatmentText($_POST['matiere']);

    // REQUETE

    $prix_promotion = !empty($_POST["prix_promotion"]) ? $_POST["prix_promotion"] : null;

    $query = $fwbBDD->prepare('UPDATE fwb_produits SET nom_categorie = :nom_categorie, nom = :nom, description = :description, image = :image, prix = :prix, prix_promotion = :prix_promotion, stock = :stock, taille = :taille, couleur = :couleur, date = :date, genre = :genre, marque = :marque, matiere = :matiere WHERE id_produit = :id_produit');

    $query->execute([
        ':id_produit' => $id_produit,
        ':nom_categorie' => $_POST['categorie'],
        ':nom' => $_POST['nom'],
        ':description' => $_POST['description'],
        ':image' => $_POST['image'],
        ':prix' => $_POST['prix'],
        ':prix_promotion' => $prix_promotion,
        ':stock' => $_POST['stock'],
        ':taille' => $_POST['taille'],
        ':couleur' => $_POST['couleur'],
        ':date' => getCurrentDate(),
        ':genre' => $_POST['genre'],
        ':marque' => $_POST['marque'],
        ':matiere' => $_POST['matiere'],
    ]);

    if ($query) {
        $contenu .= "<div class=\"alert alert-success\">Le produit a été modifié avec succès !</div>";
    } else {
        $contenu .= "<div class=\"alert alert-danger\">" . ERROR . "</div>";
    }
}


require("inc/utils.inc.php");

?>

<!-- AFFICHAGE DES ERREURS -->

<?php echo $contenu; ?>

<!-- HAUT DE PAGE -->

<div class="text-center mt-5 mb-5">
    <h1 class="mb-5 text-center">Modifier un Produit</h1>
    <hr class="custom-hr">
</div>

<!-- MODIFIER UN PRODUIT -->

<div class="container py-5 form custom-bgc rounded">
    <form action="#" method="POST">
        <div class="row text-white p-5">

            <!-- NOM & DESCRIPTION -->

            <div class="row">
                <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                        <label class="form-label" for="nom">Nom du produit</label>
                        <input type="text" id="nom" name="nom" class="form-control form-control-lg" value="<?php echo htmlspecialchars($produit['nom'] ?? ''); ?>" />
                    </div>
                </div>
                <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                        <label class="form-label" for="description">Description</label>
                        <textarea id="description" name="description" class="form-control form-control-lg"><?php echo htmlspecialchars($produit['description'] ?? ''); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- PRIX & PRIX PROMOTIONNEL -->

            <div class="row">
                <div class="mb-4 col-md-6 pb-2">
                    <div class="form-outline form-white">
                        <label class="form-label" for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control form-control-lg" value="<?php echo htmlspecialchars($produit['prix'] ?? ''); ?>" />
                    </div>
                </div>
                <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline form-white">
                        <label class="form-label" for="prix_promotion">Prix promotionnel</label>
                        <input type="text" id="prix_promotion" name="prix_promotion" class="form-control form-control-lg" value="<?php echo htmlspecialchars($produit['prix_promotion'] ?? ''); ?>" />
                    </div>
                </div>
            </div>

            <!-- STOCK & IMAGE -->

            <div class="row">
                <div class="mb-4 col-md-6 pb-2">
                    <div class="form-outline form-white">
                        <label class="form-label" for="stock">Stock</label>
                        <input type="text" id="stock" name="stock" class="form-control form-control-lg" value="<?php echo htmlspecialchars($produit['stock'] ?? ''); ?>" />
                    </div>
                </div>
                <div class="mb-4 col-md-6 pb-2">
                    <div class="form-outline form-white">
                        <label class="form-label" for="image">Image</label>
                        <input type="text" id="image" name="image" class="form-control form-control-lg" value="<?php echo htmlspecialchars($produit['image'] ?? ''); ?>" />
                    </div>
                </div>
            </div>

            <!-- NOM CATEGORIE & TAILLE -->

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="categorie" class="form-label">Catégorie</label>
                    <select class="form-select form-select-lg" id="categorie" name="categorie" aria-label="Sélectionnez une catégorie">
                        <option value="accessoires.sacs_de_sport" <?php if ($produit['nom_categorie'] == 'accessoires.sacs_de_sport') echo 'selected'; ?>>accessoires.sacs_de_sport</option>
                        <option value="accessoires.chaussettes" <?php if ($produit['nom_categorie'] == 'accessoires.chaussettes') echo 'selected'; ?>>accessoires.chaussettes</option>
                        <option value="accessoires.gourdes" <?php if ($produit['nom_categorie'] == 'accessoires.gourdes') echo 'selected'; ?>>accessoires.gourdes</option>
                        <option value="accessoires.cordes_à_sauter" <?php if ($produit['nom_categorie'] == 'accessoires.cordes_à_sauter') echo 'selected'; ?>>accessoires.cordes_à_sauter</option>
                        <option value="equipements.protege_dents" <?php if ($produit['nom_categorie'] == 'equipements.protege_dents') echo 'selected'; ?>>equipements.protege_dents</option>
                        <option value="equipements.gants_de_boxe" <?php if ($produit['nom_categorie'] == 'equipements.gants_de_boxe') echo 'selected'; ?>>equipements.gants_de_boxe</option>
                        <option value="equipements.bandes_de_boxe" <?php if ($produit['nom_categorie'] == 'equipements.bandes_de_boxe') echo 'selected'; ?>>equipements.bandes_de_boxe</option>
                        <option value="equipements.sacs_de_frappe" <?php if ($produit['nom_categorie'] == 'equipements.sacs_de_frappe') echo 'selected'; ?>>equipements.sacs_de_frappe</option>
                        <option value="equipements.plateforme_de_reflexe" <?php if ($produit['nom_categorie'] == 'equipements.plateforme_de_reflexe') echo 'selected'; ?>>equipements.plateforme_de_reflexe</option>
                        <option value="equipements.sac_de_frappe_rotatif" <?php if ($produit['nom_categorie'] == 'equipements.sac_de_frappe_rotatif') echo 'selected'; ?>>equipements.sac_de_frappe_rotatif</option>
                        <option value="vetements.chaussures_de_boxe" <?php if ($produit['nom_categorie'] == 'vetements.chaussures_de_boxe') echo 'selected'; ?>>vetements.chaussures_de_boxe</option>
                        <option value="vetements.pantalon_de_survêtement" <?php if ($produit['nom_categorie'] == 'vetements.pantalon_de_survêtement') echo 'selected'; ?>>vetements.pantalon_de_survêtement</option>
                        <option value="vetements.shorts_de_boxe" <?php if ($produit['nom_categorie'] == 'vetements.shorts_de_boxe') echo 'selected'; ?>>vetements.shorts_de_boxe</option>
                    </select>

                </div>

                <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline form-white">
                        <label class="form-label" for="taille">Taille</label>
                        <select class="form-select form-select-lg" id="taille" name="taille" aria-label="Sélectionnez une taille">
                            <option value="XS" <?php if ($produit['taille'] == 'XS') echo 'selected'; ?>>XS</option>
                            <option value="S" <?php if ($produit['taille'] == 'S') echo 'selected'; ?>>S</option>
                            <option value="M" <?php if ($produit['taille'] == 'M') echo 'selected'; ?>>M</option>
                            <option value="L" <?php if ($produit['taille'] == 'L') echo 'selected'; ?>>L</option>
                            <option value="XL" <?php if ($produit['taille'] == 'XL') echo 'selected'; ?>>XL</option>
                            <option value="TU" <?php if ($produit['taille'] == 'TU') echo 'selected'; ?>>TU</option>
                        </select>

                    </div>
                </div>
            </div>

            <!-- COULEUR & GENRE -->

            <div class="row">
                <div class="mb-4 col-md-6 pb-2">
                    <div class="form-outline form-white">
                        <label class="form-label" for="couleur">Couleur</label>
                        <select class="form-select form-select-lg" id="couleur" name="couleur" aria-label="Default select example">
                            <option value="rouge" <?php if ($produit['couleur'] == 'rouge') echo 'selected'; ?>>Rouge</option>
                            <option value="vert" <?php if ($produit['couleur'] == 'vert') echo 'selected'; ?>>Vert</option>
                            <option value="noir" <?php if ($produit['couleur'] == 'noir') echo 'selected'; ?>>Noir</option>
                            <option value="blanc" <?php if ($produit['couleur'] == 'blanc') echo 'selected'; ?>>Blanc</option>
                            <option value="bleu" <?php if ($produit['couleur'] == 'bleu') echo 'selected'; ?>>Bleu</option>
                            <option value="beige" <?php if ($produit['couleur'] == 'beige') echo 'selected'; ?>>Beige</option>
                        </select>

                    </div>
                </div>
                <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline form-white">
                        <label class="form-label" for="genre">Genre</label>
                        <select class="form-select form-select-lg" id="genre" name="genre" aria-label="Default select example">
                            <option value="homme" <?php if ($produit['genre'] == 'homme') echo 'selected'; ?>>Homme</option>
                            <option value="femme" <?php if ($produit['genre'] == 'femme') echo 'selected'; ?>>Femme</option>
                            <option value="unisex" <?php if ($produit['genre'] == 'unisex') echo 'selected'; ?>>Unisexe</option>
                        </select>

                    </div>
                </div>
            </div>

            <!-- MARQUE & MATIERE -->

            <div class="row">
                <div class="mb-4 col-md-6 pb-2">
                    <div class="form-outline form-white">
                        <label class="form-label" for="marque">Marque</label>
                        <select class="form-select form-select-lg" id="marque" name="marque" aria-label="Default select example">
                            <option value="Nike" <?php if ($produit['marque'] == 'Nike') echo 'selected'; ?>>Nike</option>
                            <option value="Adidas" <?php if ($produit['marque'] == 'Adidas') echo 'selected'; ?>>Adidas</option>
                            <option value="Everlast" <?php if ($produit['marque'] == 'Everlast') echo 'selected'; ?>>Everlast</option>
                            <option value="Venum" <?php if ($produit['marque'] == 'Venum') echo 'selected'; ?>>Venum</option>
                            <option value="Metal Boxe" <?php if ($produit['marque'] == 'Metal Boxe') echo 'selected'; ?>>Metal Boxe</option>
                        </select>

                    </div>
                </div>

                <div class="mb-4 col-md-6 pb-5">
                    <div class="form-outline form-white">
                        <label class="form-label" for="matiere">Matiere</label>
                        <select class="form-select form-select-lg" id="matiere" name="matiere" aria-label="Default select example">
                            <option value="Coton" <?php if ($produit['matiere'] == 'Coton') echo 'selected'; ?>>Coton</option>
                            <option value="Polyester" <?php if ($produit['matiere'] == 'Polyester') echo 'selected'; ?>>Polyester</option>
                            <option value="Nylon" <?php if ($produit['matiere'] == 'Nylon') echo 'selected'; ?>>Nylon</option>
                            <option value="Laine" <?php if ($produit['matiere'] == 'Laine') echo 'selected'; ?>>Laine</option>
                        </select>

                    </div>
                </div>

            </div>

            <!-- ENVOI DU FORMULAIRE -->

            <div class="d-flex justify-content-center">
                <input type="submit" value="MODIFIER LE PRODUIT" class="btn custom-button-2">
            </div>

        </div>
    </form>
</div>
</main>

<?php

require("inc/footer.inc.php");

?>