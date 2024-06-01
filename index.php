<?php
session_start();
$_SESSION['id'] = session_id();
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
            margin-bottom: 20px;
        }

        /* Heading style */
        h2 {
            text-align: center;
            font-family: 'Arial', sans-serif;
            color: #333;
            margin-bottom: 20px;
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

        /* Style for the explanation text and button */
        .explanation {
            text-align: left;
            margin-top: 20px;
            padding: 20px;
            border-radius: 8px;
        }



        .explanation p {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }


        .btn-more {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px; /* Add padding for a better appearance */
            cursor: pointer;
            color: #0d47a1;
            text-decoration: none;
            border: 2px solid #0d47a1; /* Add border for the button */
            border-radius: 5px; /* Rounded corners */
            background-color: #ffffff; /* Background color for the button */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add box shadow */
            transition: background-color 0.3s, color 0.3s; /* Smooth transition for hover effects */
        }

        .btn-more:hover {
            color: #ffffff;
            background-color: #0d47a1;
            border-color: #0d47a1;
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
        <div class="explanation">
            <h2>Bienvenue sur notre site de Services Médicaux</h2>
            <p class="intro">Notre site vous propose une large gamme de services médicaux pour répondre à tous vos besoins de santé. Découvrez nos différentes prestations, nos conseils santé et bien plus encore.</p>
            <p class="details" style="display: none;">Les plateformes médicales sont souvent compliquées à prendre en main pour les clients et pour les médecins. C'est pourquoi une équipe de quatres développeurs se sont donné comme mission de créer une plateforme claire permettant de prendre des rendez-vous médicaux, de passer des examens et même de faire des consultations en ligne : Medicare. La plateforme permet aussi de s'informer avec la présentation des dernières actualités médicales dans le monde pour sensibilisé la population à ce monde trop peu représenté.

                Pour vos rendez-vous médicaux, vous aurez le choix entre de nombreux médecins généralistes et plusieurs médecins spécialistes en addictologie, andrologie, cardiologie, dermatologie, gastro-hépato-entérologie, gynécologie, IST, ostéopathie et bien d'autres.
                Pour vous rassurer lors de votre prise de rendez-vous, Medicare vous permet de consulter les CV des medecins pour que vous choisissiez celui qui vous correspond le mieux. Vous pourrez ensuite choisir votre crénaux de rendez-vous sur la page de présentation du médecin. Si vous souhaitez simplement lui poser quelques questions rapides ne nécessitant pas de prendre un rendez-vous, vous aurez la possibilité de le contacter par email, sms ou par visioconférence s'il est disponible à ce moment là.

                Enfin, vous pourrez prendre rendez-vous dans notre laboratoire médiacal afin de passer divers examens médicaux.
            </p>
            <span class="btn-more" onclick="showMore()">En savoir plus</span>
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

    <script>
        function showMore() {
            var details = document.querySelector('.explanation .details');
            var button = document.querySelector('.explanation .btn-more');
            if (details.style.display === "block") {
                details.style.display = "none";
                button.textContent = "En savoir plus";
            } else {
                details.style.display = "block";
                button.textContent = "Afficher moins";
            }
        }
    </script>

</body>
</html>

