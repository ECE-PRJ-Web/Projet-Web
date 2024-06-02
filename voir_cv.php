<?php
session_start();
$_SESSION['id'] = session_id();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicare";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si l'ID du professionnel est passé en paramètre
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID du professionnel non spécifié");
}

$id = $_GET['id'];

// Récupérer les informations sur le professionnel
$sql = "SELECT path_cv FROM professionnels WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $professionnel = $result->fetch_assoc();
    $path_cv = $professionnel['path_cv'];
} else {
    die("CV non trouvé pour ce professionnel");
}

$conn->close();

if (!file_exists($path_cv)) {
    die("Le fichier CV n'existe pas.");
}

// Charger le contenu XML
$xml = simplexml_load_file($path_cv);
if ($xml === false) {
    die("Erreur de chargement du fichier XML.");
}

$nom = htmlspecialchars($xml->nom);
$prenom = htmlspecialchars($xml->prenom);
$email = htmlspecialchars($xml->email);
$specialite = htmlspecialchars($xml->specialite);
$experience = $xml->experience;
$hobbies = $xml->hobbies;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV de <?php echo $prenom . ' ' . $nom; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="script.js"></script>
    <link href="menu.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 14px;
        }
        .experience, .hobbies {
            margin-top: 20px;
        }
        .experience h3, .hobbies h3 {
            margin-bottom: 15px;
        }
        .experience ul, .hobbies ul {
            list-style-type: none;
            padding: 0;
        }
        .experience li, .hobbies li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="d-flex text-center">

<div class="container-fluid" id="wrapper">
    <?php include 'menu.php'; ?>

    <div class="container">
        <h1>CV de <?php echo $prenom . ' ' . $nom; ?></h1>
        <p><strong>Email: </strong><?php echo $email; ?></p>
        <p><strong>Spécialité: </strong><?php echo $specialite; ?></p>

        <div class="experience">
            <h3>Expérience</h3>
            <ul>
                <?php foreach ($experience->job as $job): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($job->title); ?></strong> chez <em><?php echo htmlspecialchars($job->employeur); ?></em> (<?php echo htmlspecialchars($job->duree); ?>)
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="hobbies">
            <h3>Hobbies</h3>
            <ul>
                <?php foreach ($hobbies->hobby as $hobby): ?>
                    <li><?php echo htmlspecialchars($hobby); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</div>
</body>
</html>
