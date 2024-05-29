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

if (isset($_GET['id']) && isset($_GET['type'])) {
    $id_rdv = $_GET['id'];
    $type = $_GET['type'];

    if ($type == 'medecin') {
        $sql_rdv = "SELECT * FROM rendezvous WHERE rdv_id = $id_rdv AND client_id = $id_client";
        $result_rdv = $conn->query($sql_rdv);

        if ($result_rdv->num_rows > 0) {
            $row_rdv = $result_rdv->fetch_assoc();
            $medecin_id = $row_rdv['medecin_id'];
            $heure = $row_rdv['heure'];

            // Supprimer le rendez-vous
            $sql_delete_rdv = "DELETE FROM rendezvous WHERE rdv_id = $id_rdv";
            if ($conn->query($sql_delete_rdv) === TRUE) {
                // Mettre à jour la disponibilité de l'heure de ce rendez-vous
                $sql_update_dispo = "UPDATE disponibilites SET disponible = 1 WHERE medecin_id = $medecin_id AND heure_debut = '$heure'";
                if ($conn->query($sql_update_dispo) === TRUE) {
                    echo "Rendez-vous avec le médecin supprimé avec succès";
                    header("Location: rendezvous.php");
                    exit();
                } else {
                    echo "Erreur lors de la mise à jour de la disponibilité du médecin : " . $conn->error;
                }
            } else {
                echo "Erreur lors de la suppression du rendez-vous avec le médecin : " . $conn->error;
            }
        } else {
            echo "Rendez-vous avec le médecin non trouvé.";
        }
    } elseif ($type == 'laboratoire') {
        $sql_rdv = "SELECT * FROM rendezvous WHERE rdv_id = $id_rdv AND client_id = $id_client";
        $result_rdv = $conn->query($sql_rdv);

        if ($result_rdv->num_rows > 0) {
            $row_rdv = $result_rdv->fetch_assoc();
            $service_id = $row_rdv['services_labo_id'];
            $heure = $row_rdv['heure'];

            // Supprimer le rendez-vous
            $sql_delete_rdv = "DELETE FROM rendezvous WHERE rdv_id = $id_rdv";
            if ($conn->query($sql_delete_rdv) === TRUE) {
                // Mettre à jour la disponibilité de l'heure de ce service de laboratoire
                $sql_update_dispo = "UPDATE disponibilites_labo SET disponible = 1 WHERE services_labo_id = $service_id AND heure_debut = '$heure'";
                if ($conn->query($sql_update_dispo) === TRUE) {
                    echo "Rendez-vous avec le laboratoire supprimé avec succès";
                    header("Location: rendezvous.php");
                    exit();
                } else {
                    echo "Erreur lors de la mise à jour de la disponibilité du laboratoire : " . $conn->error;
                }
            } else {
                echo "Erreur lors de la suppression du rendez-vous avec le laboratoire : " . $conn->error;
            }
        } else {
            echo "Rendez-vous avec le laboratoire non trouvé.";
        }
    } else {
        echo "Type de rendez-vous invalide.";
    }
} else {
    echo "ID de rendez-vous ou type non spécifié.";
}

$conn->close();
?>
