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
        <h1>Calendrier des rendez-vous</h1>
        <a href="ajouter_rendez_vous.php?id=<?php echo "$id" ?>" class="btn btn-primary">Ajouter un rendez-vous</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Jour</th>
                <th scope="col">Heure début</th>
                <th scope="col">Heure fin</th>
                <th scope="col">Disponible</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');
            $requete = $bdd->prepare("SELECT * FROM disponibilites WHERE medecin_id = :id");
            $requete->bindParam(':id', $id, PDO::PARAM_INT);
            $result = $requete->execute();
            if ($requete->rowCount() != 0) {
                while ($row = $requete->fetch()) {
                    echo "<tr>";
                    echo "<td>" . $row['jour_semaine'] . "</td>";
                    echo "<td>" . $row['heure_debut'] . "</td>";
                    echo "<td>" . $row['heure_fin'] . "</td>";
                    echo "<td>" . ($row['disponible'] == 1 ? 'Oui' : 'Non') . "</td>";
                    echo "<td><a href='supprimer_disponibilite.php?id=" . $row['id'] . "'>Supprimer</a></td>";
                    echo "</tr>";
                }
            }
            ?>
            </tbody>



