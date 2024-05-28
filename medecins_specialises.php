<?php
session_start();
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Medicare: Services médicaux </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="script.js"></script>
    <style>
        .domain-block {
            cursor: pointer;
            margin-bottom: 1rem;
            padding: 1rem;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body class="d-flex text-center">

<div class="container" id="wrapper">
    <!-- HEADER -->
    <div class="bg-info bg-gradient bg-success" style="--bs-bg-opacity: .3" id="header">
        <h1>Medicare: Médecine Spécialisée</h1>
        <div class="bd">
            <nav class="navbar navbar-expand-lg sticky-top mb-2">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">Accueil</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Tout Parcourir
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="medecine_generale.php">Médecine Générale</a></li>
                                    <li><a class="dropdown-item" href="medecins_specialises.php">Médecins Spécialistes</a></li>
                                    <li><a class="dropdown-item" href="Laboratoire.php">Laboratoire de biologie médicale</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Rendez-vous</a>
                            </li>
                        </ul>
                        <?php if (isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
                            echo '<div class="me-2">';
                            echo '<a href="compte.php" class="btn btn-outline-success me-2">Compte</a>';
                            echo '<a href="deconnexion.php" class="btn btn-outline-secondary">Déconnexion</a>';
                            echo '</div>';
                        } else {
                            echo '<div class="me-2 ">';
                            echo '<a href="connexion.php" class="btn btn-outline-secondary me-2">Connexion</a>';
                            echo '<a href="inscription.php" class="btn btn-outline-success">Inscription</a>';
                            echo '</div>';
                        }
                        ?>
                        <form class="d-flex navbar-nav mb-lg-0" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success " type="submit">Search</button>
                        </form>
                    </div>

                </div>
            </nav>
        </div>
    </div>


    <div class="row justify-content-center mt-5">
        <div class="col-md-6 ">
            <div class="domain-block" data-domain="general">
                Médecine Générale
            </div>
            <div id="doctor-list" style="display: none;">

                    <h3 id="domain-title"></h3>
                    <ul id="doctor-names" class="list-group">
                        <!-- List of doctors will appear here -->
                    </ul>

            </div>
            <div class="domain-block" data-domain="specialist">
                Médecins Spécialistes
            </div>
            <div class="domain-block" data-domain="cardiology">
                Cardiologie
            </div>
            <div class="domain-block" data-domain="neurology">
                Neurologie
            </div>
            <div class="domain-block" data-domain="pediatrics">
                Pédiatrie
            </div>
            <div class="domain-block" data-domain="dermatology">
                Dermatologie
            </div>
            <div class="domain-block" data-domain="radiology">
                Radiologie
            </div>
        </div>
    </div>
    <!--
    <div id="doctor-list" class="row justify-content-center mt-4" style="display: none;">
        <div class="col-md-6 ">
            <h3 id="domain-title"></h3>
            <ul id="doctor-names" class="list-group">
                <-- List of doctors will appear here --
            </ul>
        </div>
    </div>
    -->

    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">© 2024 SA Medicare</p>
        <p class="col-md-4 mb-0 text-body-secondary">51 Rue Trayne Cul, 69620 Val d'Oingt</p>

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2774.1514899926615!2d4.580111175787794!3d45.94825620101239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f4886b1b8a7331%3A0x8cc507515c81c158!2sRue%20Trayne%20Cul%2C%2069620%20Val%20d&#39;Oingt!5e0!3m2!1sfr!2sfr!4v1716677967175!5m2!1sfr!2sfr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </footer>
</div>

<script>
    // Example data for doctors
    const doctors = {
        "general": ["Dr. Smith", "Dr. Johnson", "Dr. Brown"],
        "specialist": ["Dr. Taylor", "Dr. Anderson", "Dr. Thomas"],
        "cardiology": ["Dr. Martinez", "Dr. Hernandez", "Dr. Lopez"],
        "neurology": ["Dr. Gonzalez", "Dr. Wilson", "Dr. Moore"],
        "pediatrics": ["Dr. Jackson", "Dr. Lee", "Dr. Harris"],
        "dermatology": ["Dr. Clark", "Dr. Lewis", "Dr. Robinson"],
        "radiology": ["Dr. Walker", "Dr. Young", "Dr. Hall"]
    };

    document.querySelectorAll('.domain-block').forEach(block => {
        block.addEventListener('click', function() {
            const domain = this.getAttribute('data-domain');
            const doctorList = doctors[domain];

            // Update the doctor list
            const doctorNames = document.getElementById('doctor-names');
            doctorNames.innerHTML = '';
            doctorList.forEach(doctor => {
                const li = document.createElement('li');
                li.className = 'list-group-item';
                li.textContent = doctor;
                doctorNames.appendChild(li);
            });

            // Update the title
            //const domainTitle = document.getElementById('domain-title');
            //domainTitle.textContent = this.textContent;

            // Show the doctor list
            document.getElementById('doctor-list').style.display = 'block';
        });
    });
</script>





</body>
</html>
