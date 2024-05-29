<?php

$id = $_POST['id'];

$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');

$requete = $bdd->prepare("DELETE FROM clients WHERE id = :id");

$requete->bindParam(':id', $id, PDO::PARAM_INT);

$requete->execute();

header('Location: gestion_comptes_admin.php');
