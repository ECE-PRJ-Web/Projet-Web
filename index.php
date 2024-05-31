<?php
session_start();
$_SESSION['id']=session_id();
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Services médicaux </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="script.js"></script>
    <link href="menu.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
    <style>
        /* General styling for the container */
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Heading style */
        h2 {
            text-align: center;
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        /* Carousel controls styling */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #000;
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        /* Fixed size for carousel images */
        .carousel-item img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Carousel caption styling */
        .carousel-caption {
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 5px;
        }

        .carousel-caption h6,
        .carousel-caption h5 {
            font-family: 'Arial', sans-serif;
            color: #fff;
        }

        /* Carousel indicators */
        .carousel-indicators li {
            background-color: #333;
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .carousel-indicators .active {
            background-color: #000;
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

            <h1 class = "mb-1"> Services Médicaux</h1>
            <img src="medi_logo.png" alt="Logo de l'entreprise" class="logo">
        </div>

        <div class="bd">
            <?php include 'menu.php'; ?>
        </div>
    </div>

    <div class="container">
        <h2 class="mt-3">Bulletin santé de la semaine</h2>
        <div id="carouselExampleControls" class="carousel slide mt-3" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="https://www.legorafi.fr/2023/12/19/penurie-de-medicaments-le-gouvernement-recommande-de-mettre-une-gousse-dail-sous-son-oreiller/">
                        <img src="medicaments.png" class="d-block" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h6>Pénurie de médicaments – Le gouvernement recommande de mettre une gousse d’ail sous son oreiller</h6>
                        </div>
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="https://www.legorafi.fr/2023/06/19/par-un-procede-revolutionnaire-des-scientifiques-reussissent-a-transformer-la-contrex-en-eau/">
                        <img src="https://www.legorafi.fr/wp-content/uploads/2023/06/labo-2048x1152.jpg" class="d-block" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h6>Par un procédé révolutionnaire, des scientifiques réussissent à transformer la Contrex en eau</h6>
                        </div>
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="https://www.legorafi.fr/2024/05/24/une-etude-revele-que-les-gauchers-sont-plus-habiles-de-leur-main-gauche/">
                        <img src="https://www.legorafi.fr/wp-content/uploads/2024/05/iStock-1253877737-2048x1365.jpg" class="d-block" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Une étude révèle que les gauchers sont plus habiles de leur main gauche</h5>
                        </div>
                    </a>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
<?php include 'footer.php'; ?>

</body>

</html>