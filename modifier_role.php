<?php
$id = $_GET['id'];

$bdd = new PDO('mysql:host=localhost;dbname=medicare', 'root', '');

$requete = $bdd->prepare("SELECT nom, prenom, type_compte FROM clients WHERE id = :id");

$requete->bindParam(':id', $id, PDO::PARAM_INT);

$requete->execute();

$row = $requete->fetch();

$nom = $row['nom'];
$prenom = $row['prenom'];
$type_compte = $row['type_compte'];

if ($type_compte == 2) {
    $type_compte = "Administrateur";
} else if ($type_compte == 1) {
    $type_compte = "Médecin";
} else {
    $type_compte = "Utilisateur";
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Medicare: <?php echo htmlspecialchars($professionnel['nom'] . ' ' . $professionnel['prenom']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

            <h1 class = "mb-1"> Détails du professionnel</h1>
            <img src="medi_logo.png" alt="Logo de l'entreprise" class="logo">
        </div>

        <div class="bd">
            <?php include 'menu.php'; ?>
        </div>
    </div>

    <div id="content" class="cover-container d-flex w-100 p-3 mx-auto flex-column">
        <h1>Modifier le rôle de <?php echo htmlspecialchars($nom . ' ' . $prenom); ?></h1>
        <form action="traitement_modifier_role.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group mb-3">
                <label for="type_compte">Rôle</label>
                <select class="form-select" id="type_compte" name="type_compte">
                    <option value="0" <?php if ($type_compte == "Utilisateur") echo "selected"; ?>>Utilisateur</option>
                    <option value="1" <?php if ($type_compte == "Médecin") echo "selected"; ?>>Médecin</option>
                    <option value="2" <?php if ($type_compte == "Administrateur") echo "selected"; ?>>Administrateur</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>

</div>

</body>
</html>
