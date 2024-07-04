<?php

$title = "FitWithBoxing - Inscription";
$active = "";

require("inc/init.inc.php");

// REDIRECTION SI EN-LIGNE

if (isOnline()) {
    header("location:profil.php");
    exit();
}

// INSCRIPTION

if (!empty($_POST)) {

    $query = $fwbBDD->prepare('INSERT INTO fwb_membres (nom, prenom, genre, email, mot_de_passe, adresse, complement_adresse, ville, code_postal, pays, telephone, date_inscription, question, reponse, statut) VALUES (:nom, :prenom, :genre, :email, :mot_de_passe, :adresse, :complement_adresse, :ville, :code_postal, :pays, :telephone, :date_inscription, :question, :reponse, :statut)');

    $mdp = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

    $query->execute([
        ':nom' => $_POST['nom'],
        ':prenom' => $_POST['prenom'],
        ':genre' => $_POST['genre'],
        ':email' => $_POST['email'],
        ':mot_de_passe' => $mdp,
        ':adresse' => $_POST['adresse'],
        ':complement_adresse' => $_POST['complement_adresse'],
        ':ville' => $_POST['ville'],
        ':code_postal' => $_POST['code_postal'],
        ':pays' => $_POST['pays'],
        ':telephone' => $_POST['telephone'],
        ':date_inscription' => getCurrentDate(),
        ':question' => $_POST['question'],
        ':reponse' => $_POST['reponse'],
        ':statut' => 'membre',
    ]);

    if ($query) {
        $contenu .= "<div class=\"alert alert-success\">Vous êtes bien inscrit.e sur le site, bienvenue ! <a href=\"connexion.php\">Cliquez ici pour vous connecter !</a></div>";
    } else {
        $contenu .= "<div class=\"alert alert-danger\">Erreur lors de l'inscription</div>";
    }
}

require("inc/utils.inc.php");

?>

