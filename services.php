<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicare";

// Vérifier si l'ID du service est passé en paramètre
if (!isset($_GET['service_id']) || empty($_GET['service_id'])) {
    die("ID du service non spécifié");
}

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les informations sur le service
$service_id = intval($_GET['service_id']);
$sql_service = "SELECT * FROM services_laboratoire WHERE service_id = $service_id";
$result_service = $conn->query($sql_service);

if ($result_service->num_rows == 0) {
    die("Service non trouvé.");
}

$service = $result_service->fetch_assoc();

// Récupérer les disponibilités du service
$sql_dispo_labo = "SELECT * FROM disponibilites_labo WHERE services_labo_id = $service_id";
$result_dispo_labo = $conn->query($sql_dispo_labo);

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
if ($result_dispo_labo->num_rows > 0) {
    while ($dispo = $result_dispo_labo->fetch_assoc()) {
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
    <title><?php echo htmlspecialchars($service['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .container-1 {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .day-header {
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body class="d-flex text-center">

<div class="container-fluid" id="wrapper">
    <div class="bg-info bg-gradient bg-success" style="--bs-bg-opacity: .3" id="header">
        <h1 class="text-center">Medicare: Services médicaux</h1>
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
                                    <li><a class="dropdown-item" href="Laboratoire.php">Laboratoire de biologie médicale</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Rendez-vous</a></li>
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
                        } ?>
                        <form class="d-flex navbar-nav mb-lg-0" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="container-1">
            <h1 class="text-center"><?php echo htmlspecialchars($service['title']); ?></h1>
            <p><?php echo nl2br(htmlspecialchars($service['description'])); ?></p>
        </div>
        <div class="container-1">
            <h2 class="text-center">Détails</h2>
            <p><?php echo nl2br(htmlspecialchars($service['details'])); ?></p>
        </div>
        <h2 class="text-center">Calendrier des créneaux disponibles</h2>
        <div class="row">
            <?php foreach ($disponibilites as $jour => $dispos): ?>
                <div class="col-md-4">
                    <h5><?php echo ucfirst($jour); ?></h5>
                    <ul class="list-group">
                        <?php if (!empty($dispos)): ?>
                            <?php foreach ($dispos as $dispo): ?>
                                <li class="list-group-item">
                                    <?php if ($dispo['disponible']): ?>
                                        <form method="post" action="resa_labo.php">
                                            <input type="hidden" name="dispo_labo_id" value="<?php echo $dispo['id']; ?>">
                                            <input type="hidden" name="services_labo_id" value="<?php echo $service_id; ?>">
                                            <button type="submit" name="submit" class="btn btn-outline-primary">
                                                <?php echo htmlspecialchars($dispo['heure_debut'] . ' - ' . $dispo['heure_fin']); ?>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <button class="btn btn-outline-secondary" disabled>
                                            <?php echo htmlspecialchars($dispo['heure_debut'] . ' - ' . $dispo['heure_fin']); ?> (Indisponible)
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

    </div>
    <footer class="d-flex flex-wrap justify-content-between align-items-start py-3 my-4 border-top">
        <div class="col-md-6 text-center">
            <h5>Nous retrouver</h5>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2774.1514899926615!2d4.580111175787794!3d45.94825620101239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f4886b1b8a7331%3A0x8cc507515c81c158!2sRue%20Trayne%20Cul%2C%2069620%20Val%20d&#39;Oingt!5e0!3m2!1sfr!2sfr!4v1716677967175!5m2!1sfr!2sfr" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <p class="mt-2">51 Rue Trayne Cul, 69620 Val d'Oingt</p>
        </div>
        <div class="col-md-6 text-center">
            <h5>Nous contacter</h5>
            <p>Téléphone : 01 23 45 67 89</p>
            <p>Courriel : <a href="mailto:labo@example.com">labo@example.com</a></p>
            <div class="social-icons">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-twitter"></i></a>
            </div>
        </div>
        <div class="col-12 text-center mt-4">
            <p class="mb-0 text-body-secondary">© 2024 SA Medicare</p>
        </div>
    </footer>
</body>
</html>

