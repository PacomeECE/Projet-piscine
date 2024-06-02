<?php
if (!isset($_GET['id'])) {
    echo "Aucun coach sélectionné.";
    exit;
}

$coachId = $_GET['id'];
$xml = simplexml_load_file('coachs.xml');

$coachFound = false;
foreach ($xml->Coach as $coach) {
    if ((string)$coach->ID === $coachId) {
        $coachFound = true;
        $nom = $coach->Nom;
        $prenom = $coach->Prenom;
        $specialite = $coach->Specialite;
        $photo = $coach->Photo;
        $telephone = $coach->Telephone;
        $email = $coach->Email;
        $formation = $coach->Formation;
        $experience = $coach->Experience;
        $autres = $coach->Autres;
        break;
    }
}

if (!$coachFound) {
    echo "Coach non trouvé.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CV de <?php echo htmlspecialchars($prenom . ' ' . $nom); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .cv-container {
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
            max-width: 600px;
        }
        .cv-container img {
            max-width: 100%;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .cv-container h1 {
            margin-bottom: 20px;
        }
        .cv-container p {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container cv-container">
        <h1>CV de <?php echo htmlspecialchars($prenom . ' ' . $nom); ?></h1>
        <img src="<?php echo htmlspecialchars($photo); ?>" alt="Photo de <?php echo htmlspecialchars($prenom . ' ' . $nom); ?>">
        <p><strong>Spécialité:</strong> <?php echo htmlspecialchars($specialite); ?></p>
        <p><strong>Téléphone:</strong> <?php echo htmlspecialchars($telephone); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <h2>Formation:</h2>
        <p><?php echo htmlspecialchars($formation); ?></p>
        <h2>Expérience:</h2>
        <p><?php echo htmlspecialchars($experience); ?></p>
        <h2>Autres:</h2>
        <p><?php echo htmlspecialchars($autres); ?></p>
        <a href="javascript:history.back()" class="btn btn-primary">Retour</a>
    </div>
</body>
</html>
