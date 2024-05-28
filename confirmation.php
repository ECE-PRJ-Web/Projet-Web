<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicare";

// Vérifier si l'ID de la disponibilité est passé en paramètre
if (!isset($_POST['dispo_id']) || empty($_POST['dispo_id'])) {
    die("ID de la disponibilité non spécifié");
}

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les informations sur la disponibilité
$dispo_id = $_POST['dispo_id'];
$sql = "SELECT * FROM disponibilites WHERE id = $dispo_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $dispo = $result->fetch_assoc();
} else {
    die("Disponibilité non trouvée");
}

// Récupérer les informations sur le professionnel
$medecin_id = $dispo['medecin_id'];
$sql_medecin = "SELECT * FROM professionnels WHERE id = $medecin_id";
$result_medecin = $conn->query($sql_medecin);

if ($result_medecin->num_rows > 0) {
    $professionnel = $result_medecin->fetch_assoc();
} else {
    die("Professionnel non trouvé");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmer le Rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex text-center">

<div class="container" id="wrapper">
    <h1>Confirmer le Rendez-vous</h1>
    <div class="lead">
        <p>Professionnel: <?php echo htmlspecialchars($professionnel['nom'] . ' ' . $professionnel['prenom']); ?></p>
        <p>Date et Heure: <?php echo htmlspecialchars($dispo['jour_semaine'] . ' de ' . $dispo['heure_debut'] . ' à ' . $dispo['heure_fin']); ?></p>
        <form method="post" action="confirmer_rdv.php">
            <input type="hidden" name="dispo_id" value="<?php echo htmlspecialchars($dispo['id']); ?>">
            <input type="hidden" name="medecin_id" value="<?php echo htmlspecialchars($medecin_id); ?>">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Confirmer</button>
        </form>
    </div>
</div>
</body>
</html>
