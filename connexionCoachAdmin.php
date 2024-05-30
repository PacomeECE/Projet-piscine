<?php
session_start();

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
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    // Échapper les chaînes pour éviter les injections SQL
    $email = mysqli_real_escape_string($db_handle, $email);
    $password = mysqli_real_escape_string($db_handle, $password);

    $sql = "SELECT * FROM utilisateurs WHERE email = '$email' AND mot_de_passe = '$password'";
    $result = mysqli_query($db_handle, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $_SESSION['id_utilisateur'] = $row['id_utilisateur'];
            $_SESSION['prenom'] = $row['prenom'];
            $_SESSION['nom'] = $row['nom'];
            $_SESSION['role_utilisateur'] = $row['role_utilisateur'];

            if ($row['role_utilisateur'] == 'admin') {
                header("Location: adminDashboard.php");
            } else if ($row['role_utilisateur'] == 'coach') {
                header("Location: coachDashboard.php");
            }
            exit;
        } else {
            echo "<script>alert('La connexion a échoué. Veuillez vérifier votre email et mot de passe.'); window.location.href = 'connexionAdmin.html';</script>";
        }
    } else {
        echo "Erreur dans la requête SQL : " . mysqli_error($db_handle);
    }
}

mysqli_close($db_handle);
?>
