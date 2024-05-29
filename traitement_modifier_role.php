<?php

$id = $_POST['id'];
$type_compte = $_POST['type_compte'];

$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');

$requete = $bdd->prepare("UPDATE clients SET type_compte = :type_compte WHERE id = :id");

$requete->bindParam(':id', $id, PDO::PARAM_INT);
$requete->bindParam(':type_compte', $type_compte, PDO::PARAM_INT);

$requete->execute();

header('Location: gestion_comptes_admin.php');

?>
