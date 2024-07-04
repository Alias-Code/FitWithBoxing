<?php

$title = "FitWithBoxing - Connexion";
$active = "login";

require("inc/init.inc.php");

// REDIRECTION SI EN-LIGNE

if (isOnline()) {
  header("location:profil.php");
  exit();
}

if (!empty($_POST)) {

  // TRAITEMENT DES CHAMPS

  $_POST["email"] = treatmentText($_POST["email"]);

  // VERIFICATION CHAMPS

  if (empty($_POST['email']) || empty($_POST['mot_de_passe'])) {
    $contenu .= "<div class=\"alert alert-danger\">" . MISS_FIELD . "</div>";
  }

  // CONNEXION

  if (empty($contenu)) {

    $connexion = $fwbBDD->prepare("SELECT * FROM fwb_membres WHERE email = :email");
    $connexion->execute([
      ':email' => $_POST['email'],
    ]);

    if ($connexion->rowCount() !== 0) {

      $userInformations = $connexion->fetch(PDO::FETCH_ASSOC);

      if (password_verify($_POST['mot_de_passe'], $userInformations['mot_de_passe'])) {

        $_SESSION['membres'] = $userInformations;
        header('location:profil.php');
        exit();
      } else {
        $contenu .= "<div class=\"alert alert-danger\">" . INCORRECT_PASSWORD . "</div>";
      }
    } else {
      $contenu .= "<div class=\"alert alert-danger\">" . INCORRECT_EMAIL . "</div>";
    }
  }
}

require('inc/utils.inc.php');

?>

<main>

  <!-- AFFICHAGE DES ERREURS -->

  <?php echo $contenu; ?>

  <!-- FORMULAIRE CONNEXION -->

  <div class="container py-5">
    <div class="d-flex justify-content-center align-items-center">
      <div class="col-10">
        <div class="row">

          <!-- IMAGE -->

          <div class=" col-md-6 col-lg-5 d-none d-md-block p-0">
            <img class="h-100 rounded-start" src="medias/logos/brand.png" alt="login form" class="img-fluid" />
          </div>

          <!-- CONNEXION -->

          <div class="col-md-6 col-lg-7 d-flex align-items-center p-0 custom-bgc rounded-end">
            <div class="connexion-form card-body p-4 p-lg-5 text-white">

              <form action="#" method="POST">

                <div class="d-flex align-items-center mb-3 pb-1">
                  <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                  <span class="h1 fw-bold mb-0"><img src="medias/logos/logo.png" alt="Logo de marque"></span>
                </div>

                <h5 class="fw-normal mb-3 pb-3 fw-bold">Connectez-vous à votre compte !</h5>

                <div class="form-outline mb-4">
                  <label class="form-label" for="email">Adresse e-mail</label>
                  <input type="email" id="email" name="email" class="form-control form-control-lg" />
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="mot_de_passe">Mot de passe</label>
                  <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control form-control-lg" />
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="afficher_mot_de_passe">
                  <label class="form-check-label" for="afficher_mot_de_passe">Afficher le mot de passe</label>
                </div>

                <div class="pt-4">
                  <input type="submit" value="SE CONNECTER" class="btn custom-button-2 btn btn-block">
                </div>

                <div class="d-flex justify-content-between mt-4">
                  <a class="fs-5 fw-bold" href="register.php">Créer un compte</a>
                  <a class="fs-5 fw-bold" href="forgot-password.php">Mot de passe oublié</a>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<?php

require("inc/footer.inc.php");

?>