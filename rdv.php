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

// Traitement de la suppression d'un rendez-vous
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_rdv'])) {
    $rdv_id = $_POST['rdv_id'];
    $sql = "DELETE FROM rendezvous WHERE id_rdv = $rdv_id";
    if (mysqli_query($db_handle, $sql)) {
        $success_message = "Rendez-vous supprimé avec succès.";
    } else {
        $error_message = "Erreur lors de la suppression du rendez-vous : " . mysqli_error($db_handle);
    }
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role_utilisateur'];

// Vérifier si l'utilisateur est admin
if ($role = 'admin') {
    header("Location: accueil.html");
    exit();
}

// Requête SQL pour récupérer tous les rendez-vous
$sql = "SELECT r.id_rdv, r.id_client, r.id_coach, r.id_creneau, r.cree_a, 
               u1.nom AS client_nom, u1.prenom AS client_prenom, 
               u2.nom AS coach_nom, u2.prenom AS coach_prenom, 
               c.jour_semaine, c.heure_debut, c.heure_fin
        FROM rendezvous r
        JOIN utilisateurs u1 ON r.id_client = u1.id_utilisateur
        JOIN utilisateurs u2 ON r.id_coach = u2.id_utilisateur
        JOIN creneaux c ON r.id_creneau = c.id_creneau
        ORDER BY r.cree_a DESC";

$result = mysqli_query($db_handle, $sql);
$rendezvous = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rendezvous[] = $row;
    }
} else {
    die("Erreur dans la requête SQL : " . mysqli_error($db_handle));
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
    <title>Gestion des Rendez-Vous</title>
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

    <div class="container mt-5 pt-5">
        <h2 class="text-center">Gestion des Rendez-Vous</h2>
        <?php if (isset($_SESSION['user_nom']) && isset($_SESSION['user_prenom'])) { ?>
            <div class="mb-4">
                <span>Connecté en tant que <?php echo htmlspecialchars($_SESSION['user_prenom'] . " " . $_SESSION['user_nom']); ?></span>
                <form method="POST" action="rdv.php" class="d-inline">
                    <button type="submit" name="logout" class="btn btn-link">Déconnexion</button>
                </form>
            </div>
        <?php } ?>

        <?php if (isset($success_message)) { ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php } ?>
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php } ?>

        <?php if (!empty($rendezvous)) { ?>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Jour</th>
                        <th>Heure Début</th>
                        <th>Heure Fin</th>
                        <th>Client</th>
                        <th>Coach</th>
                        <th>Date de Création</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rendezvous as $rdv) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($rdv['jour_semaine']); ?></td>
                            <td><?php echo htmlspecialchars($rdv['heure_debut']); ?></td>
                            <td><?php echo htmlspecialchars($rdv['heure_fin']); ?></td>
                            <td><?php echo htmlspecialchars($rdv['client_prenom'] . " " . $rdv['client_nom']); ?></td>
                            <td><?php echo htmlspecialchars($rdv['coach_prenom'] . " " . $rdv['coach_nom']); ?></td>
                            <td><?php echo htmlspecialchars($rdv['cree_a']); ?></td>
                            <td>
                                <form method="POST" action="rdv.php" class="d-inline">
                                    <input type="hidden" name="rdv_id" value="<?php echo $rdv['id_rdv']; ?>">
                                    <button type="submit" name="delete_rdv" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Aucun rendez-vous trouvé.</p>
        <?php } ?>
    </div>
    <br><br>
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
