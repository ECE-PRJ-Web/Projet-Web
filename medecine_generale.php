<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicare";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête pour obtenir les médecins généralistes
$sql = "SELECT p.id, p.path_photo, p.path_video, p.path_cv, p.specialite, c.nom, c.prenom, c.email 
        FROM professionnels p 
        INNER JOIN clients c ON p.id = c.id 
        WHERE p.specialite = 'Généraliste'";
$result = $conn->query($sql);

// Fermer la connexion après l'exécution de la requête
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Medicare: Médecine Générale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="menu.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
    <style>
        .btn-custom {
            width: 200px;  /* Vous pouvez ajuster la largeur selon vos besoins */
            height: 40px;  /* Vous pouvez ajuster la hauteur selon vos besoins */

        }
    </style>

</head>
<body class="d-flex text-center">

<div class="container-fluid" id="wrapper">
    <div class="bg-info bg-gradient bg-success head" style="--bs-bg-opacity: .3" id="header">
        <div class="d-flex justify-content-between align-items-center" >
            <h1 class="mb-1">
                <span style="color: red;">Medi</span><span style="color: white;">care</span>
            </h1>
            <h1 class = "mb-1"> Médecine générale</h1>
            <img src="medi_logo.png" alt="Logo de l'entreprise" class="logo">
        </div>

        <div class="bd">
            <?php include 'menu.php'; ?>
        </div>
    </div>

    <div id="content" class="cover-container d-flex w-100 p-3 mx-auto flex-column">
        <br>
        <div id="medecins" class="lead">
            <ul class="list-group">
                <?php if ($result->num_rows > 0): ?>
                    <?php while($professionnel = $result->fetch_assoc()): ?>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="col-auto">
                                    <img src="<?php echo htmlspecialchars($professionnel['path_photo'] ?? ''); ?>" alt="Photo de <?php echo isset($professionnel['nom']) ? htmlspecialchars($professionnel['nom']) : 'Nom inconnu'; ?>" class="img-thumbnail" width="100" height="100">
                                </div>
                                <div class="col ms-3">
                                    <h5 class="mb-1"><?php echo isset($professionnel['nom']) && isset($professionnel['prenom']) ? htmlspecialchars($professionnel['nom'] . ' ' . $professionnel['prenom']) : 'Nom inconnu'; ?></h5>
                                    <p class="mb-1">Spécialité: <?php echo htmlspecialchars($professionnel['specialite'] ?? 'Spécialité inconnue'); ?></p>
                                    <p class="mb-1">Email: <?php echo isset($professionnel['email']) ? htmlspecialchars($professionnel['email']) : 'Email inconnu'; ?></p>
                                    <a href="medecin_detail.php?id=<?php echo $professionnel['id']; ?>" class="btn btn-primary btn-custom"">Plus d'informations</a>
                                </div>
                            </div>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>

        </div>

        <li class="list-group-item">Aucun professionnel trouvé.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <?php include 'footer.php'; ?>


</body>
</html>
