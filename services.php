<?php
session_start();

$services = [
    "covid" => [
        "title" => "Dépistage covid-19",
        "description" => "<h2>Informations sur le dépistage covid-19.</h2>
<p>La maladie à coronavirus (COVID19) est une maladie infectieuse due au virus SARS-CoV-2. Le virus peut se propager par l’intermédiaire des gouttelettes de salive ou de sécrétions nasales émises par une personne infectée quand elle tousse, éternue, parle, chante ou respire. Il est donc important d’appliquer les règles d’hygiène respiratoire, par exemple en se couvrant la bouche et le nez avec le pli du coude lorsque l’on tousse, et si l’on ne se sent pas bien, de rester chez soi et de s’isoler jusqu’à ce qu’on soit rétabli.</p>
<p>Les principaux symptômes, combinés ou isolés, de l'infection par le Covid-19 sont :</p>
<ul><li> fièvre ou sensation de fièvre</li>
    <li>des signes respiratoires, comme une toux, un essoufflement ou une sensation d’oppression dans la poitrine </li>
    <li>des maux de tête, des courbatures, une fatigue inhabituelle </li>
    <li>une perte brutale de l’odorat (sans obstruction nasale), une disparition totale du goût</li>
    <li>une diarrhée.</li>.</ul>
        ",

        "details" => "<h2>Test PCR</h2>
<p>Il existe 2 méthodes actuellement en France.

Dans le premier cas, le test de référence RT-PCR, se fait sous la forme d’un prélèvement naso-pharyngé dans la majorité des cas. Il ne dure que quelques secondes et peut occasionner une légère gêne dans le nez. Le principe : un échantillon de mucus est prélevé dans le nez grâce à un long coton-tige, appelé écouvillon. Une fois récupéré, l'échantillon est scellé puis analysé par le laboratoire de biologie médicale.

Ce prélèvement n'est pas adapté à toutes les situations, particulièrement lorsque le test doit être répété. C’est pourquoi il est possible de réaliser un test RT-PCR à partir d’un prélèvement salivaire notamment chez les personnes contact pour qui un prélèvement nasopharyngé n'est pas envisageable.</p>",
    ],
    "prevention" => [
        "title" => "Biologie préventive",
        "description" => "<h2>Informations sur la biologie préventive.</h2>
        <p>La biologie préventive ou biologie fonctionnelle apporte une vision systémique et dynamique du vivant. Le corps humain peut être vu comme un ensemble de sous-systèmes. Avant la lésion d’un organe, il y a la lésion du tissu, précédée de la lésion cellulaire et de la lésion moléculaire.</p> 
        <p>C’est à l’échelle moléculaire que l’on peut prévenir la maladie et améliorer le capital santé d’un patient.</p>
        <p>La biologie fonctionnelle permet aujourd’hui une mesure complète et objective de l’état de fonctionnement des systèmes métaboliques et endocriniens et de leurs interactions pour prévenir la maladie et optimiser le capital santé des patients.</p>
        <p>Les champs d’applications et motivations pour la réalisation d’un bilan de biologie fonctionnelle sont :
          <ul>
                <li>La prévention pure</li>
                <li>L’optimisation des performances</li>
                <li>Le traitement d’inconforts (douleurs articulaires, digestion…) sans origine connue</li>
                <li>L’accompagnement en complément d’une prise en charge médicale pour des pathologies déjà avérées</li>
           </ul>",
        "details" => "<h2>info...</h2>",
    ],
    "femme-enceinte" => [
        "title" => "Biologie de la femme enceinte",
        "description" => "<h2>Informations sur la biologie de la femme enceinte.</h2>
        <p>La biologie de la femme enceinte concerne les analyses et les examens spécifiques réalisés pendant la grossesse pour surveiller la santé de la mère et du fœtus. Ces examens sont essentiels pour détecter d'éventuelles complications précoces et assurer un suivi adapté à chaque stade de la grossesse.</p>",
        "details" => "<h2>Analyses et examens spécifiques</h2>
        <p>Pendant la grossesse, plusieurs prélèvements sanguins et urinaires sont réalisés pour surveiller différents paramètres :</p>
        <ul>
            <li>Le dosage des hormones (comme l'hormone chorionique gonadotrope) pour confirmer la grossesse et évaluer son bon déroulement.</li>
            <li>La numération formule sanguine pour détecter d'éventuelles anomalies comme l'anémie.</li>
            <li>Le dépistage des infections transmissibles à l'enfant, telles que la toxoplasmose ou la rubéole.</li>
            <li>Le suivi de la glycémie pour dépister un diabète gestationnel.</li>
            <li>Le dosage des protéines urinaires pour détecter une éventuelle prééclampsie.</li>
        </ul>",
    ],
    "routine" => [
        "title" => "Biologie de routine",
        "description" => "La biologie de routine comprend un ensemble d'analyses médicales standard utilisées pour évaluer l'état de santé général d'un individu.",
        "details" => "<h2>Analyses courantes en biologie de routine</h2>
        <p>Les analyses réalisées dans le cadre de la biologie de routine incluent généralement :</p>
        <ul>
    <li>La numération formule sanguine (NFS) pour évaluer les cellules sanguines.</li>
            <li>La glycémie pour mesurer le taux de sucre dans le sang.</li>
            <li>La fonction rénale et hépatique pour évaluer le fonctionnement des reins et du foie.</li>
            <li>Le dosage des lipides sanguins (cholestérol, triglycérides) pour évaluer le risque cardiovasculaire.</li>
            <li>Le dosage des marqueurs inflammatoires pour détecter une inflammation.</li>
            <li>Le dosage des enzymes cardiaques en cas de suspicion d'infarctus du myocarde.</li>
            <li>Le dosage des hormones thyroïdiennes pour évaluer la fonction thyroïdienne.</li>
        </ul>",
    ],
    "cancerologie" => [
        "title" => "Cancérologie",
        "description" => "<h2>Informations sur la cancérologie.</h2>
        <p>La cancérologie est la branche de la médecine qui étudie et traite le cancer. Elle englobe le diagnostic, le traitement et le suivi des patients atteints de cancer.</p>",
        "details" => "<h2>Examens et traitements en cancérologie</h2>
        <p>Les examens utilisés en cancérologie incluent :</p>
        <ul>
            <li>La biopsie pour prélever un échantillon de tissu à analyser en laboratoire.</li>
            <li>L'imagerie médicale (scanner, IRM, PET-scan) pour visualiser les tumeurs et évaluer leur extension.</li>
            <li>Les analyses sanguines pour détecter des marqueurs spécifiques du cancer.</li>
        </ul>
        <p>Les traitements en cancérologie comprennent :</p>
        <ul>
            <li>La chirurgie pour retirer les tumeurs.</li>
            <li>La radiothérapie pour détruire les cellules cancéreuses.</li>
            <li>La chimiothérapie pour traiter le cancer par des médicaments.</li>
            <li>L'immunothérapie pour renforcer le système immunitaire contre le cancer.</li>
        </ul>",
    ],
    "gynécologie" => [
        "title" => "Gynécologie",
        "description" => "<h2>Informations sur la gynécologie.</h2>
        <p>La gynécologie est la spécialité médicale qui s'occupe de la santé de l'appareil génital féminin. Elle englobe le suivi gynécologique, la prévention et le traitement des pathologies gynécologiques, ainsi que le suivi de la grossesse et de l'accouchement.</p>",
        "details" => "<h2>Consultation gynécologique</h2>
        <p>La consultation gynécologique comprend généralement :</p>
        <ul>
            <li>Un entretien pour recueillir les antécédents médicaux et les symptômes.</li>
            <li>Un examen clinique pour évaluer l'état de santé des organes génitaux.</li>
            <li>Des examens complémentaires comme une échographie pelvienne ou un frottis cervico-vaginal.</li>
        </ul>
        <p>Les pathologies gynécologiques courantes incluent :</p>
        <ul>
            <li>Les infections vaginales comme la candidose ou la vaginose bactérienne.</li>
            <li>Les troubles menstruels comme les règles abondantes ou douloureuses.</li>
            <li>Les pathologies du col de l'utérus comme les lésions précancéreuses.</li>
            <li>Les pathologies mammaires comme les kystes ou les tumeurs.</li>
        </ul>",
    ],
];

$serviceKey = $_GET['service'];
$service = $services[$serviceKey] ?? null;

if (!$service) {
    echo "Service non trouvé.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $service['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<body class="d-flex">

<div class="container" id="wrapper">
    <div class="bg-info bg-gradient bg-success" style="--bs-bg-opacity: .3" id="header">
        <h1 class = "text-center">Medicare: Services médicaux</h1>
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
                                    <li><a class="dropdown-item" href="#">Médecins Spécialistes</a></li>
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

<div class="container">
    <h1><?php echo $service['title']; ?></h1>
    <p><?php echo $service['description']; ?></p>
    <h2>Détails</h2>
    <p><?php echo $service['details']; ?></p>

    <h2>Calendrier des créneaux disponibles</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Date</th>
            <th>Heure</th>
            <th>Réserver</th>
        </tr>
        </thead>
        <tbody>
        <!-- Exemple de créneaux -->
        <tr>
            <td>2024-06-01</td>
            <td>09:00 - 09:30</td>
            <td><button class="btn btn-primary">Réserver</button></td>
        </tr>
        <tr>
            <td>2024-06-01</td>
            <td>10:00 - 10:30</td>
            <td><button class="btn btn-primary">Réserver</button></td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
