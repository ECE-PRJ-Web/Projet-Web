<?php
$id = $_GET['id'];

$type_compte = $_GET['type_compte'.$id];

echo 'type_compte'.$id;
echo $type_compte;

$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');

$requete = $bdd->prepare("UPDATE clients SET type_compte = :type_compte WHERE id = :id;");
$requete->bindParam(':type_compte', $type_compte);
$requete->bindParam(':id', $id);
$result = $requete->execute();

if ($result) {
    echo "Modification réussie";
    //header('Location: gestion_comptes_admin.php');
} else {
    echo "Erreur de modification";
}

?>