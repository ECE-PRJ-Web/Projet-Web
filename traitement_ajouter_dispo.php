<?php

$id = $_POST['id'];
$jour_semaine = $_POST['jour_semaine'];
$heure_debut = $_POST['heure_debut'];
$heure_fin = $_POST['heure_fin'];

$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');
$requete = $bdd->prepare("INSERT INTO disponibilites (medecin_id, jour_semaine, heure_debut, heure_fin, disponible) VALUES (:id, :jour_semaine, :heure_debut, :heure_fin, 1)");
$requete->bindParam(':id', $id);
$requete->bindParam(':jour_semaine', $jour_semaine);
$requete->bindParam(':heure_debut', $heure_debut);
$requete->bindParam(':heure_fin', $heure_fin);
$result = $requete->execute();

if ($result) {
    header("Location: calendrier_admin.php?id=$id");
} else {
    echo "Erreur";
}
?>
