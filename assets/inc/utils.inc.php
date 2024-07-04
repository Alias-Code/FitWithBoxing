<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title ?></title>

    <!-- DESCRIPTION -->

    <meta name="description" content="FitWithBoxing vous propose une large gamme de produits de boxe haut de gamme, de quoi être excellent sur le ring. Achetez la qualité, frappez en quantité." />

    <!-- ICONS -->

    <link rel="shortcut icon" href="medias/logos/logo_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <!-- FONT LATO -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" rel="stylesheet" />

    <!-- FONT ARVO -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" />

    <!-- FONT POPPINS -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet" />

    <!-- BOOTSTRAP -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://bootswatch.com/3/sandstone/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- CSS -->

    <link type="text/css" rel="stylesheet" href="css/style.css" />

    <!-- JS -->

    <script src="js/script.js" async></script>
</head>

<body class="custom-scrollbar">

    <!-- DEBUT NAVIGATION -->

    <nav class="navbar navbar-expand-lg rounded-0 <?php if ($active == "home") {
                                                        echo "home-nav";
                                                    } ?>" data-bs-theme="dark">
        <div class="container-fluid">
            <a href="home.php"><img src="medias/logos/logo.png" alt="Logo de marque" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav me-auto">

                    <!-- CATEGORIES -->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php if ($active == "accessoires") {
                                                                echo "active";
                                                            } ?>" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Accessoires</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="products.php?nom_categorie=accessoires.sacs_de_sport">Sacs de sport</a>
                            <a class="dropdown-item" href="products.php?nom_categorie=accessoires.chaussettes">Chaussettes</a>
                            <a class="dropdown-item" href="products.php?nom_categorie=accessoires.gourdes">Gourdes</a>
                            <a class="dropdown-item" href="products.php?nom_categorie=accessoires.cordes_a_sauter">Cordes à sauter</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php if ($active == "equipements") {
                                                                echo "active";
                                                            } ?>" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Equipements</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="products.php?nom_categorie=equipements.gants_de_boxe">Gants de boxe</a>
                            <a class="dropdown-item" href="products.php?nom_categorie=equipements.proteges_dent">Protèges-dent</a>
                            <a class="dropdown-item" href="products.php?nom_categorie=equipements.bandes_de_frappe">Bandes de frappe</a>
                            <a class="dropdown-item" href="products.php?nom_categorie=equipements.casques">Casques</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php if ($active == "machines") {
                                                                echo "active";
                                                            } ?>" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Machines</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="products.php?nom_categorie=machines.sacs_de_frappe">Sacs de frappe</a>
                            <a class="dropdown-item" href="products.php?nom_categorie=machines.plateformes_de_reflexe">Plateformes de réflexe</a>
                            <a class="dropdown-item" href="products.php?nom_categorie=machines.sacs_de_frappe_rotatif">Sacs de frappe rotatifs</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php if ($active == "vetements") {
                                                                echo "active";
                                                            } ?>" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Vetements</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="products.php?nom_categorie=vetements.chaussures_de_boxe">Chaussures de boxe</a>
                            <a class="dropdown-item" href="products.php?nom_categorie=vetements.pantalons_de_survêtement">Pantalons de survêtement</a>
                            <a class="dropdown-item" href="products.php?nom_categorie=vetements.shorts_de_boxe">Shorts de boxe</a>
                        </div>
                    </li>

                    <!-- ADMIN -->

                    <?php if (isAdmin()) { ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php if ($active == "add-product" || $active == "delete-product") {
                                                                    echo "active";
                                                                } ?>" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ADMIN</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="add-product.php">Ajouter un produit</a>
                                <a class="dropdown-item" href="products-management.php">Gestion des produits</a>
                            </div>
                        </li>

                    <?php } ?>

                    <!-- LIENS -->

                    <li class="nav-item">
                        <a class="nav-link <?php if ($active == "all-products") {
                                                echo "active";
                                            } ?>" href="all-products.php">Produits</a>
                    </li>
                </ul>

                <!-- LIENS -->

                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link <?php if ($active == "about") {
                                                echo "active";
                                            } ?>" href="about.php">A Propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($active == "contact") {
                                                echo "active";
                                            } ?>" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-4 <?php if ($active == "faq") {
                                                    echo "active";
                                                } ?>" href="faq.php">FAQ</a>
                    </li>
                </ul>

                <!-- ICONS -->

                <div class="d-flex">
                    <a href="login.php"><i class="bi bi-person-fill fs-1"></i></a>
                    <a href="all-products.php"><i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="25px" fill="white" height="25px">
                                <path d="M34.8 32c-.9 1-1.9 1.9-2.9 2.7l11.7 11.7 2.8-2.8L34.8 32zM20.5 2.5A17 17 0 1020.5 36.5 17 17 0 1020.5 2.5z" />
                            </svg></i></a>
                    <a href="cart.php"><i class="bi bi-cart-fill"></i></a>
                </div>
            </div>
        </div>
    </nav>