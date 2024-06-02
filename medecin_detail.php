<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicare";

// Vérifier si l'ID du professionnel est passé en paramètre
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID du professionnel non spécifié");
}

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les informations sur le professionnel
$id = $_GET['id'];
$sql = "SELECT p.id, p.path_photo, p.specialite, p.path_video, p.path_cv, p.disponible, c.nom, c.prenom, c.email 
        FROM professionnels p 
        INNER JOIN clients c ON p.id = c.id 
        WHERE p.id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $professionnel = $result->fetch_assoc();
} else {
    die("Professionnel non trouvé");
}

// Récupérer les disponibilités du professionnel
$sql_dispo = "SELECT * FROM disponibilites WHERE medecin_id = $id";
$result_dispo = $conn->query($sql_dispo);

// Créer un tableau associatif pour stocker les disponibilités par jour
$disponibilites = array(
    'lundi' => array(),
    'mardi' => array(),
    'mercredi' => array(),
    'jeudi' => array(),
    'vendredi' => array(),
    'samedi' => array(),
    'dimanche' => array()
);

// Remplir le tableau associatif avec les disponibilités
if ($result_dispo->num_rows > 0) {
    while ($dispo = $result_dispo->fetch_assoc()) {
        $jour = $dispo['jour_semaine'];
        $disponibilites[$jour][] = array(
            'id' => $dispo['id'],
            'heure_debut' => $dispo['heure_debut'],
            'heure_fin' => $dispo['heure_fin'],
            'disponible' => $dispo['disponible']
        );
    }
}

$conn->close();
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
    <style>
        .container-2 {
            border: 1px solid #ddd;
            padding: 20px;
            max-width: 400px;
            max-height: 400px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #f9f9f9;
        }
        .btn-custom {
            margin-bottom: 20px;
        }
        .special-text {
            font-weight: bold;
            color: #333;
        }
        .btn-disabled {
            background-color: grey;
            border-color: grey;
            pointer-events: none;
            color: white;
        }
    </style>
</head>
<body class="d-flex text-center">

<div class="container-fluid" id="wrapper">
    <div class="bg-info bg-gradient bg-success head" style="--bs-bg-opacity: .3" id="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-1">
                <span style="color: red;">Medi</span><span style="color: white;">care</span>
            </h1>
            <h1 class="mb-1"> Médecin</h1>
            <img src="medi_logo.png" alt="Logo de l'entreprise" class="logo">
        </div>

        <div class="bd">
            <?php include 'menu.php'; ?>
        </div>
    </div>

    <div id="content" class="cover-container d-flex w-100 p-3 mx-auto flex-column ">
        <h2><?php echo htmlspecialchars($professionnel['nom'] . ' ' . $professionnel['prenom']); ?></h2>
        <br>
        <div class="lead container-2">
            <div class="d-flex align-items-center ">
                <?php
                $path_photo = $professionnel['path_photo'];
                $nom = $professionnel['nom'];

                if (!empty($path_photo)) {
                    $path_photo = htmlspecialchars($path_photo);
                    echo '<img src="' . $path_photo . '" alt="Photo de ' . htmlspecialchars($nom) . '" class="img-thumbnail" width="100" height="100">';
                } else {
                    echo '<p>Pas de photo disponible</p>';
                }
                ?>

                <div class="ms-3">
                    <p><span class="special-text">Spécialité: </span><span><?php echo htmlspecialchars($professionnel['specialite']); ?></span></p>
                    <p><span class="special-text">Email: </span><span><?php echo htmlspecialchars($professionnel['email']); ?></span></p>
                    <?php if ($professionnel['disponible']): ?>
                        <a href="<?php echo "chat.php?receiver_id=$id"?>" class="btn btn-primary btn-custom">Envoyer un message</a>
                    <?php else: ?>
                        <button class="btn btn-primary btn-custom btn-disabled">Envoyer un message</button>
                    <?php endif; ?>
                    <a href="tel:<?php echo htmlspecialchars($professionnel['path_video'] ?? ''); ?>" class="btn btn-success ms-2">Appeler</a>
                </div>
            </div>
        </div>
    </div>

    <br>
    <h3>Disponibilités</h3>
    <div class="row">
        <?php foreach ($disponibilites as $jour => $dispos): ?>
            <div class="col-md-4">
                <h5><?php echo ucfirst($jour); ?></h5>
                <ul class="list-group">
                    <?php if (!empty($dispos)): ?>
                        <?php foreach ($dispos as $dispo): ?>
                            <li class="list-group-item">
                                <?php if ($dispo['disponible']): ?>
                                    <form method="post" action="confirmer_rdv.php">
                                        <input type="hidden" name="dispo_id" value="<?php echo htmlspecialchars($dispo['id']); ?>">
                                        <button type="submit" name="submit" class="btn btn-outline-primary">
                                            <?php echo htmlspecialchars($dispo['heure_debut'] . ' à ' . $dispo['heure_fin']); ?>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <button class="btn btn-outline-secondary" disabled>
                                        <?php echo htmlspecialchars($dispo['heure_debut'] . ' à ' . $dispo['heure_fin']); ?> (Indisponible)
                                    </button>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item">Aucune disponibilité ce jour.</li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
    <br>
    <a href="medecine_generale.php" class="btn btn-secondary">Retourner à la liste des professionnels</a>
    <?php include 'footer.php'; ?>

</div>
</body>
</html>
