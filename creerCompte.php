<?php
// Connexion à la base de données
$database = "Projet-piscine";
$db_handle = mysqli_connect('localhost', 'root', ''); 

if (!$db_handle) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}

$db_found = mysqli_select_db($db_handle, $database);

if (!$db_found) {
    die("Base de données introuvable.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = mysqli_real_escape_string($db_handle, $_POST['nom']);
    $prenom = mysqli_real_escape_string($db_handle, $_POST['prenom']);
    $adresse1 = mysqli_real_escape_string($db_handle, $_POST['adresse1']);
    $adresse2 = mysqli_real_escape_string($db_handle, $_POST['adresse2']);
    $ville = mysqli_real_escape_string($db_handle, $_POST['ville']);
    $codePostal = mysqli_real_escape_string($db_handle, $_POST['codePostal']);
    $pays = mysqli_real_escape_string($db_handle, $_POST['pays']);
    $telephone = mysqli_real_escape_string($db_handle, $_POST['telephone']);
    $email = mysqli_real_escape_string($db_handle, $_POST['email']);
    $carteEtudiant = mysqli_real_escape_string($db_handle, $_POST['carteEtudiant']);
    $password = mysqli_real_escape_string($db_handle, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($db_handle, $_POST['confirmPassword']);
    $numeroCarte = mysqli_real_escape_string($db_handle, $_POST['numeroCarte']);
    $nomProprietaire = mysqli_real_escape_string($db_handle, $_POST['nomProprietaire']);
    $dateExpiration = mysqli_real_escape_string($db_handle, $_POST['dateExpiration']);
    $cvv = mysqli_real_escape_string($db_handle, $_POST['cvv']);
    $typeCarte = mysqli_real_escape_string($db_handle, $_POST['typeCarte']);

    // Validation des données côté serveur
    if (empty($nom) || empty($prenom) || empty($adresse1) || empty($ville) || empty($codePostal) || empty($pays) || empty($telephone) || empty($email) || empty($carteEtudiant) || empty($password) || empty($confirmPassword) || empty($numeroCarte) || empty($nomProprietaire) || empty($dateExpiration) || empty($cvv) || empty($typeCarte)) {
        echo "<script>alert('Veuillez remplir tous les champs obligatoires.'); window.location.href = 'creerCompte.html';</script>";
        exit;
    }

    if ($password !== $confirmPassword) {
        echo "<script>alert('Les mots de passe ne correspondent pas.'); window.location.href = 'creerCompte.html';</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Adresse email invalide.'); window.location.href = 'creerCompte.html';</script>";
        exit;
    }

    if (!preg_match("/^[0-9]{16}$/", $numeroCarte)) {
        echo "<script>alert('Numéro de carte invalide.'); window.location.href = 'creerCompte.html';</script>";
        exit;
    }

    if (!preg_match("/^[0-9]{3,4}$/", $cvv)) {
        echo "<script>alert('CVV invalide.'); window.location.href = 'creerCompte.html';</script>";
        exit;
    }

    if (!preg_match("/^(0[1-9]|1[0-2])\/?([0-9]{2})$/", $dateExpiration)) {
        echo "<script>alert('Date d\'expiration invalide. Utilisez le format MM/AA.'); window.location.href = 'creerCompte.html';</script>";
        exit;
    }

    // Hachage du mot de passe
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    // Insertion des données dans la base de données
    $sql = "INSERT INTO utilisateurs (prenom, nom, email, mot_de_passe, adresse_ligne1, adresse_ligne2, ville, code_postal, pays, telephone, carte_etudiant, role_utilisateur, numero_carte, nom_proprietaire, date_expiration, cvv, type_carte) 
            VALUES ('$prenom', '$nom', '$email', '$passwordHashed', '$adresse1', '$adresse2', '$ville', '$codePostal', '$pays', '$telephone', '$carteEtudiant', 'client', '$numeroCarte', '$nomProprietaire', '$dateExpiration', '$cvv', '$typeCarte')";

    if (mysqli_query($db_handle, $sql)) {
        echo "<script>alert('Compte créé avec succès.'); window.location.href = 'connexion.html';</script>";
    } else {
        echo "Erreur : " . $sql . "<br>" . mysqli_error($db_handle);
    }
}

mysqli_close($db_handle);
?>
