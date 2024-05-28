<?php
session_start();

$reciever_id = $_GET['receiver_id'];
$sender_id = $_SESSION['id_client'];


$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');

$requete = $bdd->prepare("SELECT messages.*, clients.nom, clients.prenom FROM messages
         JOIN clients ON messages.expediteur_id = clients.id
WHERE (expediteur_id = :sender_id AND destinataire_id = :reciever_id) OR (expediteur_id = :reciever_id AND destinataire_id = :sender_id)
ORDER BY date_heure ASC;");

$requete->bindParam(':sender_id', $sender_id, PDO::PARAM_INT);
$requete->bindParam(':reciever_id', $reciever_id, PDO::PARAM_INT);

$requete->execute();



?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Medicare: Services médicaux </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="script.js"></script>
    <link href="style_chat.css" rel="stylesheet">
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

    <div id="content" class="cover-container d-flex w-100 p-3 mx-auto flex-column justify-content-center">
        <h1>Chat</h1>
        <div id="menu">
            <?php
            if (isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
                $nom = $_SESSION['nom'];
                $prenom = $_SESSION['prenom'];
                echo "<p class='welcome'>Bienvenu, $prenom $nom </p>";

            }
            ?>
            <div style="clear:both"></div>
        </div>

        <div id="chatbox">

            <?php
            while ($donnees = $requete->fetch()) {
                $sender_name = $donnees['nom'];
                $s = $donnees['prenom'];
                $temps = $donnees['date_heure'];
                $message = $donnees['message'];
                echo "<p class='msgln'><b> $s $sender_name ($temps) </b> $message</p>";
            }
            ?>

        </div>

        <form name="message" action="traitement_messages.php">
            <?php
            echo "<input name='sender_id' type='hidden' value='$sender_id'>";
            echo "<input name='receiver_id' type='hidden' value='$reciever_id'>";
            ?>
            <input name="usermsg" type="text" id="usermsg" size="63" />
            <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
        </form>
    </div>

