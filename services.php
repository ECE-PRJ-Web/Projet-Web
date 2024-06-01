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
    <link href="menu.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
    <style>
        .container-1 {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            margin-top : 20px;
        }
        .day-header {
            margin-top : 50px
            text-align: center;
        }

        .horraires{
            margin-top : 60px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="d-flex text-center">

<div class="container-fluid" id="wrapper">
    <div class="bg-info bg-gradient bg-success head" style="--bs-bg-opacity: .3" id="header">
        <div class="d-flex justify-content-between align-items-center" >
            <h1 class="mb-1">
                <span style="color: red;">Medi</span><span style="color: white;">care</span>
            </h1>
            <h1 class = "mb-1">Services</h1>
            <img src="medi_logo.png" alt="Logo de l'entreprise" class="logo">
        </div>
        <div class="bd">
            <?php include 'menu.php'; ?>
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
            <p><strong>Salle :</strong> <?php echo htmlspecialchars($service['salle']); ?></p>
        </div>

        <h2 class="text-center horraires">Calendrier des créneaux disponibles</h2>
        <div class="row">
            <?php foreach ($disponibilites as $jour => $dispos): ?>
                <div class="col-md-4">
                    <h5 class = "day-header"><?php echo ucfirst($jour); ?></h5>
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
    <?php include 'footer.php'; ?>

</body>
</html>

