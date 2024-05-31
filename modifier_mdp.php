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
    <div class="container">

        <h2>Modifier votre mot de passe</h2>
        <form action="traitement_modifier_mdp.php" method="post">
            <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe actuel</label>
                <input type="password" class="form-control" id="mdp" name="mdp">
            </div>
            <div class="mb-3">
                <label for="new_mdp" class="form-label">Nouveau mot de passe</label>
                <input type="password" class="form-control" id="new_mdp" name="new_mdp">
            </div>
            <div class="mb-3">
                <label for="new_mdp_confirm" class="form-label">Confirmer le nouveau mot de passe</label>
                <input type="password" class="form-control" id="new_mdp_confirm" name="new_mdp_confirm">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>

    </div>
    <?php include 'footer.php'; ?>
</div>


</body>
</html>