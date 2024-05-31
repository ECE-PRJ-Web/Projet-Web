<?php
session_start();
$_SESSION['id']=session_id();
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

        <h2>Connexion</h2>
        <br>
        <form action="traitement_connexion.php" method="POST" class="text-center">
            <div class="mb-3 row ">
                <label for="mail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-5">
                    <input type="email" class="form-control" id="mail" name="mail">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Mot de passe</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <input type="submit" value="Se connecter" class="btn btn-success">
        </form>

    </div>
    <?php include 'footer.php'; ?>


</div>


</body>
</html>