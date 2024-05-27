<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicare";

// Vérifier si la requête est POST et si les données nécessaires sont présentes
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_rdv'])) {
    $rdv_id = $_POST['confirm_rdv'];

    // Connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['client_id'])) {
        $conn->close();
        header('Location: connexion.php');
        exit;
    }

    // Préparation de la requête pour mettre à jour la disponibilité
    $sql_update = "UPDATE disponibilites SET disponible = 0 WHERE id = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("i", $rdv_id);

    // Exécution de la mise à jour
    if ($stmt->execute()) {
        $stmt->close();

        // Récupération des détails du rendez-vous
        $sql_rdv = "SELECT medecin_id, date, heure FROM rendezvous WHERE rdv_id = ?";
        $stmt_rdv = $conn->prepare($sql_rdv);
        $stmt_rdv->bind_param("i", $rdv_id);
        $stmt_rdv->execute();
        $stmt_rdv->store_result();
        $stmt_rdv->bind_result($medecin_id, $date, $heure);
        $stmt_rdv->fetch();
        $stmt_rdv->close();

        // Insertion du rendez-vous confirmé
        $sql_insert_rdv = "INSERT INTO rendezvous (client_id, medecin_id, date, heure, statut) VALUES (?, ?, ?, ?, 'programmé')";
        $stmt_insert_rdv = $conn->prepare($sql_insert_rdv);
        $client_id = $_SESSION['client_id'];

        $stmt_insert_rdv->bind_param("iiss", $client_id, $medecin_id, $date, $heure);

        if ($stmt_insert_rdv->execute()) {
            $stmt_insert_rdv->close();
            $conn->close();
            header('Location: confirmation_success.php'); // Redirection vers une page de confirmation réussie
            exit;
        } else {
            echo "Erreur lors de la confirmation du rendez-vous.";
        }
    } else {
        echo "Erreur lors de la mise à jour de la disponibilité.";
    }
} else {
    // Rediriger avec un message d'erreur si les données ne sont pas correctement envoyées
    header('Location: confirmation.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex text-center">
<div class="container" id="wrapper">
    <!-- Header -->
    <div class="bg-info bg-gradient bg-success" style="--bs-bg-opacity: .3" id="header">
        <h1>Medicare: Confirmation de rendez-vous</h1>
        <div class="bd">
            <nav class="navbar navbar-expand-lg sticky-top mb-2">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">Accueil</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- ... -->
                </div>
            </nav>
        </div>
    </div>

    <!-- Contenu de confirmation -->
    <div id="content" class="cover-container d-flex w-100 p-3 mx-auto flex-column">
        <h2>Confirmation de rendez-vous</h2>
        <br>
        <div id="confirmation_detail" class="lead">
            <p>Votre rendez-vous a été confirmé avec succès.</p>
            <br>
            <a href="index.php" class="btn btn-primary">Retourner à l'accueil</a>
        </div>
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
