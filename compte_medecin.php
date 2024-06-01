<?php
session_start();
$_SESSION['id'] = session_id();
$nom = $_SESSION['nom'];
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
        h5 {
            color: red;
        }
        .indisponible {
            background-color: #f8d7da;
        }
        .disponible {
            background-color: #d4edda;
        }
    </style>
</head>
<body class="d-flex text-center">

<div class="container-fluid" id="wrapper">
    <div class="bg-info bg-gradient bg-success head" style="--bs-bg-opacity: .3" id="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-1">
                <span style="color: red;">Medi</span><span style="color: white;">care</span>
            </h1>

            <h1 class="mb-1">Services Médicaux</h1>
            <img src="medi_logo.png" alt="Logo de l'entreprise" class="logo">
        </div>

        <div class="bd">
            <?php include 'menu.php'; ?>
        </div>
    </div>

    <div class="container">
        <form action="traitement_modification_medecin.php" method="POST">
            <div class="mb-3">
                <label for="disponible" class="form-label">Disponibilité</label>
                <select class="form-select" id="disponible" name="disponible">
                    <?php
                    $bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');
                    $reponse = $bdd->prepare('SELECT disponible FROM professionnels WHERE id = :id');
                    $reponse->bindParam(':id', $_SESSION['id_client']);
                    $reponse->execute();
                    $donnees = $reponse->fetch();
                    if ($donnees['disponible'] == 1) {
                        echo '<option value="1" selected>Disponible</option>';
                        echo '<option value="0">Non disponible</option>';
                    } else {
                        echo '<option value="1">Disponible</option>';
                        echo '<option value="0" selected>Non disponible</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Modifier</button>
            </div>
        </form>

        <h2 class="mt-3">Bienvenue Dr. <?php echo $nom ?></h2>
        <h2 class="mt-3">Calendrier</h2>

        <!-- Section pour afficher les disponibilités -->
        <div class="mt-3">
            <h3>Disponibilités</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Jour</th>
                    <th>Heure Début</th>
                    <th>Heure Fin</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $reponse = $bdd->prepare('SELECT id, jour_semaine, heure_debut, heure_fin, disponible FROM disponibilites WHERE medecin_id = :id ORDER BY FIELD(jour_semaine, "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche"), heure_debut');
                $reponse->bindParam(':id', $_SESSION['id_client']);
                $reponse->execute();
                while ($disponibilite = $reponse->fetch()) {
                    $classe = $disponibilite['disponible'] ? 'disponible' : 'indisponible';
                    echo '<tr class="' . $classe . '">';
                    echo '<td>' . ucfirst($disponibilite['jour_semaine']) . '</td>';
                    echo '<td>' . $disponibilite['heure_debut'] . '</td>';
                    echo '<td>' . $disponibilite['heure_fin'] . '</td>';
                    echo '<td><form action="modifier_disponibilite.php" method="POST">
                                <input type="hidden" name="id" value="' . $disponibilite['id'] . '">
                                <input type="hidden" name="disponible" value="' . ($disponibilite['disponible'] ? '0' : '1') . '">
                                <button type="submit" class="btn ' . ($disponibilite['disponible'] ? 'btn-danger">Rendre Indisponible' : 'btn-success">Rendre Disponible') . '</button>
                              </form></td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
        </div>

        <h2 class="mt-3">Chat</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Email</th>
                <th scope="col">Contacter</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $reponse = $bdd->query('SELECT id, nom, prenom, email FROM clients');
            while ($donnees = $reponse->fetch()) {
                echo '<tr>';
                echo '<td>' . $donnees['nom'] . '</td>';
                echo '<td>' . $donnees['prenom'] . '</td>';
                echo '<td>' . $donnees['email'] . '</td>';
                echo '<td><a href="chat.php?receiver_id=' . $donnees['id'] . '">Contacter</a></td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php include 'footer.php'; ?>
</div>

</body>
</html>
