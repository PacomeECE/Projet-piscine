<?php
// Connexion à la base de données
$database = "Projet-piscine";
$db_handle = mysqli_connect('localhost', 'root', '', $database);

if (!$db_handle) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}

// Récupérer les créneaux disponibles pour le coach Nathalie Céleri (id_coach = 18)
$sql = "SELECT c.jour_semaine, c.heure_debut, c.heure_fin
        FROM disponibilites_coachs dc
        JOIN creneaux c ON dc.id_creneau = c.id_creneau
        WHERE dc.id_coach = 18 AND dc.disponible = 1
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

function regrouperCreneaux($creneauxJour) {
    $regroupes = [];
    $debut = null;
    $fin = null;
    foreach ($creneauxJour as $creneau) {
        if ($debut === null) {
            $debut = $creneau['heure_debut'];
            $fin = $creneau['heure_fin'];
        } elseif ($creneau['heure_debut'] === $fin) {
            $fin = $creneau['heure_fin'];
        } else {
            $regroupes[] = ['heure_debut' => $debut, 'heure_fin' => $fin];
            $debut = $creneau['heure_debut'];
            $fin = $creneau['heure_fin'];
        }
    }
    if ($debut !== null) {
        $regroupes[] = ['heure_debut' => $debut, 'heure_fin' => $fin];
    }
    return $regroupes;
}
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
    <title>SPORTIFY - Nutrition</title>
    <style>
        .availability-table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        .availability-table th, .availability-table td {
            border: 1px solid #ddd;
            padding: 8px;
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
        }

        .availability-table td.unavailable {
            background-color: #96bbfe;
        }

        .badge {
            background-color: #96bbfe;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 5px;
        }

        .coach-profile {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
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
            text-align: left;
        }

        .creneau-list {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f8f9fa;
        }

        .creneau-list .badge {
            background-color: #007bff;
            color: white;
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
                    <a class="nav-link" href="compte.php">Compte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="toutParcourir.html">Tout Parcourir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rdv.php">Rendez-Vous</a>
                </li>
            </ul>
            <div class="search-container form-inline my-2 my-lg-0 ml-auto">
                <input type="search" id="search-input" placeholder="Taper pour Rechercher" class="form-control mr-sm-2">
                <button id="search-button" class="btn my-2 my-sm-0" type="button">Rechercher</button>
            </div>
        </div>
    </nav>

    <main class="container mt-5 pt-5">
        <div class="coach-profile mt-5">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Nutrition</h1>
                </div>
                <div class="card-body">
                    <div class="coach-info">
                    <h3>Nathalie Céleri - Coach, Nutrition</h3>
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="images/nat.png" alt="Nathalie Céleri" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <p><strong>Salle:</strong> Em210</p>
                                <p><strong>Téléphone:</strong> 07 46 91 73 29</p>
                                <p><strong>Email:</strong> <a href="mailto:nat.celeri@edu.ece.fr">nat.celeri@edu.ece.fr</a></p>
                                <p><strong>CV:</strong> Formation: Diplôme en diététique et nutrition. Expériences: Diététicienne depuis 10 ans. Autres: Spécialisée en nutrition sportive et gestion de poids.</p>
                            </div>
                        </div>

                        <!-- Tableau des disponibilités -->
                        <table class="availability-table mt-4">
                            <thead>
                                <tr>
                                    <th>Jour</th>
                                    <th>Disponibilité</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($error_message)) {
                                    echo "<tr><td colspan='2'>" . htmlspecialchars($error_message) . "</td></tr>";
                                } else {
                                    $jours = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
                                    foreach ($jours as $jour) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($jour) . "</td>";
                                        echo "<td>";
                                        if (isset($creneaux[$jour])) {
                                            $creneaux_regroupes = regrouperCreneaux($creneaux[$jour]);
                                            foreach ($creneaux_regroupes as $creneau) {
                                                echo "<div class='badge'>" . htmlspecialchars($creneau['heure_debut']) . " - " . htmlspecialchars($creneau['heure_fin']) . "</div> ";
                                            }
                                        } else {
                                            echo "<div class='badge unavailable'>Aucun créneau disponible</div>";
                                        }
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                        <div class="buttons mt-3 text-center">
                            <a href="prendreRdv.php" class="btn btn-success mr-2">Prendre un RDV</a>
                        </div>
                        <form id="form-email" action="mailto:nat.celeri@edu.ece.fr" method="post" enctype="text/plain">
                        <div class="form-group">
                            <div class="label-container">
                                <label for="message">Contacter le Coach :</label>
                                </div>
                            <textarea id="Demande du client" class="form-control" rows="5" required placeholder="Écrivez votre message ici." name="Demande du client"></textarea></div>
                                <button type="submit" class="btn btn-info">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="chatbox"> 
        <div id="chatlogs">
            <div class="message">
                <span class="sender">Coach virtuel:</span>
                <span class="text">Bonjour! Comment puis-je vous aider aujourd'hui?</span>
            </div>
        </div>
        <div id="chatbuttons">
            <button class="reponse-btn" onclick="addMessage('Prenez-vous des débutants ?')">Prenez-vous des débutants ?</button>
            <button class="reponse-btn" onclick="addMessage('Quels sont vos tarifs?')">Quels sont vos tarifs ?</button>
            <button class="reponse-btn" onclick="addMessage('Pouvez-vous me parler de vos services?')">Pouvez-vous me parler de vos services ?</button>
        </div>
    </div>

    <footer class="footer text-center py-4">
        <div class="container">
            <p>Contactez-nous :</p>
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="https://www.facebook.com/sportify" class="btn-social btn-outline">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="https://www.twitter.com/sportify" class="btn-social btn-outline">
                        <i class="fab fa-twitter"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="https://www.instagram.com/sportify" class="btn-social btn-outline">
                        <i class="fab fa-instagram"></i>
                    </a>
                </li>
            </ul>
            <p>&copy; 2024 SPORTIFY. Tous droits réservés.</p>
        </div>
    </footer>
    <script src="recherche.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script></body>
</html>
