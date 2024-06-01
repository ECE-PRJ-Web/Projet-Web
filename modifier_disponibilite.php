<?php
// modifier_disponibilite.php
$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');
$id = $_POST['id'];
$disponible = $_POST['disponible'];

$requete = $bdd->prepare('UPDATE disponibilites SET disponible = :disponible WHERE id = :id');
$requete->bindParam(':id', $id);
$requete->bindParam(':disponible', $disponible);
$requete->execute();

header('Location: compte_medecin.php'); // Remplacez par votre page principale
exit;
?>
