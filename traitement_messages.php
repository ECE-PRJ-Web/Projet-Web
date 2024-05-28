<?php
session_start();

$reciever_id = $_GET['receiver_id'];
$sender_id = $_GET['sender_id'];
$message = $_GET['usermsg'];

$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');

$temps = date("Y-m-d H:i:s");

$requete = $bdd->prepare("INSERT INTO messages (expediteur_id, destinataire_id, message, date_heure) VALUES (:sender_id, :reciever_id, :message, :temps);");

$requete->bindParam(':sender_id', $sender_id, PDO::PARAM_INT);
$requete->bindParam(':reciever_id', $reciever_id, PDO::PARAM_INT);
$requete->bindParam(':message', $message, PDO::PARAM_STR);
$requete->bindParam(':temps', $temps, PDO::PARAM_STR);

$requete->execute();

header('Location: chat.php?receiver_id='.$reciever_id);
