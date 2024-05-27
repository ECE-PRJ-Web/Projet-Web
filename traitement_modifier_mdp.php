<?php
session_start();

$ancien_mdp = $_POST['mdp'];
$nouveau_mdp = $_POST['new_mdp'];
$nouveau_mdp_confirm = $_POST['new_mdp_confirm'];

$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');

$requete = $bdd->prepare("SELECT password FROM clients WHERE id = :id");
$requete->bindParam(':id', $_SESSION['id_client']);

$requete->execute();
$reussi = false;
$bon_ancien_mdp = false;
$match_mdp = false;

    $client = $requete->fetch();
    if ($client['password'] === $ancien_mdp) {
        if ($nouveau_mdp == $nouveau_mdp_confirm) {
            $requete = $bdd->prepare("UPDATE clients SET password = :password WHERE id = :id");
            $requete->bindParam(':password', $nouveau_mdp);
            $requete->bindParam(':id', $_SESSION['id_client']);
            $reussi = $requete->execute();
            $match_mdp = true;
        }
    }
    else {
        $bon_ancien_mdp = false;
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
</head>
<body class="d-flex text-center">

<div class="container" id="wrapper">
    <div class="bg-info bg-gradient bg-success" style="--bs-bg-opacity: .3" id="header">
        <h1>Medicare: Services médicaux</h1>
        <div class="bd">
            <nav class="navbar navbar-expand-lg sticky-top mb-2">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">Accueil</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Tout Parcourir
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Médecine Générale</a></li>
                                    <li><a class="dropdown-item" href="#">Médecins Spécialistes</a></li>
                                    <li><a class="dropdown-item" href="#">Laboratoire de biologie médicale</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Rendez-vous</a>
                            </li>
                        </ul>
                        <?php if (isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
                            echo '<div class="me-2">';
                            echo '<a href="compte.php" class="btn btn-outline-success me-2">Compte</a>';
                            echo '<a href="deconnexion.php" class="btn btn-outline-secondary">Déconnexion</a>';
                            echo '</div>';
                        } else {
                            echo '<div class="me-2 ">';
                            echo '<a href="connexion.php" class="btn btn-outline-secondary me-2">Connexion</a>';
                            echo '<a href="inscription.php" class="btn btn-outline-success">Inscription</a>';
                            echo '</div>';
                        }
                        ?>
                        <form class="d-flex navbar-nav mb-lg-0" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success " type="submit">Search</button>
                        </form>
                    </div>

                </div>
            </nav>
        </div>
    </div>
    <div class="container">

        <?php
        if ($reussi) {
            echo '<div class="alert alert-success" role="alert">Votre mot de passe a bien été modifié</div>';
        }
        else {
            if (!$bon_ancien_mdp) {
                echo '<div class="alert alert-danger" role="alert">Votre ancien mot de passe est incorrect</div>';
            }
            else if (!$match_mdp) {
                echo '<div class="alert alert-danger" role="alert">Les nouveaux mots de passe ne correspondent pas</div>';
            }
        }
        ?>

        <a href="compte.php" class="btn btn-success">Retour au compte</a>


