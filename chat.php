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
    <link href="menu.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
</head>
<html class="d-flex text-center">

<body class="container-fluid" id="wrapper">
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
    <?php include 'footer.php'; ?>
</body>
</html>

