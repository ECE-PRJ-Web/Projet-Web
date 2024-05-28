<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicare";

// Vérifier si toutes les informations sont passées en paramètre
if (!isset($_POST['dispo_id']) || empty($_POST['dispo_id']) ||
    !isset($_POST['medecin_id']) || empty($_POST['medecin_id'])) {
    die("Informations incomplètes");
}

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les informations du formulaire
$dispo_id = $_POST['dispo_id'];
$medecin_id = $_POST['medecin_id'];
$client_id = $_SESSION['id_client']; // Récupérer l'ID du client depuis la session


// Récupérer les informations sur la disponibilité
$sql_dispo = "SELECT * FROM disponibilites WHERE id = $dispo_id";
$result_dispo = $conn->query($sql_dispo);

if ($result_dispo->num_rows > 0) {
    $dispo = $result_dispo->fetch_assoc();
} else {
    die("Disponibilité non trouvée");
}

// Insérer les informations du rendez-vous dans la table rendezvous
$date = date('Y-m-d'); // Vous pouvez ajuster cette valeur en fonction des informations de disponibilité
$heure = $dispo['heure_debut'];
$sql_rdv = "INSERT INTO rendezvous (client_id, medecin_id, date, heure, statut) VALUES ($client_id, $medecin_id, '$date', '$heure', 'programmé')";

if ($conn->query($sql_rdv) === TRUE) {
    // Mettre à jour la disponibilité pour indiquer qu'elle n'est plus disponible
    $sql_update_dispo = "UPDATE disponibilites SET disponible = 0 WHERE id = $dispo_id";
    if ($conn->query($sql_update_dispo) === TRUE) {
        echo "Rendez-vous confirmé avec succès.";
    } else {
        die("Erreur lors de la mise à jour de la disponibilité: " . $conn->error);
    }
} else {
    die("Erreur lors de l'insertion du rendez-vous: " . $conn->error);
}

$conn->close();
?>
