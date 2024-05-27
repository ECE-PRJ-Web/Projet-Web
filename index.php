<?php
session_start();
$_SESSION['id']=session_id();

if (isset($_SESSION['connected']) && $_SESSION['connected'] == true) {

}

else {
    header('Location: connexion.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Medicare: Services médicaux</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="script.js"></script>
</head>
<body class="d-flex text-center">

<div class="container" id="wrapper">
    <div class="bg-info bg-gradient bg-success" style="--bs-bg-opacity: .3" id="header">
        <h1>Medicare: Services médicaux</h1>
        <div class="bd">
            <nav class="navbar navbar-expand-lg sticky-top mb-2">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">Accueil</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Tout Parcourir
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="medecine_generale.php">Médecine Générale</a></li>
                                    <li><a class="dropdown-item" href="#">Médecins Spécialistes</a></li>
                                    <li><a class="dropdown-item" href="#">Laboratoire de biologie médicale</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Rendez-vous</a>
                            </li>
                        </ul>
                        <?php if (isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
                            echo '<div class="me-2">';
                            echo '<a href="compte.php" class="btn btn-outline-success me-2">Compte</a>';
                            echo '<a href="deconnexion.php" class="btn btn-outline-secondary">Déconnexion</a>';
                            echo '</div>';
                        } else {
                            echo '<div class="me-2 ">';
                            echo '<a href="connexion.php" class="btn btn-outline-secondary me-2">Connexion</a>';
                            echo '<a href="inscription.php" class="btn btn-outline-success">Inscription</a>';
                            echo '</div>';
                        }
                        ?>
                        <form class="d-flex navbar-nav mb-lg-0" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success " type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div id="content" class="cover-container d-flex w-100 p-3 mx-auto flex-column ">
        <h2>Bulletin santé de la semaine</h2>
        <br>
        <div id="carrousel" class="lead">
            <ul style="list-style: none">
                <li><a href="https://www.legorafi.fr/2023/12/19/penurie-de-medicaments-le-gouvernement-recommande-de-mettre-une-gousse-dail-sous-son-oreiller/"><h5 class="">Pénurie de médicaments – Le gouvernement recommande <br> de mettre une gousse d’ail sous son oreiller</h5><img class="img-fluid" src="medicaments.png" width="700" height="400.jpg"/></a></li>
                <li><a href="https://www.legorafi.fr/2023/06/19/par-un-procede-revolutionnaire-des-scientifiques-reussissent-a-transformer-la-contrex-en-eau/"><h5 class="">Par un procédé révolutionnaire,<br>des scientifiques réussissent à transformer la Contrex en eau</h5> <img class="img-fluid" src="https://www.legorafi.fr/wp-content/uploads/2023/06/labo-2048x1152.jpg" width="700" height="400.jpg"></a></li>
                <li><a href="https://www.legorafi.fr/2024/05/24/une-etude-revele-que-les-gauchers-sont-plus-habiles-de-leur-main-gauche/"><h5 class="">Une étude révèle que les gauchers <br> sont plus habiles de leur main gauche</h5> <img class="img-fluid" src="https://www.legorafi.fr/wp-content/uploads/2024/05/iStock-1253877737-2048x1365.jpg" width="700" height="400.jpg"></a></li>
            </ul>
        </div>
    </div>

    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">© 2024 SA Medicare</p>
        <p class="col-md-4 mb-0 text-body-secondary">51 Rue Trayne Cul, 69620 Val d'Oingt</p>

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2774.1514899926615!2d4.580111175787794!3d45.94825620101239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f4886b1b8a7331%3A0x8cc507515c81c158!2sRue%20Trayne%20Cul%2C%2069620%20Val%20d&#39;Oingt!5e0!3m2!1sfr!2sfr!4v1716677967175!5m2!1sfr!2sfr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </footer>
</div>
</body>
</html>
