<?php
session_start();

$services = [
    "covid" => [
        "title" => "Dépistage covid-19",
        "description" => "Informations sur le dépistage covid-19.",
        "details" => "Détails sur le prélèvement de sang, de l’urine, etc.",
    ],
    "prevention" => [
        "title" => "Biologie préventive",
        "description" => "Informations sur la biologie préventive.",
        "details" => "Détails sur le prélèvement de sang, de l’urine, etc.",
    ],
    "femme-enceinte" => [
        "title" => "Biologie de la femme enceinte",
        "description" => "Informations sur la biologie de la femme enceinte.",
        "details" => "Détails sur le prélèvement de sang, de l’urine, etc.",
    ],
    "routine" => [
        "title" => "Biologie de routine",
        "description" => "Informations sur la biologie de routine.",
        "details" => "Détails sur le prélèvement de sang, de l’urine, etc.",
    ],
    "cancerologie" => [
        "title" => "Cancérologie",
        "description" => "La cancérologie",
        "details" => "Détails sur le prélèvement de sang, de l’urine, etc.",
    ],
    "gynécologie" => [
        "title" => "Gynécologie",
        "description" => "Informations sur la gynécologie.",
        "details" => "Détails sur le prélèvement de sang, de l’urine, etc.",
    ],
];

$serviceKey = $_GET['service'];
$service = $services[$serviceKey] ?? null;

if (!$service) {
    echo "Service non trouvé.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $service['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
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
                                    <li><a class="dropdown-item" href="#">Médecine Générale</a></li>
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

<div class="container">
    <h1><?php echo $service['title']; ?></h1>
    <p><?php echo $service['description']; ?></p>
    <h2>Détails</h2>
    <p><?php echo $service['details']; ?></p>

    <h2>Calendrier des créneaux disponibles</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Date</th>
            <th>Heure</th>
            <th>Réserver</th>
        </tr>
        </thead>
        <tbody>
        <!-- Exemple de créneaux -->
        <tr>
            <td>2024-06-01</td>
            <td>09:00 - 09:30</td>
            <td><button class="btn btn-primary">Réserver</button></td>
        </tr>
        <tr>
            <td>2024-06-01</td>
            <td>10:00 - 10:30</td>
            <td><button class="btn btn-primary">Réserver</button></td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
