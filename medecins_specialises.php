<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicare";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête pour obtenir les spécialités disponibles
$sql_specialites = "SELECT DISTINCT specialite FROM professionnels";
$result_specialites = $conn->query($sql_specialites);

// Requête pour obtenir les médecins spécialisés
$sql_medecins = "SELECT p.id, p.path_photo, p.path_video, p.path_cv, p.specialite, c.nom, c.prenom, c.email 
                FROM professionnels p 
                INNER JOIN clients c ON p.id = c.id";
$result_medecins = $conn->query($sql_medecins);

// Fermer la connexion après l'exécution de la requête
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Medicare: Médecins Spécialistes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex text-center">

<div class="container-fluid" id="wrapper">
    <div class="bg-info bg-gradient bg-success" style="--bs-bg-opacity: .3" id="header">
        <h1>Medicare: Médecins Spécialistes</h1>
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
                                    <li><a class="dropdown-item" href="medecins_specialises.php">Médecins Spécialistes</a></li>
                                    <li><a class="dropdown-item" href="Laboratoire.php">Laboratoire de biologie médicale</a></li>
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
        <div class="dropdown mt-2">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Spécialités
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php while($specialite = $result_specialites->fetch_assoc()): ?>
                    <li><a class="dropdown-item" href="medecins_specialises.php?specialite=<?php echo urlencode($specialite['specialite']); ?>"><?php echo htmlspecialchars($specialite['specialite']); ?></a></li>
                <?php endwhile; ?>
            </ul>
        </div>

        <h2>Médecins Spécialistes</h2>
        <?php if (isset($_GET['specialite'])): ?>
            <h3>Spécialité: <?php echo htmlspecialchars($_GET['specialite']); ?></h3>
        <?php endif; ?>
        <br>
        <div id="medecins" class="lead">
            <ul class="list-group">
                <?php if ($result_medecins->num_rows > 0): ?>
                    <?php while($professionnel = $result_medecins->fetch_assoc()): ?>
                        <?php if (!isset($_GET['specialite']) || $_GET['specialite'] === $professionnel['specialite']): ?>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo htmlspecialchars($professionnel['path_photo'] ?? ''); ?>" alt="Photo de <?php echo isset($professionnel['nom']) ? htmlspecialchars($professionnel['nom']) : 'Nom inconnu'; ?>" class="img-thumbnail" width="100" height="100">
                                    <div class="ms-3">
                                        <h5 class="mb-1"><?php echo isset($professionnel['nom']) && isset($professionnel['prenom']) ? htmlspecialchars($professionnel['nom'] . ' ' . $professionnel['prenom']) : 'Nom inconnu'; ?></h5>
                                        <p class="mb-1">Spécialité: <?php echo htmlspecialchars($professionnel['specialite'] ?? 'Spécialité inconnue'); ?></p>
                                        <p class="mb-1">Email: <?php echo isset($professionnel['email']) ? htmlspecialchars($professionnel['email']) : 'Email inconnu'; ?></p>
                                        <a href="medecin_detail.php?id=<?php echo $professionnel['id']; ?>" class="btn btn-primary">Plus d'informations</a>
                                    </div>
                                </div>
                            </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li class="list-group-item">Aucun professionnel trouvé.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">© 2024 SA Medicare</p>
        <p class="col-md-4 mb-0 text-body-secondary">51 Rue Trayne Cul, 69620 Val d'Oingt</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2774.1514899926615!2d4.580111175787794!3d45.94825620101239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f4886b1b8a7331%3A0x8cc507515c81c158!2sRue%20Trayne%20Cul%2C%2069620%20Val%20d'Oingt!5e0!3m2!1sfr!2sfr!4v1716677967175!5m2!1sfr!2sfr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </footer>
</div>

</body>
</html>
