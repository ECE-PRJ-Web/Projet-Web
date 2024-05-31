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
        <h1 class="mb-4">Gestion des comptes</h1>
        <div class="d-flex justify-content-center">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Type de compte</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');
                $requete = $bdd->prepare("SELECT * FROM clients");
                $result = $requete->execute();
                if ($requete->rowCount() != 0) {
                    while ($row = $requete->fetch()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['nom'] . "</td>";
                        echo "<td>" . $row['prenom'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        if ($row['type_compte'] == 2) {
                            echo "<td>Administrateur</td>";
                        }
                        else if ($row['type_compte'] == 1) {
                            echo "<td>Médecin</td>";
                        }
                        else {
                            echo "<td>Utilisateur</td>";
                        }
                        echo "<td><a href='modifier_role.php?id=" . $row['id'] . "'>Modifier</a> | <a href='chat.php?receiver_id=" . $row['id'] . "'>Contacter</a> | <a href='supprimer_utilisateur.php?id=" . $row['id'] . "'>Supprimer</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
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