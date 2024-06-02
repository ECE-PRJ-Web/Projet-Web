<?php
session_start();
$id = $_GET['id'];
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

            <h1 class = "mb-1">Gestion des médecins</h1>
            <img src="medi_logo.png" alt="Logo de l'entreprise" class="logo">
        </div>

        <div class="bd">
            <?php include 'menu.php'; ?>
        </div>
    </div>
    <div id="content" class="cover-container d-flex w-100 p-3 mx-auto flex-column justify-content-center">
        <h1>Ajouter Dispo</h1>
        <form action="traitement_ajouter_dispo.php" method="post">
            <div class="mb-3">
                <label for="jour_semaine" class="form-label">Jour</label>
                <select class="form-select" name="jour_semaine" id="jour_semaine">
                    <option value="Lundi">Lundi</option>
                    <option value="Mardi">Mardi</option>
                    <option value="Mercredi">Mercredi</option>
                    <option value="Jeudi">Jeudi</option>
                    <option value="Vendredi">Vendredi</option>
                    <option value="Samedi">Samedi</option>
                    <option value="Dimanche">Dimanche</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="heure_debut" class="form-label">Heure début</label>
                <input type="time" class="form-control" name="heure_debut" id="heure_debut">
            </div>
            <div class="mb-3">
                <label for="heure_fin" class="form-label">Heure fin</label>
                <input type="time" class="form-control" name="heure_fin" id="heure_fin">
            </div>
            <?php
            echo "<input type='hidden' name='id' value='$id'>";
            ?>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</div>

