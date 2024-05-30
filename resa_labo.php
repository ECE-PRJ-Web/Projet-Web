<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicare";

// Vérifier si toutes les informations sont passées en paramètre
if (!isset($_POST['dispo_labo_id']) || empty($_POST['dispo_labo_id']) ||
    !isset($_POST['services_labo_id']) || empty($_POST['services_labo_id'])) {
    die("Informations incomplètes");
}

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les informations du formulaire
$dispo_labo_id = intval($_POST['dispo_labo_id']);
$services_labo_id = intval($_POST['services_labo_id']);
$client_id = isset($_SESSION['id_client']) ? intval($_SESSION['id_client']) : 0; // Récupérer l'ID du client depuis la session

if ($client_id == 0) {
    die("Client non authentifié.");
}

// Récupérer les informations sur la disponibilité
$sql_dispo_labo = "SELECT * FROM disponibilites_labo WHERE id = $dispo_labo_id";
$result_dispo = $conn->query($sql_dispo_labo);

if ($result_dispo->num_rows > 0) {
    $dispo_labo = $result_dispo->fetch_assoc();
} else {
    die("Disponibilité non trouvée");
}

// Insérer les informations du rendez-vous dans la table rendezvous
$date = date('Y-m-d'); // Vous pouvez ajuster cette valeur en fonction des informations de disponibilité
$heure = $dispo_labo['heure_debut'];
$sql_rdv = "INSERT INTO rendezvous (client_id, medecin_id, services_labo_id, date, heure, statut) VALUES ($client_id, NULL, $services_labo_id, '$date', '$heure', 'programmé')";

if ($conn->query($sql_rdv) === TRUE) {
    // Mettre à jour la disponibilité pour indiquer qu'elle n'est plus disponible
    $sql_update_dispo = "UPDATE disponibilites_labo SET disponible = 0 WHERE id = $dispo_labo_id";
    if ($conn->query($sql_update_dispo) === TRUE) {
        // Afficher un message de confirmation avec un pop-up
        echo '<script type="text/javascript">
                alert("Rendez-vous confirmé avec succès.");
                window.location.href = "rendezvous.php"; // Redirection après confirmation
              </script>';
    } else {
        die("Erreur lors de la mise à jour de la disponibilité: " . $conn->error);
    }
} else {
    die("Erreur lors de l'insertion du rendez-vous: " . $conn->error);
}

$conn->close();
?>
