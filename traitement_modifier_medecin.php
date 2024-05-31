<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');

$specialite = $_POST['specialite'];
$id = $_POST['id'];

$uploaddir_image = 'images/';
$uploaddir_video = 'videos/';
$uploaddir_CV = 'CV/';

$uploadfile_image = $uploaddir_image . basename($_FILES['photo']['name']);
$uploadfile_video = $uploaddir_video . basename($_FILES['video']['name']);
$uploadfile_CV = $uploaddir_CV . basename($_FILES['CV']['name']);

if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile_image)) {
    $photo = $_FILES['photo'];
    $photo_name = $photo['name'];
    $photo_tmp_name = $photo['tmp_name'];
    $photo_dest = $uploaddir_image . $photo_name;
    $requete = $bdd->prepare("UPDATE professionnels SET path_photo = :photo WHERE id = :id");
    $requete->bindParam(':photo', $photo_dest);
    $requete->bindParam(':id', $id);
    $result = $requete->execute();
}

if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile_image)) {
    $video = $_FILES['video'];
    $video_name = $video['name'];
    $video_tmp_name = $video['tmp_name'];
    $video_dest = 'videos/' . $video_name;
    move_uploaded_file($video_tmp_name, $video_dest);
    $requete = $bdd->prepare("UPDATE professionnels SET path_video = :video WHERE id = :id");
    $requete->bindParam(':video', $video_dest);
    $requete->bindParam(':id', $id);
    $result = $requete->execute();
}

if (move_uploaded_file($_FILES['CV']['tmp_name'], $uploadfile_CV)) {
    $CV = $_FILES['CV'];
    $CV_name = $CV['name'];
    $CV_tmp_name = $CV['tmp_name'];
    $CV_dest = 'CV/' . $CV_name;
    move_uploaded_file($CV_tmp_name, $CV_dest);
    $requete = $bdd->prepare("UPDATE professionnels SET path_CV = :CV WHERE id = :id");
    $requete->bindParam(':CV', $CV_dest);
    $requete->bindParam(':id', $id);
    $result = $requete->execute();
}

$requete = $bdd->prepare("UPDATE professionnels SET specialite = :specialite WHERE id = :id");

$requete->bindParam(':specialite', $specialite);
$requete->bindParam(':id', $id);

$result = $requete->execute();

if ($result) {
    header('Location: gestion_medecin_admin.php');
} else {
    echo "Erreur de modification";
}

?>
