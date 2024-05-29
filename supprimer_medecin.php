<?php
session_start();

$id_medecin = $_GET['id'];

$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');

$requete = $bdd->prepare("DELETE FROM professionnels WHERE id = :id");
$requete->bindParam(':id', $id_medecin);
$result = $requete->execute();

if ($result) {
    header('Location: gestion_medecin_admin.php');
} else {
    echo "Erreur de suppression";
}

?>