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

            <h1 class = "mb-1"> Services Médicaux</h1>
            <img src="medi_logo.png" alt="Logo de l'entreprise" class="logo">
        </div>

        <div class="bd">
            <?php include 'menu.php'; ?>
        </div>
    </div>
    <div class="container">
        <h2>Édition des données</h2>
        <a href="modifier_mdp.php" class="btn btn-primary mb-2">Modifier mon mot de passe</a>

        <form action="traitement_edition_donnees_clients.php" method="post">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <?php if (isset($_SESSION['nom'])) {
                    echo '<input type="text" class="form-control" id="nom" name="nom" value="' . $_SESSION['nom'] . '" required>';
                } else {
                    echo '<input type="text" class="form-control" id="nom" name="nom" value="" required>';
                }?>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <?php if (isset($_SESSION['prenom'])) {
                    echo '<input type="text" class="form-control" id="prenom" name="prenom" value="' . $_SESSION['prenom'] . '" required>';
                } else {
                    echo '<input type="text" class="form-control" id="prenom" name="prenom" value="" required>';
                }?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <?php if (isset($_SESSION['mail'])) {
                    echo '<input type="email" class="form-control" id="email" name="email" value="' . $_SESSION['mail'] . '" required>';
                } else {
                    echo '<input type="email" class="form-control" id="email" name="email" value="" required>';
                }?>
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <?php if (isset($_SESSION['adresse'])) {
                    echo '<input type="text" class="form-control" id="adresse" name="adresse" value="' . $_SESSION['adresse'] . '">';
                } else {
                    echo '<input type="text" class="form-control" id="adresse" name="adresse" value="">';
                }?>
            </div>
            <div class="mb-3">
                <label for="CarteVitale" class="form-label">Numéro de Carte Vitale</label>
                <?php if (isset($_SESSION['CarteVitale'])) {
                    echo '<input type="text" class="form-control" id="CarteVitale" name="CarteVitale" value="' . $_SESSION['CarteVitale'] . '">';
                } else {
                    echo '<input type="text" class="form-control" id="CarteVitale" name="CarteVitale" value="">';
                }?>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Valider</button>

    </div>
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">© 2024 SA Medicare</p>
        <p class="col-md-4 mb-0 text-body-secondary">51 Rue Trayne Cul, 69620 Val d'Oingt</p>

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2774.1514899926615!2d4.580111175787794!3d45.94825620101239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f4886b1b8a7331%3A0x8cc507515c81c158!2sRue%20Trayne%20Cul%2C%2069620%20Val%20d&#39;Oingt!5e0!3m2!1sfr!2sfr!4v1716677967175!5m2!1sfr!2sfr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </footer>
</div>

<?php include 'footer.php'; ?>

</body>
</html>