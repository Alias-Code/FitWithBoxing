<?php

$title = "FitWithBoxing - Mot de passe oublié";
$active = "";

require("inc/init.inc.php");

// REDIRECTION SI NON EN-LIGNE

if (!isOnline()) {
    header("location:home.php");
    exit();
}

// REINITIALISATION DU MOT DE PASSE

$resetPassword = false;

if (!empty($_POST)) {

    // ETAPE 1 : REPONDRE A LA QUESTION

    if (!$resetPassword && empty($_POST["mot_de_passe"])) {

        $mot = count(explode(" ", $_POST["reponse"]));

        if ($mot > 1) {
            $contenu .= "<div class=\"alert alert-danger\">" . INCORRECT_RESPONSE . "</div>";
        }

        if (empty($contenu)) {

            if ($_POST["reponse"] === $_SESSION["membres"]["reponse"]) {
                $contenu .= "<div class=\"alert alert-success\">" . CORRECT_RESPONSE . "</div>";
                $resetPassword = true;
            } else {
                $contenu .= "<div class=\"alert alert-danger\">" . INCORRECT_RESPONSE . "</div>";
            }
        }
    } else {

        // ETAPE 2 : ENTRER UN NOUVEAU MOT DE PASSE

        $mdp = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

        $query = $fwbBDD->prepare("UPDATE fwb_membres SET mot_de_passe = :mot_de_passe WHERE id_membre = :id_membre");

        $query->execute([
            ":mot_de_passe" => $mdp,
            ":id_membre" => $_SESSION["membres"]["id_membre"]
        ]);

        if ($query) {
            header('location:profil.php');
            exit();
        } else {
            $contenu .= "<div class=\"alert alert-danger\">" . ERROR . "</div>";
        }
    }
}

require("inc/utils.inc.php");

?>

<main>

    <!-- AFFICHAGE DES ERREURS -->

    <?php echo $contenu; ?>

    <!-- DEBUT REINITIALISATION MOT DE PASSE -->

    <div class="container py-5 row d-flex justify-content-center mx-auto">
        <div class="col-10">
            <div class="row">

                <!-- IMAGE -->

                <div class=" col-md-5 d-none d-md-block p-0">
                    <img class="connexion-image" src="medias/logos/brand.png" alt="login form" class="img-fluid" />
                </div>

                <!-- REINITIALISATION DU MOT DE PASSE -->

                <div class="col-md-7 p-0 custom-bgc rounded-end">
                    <div class="connexion-form card-body p-4 p-lg-5 text-white h-100 d-flex align-items-center mx-auto">

                        <!-- ETAPE 1 : REPONDRE A LA QUESTION -->

                        <?php if (!$resetPassword) { ?>
                            <form action="#" method="POST" class="step-1">

                                <h1 class="fw-normal mb-5 pb-3 fw-bold text-center">Réinitialisation du mot de passe</h1>

                                <h3 class="mb-4 pb-3"><?php echo $_SESSION["membres"]["question"] ?></h3>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="reponse">Votre réponse</label>
                                    <input type="text" id="reponse" name="reponse" class="form-control form-control-lg" placeholder="Veuillez répondre en un seul mot !" />
                                </div>

                                <div class="pt-4">
                                    <input type="submit" value="ENVOYER" class="btn custom-button-2 btn btn-lg btn-block">

                                </div>
                            </form>

                        <?php } ?>

                        <!-- ETAPE 2 : ENTRER UN NOUVEAU MOT DE PASSE -->

                        <?php if ($resetPassword) { ?>

                            <form action="#" method="POST" class="step-2">

                                <h1 class="fw-normal mb-5 pb-3 fw-bold text-center">Réinitialisation du mot de passe</h1>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="mot_de_passe">Votre nouveau mot de passe</label>
                                    <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control form-control-lg" />
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="afficher_mot_de_passe">
                                    <label class="form-check-label" for="afficher_mot_de_passe">Afficher le mot de passe</label>
                                </div>

                                <div class="pt-4">
                                    <input type="submit" value="ENVOYER" class="btn connexion-button btn btn-lg btn-block">
                                </div>
                            </form>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<?php

require("inc/footer.inc.php");

?>