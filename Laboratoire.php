<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicare";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête pour obtenir les services
$sql = "SELECT * FROM services_laboratoire";
$result = $conn->query($sql);

// Fermer la connexion après avoir récupéré les données
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Laboratoire de Biologie Médicale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="menu.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
    <style>

        .head{
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container-1 {
            margin-left: 18%;
            max-width: 800px;
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2, h5 {
            color: black;
        }

        h2 {
            margin-top: 5px;
        }

        p {
            color: #333;
        }

        .lab-info {
            border: 2px solid #007bff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .service-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f8f9fa;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .service-card:hover {
            background-color: #e2e6ea;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .service-card a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .service-card a:hover {
            color: #0056b3;
        }

    </style>
</head>
<body class="d-flex text-center">

<div class="container-fluid" id="wrapper">
    <div class="bg-info bg-gradient bg-success head" style="--bs-bg-opacity: .3" id="header">
        <div class="d-flex justify-content-between align-items-center" >
            <h1 class="mb-1">Medicare</h1>
            <h1 class = "mb-1"> Laboratoire</h1>
            <img src="" alt="Logo de l'entreprise" class="logo">
        </div>

        <div class="bd">
            <?php include 'menu.php'; ?>
        </div>
    </div>

<div class="container-1 ">
    <h1>Laboratoire de Biologie Médicale</h1>
        <div class="row mb-4">
            <div class="col-md-6">
                <h2>Coordonnées</h2>
                <p><strong>Salle :</strong> B123</p>
                <p><strong>Téléphone :</strong> 01 23 45 67 89</p>
                <p><strong>Courriel :</strong> labo@example.com</p>
            </div>
            <div class="col-md-6 text-center">
                <img src="labo-img.png" alt="Image du labo" class="img-fluid">
            </div>
        </div>

    <button class="btn btn-primary" data-bs-toggle="collapse" href="#services" role="button" aria-expanded="false" aria-controls="services">Nos Services</button>
<div class="collapse mt-3" id="services">
        <div class="card card-body">
            <ul class="list-unstyled">
                <?php
                // Boucle pour afficher les services
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<li class="service-card"><a href="services.php?service_id=' . $row["service_id"] . '">' . $row["title"] . '</a></li>';
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </ul>

        </div>
    </div>
</div>
    <?php include 'footer.php'; ?>
</body>

</html>
