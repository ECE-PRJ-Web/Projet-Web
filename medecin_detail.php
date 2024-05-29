<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicare";

// Vérifier si l'ID du professionnel est passé en paramètre
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID du professionnel non spécifié");
}

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les informations sur le professionnel
$id = $_GET['id'];
$sql = "SELECT * FROM professionnels WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $professionnel = $result->fetch_assoc();
} else {
    die("Professionnel non trouvé");
}

// Récupérer les disponibilités du professionnel
$sql_dispo = "SELECT * FROM disponibilites WHERE medecin_id = $id";
$result_dispo = $conn->query($sql_dispo);

// Créer un tableau associatif pour stocker les disponibilités par jour
$disponibilites = array(
    'lundi' => array(),
    'mardi' => array(),
    'mercredi' => array(),
    'jeudi' => array(),
    'vendredi' => array(),
    'samedi' => array(),
    'dimanche' => array()
);

// Remplir le tableau associatif avec les disponibilités
if ($result_dispo->num_rows > 0) {
    while ($dispo = $result_dispo->fetch_assoc()) {
        $jour = $dispo['jour_semaine'];
        $disponibilites[$jour][] = array(
            'id' => $dispo['id'],
            'heure_debut' => $dispo['heure_debut'],
            'heure_fin' => $dispo['heure_fin'],
            'disponible' => $dispo['disponible']
        );
    }
}

$conn->close();
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
        <h2><?php echo htmlspecialchars($professionnel['nom'] . ' ' . $professionnel['prenom']); ?></h2>
        <br>
        <div class="lead">
            <div class="d-flex align-items-center">
                <img src="<?php echo htmlspecialchars($professionnel['path_photo']); ?>" alt="Photo de <?php echo htmlspecialchars($professionnel['nom']); ?>" class="img-thumbnail" width="100" height="100">
                <div class="ms-3">
                    <p>Spécialité: <?php echo htmlspecialchars($professionnel['specialite']); ?></p>
                    <p>Email: <?php echo htmlspecialchars($professionnel['email']); ?></p>
                    <a href="<?php echo "chat.php?receiver_id=$id"?>" class="btn btn-primary">Envoyer un message</a>
                    <a href="tel:<?php echo htmlspecialchars($professionnel['path_video']); ?>" class="btn btn-success ms-2">Appeler</a>
                </div>
            </div>
        </div>
        <br>
        <h3>Disponibilités</h3>
        <div class="row">
            <?php foreach ($disponibilites as $jour => $dispos): ?>
                <div class="col-md-4">
                    <h5><?php echo ucfirst($jour); ?></h5>
                    <ul class="list-group">
                        <?php if (!empty($dispos)): ?>
                            <?php foreach ($dispos as $dispo): ?>
                                <li class="list-group-item">
                                    <?php if ($dispo['disponible']): ?>
                                        <form method="post" action="confirmation.php">
                                            <input type="hidden" name="dispo_id" value="<?php echo htmlspecialchars($dispo['id']); ?>">
                                            <button type="submit" name="submit" class="btn btn-outline-primary">
                                                <?php echo htmlspecialchars($dispo['heure_debut'] . ' à ' . $dispo['heure_fin']); ?>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <button class="btn btn-outline-secondary" disabled>
                                            <?php echo htmlspecialchars($dispo['heure_debut'] . ' à ' . $dispo['heure_fin']); ?> (Indisponible)
                                        </button>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="list-group-item">Aucune disponibilité ce jour.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
        <br>
        <a href="medecine_generale.php" class="btn btn-secondary">Retourner à la liste des professionnels</a>
    </div>

    <!-- Footer -->
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">© 2024 SA Medicare</p>
        <p class="col-md-4 mb-0 text-body-secondary">51 Rue Trayne Cul, 69620 Val d'Oingt</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2774.1514899926615!2d4.580111175787794!3d45.94825620101239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f4886b1b8a7331%3A0x8cc507515c81c158!2sRue%20Trayne%20Cul%2C%2069620%20Val%20d'Oingt!5e0!3m2!1sfr!2sfr!4v1716677967175!5m2!1sfr!2sfr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </footer>
</div>
</body>
</html>
