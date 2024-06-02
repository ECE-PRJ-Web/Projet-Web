<?php
$id = $_GET['id'];

$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');
$requete = $bdd->prepare("SELECT * FROM disponibilites WHERE id = :id");
$requete->bindParam(':id', $id);
$result = $requete->execute();
$row = $requete->fetch();
$id_medecin = $row['medecin_id'];

$requete = $bdd->prepare("DELETE FROM disponibilites WHERE id = :id");
$requete->bindParam(':id', $id);
$result = $requete->execute();

if ($result) {
    header("Location: calendrier_admin.php?id=$id_medecin");
} else {
    echo "Erreur";
}
?>


