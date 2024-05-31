<?php
session_start();
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
        if (isset($_SESSION['type_compte']) && $_SESSION['type_compte'] == 1) {
            echo '<a href="compte_medecin.php" class="btn btn-primary mb-2">Mon compte médecin</a>';
        }
        else if (isset($_SESSION['type_compte']) && $_SESSION['type_compte'] == 2) {
            echo '<a href="compte_admin.php" class="btn btn-primary mb-2">Mon compte administrateur</a>';
        }
        else {
            $type_compte = $_SESSION['type_compte'];
            echo "<p>Type compte: $type_compte </p>";
        }
        ?>
        <h2>Mon compte</h2>

        <h3>Mes informations</h3>
        <p>Nom: <?php echo $_SESSION['nom'] ?></p>
        <p>Prénom: <?php echo $_SESSION['prenom'] ?></p>
        <p>Email: <?php echo $_SESSION['mail'] ?></p>

        <?php
        if ($_SESSION['adresse'] && !empty($_SESSION['adresse']) !== null) {
            $adresse = $_SESSION['adresse'];
            echo "<p> Adresse: $adresse </p>";
        }
        else {
            echo "<p> Adresse: Non renseignée </p>";

        }

        if ($_SESSION['CarteVitale'] && !empty($_SESSION['CarteVitale']) !== null){
            $CarteVitale = $_SESSION['CarteVitale'];
            echo "<p> Numéro de carte vitale: $CarteVitale </p>";
        }
        else {
            echo "<p> Numéro de carte vitale: Non renseigné </p>";

        }?>
        <a href="edition_donnes_clients.php" class="btn btn-primary mb-2">Modifier mes informations</a>
        <a href="deconnexion.php" class="btn btn-danger">Déconnexion</a>

    </div>
<?php include 'footer.php'; ?>
</div>

</body>
</html>
