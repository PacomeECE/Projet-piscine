<?php
session_start();

// Connexion à la base de données
$database = "Projet-piscine";
$db_handle = mysqli_connect('localhost', 'root', '', $database);

if (!$db_handle) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_email'])) {
    header("Location: connexion.php?redirect_url=abonnement.php");
    exit();
}

// Récupérer les informations de l'utilisateur
$user_id = $_SESSION['user_id'];
$user_nom = $_SESSION['user_nom'];
$user_prenom = $_SESSION['user_prenom'];
$user_email = $_SESSION['user_email'];

// Récupérer les informations de paiement de l'utilisateur
$sql = "SELECT numero_carte, nom_proprietaire, date_expiration, cvv, type_carte FROM utilisateurs WHERE id_utilisateur = $user_id";
$result = mysqli_query($db_handle, $sql);
if ($result) {
    $user_payment_info = mysqli_fetch_assoc($result);
} else {
    die("Erreur dans la requête SQL : " . mysqli_error($db_handle));
}

// Traitement de l'abonnement
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['valider_paiement'])) {
    $montant = $_POST['montant'];
    $date_paiement = date('Y-m-d H:i:s');
    $nom_abonnement = "Abonnement";

    // Insérer dans la table paiements
    $sql = "INSERT INTO paiements (id_client, montant, date_paiement, nom) VALUES ($user_id, $montant, '$date_paiement', '$nom_abonnement')";
    if (mysqli_query($db_handle, $sql)) {
        header("Location: compte.php");
        exit();
    } else {
        $error_message = "Erreur lors de l'abonnement : " . mysqli_error($db_handle);
    }
}

mysqli_close($db_handle);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="sports.css">
    <title>Abonnement</title>
    <style>
        #loadingSpinner {
            display: none;
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
                    <a class="nav-link" href="connexion.php">Compte</a>
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
        <div class="mb-4">
            <span>Connecté en tant que <?php echo htmlspecialchars($user_prenom . " " . $user_nom); ?></span>
            <form method="POST" action="connexion.php" class="d-inline">
                <button type="submit" name="logout" class="btn btn-link">Déconnexion</button>
            </form>
        </div>
        <h2 class="text-center">Choisissez votre abonnement</h2>
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php } ?>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Abonnement Mensuel</h5>
                        <p class="card-text">Prix: 30€ / mois</p>
                        <button class="btn btn-primary" onclick="showPaymentInfo(30.00, 'Abonnement Mensuel')">Souscrire</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Abonnement Trimestriel</h5>
                        <p class="card-text">Prix: 80€ / 3 mois</p>
                        <button class="btn btn-primary" onclick="showPaymentInfo(80.00, 'Abonnement Trimestriel')">Souscrire</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Abonnement Annuel</h5>
                        <p class="card-text">Prix: 300€ / an</p>
                        <button class="btn btn-primary" onclick="showPaymentInfo(300.00, 'Abonnement Annuel')">Souscrire</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="paymentInfo" class="mt-5" style="display: none;">
            <h3>Informations de paiement</h3>
            <p><strong>Numéro de carte:</strong> <?php echo htmlspecialchars($user_payment_info['numero_carte']); ?></p>
            <p><strong>Nom du propriétaire:</strong> <?php echo htmlspecialchars($user_payment_info['nom_proprietaire']); ?></p>
            <p><strong>Date d'expiration:</strong> <?php echo htmlspecialchars($user_payment_info['date_expiration']); ?></p>
            <p><strong>CVV:</strong> <?php echo htmlspecialchars($user_payment_info['cvv']); ?></p>
            <p><strong>Type de carte:</strong> <?php echo htmlspecialchars($user_payment_info['type_carte']); ?></p>
            <form id="paymentForm" method="POST" action="abonnement.php">
                <input type="hidden" id="montant" name="montant">
                <button type="submit" name="valider_paiement" class="btn btn-success" onclick="showLoadingSpinner()">Valider le paiement</button>
            </form>
        </div>

        <div id="loadingSpinner" class="text-center mt-3">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Chargement...</span>
            </div>
            <p>Traitement du paiement, veuillez patienter...</p>
        </div>
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
        function showPaymentInfo(montant, abonnement) {
            document.getElementById('montant').value = montant;
            document.getElementById('paymentInfo').style.display = 'block';
        }

        function showLoadingSpinner() {
            document.getElementById('loadingSpinner').style.display = 'block';
        }
    </script>
</body>

</html>
