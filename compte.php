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

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_email'])) {
    header("Location: connexion.php");
    exit();
}

// Récupérer les informations de l'utilisateur
$user_id = $_SESSION['user_id'];
$user_nom = $_SESSION['user_nom'];
$user_prenom = $_SESSION['user_prenom'];
$user_email = $_SESSION['user_email'];
$role = $_SESSION['role_utilisateur'];
$carte_etudiante = $_SESSION['carte_etudiante'];

// Définir les variables pour les informations supplémentaires
$adresse_ligne1 = "";
$adresse_ligne2 = "";
$ville = "";
$code_postal = "";
$pays = "";
$telephone = "";
$numero_carte = "";
$nom_proprietaire = "";
$date_expiration = "";
$cvv = "";
$type_carte = "";

// Récupérer les informations supplémentaires de la table utilisateurs
$sql = "SELECT * FROM utilisateurs WHERE id_utilisateur = $user_id";
$result = mysqli_query($db_handle, $sql);
if ($result) {
    $user = mysqli_fetch_assoc($result);
    $adresse_ligne1 = $user['adresse_ligne1'];
    $adresse_ligne2 = $user['adresse_ligne2'];
    $ville = $user['ville'];
    $code_postal = $user['code_postal'];
    $pays = $user['pays'];
    $telephone = $user['telephone'];
    $numero_carte = $user['numero_carte'];
    $nom_proprietaire = $user['nom_proprietaire'];
    $date_expiration = $user['date_expiration'];
    $cvv = $user['cvv'];
    $type_carte = $user['type_carte'];
}

// Récupérer l'historique des paiements pour le client
$historique_paiements = [];
$abonnement = false;
if ($role == 'client') {
    $sql_paiements = "SELECT * FROM paiements WHERE id_client = $user_id ORDER BY date_paiement DESC";
    $result_paiements = mysqli_query($db_handle, $sql_paiements);
    if ($result_paiements) {
        while ($row = mysqli_fetch_assoc($result_paiements)) {
            $historique_paiements[] = $row;
            if ($row['nom'] == 'Abonnement') {
                $abonnement = true;
            }
        }
    }
}

// Traitement de l'ajout de coach
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_coach'])) {
    $coach_nom = $_POST['nom'];
    $coach_prenom = $_POST['prenom'];
    $coach_specialite = $_POST['specialite'];
    $coach_email = $_POST['email'];
    $coach_mot_de_passe = $_POST['mot_de_passe'];
    $coach_cv = $_POST['cv'];
    $coach_photo_url = $_POST['photo_url'];
    $coach_video_url = $_POST['video_url'];
    $adresse_ligne1 = $_POST['adresse_ligne1'];
    $adresse_ligne2 = $_POST['adresse_ligne2'];
    $ville = $_POST['ville'];
    $code_postal = $_POST['code_postal'];
    $pays = $_POST['pays'];
    $telephone = $_POST['telephone'];

    // Insérer dans la table utilisateurs
    $sql_user = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role_utilisateur, adresse_ligne1, adresse_ligne2, ville, code_postal, pays, telephone) 
                 VALUES ('$coach_nom', '$coach_prenom', '$coach_email', '$coach_mot_de_passe', 'coach', '$adresse_ligne1', '$adresse_ligne2', '$ville', '$code_postal', '$pays', '$telephone')";

    if (mysqli_query($db_handle, $sql_user)) {
        $coach_id = mysqli_insert_id($db_handle); // Récupérer l'ID utilisateur du nouveau coach

        // Insérer dans la table coachs
        $sql_coach = "INSERT INTO coachs (id_utilisateur, specialite, photo_url, video_url, cv) 
                      VALUES ($coach_id, '$coach_specialite', '$coach_photo_url', '$coach_video_url', '$coach_cv')";

        if (!mysqli_query($db_handle, $sql_coach)) {
            $error_message = "Erreur dans l'ajout de coach (table coachs) : " . mysqli_error($db_handle);
        }
    } else {
        $error_message = "Erreur dans l'ajout de coach (table utilisateurs) : " . mysqli_error($db_handle);
    }
}

// Traitement de la suppression de coach
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_coach'])) {
    $coach_id = $_POST['coach_id'];
    $sql = "DELETE FROM utilisateurs WHERE id_utilisateur = $coach_id AND role_utilisateur = 'coach'";
    if (!mysqli_query($db_handle, $sql)) {
        $error_message = "Erreur dans la suppression de coach : " . mysqli_error($db_handle);
    }
}

