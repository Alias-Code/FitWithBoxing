<?php

$title = "FitWithBoxing - Profil";
$active = "Profil";

require("inc/init.inc.php");

// REDIRECTION SI NON EN-LIGNE

if (!isOnline()) {
    header('location:connexion.php');
    exit();
}

// RECUPERATION DES INFORMATIONS

$query = $fwbBDD->prepare("SELECT * FROM fwb_membres, fwb_commandes WHERE membres.prenom = 'Adam' AND commandes.id_membre = membres.id_membre");
$query->execute([
    ':id_membre' => $_SESSION['membres']['id_membre'],
]);

$userInfo = $query->fetch(PDO::FETCH_ASSOC);

// DECONNEXION

if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
    session_destroy();
    header('location:home.php');
    exit();
}

require("inc/utils.inc.php");

?>

<!-- PROFIL -->

<div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col col-xl-10">
            <div class="card">
                <div class="row g-0">

                    <!-- IMAGE -->

                    <div class="col-md-6 col-lg-5 d-none d-md-block">
                        <img class="connexion-image h-100 rounded-start" src="medias/logos/brand.png" alt="login form" class="img-fluid" />
                    </div>

                    <!-- INFORMATIONS DU PROFIL -->

                    <div class="col-md-6 col-lg-7 d-flex align-items-center custom-bgc rounded-end">
                        <div class="profil-informations card-body p-4 p-lg-5 text-dark">

                            <!-- IMAGE -->

                            <div class=" col-md-12 d-flex justify-content-center mb-4">
                                <img class="connexion-image" src="medias/logos/logo.png" alt="login form" class="img-fluid" />
                            </div>

                            <h1 class="text-center mb-5">Profil de <?php echo "$userInfo[prenom] $userInfo[nom]" ?></h1>

                            <div class="row text-white fs-4">
                                <div class="col-sm-6 mb-3">
                                    <p><strong>Nom :</strong> <?php echo $userInfo['nom']; ?></p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <p><strong>Prénom :</strong> <?php echo $userInfo['prenom']; ?></p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <p><strong>Email :</strong> <?php echo $userInfo['email']; ?></p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <p><strong>Adresse :</strong> <?php echo $userInfo['adresse']; ?></p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <p><strong>Complément d'adresse :</strong> <?php echo $userInfo['complement_adresse']; ?></p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <p><strong>Ville :</strong> <?php echo $userInfo['ville']; ?></p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <p><strong>Code postal :</strong> <?php echo $userInfo['code_postal']; ?></p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <p><strong>Pays :</strong> <?php echo $userInfo['pays']; ?></p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <p><strong>Téléphone :</strong> <?php echo $userInfo['telephone']; ?></p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <p><strong>Date d'inscription :</strong> <?php echo $userInfo['date_inscription']; ?></p>
                                </div>

                                <div class="row mt-3">
                                    <a href="edit-profil.php?id_membre=<?php echo $_SESSION["membres"]["id_membre"] ?>" class="btn col-6 custom-button-2">MODIFIER SON PROFIL</a>
                                    <a href="profil.php?action=deconnexion" class="btn col-6 custom-button-2">SE DECONNECTER</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

require 'inc/footer.inc.php';

?>