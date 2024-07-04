<?php

$title = "FitWithBoxing - Modification du profil";
$active = "";

require("inc/init.inc.php");

// RECUPERATION DES INFORMATIONS

if (isset($_GET['id_membre']) && $_SESSION['membres']['id_membre'] == $_GET['id_membre']) {

    $userInformationsQuery = $fwbBDD->prepare(" SELECT * FROM fwb_membres WHERE id_membre = :id_membre ");

    $userInformationsQuery->execute(array(
        ':id_membre' => $_SESSION['membres']['id_membre']
    ));

    if ($userInformationsQuery->rowCount() == 0) {
        header('location:home.php');
        exit();
    }

    $userInformations = $userInformationsQuery->fetch(PDO::FETCH_ASSOC);
} else {
    header('location:home.php');
    exit();
}

// ACTUALISATION DES INFORMATIONS

if (!empty($_POST)) {

    // TRAITEMENT DES CHAMPS

    $_POST["nom"] = treatmentText($_POST["nom"]);
    $_POST["prenom"] = treatmentText($_POST["prenom"]);
    $_POST["genre"] = treatmentText($_POST["genre"]);
    $_POST["adresse"] = treatmentText($_POST["adresse"]);
    $_POST["complement_adresse"] = treatmentText($_POST["complement_adresse"]);
    $_POST["ville"] = treatmentText($_POST["ville"]);
    $_POST["code_postal"] = treatmentText($_POST["code_postal"]);
    $_POST["pays"] = treatmentText($_POST["pays"]);
    $_POST["telephone"] = treatmentText($_POST["telephone"]);

    // REQUETE

    $verifEditProfil = $fwbBDD->prepare("UPDATE fwb_membres SET nom = :nom, prenom = :prenom, genre = :genre, adresse = :adresse, complement_adresse = :complement_adresse, ville = :ville, code_postal = :code_postal, pays = :pays, telephone = :telephone WHERE id_membre = :id_membre");

    $verifEditProfil->execute([
        ':nom' => $_POST["nom"],
        ':prenom' => $_POST["prenom"],
        ':genre' => $_POST["genre"],
        ':adresse' => $_POST["adresse"],
        ':complement_adresse' => $_POST["complement_adresse"],
        ':ville' => $_POST["ville"],
        ':code_postal' => $_POST["code_postal"],
        ':pays' => $_POST["pays"],
        ':telephone' => $_POST["telephone"],
        ':id_membre' => $_GET["id_membre"]
    ]);

    if ($verifEditProfil) {
        $contenu .= "<div class=\"alert alert-success\"> . PROFIL_EDIT . </div>";
        header("location:profil.php");
        exit();
    } else {
        $contenu .= "<div class=\"alert alert-danger\">" . ERROR . "</div>";
    }
}

require('inc/utils.inc.php');

?>

<main>

    <!-- AFFICHAGE DES ERREURS -->

    <?php echo $contenu; ?>

    <!-- HAUT DE PAGE -->

    <div class="text-center mt-5 mb-5">
        <h1 class="mb-5 text-center">Modification du profil</h1>
        <hr class="custom-hr">
    </div>

    <!-- FORMULAIRE DE MODIFICATION DU PROFIL -->

    <div class="container py-5 rounded custom-bgc">
        <form action="#" method="POST">
            <div class="row text-white p-5">

                <!-- NOM DE FAMILLE & PRENOM -->

                <div class="row">
                    <div class="col-md-6 mb-4 pb-2">
                        <div class="form-outline">
                            <label class="form-label" for="nom">Nom de famille</label>
                            <input type="text" id="nom" name="nom" class="form-control form-control-lg" value="<?php echo $userInformations['nom']; ?>" />
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 pb-2">
                        <div class="form-outline">
                            <label class="form-label" for="prenom">Prénom</label>
                            <input type="text" id="prenom" name="prenom" class="form-control form-control-lg" value="<?php echo $userInformations['prenom']; ?>" />
                        </div>
                    </div>
                </div>

                <!-- PAYS & GENRE -->

                <div class="row">
                    <div class="mb-4 col-md-6 pb-2">
                        <div class="form-outline form-white">
                            <label class="form-label" for="adresse">Adresse</label>
                            <input type="text" id="adresse" name="adresse" class="form-control form-control-lg" value="<?php echo $userInformations['adresse']; ?>" />
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 pb-2">
                        <div class="form-outline form-white">
                            <label class="form-label" for="complement_adresse">Complément d'adresse</label>
                            <input type="text" id="complement_adresse" name="complement_adresse" class="form-control form-control-lg" value="<?php echo $userInformations['complement_adresse']; ?>" />
                        </div>
                    </div>
                </div>

                <!-- TELEPHONE -->

                <div class="mb-4 pb-2">
                    <div class="form-outline form-white">
                        <label class="form-label" for="telephone">Numéro de téléphone</label>
                        <input type="text" id="telephone" name="telephone" class="form-control form-control-lg" value="<?php echo $userInformations['telephone']; ?>" />
                    </div>
                </div>

                <!-- VILLE & CODE POSTAL -->

                <div class="row">
                    <div class="col-md-6 mb-4 pb-2">
                        <div class="form-outline form-white">
                            <label class="form-label" for="ville">Ville</label>
                            <input type="text" id="ville" name="ville" class="form-control form-control-lg" value="<?php echo $userInformations['ville']; ?>" />
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 pb-2">
                        <div class="form-outline form-white">
                            <label class="form-label" for="code_postal">Code postal</label>
                            <input type="text" id="code_postal" name="code_postal" class="form-control form-control-lg" value="<?php echo $userInformations['code_postal']; ?>" />
                        </div>
                    </div>
                </div>

                <!-- PAYS & GENRE -->

                <div class="row">
                    <div class="mb-4 col-md-6 pb-2">
                        <label class="form-label" for="pays">Pays</label>
                        <select class="form-select form-select-lg" id="pays" name="pays" aria-label="Default select example">
                            <option <?php if ($userInformations['pays'] == 'France') echo 'selected'; ?>>France</option>
                            <option <?php if ($userInformations['pays'] == 'Espagne') echo 'selected'; ?>>Espagne</option>
                            <option <?php if ($userInformations['pays'] == 'Italie') echo 'selected'; ?>>Italie</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-4 pb-2">

                        <label class="form-label" for="genre">Genre</label>
                        <select class="form-select form-select-lg" id="genre" name="genre" aria-label="Default select example">
                            <option value="homme" <?php if ($userInformations['genre'] == 'homme') echo 'selected'; ?>>Homme</option>
                            <option value="femme" <?php if ($userInformations['genre'] == 'femme') echo 'selected'; ?>>Femme</option>
                        </select>
                    </div>
                </div>


                <!-- IMAGE -->

                <div class="p-5">
                    <div class="row">
                        <div class="col-lg-12 d-flex justify-content-center">
                            <img src="medias/logos/logo.png" alt="Logo de marque" class="align-self-end">
                        </div>
                    </div>
                </div>

                <!-- BUTTON D'ENVOI -->

                <div class="d-flex justify-content-center">
                    <input type="submit" value="ENREGISTRER" class="btn custom-button-2">
                </div>

                <!-- MOT DE PASSE OUBLIE -->

                <a class="fs-4 fw-bold" href="forgot-password.php?id_membre=<?php echo $_SESSION["membres"]["id_membre"] ?>">Mot de passe oublié</a>
            </div>
        </form>
    </div>
</main>



<?php
require 'inc/footer.inc.php';
?>