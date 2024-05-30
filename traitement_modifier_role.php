<?php

$id = $_POST['id'];
$type_compte = $_POST['type_compte'];

$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');

$requete = $bdd->prepare("SELECT nom, prenom, type_compte FROM clients WHERE id = :id");

$requete->bindParam(':id', $id, PDO::PARAM_INT);

$requete->execute();

$row = $requete->fetch();
$type_compte_ancien = $row['type_compte'];

$requete = $bdd->prepare("UPDATE clients SET type_compte = :type_compte WHERE id = :id");

$requete->bindParam(':id', $id, PDO::PARAM_INT);
$requete->bindParam(':type_compte', $type_compte, PDO::PARAM_INT);

$requete->execute();

if ($type_compte == 1 && $type_compte_ancien != 1) {
    $requete = $bdd->prepare("INSERT INTO professionnels (id) VALUES (:id)");

    $requete->bindParam(':id', $id, PDO::PARAM_INT);

    $requete->execute();
} else if ($type_compte != 1 && $type_compte_ancien == 1) {
    $requete = $bdd->prepare("DELETE FROM professionnels WHERE :id");

    $requete->bindParam(':id', $id, PDO::PARAM_INT);

    $requete->execute();

}

header('Location: gestion_comptes_admin.php');

?>
