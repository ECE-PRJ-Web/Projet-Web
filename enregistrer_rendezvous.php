<?php
// Connexion à la base de données (à adapter selon votre configuration)
$pdo = new PDO('mysql:host=localhost;dbname=medicare', 'username', 'password');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Vérification des paramètres de la requête
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données de la requête
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $medecin_id = $_POST['medecin_id'];

    // Vérification si le client est connecté (utilisation de $_SESSION)
    session_start();
    if (!isset($_SESSION['connected']) || $_SESSION['connected'] !== true) {
        http_response_code(401);
        die('Vous devez être connecté pour prendre un rendez-vous.');
    }

    $client_id = $_SESSION['client_id']; // À définir en fonction de votre système de gestion de sessions

    // Vérification de la disponibilité du créneau
    $query = "SELECT COUNT(*) as count FROM disponibilites WHERE medecin_id = ? AND date = ? AND heure_debut <= ? AND heure_fin > ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$medecin_id, $date, $heure, $heure]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['count'] == 0) {
        http_response_code(400);
        die('Ce créneau n\'est plus disponible.');
    }

    // Enregistrement du rendez-vous
    $query = "INSERT INTO rendezvous (client_id, medecin_id, date, heure, statut) VALUES (?, ?, ?, ?, 'programmé')";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$client_id, $medecin_id, $date, $heure]);

    if ($stmt->rowCount() > 0) {
        http_response_code(200);
        echo 'Rendez-vous enregistré avec succès!';
    } else {
        http_response_code(500);
        echo 'Erreur lors de l\'enregistrement du rendez-vous.';
    }
} else {
    http_response_code(405);
    echo 'Méthode non autorisée';
}
?>
