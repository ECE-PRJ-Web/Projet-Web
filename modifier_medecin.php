<?php
session_start();

$id_medecin = $_GET['id'];

$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');

$requete = $bdd->prepare("SELECT * FROM professionnels WHERE id = :id");
$requete->bindParam(':id', $id_medecin);
$result = $requete->execute();

if ($result) {
    $row = $requete->fetch();
    $specialite = $row['specialite'];
    $path_photo = $row['path_photo'];
    $path_video = $row['path_video'];

} else {
    echo "Erreur de récupération";
}



?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Medicare: Services médicaux </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="script.js"></script>
    <link href="menu.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
</head>
<body class="d-flex text-center">


<div class="container-fluid" id="wrapper">
    <div class="bg-info bg-gradient bg-success head" style="--bs-bg-opacity: .3" id="header">
        <div class="d-flex justify-content-between align-items-center" >
            <h1 class="mb-1">
                <span style="color: red;">Medi</span><span style="color: white;">care</span>
            </h1>

            <h1 class = "mb-1">Gestion des médecins</h1>
            <img src="medi_logo.png" alt="Logo de l'entreprise" class="logo">
        </div>

        <div class="bd">
            <?php include 'menu.php'; ?>
        </div>
    </div>

    <div id="content" class="cover-container d-flex w-100 p-3 mx-auto flex-column justify-content-center">

        <form action="traitement_modifier_medecin.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id_medecin; ?>">
            <div class="mb-3">
                <label for="specialite" class="form-label">Spécialité</label>
                <input type="text" class="form-control" id="specialite" name="specialite" value="<?php echo $specialite;?>">
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo">
            </div>
            <div class="mb-3">
                <label for="video" class="form-label">Vidéo</label>
                <input type="file" class="form-control" id="video" name="video">
            </div>
            <div class="mb-3">
                <label for="CV" class="form-label">CV</label>
                <input type="file" class="form-control" id="CV" name="CV">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>

</div>
</body>
</html>