<main>

    <!-- AFFICHAGE DES ERREURS -->

    <?php echo $contenu; ?>

    <div id="error-messages" class="alert alert-danger" style="display: none;"></div>

    <!-- FORMULAIRE D'INSCRIPTION -->

    <div class="custom-bgc rounded-4 container text-white">
        <form action="#" method="POST" class="registration-form">
            <div class="row">

                <!-- INFORMATION SPERSONNELLES -->

                <div class="col-lg-6">
                    <div class="p-5">

                        <h1 class="mb-5 text-center">Informations personnelles</h1>

                        <!-- NOM DE FAMILLE & PRENOM -->

                        <div class="row">
                            <div class="col-md-6 mb-4 pb-2">
                                <div class="form-outline">
                                    <label class="form-label" for="nom">Nom de famille</label>
                                    <input type="text" id="nom" name="nom" class="form-control form-control-lg" />
                                </div>
                            </div>

                            <div class="col-md-6 mb-4 pb-2">
                                <div class="form-outline">
                                    <label class="form-label" for="prenom">Prénom</label>
                                    <input type="text" id="prenom" name="prenom" class="form-control form-control-lg" />
                                </div>
                            </div>
                        </div>

                        <!-- GENRE -->

                        <div class="mb-4 pb-2">
                            <label class="form-label" for="genre">Genre</label>
                            <select class="form-select form-select-lg" id="genre" name="genre" aria-label="Default select example">
                                <option value="1" selected>Homme</option>
                                <option value="2">Femme</option>
                            </select>
                        </div>

                        <!-- ADRESSE E-MAIL -->

                        <div class="mb-2 pb-2">
                            <div class="form-outline">
                                <label class="form-label" for="email">Adresse e-mail</label>
                                <input type="text" id="email" name="email" class="form-control form-control-lg" />
                            </div>
                        </div>

                        <!-- MOT DE PASSE -->

                        <div class="row">
                            <div class="col-md-12 mb-4 pb-2">

                                <div class="form-outline">
                                    <label class="form-label" for="mot_de_passe">Mot de passe</label>
                                    <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control form-control-lg" />
                                </div>

                            </div>
                            <div class="form-check p-5">
                                <input class="form-check-input" type="checkbox" id="afficher_mot_de_passe">
                                <label class="form-check-label" for="afficher_mot_de_passe">Afficher le mot de passe</label>
                            </div>
                        </div>
                    </div>

                    <!-- IMAGE -->

                    <div class="p-5">
                        <div class="row">
                            <div class="col-lg-12 d-flex justify-content-center">
                                <img src="medias/logos/logo-removebg-preview.png" alt="" class="align-self-end">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- INFORMATIONS GENERALES -->

                <div class="col-lg-6 bg-red text-white">
                    <div class="p-5">
                        <h1 class="mb-5 text-center">Informations générales</h1>

                        <!-- ADRESSE -->

                        <div class="mb-4 pb-2">
                            <div class="form-outline form-white">
                                <label class="form-label" for="adresse">Adresse</label>
                                <input type="text" id="adresse" name="adresse" class="form-control form-control-lg" />
                            </div>
                        </div>

                        <!-- COMPLEMENT ADRESSE -->

                        <div class="mb-4 pb-2">
                            <div class="form-outline form-white">
                                <label class="form-label" for="complement_adresse">Complément d'adresse</label>
                                <input type="text" id="complement_adresse" name="complement_adresse" class="form-control form-control-lg" />
                            </div>
                        </div>

                        <!-- VILLE & CODE POSTAL -->

                        <div class="row">
                            <div class="col-md-6 mb-4 pb-2">

                                <div class="form-outline form-white">
                                    <label class="form-label" for="ville">Ville</label>
                                    <input type="text" id="ville" name="ville" class="form-control form-control-lg" />
                                </div>

                            </div>
                            <div class="col-md-6 mb-4 pb-2">

                                <div class="form-outline form-white">
                                    <label class="form-label" for="code_postal">Code postal</label>
                                    <input type="text" id="code_postal" name="code_postal" class="form-control form-control-lg" />
                                </div>

                            </div>
                        </div>

                        <!-- PAYS & NUMERO DE TELEPHONE -->

                        <div class="row">
                            <div class="mb-4 col-md-6 pb-2">
                                <label class="form-label" for="pays">Pays</label>
                                <select class="form-select form-select-lg" id="pays" name="pays" aria-label="Default select example">
                                    <option selected>France</option>
                                    <option value="1">Espagne</option>
                                    <option value="2">Italie</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4 pb-2">

                                <div class="form-outline form-white">
                                    <label class="form-label" for="telephone">Numéro de téléphone</label>
                                    <input type="text" id="telephone" name="telephone" class="form-control form-control-lg" />
                                </div>

                            </div>
                        </div>

                        <!-- QUESTIONS DE SECURITE & REPONSE -->

                        <div class="row">
                            <div class="mb-4 col-md-6 pb-2">
                                <label class="form-label" for="question">Question de sécurité</label>
                                <select class="form-select form-select-lg" id="question" name="question" aria-label="Default select example">
                                    <option selected>Quel est le cadeau le plus touchant que vous avez reçu ?</option>
                                    <option>Quel est le nom de votre meilleur ami ?</option>
                                    <option>Quelle est la ville de vacances qui vous a le plus plu ?</option>
                                    <option>Quel est le nom de vôtre chat ?</option>
                                    <option>Combien d'animaux aviez-vous quand vous étiez petit ?</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-4 pb-2">

                                <div class="form-outline form-white">
                                    <label class="form-label" for="reponse">Réponse</label>
                                    <input type="text" id="reponse" name="reponse" class="form-control form-control-lg" placeholder="Veuillez répondre en un seul mot !" />
                                </div>

                            </div>
                        </div>


                        <!-- CONDITIONS D'UTILISATION -->

                        <div class="form-check d-flex justify-content-start mb-4 pb-3">
                            <input class="form-check-input me-3" type="checkbox" value="" id="conditions_utilisation" name="conditions_utilisation" />
                            <label class="form-check-label text-white" for="conditions_utilisation">
                                J'accepte les <a href="#" class="text-white"><u>Conditions Générales d'Utilisation</u></a>.
                            </label>
                        </div>

                        <!-- BOUTTON -->

                        <input type="submit" value="S'INSCRIRE" class="btn custom-button-2">

                    </div>
                </div>
            </div>
        </form>
    </div>
</main>


<?php

require("inc/footer.inc.php");

?>