// Récupérer les informations spécifiques à l'admin
if ($role == 'admin') {
    $sql_admin = "SELECT * FROM utilisateurs WHERE role_utilisateur = 'coach'";
    $result_admin = mysqli_query($db_handle, $sql_admin);
    $coachs = [];
    while ($row = mysqli_fetch_assoc($result_admin)) {
        $coachs[] = $row;
    }
} elseif ($role == 'coach') {
    // Récupérer les rendez-vous du coach
    $sql_coach = "SELECT r.id_rdv, c.nom AS client_nom, c.prenom AS client_prenom, cr.jour_semaine, cr.heure_debut, cr.heure_fin 
                  FROM rendezvous r 
                  JOIN utilisateurs c ON r.id_client = c.id_utilisateur 
                  JOIN creneaux cr ON r.id_creneau = cr.id_creneau 
                  WHERE r.id_coach = $user_id";
    $result_coach = mysqli_query($db_handle, $sql_coach);
    $rendezvous_coach = [];
    while ($row = mysqli_fetch_assoc($result_coach)) {
        $rendezvous_coach[] = $row;
    }
} elseif ($role == 'client') {
    // Récupérer les rendez-vous du client
    $sql_client = "SELECT r.id_rdv, u.nom AS coach_nom, u.prenom AS coach_prenom, cr.jour_semaine, cr.heure_debut, cr.heure_fin 
                   FROM rendezvous r 
                   JOIN coachs co ON r.id_coach = co.id_coach 
                   JOIN utilisateurs u ON co.id_utilisateur = u.id_utilisateur 
                   JOIN creneaux cr ON r.id_creneau = cr.id_creneau 
                   WHERE r.id_client = $user_id";
    $result_client = mysqli_query($db_handle, $sql_client);
    $rendezvous_client = [];
    while ($row = mysqli_fetch_assoc($result_client)) {
        $rendezvous_client[] = $row;
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
    <title>Votre Compte</title>
    <style>
        .hidden-form {
            display: none;
        }

        .info-discrete {
            color: black;
            font-size: 0.9em;
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
        <div class="mb-4">
            <span>Connecté en tant que <?php echo htmlspecialchars($user_prenom . " " . $user_nom); ?></span>
            <form method="POST" action="connexion.php" class="d-inline">
                <button type="submit" name="logout" class="btn btn-link">Déconnexion</button>
            </form>
        </div>

        <?php if ($role == 'admin') { ?>
            <h3>Informations de l'administrateur</h3>
            <p><strong>Nom:</strong> <?php echo htmlspecialchars($user_nom); ?></p>
            <p><strong>Prénom:</strong> <?php echo htmlspecialchars($user_prenom); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user_email); ?></p>

            <h4>Liste des coachs</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($coachs as $coach) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($coach['id_utilisateur']); ?></td>
                            <td><?php echo htmlspecialchars($coach['nom']); ?></td>
                            <td><?php echo htmlspecialchars($coach['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($coach['email']); ?></td>
                            <td>
                                <form method="POST" action="compte.php" class="d-inline">
                                    <input type="hidden" name="coach_id" value="<?php echo $coach['id_utilisateur']; ?>">
                                    <button type="submit" name="delete_coach" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <h4>Ajouter un coach</h4>
            <?php if (isset($error_message)) { ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
            <?php } ?>
            <button class="btn btn-primary" onclick="document.getElementById('addCoachForm').style.display='block'; this.style.display='none';">Ajouter un coach</button>
            <form id="addCoachForm" method="POST" action="compte.php" class="hidden-form mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom :</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                        </div>
                        <div class="form-group">
                            <label for="specialite">Spécialité :</label>
                            <input type="text" class="form-control" id="specialite" name="specialite" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="mot_de_passe">Mot de passe :</label>
                            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cv">CV :</label>
                            <textarea class="form-control" id="cv" name="cv" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="photo_url">URL de la photo :</label>
                            <input type="text" class="form-control" id="photo_url" name="photo_url" required>
                        </div>
                        <div class="form-group">
                            <label for="video_url">URL de la vidéo :</label>
                            <input type="text" class="form-control" id="video_url" name="video_url" required>
                        </div>
                        <div class="form-group">
                            <label for="adresse_ligne1">Adresse Ligne 1 :</label>
                            <input type="text" class="form-control" id="adresse_ligne1" name="adresse_ligne1" required>
                        </div>
                        <div class="form-group">
                            <label for="adresse_ligne2">Adresse Ligne 2 :</label>
                            <input type="text" class="form-control" id="adresse_ligne2">
                        </div>
                        <div class="form-group">
                            <label for="ville">Ville :</label>
                            <input type="text" class="form-control" id="ville" name="ville" required>
                        </div>
                        <div class="form-group">
                            <label for="code_postal">Code Postal :</label>
                            <input type="text" class="form-control" id="code_postal" name="code_postal" required>
                        </div>
                        <div class="form-group">
                            <label for="pays">Pays :</label>
                            <input type="text" class="form-control" id="pays" name="pays" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Téléphone :</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="add_coach" class="btn btn-primary">Ajouter</button>
            </form>

        <?php } elseif ($role == 'coach') { ?>
            <h3>Informations du coach</h3>
            <p><strong>Nom:</strong> <?php echo htmlspecialchars($user_nom); ?></p>
            <p><strong>Prénom:</strong> <?php echo htmlspecialchars($user_prenom); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user_email); ?></p>

            <h4>Vos rendez-vous</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Jour</th>
                        <th>Heure Début</th>
                        <th>Heure Fin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rendezvous_coach as $rdv) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($rdv['client_prenom'] . " " . $rdv['client_nom']); ?></td>
                            <td><?php echo htmlspecialchars($rdv['jour_semaine']); ?></td>
                            <td><?php echo htmlspecialchars($rdv['heure_debut']); ?></td>
                            <td><?php echo htmlspecialchars($rdv['heure_fin']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        <?php } elseif ($role == 'client') { ?>
            <h3>Informations du client</h3>
            <p><strong>Nom:</strong> <?php echo htmlspecialchars($user_nom); ?></p>
            <p><strong>Prénom:</strong> <?php echo htmlspecialchars($user_prenom); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user_email); ?></p>
            <p><strong>Adresse:</strong> <?php echo htmlspecialchars($adresse_ligne1 . ' ' . $adresse_ligne2 . ', ' . $ville . ', ' . $code_postal . ', ' . $pays); ?></p>
            <p><strong>Carte Étudiante:</strong> <?php echo htmlspecialchars($carte_etudiante); ?></p>

            <h4>Vos rendez-vous</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Coach</th>
                        <th>Jour</th>
                        <th>Heure Début</th>
                        <th>Heure Fin</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rendezvous_client as $rdv) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($rdv['coach_prenom'] . " " . $rdv['coach_nom']); ?></td>
                            <td><?php echo htmlspecialchars($rdv['jour_semaine']); ?></td>
                            <td><?php echo htmlspecialchars($rdv['heure_debut']); ?></td>
                            <td><?php echo htmlspecialchars($rdv['heure_fin']); ?></td>
                            <td>
                                <form method="POST" action="rdv.php">
                                    <input type="hidden" name="rdv_id" value="<?php echo $rdv['id_rdv']; ?>">
                                    <button type="submit" name="delete_rdv" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <h4>Informations de paiement</h4>
            <p class="info-discrete"><strong>Numéro de carte:</strong> **** **** **** <?php echo substr($numero_carte, -4); ?></p>
            <p class="info-discrete"><strong>Nom du propriétaire:</strong> <?php echo htmlspecialchars($nom_proprietaire); ?></p>
            <p class="info-discrete"><strong>Date d'expiration:</strong> <?php echo htmlspecialchars($date_expiration); ?></p>
            <p class="info-discrete"><strong>Type de carte:</strong> <?php echo htmlspecialchars($type_carte); ?></p>

            <h4>Historique des paiements</h4>
            <?php if (empty($historique_paiements)) { ?>
                <p>Aucun paiement trouvé.</p>
            <?php } else { ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Montant</th>
                            <th>Date de Paiement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($historique_paiements as $paiement) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($paiement['nom']); ?></td>
                                <td><?php echo htmlspecialchars($paiement['montant']); ?></td>
                                <td><?php echo htmlspecialchars($paiement['date_paiement']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>

            <?php if (!$abonnement) { ?>
                <p>Vous n'avez pas encore souscrit à un abonnement.</p>
                <a href="abonnement.php" class="btn btn-primary">Souscrire à un abonnement</a>
            <?php } ?>

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
    <script src="recherche.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
