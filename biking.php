<?php
// Connexion à la base de données
$database = "Projet-piscine";
$db_handle = mysqli_connect('localhost', 'root', '', $database);

if (!$db_handle) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}

// Récupérer les créneaux disponibles pour le coach Sylvain Saroule (id_coach = 3)
$sql = "SELECT c.jour_semaine, c.heure_debut, c.heure_fin
        FROM disponibilites_coachs dc
        JOIN creneaux c ON dc.id_creneau = c.id_creneau
        WHERE dc.id_coach = 3 AND dc.disponible = 1
        ORDER BY c.jour_semaine, c.heure_debut";

$result = mysqli_query($db_handle, $sql);

$creneaux = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $creneaux[$row['jour_semaine']][] = $row;
    }
} else {
    $error_message = "Erreur dans la requête SQL : " . mysqli_error($db_handle);
}

mysqli_close($db_handle);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="images/logo.png" />
    <link rel="stylesheet" href="sports.css" />
    <title>SPORTIFY - Biking</title>
    <style>
        .availability-table {
            margin-top: 20px;
        }

        .availability-table th, .availability-table td {
            vertical-align: middle;
            text-align: center;
        }

        .availability-table th {
            background-color: #007bff;
            color: white;
        }

        .availability-table td {
            background-color: #f8f9fa;
        }

        .availability-table td.available {
            background-color: #d4edda;
            color: black;
        }

        .availability-table td.unavailable {
            background-color: #f8d7da;
        }

        .badge {
            background-color: #d4edda;
            color: black;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 5px;
        }

        .badge.unavailable {
            background-color: #f8d7da;
        }

        .coach-profile {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .coach-info {
            padding: 20px;
        }

        .coach-info img {
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .day-header {
            font-weight: bold;
            font-size: 1.2em;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .creneau-list {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <a class="navbar-brand" href="accueil.html">
            <img src="images/logo.png" height="60" alt="Sportify Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="accueil.html">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="connexion.html">Compte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="toutParcourir.html">Tout Parcourir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rdv.html">Rendez-Vous</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0 ml-auto">
                <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search">
                <button class="btn my-2 my-sm-0" type="submit">Rechercher</button>
            </form>
        </div>
    </nav>

    <main class="container mt-5 pt-5">
        <div class="coach-profile mt-5">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Biking</h1>
                </div>
                <div class="card-body">
                    <div class="coach-info">
                        <h3>Sylvain Saroule - Coach, Biking</h3>
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="images/coach3.jpg" alt="Sylvain Saroule" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <p><strong>Salle:</strong> EM010</p>
                                <p><strong>Téléphone:</strong> 07 46 91 73 24</p>
                                <p><strong>Email:</strong> <a href="mailto:sylvain.saroule@edu.ece.fr">sylvain.saroule@edu.ece.fr</a></p>
                                <p><strong>CV:</strong> Formation: Champion national de vélo d'intérieur. Expériences: Entraîneur de Biking depuis 10 ans. Autres: Spécialisé en préparation physique.</p>
                            </div>
                        </div>

                        <!-- Tableau des disponibilités -->
                        <div class="availability-table mt-4">
                            <?php
                            if (isset($error_message)) {
                                echo "<p>" . htmlspecialchars($error_message) . "</p>";
                            } else {
                                $jours = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
                                foreach ($jours as $jour) {
                                    echo "<div class='day-header'>" . htmlspecialchars($jour) . "</div>";
                                    echo "<div class='creneau-list'>";
                                    if (isset($creneaux[$jour])) {
                                        foreach ($creneaux[$jour] as $creneau) {
                                            echo "<div class='badge'>" . htmlspecialchars($creneau['heure_debut']) . " - " . htmlspecialchars($creneau['heure_fin']) . "</div>";
                                        }
                                    } else {
                                        echo "<div class='badge unavailable'>Aucun créneau disponible</div>";
                                    }
                                    echo "</div>";
                                }
                            }
                            ?>
                        </div>

                        <div class="buttons mt-3 text-center">
                            <button class="btn btn-success mr-2">Prendre un RDV</button>
                            <button class="btn btn-info mr-2">Communiquer avec le coach</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer text-center py-4">
        <div class="container">
            <p>Contactez-nous :</p>
            <p>
                <i class="fas fa-phone" style="margin-right: 10px;"></i>
                <a href="tel:0144876211">01 44 87 62 11</a>
            </p>
            <p>
                <i class="fas fa-map-marker-alt" style="margin-right: 10px;"></i>
                <a href="https://www.google.com/maps/search/?api=1&query=10+Rue+Sextius+Michel,+Paris,+France">10 rue Sextius Michel, Paris, France</a>
            </p>
            <p>
                <i class="fas fa-envelope" style="margin-right: 10px;"></i>
                <a href="mailto:salle.sports@omnessports.fr">salle.sports@omnessports.fr</a>
            </p>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8767.74803941555!2d2.28749683632621!3d48.84760618152228!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b4f58251b%3A0x167f5a60fb94aa76!2sECE%20-%20Ecole%20d&#39;ing%C3%A9nieurs%20-%20Engineering%20school.!5e0!3m2!1sfr!2sfr!4v1685374726975!5m2!1sfr!2sfr"
                width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
