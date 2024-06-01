<?php
session_start();
$_SESSION['id']=session_id();


$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mail = $_POST['mail'];
$password = $_POST['password'];

$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');

$requete = $bdd->prepare("SELECT * FROM clients WHERE email = :mail");
$requete->bindParam(':mail', $mail);

$requete->execute();
$reussi = false;
if ($requete->rowCount() == 0) {
    $requete = $bdd->prepare("INSERT INTO clients (nom, prenom, email, password) VALUES (:nom, :prenom, :mail, :password)");
    $requete->bindParam(':nom', $nom);
    $requete->bindParam(':prenom', $prenom);
    $requete->bindParam(':mail', $mail);
    $requete->bindParam(':password', $password);
    $requete->execute();
    $_SESSION['connected'] = true;
    $reussi = true;
    $requete = $bdd->prepare("SELECT id FROM clients WHERE email = :mail");
    $requete->bindParam(':mail', $mail);
    $requete->execute();
    $_SESSION['type'] = "client";
    $_SESSION['id_client'] = $requete->fetch()['id'];
}
else {
    $reussi = false;
}

$requete = $bdd->prepare("SELECT * FROM clients WHERE email = :mail");
$requete->bindParam(':mail', $mail);

$requete->execute();
$reussi = false;
if ($requete->rowCount() != 0) {
    $client = $requete->fetch();
    if ($client['password'] == $password) {
        $_SESSION['connected'] = true;
        $_SESSION['id_client'] = $client['id'];
        $_SESSION['nom'] = $client['nom'];
        $_SESSION['prenom'] = $client['prenom'];
        $_SESSION['mail'] = $client['email'];
        $_SESSION['adresse'] = $client['address'];
        $_SESSION['CarteVitale'] = $client['CarteVitale'];
        $_SESSION['type_compte'] = $client['type_compte'];
        $reussi = true;
    }
}

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
    echo "<h2>Inscription réussie</h2>";
    echo "<p>Bienvenue $prenom $nom, vous êtes maintenant inscrit sur Medicare</p>";
    echo "<a href='index.php' class='btn btn-success'>Retour à l'accueil</a>";
}
else {
    echo "<h2>Inscription échouée</h2>";
    echo "<p>Un compte existe déjà avec l'adresse mail $mail</p>";
    echo "<a href='inscription.php' class='btn btn-danger'>Réessayer</a>";
}

?>
    </div>
    <?php include 'footer.php'; ?>
</div>


</body>
</html>

