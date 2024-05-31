<?php
session_start();

$disponible = $_POST['disponible'];

$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');

$requete = $bdd->prepare("UPDATE professionnels SET disponible = :disponible WHERE id = :id");

$requete->bindParam(':disponible', $disponible);
$requete->bindParam(':id', $_SESSION['id_client']);

$result = $requete->execute();

if ($result) {
    header('Location: compte_medecin.php');
} else {
    echo "Erreur de modification";
}
?>

