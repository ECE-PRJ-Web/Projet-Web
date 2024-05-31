<?php
session_start();

$_SESSION['id']=session_id();

$mail = $_POST['email'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse = $_POST['adresse'];
$CarteVitale = $_POST['CarteVitale'];

$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');

$requete = $bdd->prepare("UPDATE clients SET nom = :nom, prenom = :prenom, email = :mail, address = :adresse, CarteVitale = :CarteVitale WHERE id = :id");
$requete->bindParam(':nom', $nom);
$requete->bindParam(':prenom', $prenom);
$requete->bindParam(':mail', $mail);
$requete->bindParam(':adresse', $adresse);
$requete->bindParam(':CarteVitale', $CarteVitale);
$requete->bindParam(':id', $_SESSION['id_client']);

$reussi = $requete->execute();

$_SESSION['nom'] = $nom;
$_SESSION['prenom'] = $prenom;
$_SESSION['mail'] = $mail;
$_SESSION['adresse'] = $adresse;
$_SESSION['CarteVitale'] = $CarteVitale;

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

        <?php

        if ($reussi) {
            echo "<h2>Mise à jour réussie</h2>";
            echo "<p>Vos données ont bien été mises à jour !</p>";
            echo "<a href='index.php' class='btn btn-success mb-2'>Retour à l'accueil</a>";
            echo "<a href='compte.php' class='btn btn-primary'>Retour à mon compte</a>";
        }
        else {
            echo "<h2>Echec</h2>";
            echo "<p>Echec de la mise à jour, vérifier vos informations</p>";
            echo "<a href='edition_donnes_clients.php' class='btn btn-danger'>Réessayer</a>";
        }

        ?>
    </div>

    <?php include 'footer.php'; ?>

</div>


</body>
</html>
