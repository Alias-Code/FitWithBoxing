<?php

$title = "FitWithBoxing - Ajout Produit";
$active = "add-product";

require("inc/init.inc.php");

// REDIRECTION SI NON EN-LIGNE OU NON ADMIN

if (!isOnline() || !isAdmin()) {
    header("location:login.php");
    exit();
}

// AJOUT DU PRODUIT

if (!empty($_POST)) {

    // TRAITEMENT DES CHAMPS

    $_POST['nom'] = treatmentText($_POST['nom']);
    $_POST['description'] = treatmentText($_POST['description']);
    $_POST['image'] = treatmentText($_POST['image']);
    $_POST['prix'] = treatmentText($_POST['prix']);
    $_POST['prix_promotion'] = treatmentText($_POST['prix_promotion'] ?? null);
    $_POST['stock'] = treatmentText($_POST['stock']);
    $_POST['taille'] = treatmentText($_POST['taille']);
    $_POST['couleur'] = treatmentText($_POST['couleur']);
    $_POST['genre'] = treatmentText($_POST['genre']);
    $_POST['marque'] = treatmentText($_POST['marque']);
    $_POST['matiere'] = treatmentText($_POST['matiere']);

    // REQUETE

    $query = $fwbBDD->prepare('INSERT INTO fwb_produits (nom_categorie, nom, description, image, prix, prix_promotion, stock, taille, couleur, date, genre, marque, matiere) 
                                VALUES (:nom_categorie, :nom, :description, :image, :prix, :prix_promotion, :stock, :taille, :couleur, :date, :genre, :marque, :matiere)');

    $query->execute([
        ':nom_categorie' => $_POST['categorie'],
        ':nom' => $_POST['nom'],
        ':description' => $_POST['description'],
        ':image' => $_POST['image'],
        ':prix' => $_POST['prix'],
        ':prix_promotion' => $_POST['prix_promotion'] ?? null,
        ':stock' => $_POST['stock'],
        ':taille' => $_POST['taille'],
        ':couleur' => $_POST['couleur'],
        ':date' => getCurrentDate(),
        ':genre' => $_POST['genre'],
        ':marque' => $_POST['marque'],
        ':matiere' => $_POST['matiere'],
    ]);

    if ($query) {
        $contenu .= "<div class=\"alert alert-success\">Le produit a été ajouté avec succès !</div>";
    } else {
        $contenu .= "<div class=\"alert alert-danger\">Erreur lors de l'ajout du produit</div>";
    }
}

require("inc/utils.inc.php");

?>

<!-- AFFICHAGE DES ERREURS -->

<?php echo $contenu; ?>

<!-- HAUT DE PAGE -->

<div class="text-center mt-5 mb-5">
    <h1 class="mb-5 text-center">Ajouter un Produit</h1>
    <hr class="custom-hr">
</div>

<!-- AJOUTER UN PRODUIT -->

<div class="container py-5 form custom-bgc rounded">
    <form action="#" method="POST">
        <div class="row">
            <div class="text-white">
                <div class="p-5">

                    <!-- NOM & DESCRIPTION -->

                    <div class="row">
                        <div class="col-md-6 mb-4 pb-2">
                            <div class="form-outline">
                                <label class="form-label" for="nom">Nom du produit</label>
                                <input type="text" id="nom" name="nom" class="form-control form-control-lg" value="..." />
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 pb-2">
                            <div class="form-outline">
                                <label class="form-label" for="description">Description</label>
                                <textarea id="description" name="description" class="form-control form-control-lg">...</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- PRIX & PRIX PROMOTIONNEL -->

                    <div class="row">
                        <div class="mb-4 col-md-6 pb-2">
                            <div class="form-outline form-white">
                                <label class="form-label" for="prix">Prix</label>
                                <input type="text" id="prix" name="prix" class="form-control form-control-lg" value="999" />
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 pb-2">
                            <div class="form-outline form-white">
                                <label class="form-label" for="prix_promotion">Prix promotionnel</label>
                                <input type="text" id="prix_promotion" name="prix_promotion" class="form-control form-control-lg" value="499" />
                            </div>
                        </div>
                    </div>

                    <!-- STOCK & IMAGE -->

                    <div class="row">
                        <div class="mb-4 col-md-6 pb-2">
                            <div class="form-outline form-white">
                                <label class="form-label" for="stock">Stock</label>
                                <input type="text" id="stock" name="stock" class="form-control form-control-lg" value="999" />
                            </div>
                        </div>
                        <div class="mb-4 col-md-6 pb-2">
                            <div class="form-outline form-white">
                                <label class="form-label" for="image">Image</label>
                                <input type="text" id="image" name="image" class="form-control form-control-lg" value="https://images.unsplash.com/photo-1549719386-74dfcbf7dbed?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" />
                            </div>
                        </div>
                    </div>

                    <!-- NOM CATEGORIE -->

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="categorie" class="form-label">Catégorie</label>
                            <select class="form-select form-select-lg" id="categorie" name="categorie" aria-label="Sélectionnez une catégorie">
                                <option value="accessoires.sacs_de_sport">accessoires.sacs_de_sport</option>
                                <option value="accessoires.chaussettes">accessoires.chaussettes</option>
                                <option value="accessoires.gourdes">accessoires.gourdes</option>
                                <option value="accessoires.cordes_à_sauter">accessoires.cordes_à_sauter</option>
                                <option value="equipements.protege_dents">equipements.protege_dents</option>
                                <option value="equipements.gants_de_boxe">equipements.gants_de_boxe</option>
                                <option value="equipements.bandes_de_boxe">equipements.bandes_de_boxe</option>
                                <option value="equipements.sacs_de_frappe">equipements.sacs_de_frappe</option>
                                <option value="equipements.plateforme_de_reflexe">equipements.plateforme_de_reflexe</option>
                                <option value="equipements.sac_de_frappe_rotatif">equipements.sac_de_frappe_rotatif</option>
                                <option value="vetements.chaussures_de_boxe">vetements.chaussures_de_boxe</option>
                                <option value="vetements.pantalon_de_survêtement">vetements.pantalon_de_survêtement</option>
                                <option value="vetements.shorts_de_boxe">vetements.shorts_de_boxe</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-4 pb-2">
                            <div class="form-outline form-white">
                                <label class="form-label" for="taille">Taille</label>
                                <select class="form-select form-select-lg" id="taille" name="taille" aria-label="Default select example">
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="TU">TU</option>
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
                                    <option value="rouge">Rouge</option>
                                    <option value="vert">Vert</option>
                                    <option value="noir">Noir</option>
                                    <option value="blanc">Blanc</option>
                                    <option value="bleu">Bleu</option>
                                    <option value="beige">Beige</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 pb-2">
                            <div class="form-outline form-white">
                                <label class="form-label" for="genre">Genre</label>
                                <select class="form-select form-select-lg" id="genre" name="genre" aria-label="Default select example">
                                    <option value="homme">Homme</option>
                                    <option value="femme">Femme</option>
                                    <option value="unisex">Unisexe</option>
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
                                    <option value="Nike">Nike</option>
                                    <option value="Adidas">Adidas</option>
                                    <option value="Everlast">Everlast</option>
                                    <option value="Venum">Venum</option>
                                    <option value="Metal Boxe">Metal Boxe</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4 col-md-6 pb-5">
                            <div class="form-outline form-white">
                                <label class="form-label" for="matiere">Matiere</label>
                                <select class="form-select form-select-lg" id="matiere" name="matiere" aria-label="Default select example">
                                    <option value="Coton">Coton</option>
                                    <option value="Polyester">Polyester</option>
                                    <option value="Nylon">Nylon</option>
                                    <option value="Laine">Laine</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <!-- BUTTON D'ENVOI -->

                    <div class="d-flex justify-content-center">
                        <input type="submit" value="AJOUTER LE PRODUIT" class="btn custom-button-2">
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
</main>

<?php

require("inc/footer.inc.php");

?>