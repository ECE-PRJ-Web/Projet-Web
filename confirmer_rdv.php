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

// Récupérer l'ID du client depuis la session
$client_id = $_SESSION['id_client'];

// Insérer les informations du rendez-vous dans la table rendezvous
$date = date('Y-m-d'); // Vous pouvez ajuster cette valeur en fonction des informations de disponibilité
$heure = $dispo['heure_debut'];
$sql_rdv = "INSERT INTO rendezvous (client_id, medecin_id, date, heure, statut) VALUES ($client_id, $medecin_id, '$date', '$heure', 'programmé')";

if ($conn->query($sql_rdv) === TRUE) {
    // Mettre à jour la disponibilité pour indiquer qu'elle n'est plus disponible
    $sql_update_dispo = "UPDATE disponibilites SET disponible = 0 WHERE id = $dispo_id";
    if ($conn->query($sql_update_dispo) === TRUE) {
        echo "<script>alert('Rendez-vous confirmé avec succès.'); window.location.href = 'rendezvous.php';</script>";
    } else {
        die("Erreur lors de la mise à jour de la disponibilité: " . $conn->error);
    }
} else {
    die("Erreur lors de l'insertion du rendez-vous: " . $conn->error);
}

$conn->close();
?>
