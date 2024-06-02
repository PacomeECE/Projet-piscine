<?php
session_start();

// Connexion à la base de données
$database = "Projet-piscine";
$db_handle = mysqli_connect('localhost', 'root', '', $database);

if (!$db_handle) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}

// Variables d'erreur
$error_message = "";

// Traitement de la connexion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier les informations de connexion
    $sql = "SELECT * FROM utilisateurs WHERE email = '$email' AND mot_de_passe = '$password'";
    $result = mysqli_query($db_handle, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['user_email'] = $email;
            $_SESSION['user_id'] = $user['id_utilisateur'];
            $_SESSION['user_nom'] = $user['nom'];
            $_SESSION['user_prenom'] = $user['prenom'];
            $_SESSION['role_utilisateur'] = $user['role_utilisateur'];
            $_SESSION['carte_etudiante'] = $user['carte_etudiant'];

            // Récupérer les informations de paiement pour le client
            if ($user['role_utilisateur'] == 'client') {
                $sql_paiement = "SELECT numero_carte, nom_proprietaire, date_expiration, type_carte 
                                 FROM utilisateurs WHERE id_utilisateur = " . $user['id_utilisateur'];
                $result_paiement = mysqli_query($db_handle, $sql_paiement);
                if ($result_paiement && mysqli_num_rows($result_paiement) == 1) {
                    $paiement = mysqli_fetch_assoc($result_paiement);
                    $_SESSION['numero_carte'] = $paiement['numero_carte'];
                    $_SESSION['nom_proprietaire'] = $paiement['nom_proprietaire'];
                    $_SESSION['date_expiration'] = $paiement['date_expiration'];
                    $_SESSION['type_carte'] = $paiement['type_carte'];
                }
            }

            // Si l'utilisateur est un coach, récupérer les informations supplémentaires
            if ($user['role_utilisateur'] == 'coach') {
                $sql_coach = "SELECT * FROM coachs WHERE id_utilisateur = " . $user['id_utilisateur'];
                $result_coach = mysqli_query($db_handle, $sql_coach);
                if ($result_coach) {
                    $coach = mysqli_fetch_assoc($result_coach);
                    $_SESSION['coach_specialite'] = $coach['specialite'];
                    $_SESSION['coach_photo_url'] = $coach['photo_url'];
                    $_SESSION['coach_video_url'] = $coach['video_url'];
                    $_SESSION['coach_cv'] = $coach['cv'];
                }
            }

            // Rediriger vers la page de destination si elle est définie, sinon vers la page compte
            $redirect_url = isset($_GET['redirect_url']) ? $_GET['redirect_url'] : 'compte.php';
            header("Location: $redirect_url");
            exit();
        } else {
            $error_message = "Email ou mot de passe incorrect.";
        }
    } else {
        $error_message = "Erreur dans la requête SQL : " . mysqli_error($db_handle);
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
    <title>Connexion</title>
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
        <h2 class="text-center">Connexion</h2>
        <?php if ($error_message) { ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php } ?>
        <form method="POST" action="connexion.php">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Connexion</button>
        </form>
        <p class="text-center mt-3">
            <a href="creerCompte.html">Je n'ai pas encore de compte chez vous. Je souhaite m'en créer un.</a>
        </p>
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
</body>

</html>
