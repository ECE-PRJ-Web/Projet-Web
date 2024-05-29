<?php
session_start();
if (!isset($_SESSION['connected']) || $_SESSION['connected'] !== true) {
    header("Location: connexion.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicare";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id_client = $_SESSION['id_client'];

if (isset($_GET['id'])) {
    $id_rdv = $_GET['id'];

    // Récupérer les informations du rendez-vous pour récupérer l'id du médecin et la disponibilité
    $sql_rdv = "SELECT * FROM rendezvous WHERE rdv_id = $id_rdv AND client_id = $id_client";
    $result_rdv = $conn->query($sql_rdv);

    if ($result_rdv->num_rows > 0) {
        $row_rdv = $result_rdv->fetch_assoc();

        // Supprimer le rendez-vous
        $sql_delete_rdv = "DELETE FROM rendezvous WHERE rdv_id = $id_rdv";
        if ($conn->query($sql_delete_rdv) === TRUE) {
            // Mettre à jour la disponibilité de l'heure de ce rendez-vous
            $id_dispo = $row_rdv['heure'];
            $medecin_id = $row_rdv['medecin_id']; // récupérer l'id du médecin
            $sql_update_dispo = "UPDATE disponibilites SET disponible = 1 WHERE medecin_id = $medecin_id AND heure_debut = '$id_dispo' ";
            if ($conn->query($sql_update_dispo) === TRUE) {
                echo "Rendez-vous supprimé avec succès";
                header("Location: rendezvous.php");
                exit();
            } else {
                echo "Erreur lors de la mise à jour de la disponibilité : " . $conn->error;
            }
        } else {
            echo "Erreur lors de la suppression du rendez-vous : " . $conn->error;
        }
    } else {
        echo "Rendez-vous non trouvé.";
    }
}
$conn->close();
?>
