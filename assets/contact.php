<?php

$title = "FitWithBoxing - Contact";
$active = "contact";

require("inc/init.inc.php");

if (!empty($_POST)) {

    // TRAITEMENT DES CHAMPS

    $_POST["nom"] = treatmentText($_POST["nom"]);
    $_POST["prenom"] = treatmentText($_POST["prenom"]);
    $_POST["email"] = treatmentText($_POST["email"]);
    $_POST["message"] = treatmentText($_POST["message"]);

    // VERIFICATIONS CHAMP

    if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['message'])) {
        $contenu .= "<div class=\"alert alert-danger\">" . MISS_FIELD . "</div>";
    }

    // VERIFICATION SANS ERREUR

    if (empty($contenu)) {

        $verifContact = $fwbBDD->prepare("INSERT INTO fwb_contact (nom, prenom, email, message, date_envoi) 
        VALUES (:nom, :prenom, :email, :message, :date)");

        $verifContact->execute([
            ':nom' => $_POST["nom"],
            ':prenom' => $_POST["prenom"],
            ':email' => $_POST["email"],
            ':message' => $_POST["message"],
            ':date' => getCurrentDate(),
        ]);

        if ($verifContact) {
            $contenu .= "<div class=\"alert alert-success\">" . FIELD_VALID . "</div>";
        } else {
            $contenu .= "<div class=\"alert alert-danger\">" . ERROR . "</div>";
        }
    }
}

require('inc/utils.inc.php');

?>

<main>

    <!-- AFFICHAGE DES ERREURS -->

    <?php echo $contenu; ?>

    <!-- HAUT DE PAGE -->

    <div class="text-center mt-5 mb-5">
        <h1>CONTACTEZ-NOUS</h1>
        <hr class="custom-hr">
    </div>

    <!-- FORMULAIRE CONTACT -->

    <div class="container w-50">
        <form action="#" method="POST">
            <div class="row">
                <div class="form-group col-6">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="MOREL">
                </div>
                <div class="form-group col-6">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Nicolas">
                </div>
            </div>
            <div class="form-group">
                <label for="email">Adresse e-email</label>
                <input type="eemail" class="form-control" id="email" name="email" placeholder="nom@exemple.com">
            </div>

            <div class="form-group">
                <label for="message">Votre message</label>
                <textarea class="form-control" id="message" name="message" rows="8"></textarea>
            </div>

            <input type="submit" value="ENVOYER" class="btn custom-button-1">

        </form>
    </div>

</main>

<?php

require("inc/footer.inc.php");

?>