<?php
$id = $_GET['id'];

$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');

$requete = $bdd->prepare("SELECT nom, prenom, type_compte FROM clients WHERE id = :id");

$requete->bindParam(':id', $id, PDO::PARAM_INT);

$requete->execute();

$row = $requete->fetch();

$nom = $row['nom'];
$prenom = $row['prenom'];
$type_compte = $row['type_compte'];

if ($type_compte == 2) {
    $type_compte = "Administrateur";
} else if ($type_compte == 1) {
    $type_compte = "Médecin";
} else {
    $type_compte = "Utilisateur";
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Medicare: <?php echo htmlspecialchars($professionnel['nom'] . ' ' . $professionnel['prenom']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex text-center">

<div class="container" id="wrapper">
    <!-- Header et navigation -->
    <div class="bg-info bg-gradient bg-success" style="--bs-bg-opacity: .3" id="header">
        <h1>Medicare: Détails du professionnel</h1>
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
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div id="content" class="cover-container d-flex w-100 p-3 mx-auto flex-column">
        <h1>Modifier le rôle de <?php echo htmlspecialchars($nom . ' ' . $prenom); ?></h1>
        <form action="traitement_modifier_role.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group mb-3">
                <label for="type_compte">Rôle</label>
                <select class="form-select" id="type_compte" name="type_compte">
                    <option value="0" <?php if ($type_compte == "Utilisateur") echo "selected"; ?>>Utilisateur</option>
                    <option value="1" <?php if ($type_compte == "Médecin") echo "selected"; ?>>Médecin</option>
                    <option value="2" <?php if ($type_compte == "Administrateur") echo "selected"; ?>>Administrateur</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</div>
