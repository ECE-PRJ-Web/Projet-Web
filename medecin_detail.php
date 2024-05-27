<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicare";

// Vérifier si l'ID du médecin est passé en paramètre
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID du médecin non spécifié");
}

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les informations sur le médecin
$id = $_GET['id'];
$sql = "SELECT * FROM medecins WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $medecin = $result->fetch_assoc();
} else {
    die("Médecin non trouvé");
}

// Récupérer les disponibilités du médecin
$sql_dispo = "SELECT * FROM disponibilites WHERE medecin_id = $id AND disponible = 1";
$result_dispo = $conn->query($sql_dispo);

// Fonction pour insérer un rendez-vous
function insererRdv($date, $heure, $medecin_id, $conn) {
    $sql_insert = "INSERT INTO rendez_vous (date_rdv, heure_rdv, medecin_id) VALUES ('$date', '$heure', $medecin_id)";
    if ($conn->query($sql_insert) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Traitement du formulaire de prise de rendez-vous
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $date_rdv = $_POST['date_rdv'];
    $heure_rdv = $_POST['heure_rdv'];

    // Insérer le rendez-vous dans la base de données
    if (insererRdv($date_rdv, $heure_rdv, $id, $conn)) {
        echo '<div class="alert alert-success" role="alert">Rendez-vous enregistré avec succès !</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'enregistrement du rendez-vous.</div>';
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Medicare: <?php echo htmlspecialchars($medecin['nom'] . ' ' . $medecin['prenom']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex text-center">

<div class="container" id="wrapper">
    <div class="bg-info bg-gradient bg-success" style="--bs-bg-opacity: .3" id="header">
        <h1>Medicare: <?php echo htmlspecialchars($medecin['nom'] . ' ' . $medecin['prenom']); ?></h1>
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
        <h2><?php echo htmlspecialchars($medecin['nom'] . ' ' . $medecin['prenom']); ?></h2>
        <br>
        <div class="lead">
            <div class="d-flex align-items-center">
                <img src="<?php echo htmlspecialchars($medecin['photo']); ?>" alt="Photo de <?php echo htmlspecialchars($medecin['nom']); ?>" class="img-thumbnail" width="100" height="100">
                <div class="ms-3">
                    <p>Bureau: <?php echo htmlspecialchars($medecin['bureau']); ?></p>
                    <p>Téléphone: <?php echo htmlspecialchars($medecin['telephone']); ?></p>
                    <p>Courriel: <?php echo htmlspecialchars($medecin['courriel']); ?></p>
                    <a href="#" class="btn btn-primary">Envoyer un message</a>
                    <a href="tel:<?php echo htmlspecialchars($medecin['telephone']); ?>" class="btn btn-success ms-2">Appeler</a>
                </div>
            </div>
        </div>
        <br>
        <h3>Disponibilités</h3>
        <ul class="list-group">
            <?php if ($result_dispo->num_rows > 0): ?>
                <?php while($dispo = $result_dispo->fetch_assoc()): ?>
                    <li class="list-group-item">
                        <?php echo htmlspecialchars($dispo['jour'] . ' - ' . $dispo['heure_debut'] . ' à ' . $dispo['heure_fin']); ?>
                    </li>
                <?php endwhile; ?>
            <?php else: ?>
                <li class="list-group-item">Aucune disponibilité trouvée.</li>
            <?php endif; ?>
        </ul>
        <br>
        <h3>Prendre un rendez-vous</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>">
            <div class="mb-3">
                <label for="date_rdv" class="form-label">Date du rendez-vous</label>
                <input type="date" class="form-control" id="date_rdv" name="date_rdv" required>
            </div>
            <div class="mb-3">
                <label for="heure_rdv" class="form-label">Heure du rendez-vous</label>
                <input type="time" class="form-control" id="heure_rdv" name="heure_rdv" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Prendre rendez-vous</button>
        </form>
        <br>
        <a href="medecine_generale.php" class="btn btn-secondary">Retourner à la liste des médecins généralistes</a>
    </div>

    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">© 2024 SA Medicare</p>
        <p class="col-md-4 mb-0 text-body-secondary">51 Rue Trayne Cul, 69620 Val d'O
        <p class="col-md-4 mb-0 text-body-secondary">© 2024 SA Medicare</p>
        <p class="col-md-4 mb-0 text-body-secondary">51 Rue Trayne Cul, 69620 Val d'Oingt</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2774.1514899926615!2d4.580111175787794!3d45.94825620101239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f4886b1b8a7331%3A0x8cc507515c81c158!2sRue%20Trayne%20Cul%2C%2069620%20Val%20d&#39;Oingt!5e0!3m2!1sfr!2sfr!4v1716677967175!5m2!1sfr!2sfr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </footer>
</div>
</body>
</html>
