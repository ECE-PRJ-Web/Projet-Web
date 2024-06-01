<?php
session_start();
$_SESSION['id']=session_id();
$recherche = $_GET['recherche'];
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Medicare: Services médicaux </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="script.js"></script>
    <link href="menu.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
    <style>
        #carouselExampleControls img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        h5{
            color : red;
        }
    </style>
</head>
<body class="d-flex text-center">

<div class="container-fluid" id="wrapper">
    <div class="bg-info bg-gradient bg-success head" style="--bs-bg-opacity: .3" id="header">
        <div class="d-flex justify-content-between align-items-center" >
            <h1 class="mb-1">
                <span style="color: red;">Medi</span><span style="color: white;">care</span>
            </h1>

            <h1 class = "mb-1"> Services Médicaux</h1>
            <img src="medi_logo.png" alt="Logo de l'entreprise" class="logo">
        </div>

        <div class="bd">
            <?php include 'menu.php'; ?>
        </div>
    </div>

    <div id="content" class="cover-container d-flex w-100 p-3 mx-auto flex-column justify-content-center">
        <h1>Résultats de la recherche de médecin</h1>
        <div class="d-flex justify-content-center">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Spécialité</th>
                    <th scope="col">Détails</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');
                $requete = $bdd->prepare("SELECT * FROM clients JOIN professionnels ON clients.id = professionnels.id WHERE clients.nom LIKE :recherche OR clients.prenom LIKE :recherche OR professionnels.specialite LIKE :recherche OR clients.email LIKE :recherche");
                $recherche = "%$recherche%";
                $requete->bindParam(':recherche', $recherche, PDO::PARAM_STR);
                $result = $requete->execute();
                if ($requete->rowCount() != 0) {
                    while ($row = $requete->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['nom'] . "</td>";
                        echo "<td>" . $row['prenom'] . "</td>";
                        echo "<td>" . $row['specialite'] . "</td>";
                        echo "<td><a href='details_medecin.php?id=" . $row['id'] . "'>Détails</a></td>";
                    }
                } else {
                    echo "<h5>Aucun résultat trouvé</h5>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <h1>Résultats de la recherche de service de laboratoire</h1>
        <div class="d-flex justify-content-center">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Nom du service</th>
                    <th scope="col">Description</th>
                    <th scope="col">Salle</th>
                    <th scope="col">Détails</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');
                $requete = $bdd->prepare("SELECT * FROM services_laboratoire WHERE nom_service LIKE :recherche OR description LIKE :recherche OR salle LIKE :recherche");
                $recherche = "%$recherche%";
                $requete->bindParam(':recherche', $recherche, PDO::PARAM_STR);
                $result = $requete->execute();
                if ($requete->rowCount() != 0) {
                    while ($row = $requete->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['nom_service'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['salle'] . "</td>";
                        echo "<td><a href='services.php?service_id=" . $row['service_id'] . "'>Détails</a></td>";
                    }
                } else {
                    echo "<h5>Aucun résultat trouvé</h5>";
                }
                ?>


                </tbody>
            </table>
        </div>


    </div>



    <?php include 'footer.php'; ?>
</div>
</body>
</html>

