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
                        <li><a class="dropdown-item" href="medecins_specialises.php">Médecins Spécialistes</a></li>
                        <li><a class="dropdown-item" href="Laboratoire.php">Laboratoire de biologie médicale</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rendezvous.php">Rendez-vous</a>
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
            <form class="d-flex navbar-nav mb-lg-0" role="search" action="recherche.php">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success " type="submit">Search</button>
            </form>
        </div>

    </div>
</nav>