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

// Récupérer les rendez-vous du client (médecins et laboratoires)
$sql = "
    (SELECT r.rdv_id, p.nom AS nom_professionnel, p.prenom AS prenom_professionnel, r.date, r.heure, r.statut, 'medecin' AS type
     FROM rendezvous r
     INNER JOIN clients p ON r.medecin_id = p.id
     WHERE r.client_id = $id_client)
    UNION
    (SELECT r.rdv_id, sl.nom_service AS nom_professionnel, '' AS prenom_professionnel, r.date, r.heure, r.statut, 'laboratoire' AS type
     FROM rendezvous r
     INNER JOIN services_laboratoire sl ON r.services_labo_id = sl.service_id
     WHERE r.client_id = $id_client)
    ORDER BY date, heure";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Medicare: Rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="menu.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">

</head>
<body class="d-flex text-center">

<div class="container-fluid" id="wrapper">
    <div class="bg-info bg-gradient bg-success head" style="--bs-bg-opacity: .3" id="header">
        <div class="d-flex justify-content-between align-items-center" >
            <h1 class="mb-1">
                <span style="color: red;">Medi</span><span style="color: white;">care</span>
            </h1>

            <h1 class = "mb-1">Vos rendez-vous</h1>
            <img src="medi_logo.png" alt="Logo de l'entreprise" class="logo">
        </div>

        <div class="bd">
            <?php include 'menu.php'; ?>
        </div>
    </div>

    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card my-3'>";
                echo "<div class='card-body'>";
                if ($row['type'] == 'medecin') {
                    echo "<h5 class='card-title'>Dr. " . htmlspecialchars($row['nom_professionnel']) . " " . htmlspecialchars($row['prenom_professionnel']) . "</h5>";
                } else {
                    echo "<h5 class='card-title'>Laboratoire: " . htmlspecialchars($row['nom_professionnel']) . "</h5>";
                }
                echo "<p class='card-text'>Date: " . htmlspecialchars($row['date']) . ", Heure: " . htmlspecialchars($row['heure']) . "</p>";
                if ($row['statut'] == 'programmé' || $row['statut'] == 'réservé') {
                    echo "<a href='supprimer_rdv.php?id=" . htmlspecialchars($row['rdv_id']) . "&type=" . htmlspecialchars($row['type']) . "' class='btn btn-danger'>Supprimer le rendez-vous</a>";
                }
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Vous n'avez aucun rendez-vous programmé.</p>";
        }
        ?>
    </div>

    <?php include 'footer.php'; ?>

</div>

</body>
</html>