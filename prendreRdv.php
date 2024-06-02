<?php
session_start();

// Connexion à la base de données
$database = "Projet-piscine";
$db_handle = mysqli_connect('localhost', 'root', '', $database);

if (!$db_handle) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}

// Variables d'erreur et de succès
$error_message = "";
$success_message = "";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_email'])) {
    header("Location: connexion.php");
    exit();
}

// Traitement de la déconnexion
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: connexion.php");
    exit();
}

// Vérification de la session
$user_id = $_SESSION['user_id'];
echo "<p>DEBUG: Utilisateur connecté - ID: " . $user_id . ", Nom: " . $_SESSION['user_nom'] . ", Prénom: " . $_SESSION['user_prenom'] . "</p>";

// Récupérer les coachs disponibles en joignant les tables coachs et utilisateurs
$sql = "SELECT c.id_coach, u.nom, u.prenom 
        FROM coachs c
        JOIN utilisateurs u ON c.id_coach = u.id_utilisateur";
$result = mysqli_query($db_handle, $sql);
$coachs = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $coachs[] = $row;
    }
} else {
    die("Erreur dans la requête SQL : " . mysqli_error($db_handle));
}

// Récupérer les créneaux disponibles pour un coach donné et un jour donné
$selected_coach_id = isset($_GET['coach_id']) ? $_GET['coach_id'] : (isset($_POST['coach_id']) ? $_POST['coach_id'] : '');
$selected_day = isset($_GET['jour']) ? $_GET['jour'] : (isset($_POST['jour']) ? $_POST['jour'] : '');

$creneaux = [];
$reserved_creneaux = [];
if ($selected_coach_id && $selected_day) {
    $sql = "SELECT c.id_creneau, c.heure_debut, c.heure_fin, 
                   (SELECT COUNT(*) FROM rendezvous r WHERE r.id_creneau = c.id_creneau AND r.id_coach = $selected_coach_id) AS is_reserved
            FROM disponibilites_coachs dc
            JOIN creneaux c ON dc.id_creneau = c.id_creneau
            WHERE dc.id_coach = $selected_coach_id AND dc.disponible = 1 AND c.jour_semaine = '$selected_day'
            ORDER BY c.heure_debut";
    $result = mysqli_query($db_handle, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $creneaux[] = $row;
            if ($row['is_reserved'] > 0) {
                $reserved_creneaux[] = $row['id_creneau'];
            }
        }
    } else {
        die("Erreur dans la requête SQL : " . mysqli_error($db_handle));
    }
}

// Traitement de la réservation des créneaux
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reserver'])) {
    $selected_coach_id = $_POST['coach_id'];
    $selected_day = $_POST['jour'];
    $selected_creneaux = explode(',', $_POST['selected_creneaux']);
    $client_id = $_SESSION['user_id'];
    $date_creation = date('Y-m-d H:i:s');

    foreach ($selected_creneaux as $creneau_id) {
        $creneau_id = intval($creneau_id); // Assurez-vous que l'ID du créneau est un entier
        $sql = "INSERT INTO rendezvous (id_client, id_coach, id_creneau, cree_a) VALUES ($client_id, $selected_coach_id, $creneau_id, '$date_creation')";
        echo "<p>DEBUG: $sql</p>"; // Instruction de débogage
        if (!mysqli_query($db_handle, $sql)) {
            $error_message = "Erreur dans l'insertion : " . mysqli_error($db_handle);
            break; // Arrêtez l'insertion si une erreur se produit
        } else {
            $success_message = "Rendez-vous pris avec succès !";
        }
    }

    if ($success_message) {
        header("Location: rdv.php");
        exit();
    }
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
    <title>Prendre un RDV</title>
    <style>
        .grid-creneaux {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
        }
        .creneau {
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
        }
        .creneau.selected {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        .creneau.reserved {
            background-color: #d3d3d3;
            color: #6c757d;
            cursor: not-allowed;
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
            <form class="form-inline my-2 my-lg-0 ml-auto">
                <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search">
                <button class="btn my-2 my-sm-0" type="submit">Rechercher</button>
            </form>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <h2 class="text-center">Prendre un Rendez-Vous</h2>
        <?php if (isset($_SESSION['user_nom']) && isset($_SESSION['user_prenom'])) { ?>
            <div class="mb-4">
                <span>Connecté en tant que <?php echo htmlspecialchars($_SESSION['user_prenom'] . " " . $_SESSION['user_nom']); ?></span>
                <form method="POST" action="prendreRdv.php" class="d-inline">
                    <button type="submit" name="logout" class="btn btn-link">Déconnexion</button>
                </form>
            </div>
        <?php } ?>

        <?php if ($success_message) { ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php } ?>
        <?php if ($error_message) { ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php } ?>

        <form method="GET" action="prendreRdv.php">
            <div class="form-group">
                <label for="coach">Coach :</label>
                <select class="form-control" id="coach" name="coach_id" onchange="this.form.submit()">
                    <option value="">Sélectionner un coach</option>
                    <?php foreach ($coachs as $coach) { ?>
                        <option value="<?php echo $coach['id_coach']; ?>" <?php echo $selected_coach_id == $coach['id_coach'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($coach['prenom'] . " " . $coach['nom']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="jour">Jour :</label>
                <select class="form-control" id="jour" name="jour" onchange="this.form.submit()">
                    <option value="">Sélectionner un jour</option>
                    <?php
                    $jours = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
                    foreach ($jours as $jour) {
                        echo "<option value=\"$jour\" " . ($selected_day == $jour ? 'selected' : '') . ">$jour</option>";
                    }
                    ?>
                </select>
            </div>
        </form>

        <?php if (!empty($creneaux)) { ?>
            <form method="POST" action="prendreRdv.php">
                <input type="hidden" name="coach_id" value="<?php echo $selected_coach_id; ?>">
                <input type="hidden" name="jour" value="<?php echo $selected_day; ?>">
                <div class="grid-creneaux">
                    <?php foreach ($creneaux as $creneau) { ?>
                        <div class="creneau <?php echo in_array($creneau['id_creneau'], $reserved_creneaux) ? 'reserved' : ''; ?>" data-id-creneau="<?php echo $creneau['id_creneau']; ?>" data-heure-debut="<?php echo $creneau['heure_debut']; ?>">
                            <?php echo htmlspecialchars($creneau['heure_debut']) . " - " . htmlspecialchars($creneau['heure_fin']); ?>
                        </div>
                    <?php } ?>
                </div>
                <input type="hidden" id="selectedCreneaux" name="selected_creneaux" value="">
                <button type="submit" name="reserver" class="btn btn-primary mt-3">Prendre RDV</button>
            </form>
        <?php } else if ($selected_day) { ?>
            <p>Aucun créneau disponible pour ce jour.</p>
        <?php } ?>
    </div>

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
    <script>
        $(document).ready(function() {
            $('.creneau').on('click', function() {
                if ($(this).hasClass('reserved')) {
                    return;
                }

                $('.creneau').removeClass('selected');
                $(this).addClass('selected');
                const creneauId = $(this).data('id-creneau');
                $('#selectedCreneaux').val(creneauId);
            });
        });
    </script>
</body>

</html>
