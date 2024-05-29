<?php
session_start();
// Inclusion des headers nécessaires au wrapper, au footer et au bon fonctionnement de la page
echo '<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<title>Choix Profil</title>
<link rel="stylesheet" type="text/css" href="toutParcourir.css">
<link rel="stylesheet" href="accueil.css">
</head>';

// Création du wrapper
echo '<body>
<div class="wrapper">
    <div class="search-container">
        <div class="search">
            <input type="search" id="search-input" placeholder="Taper pour Rechercher">
            <i id="search-button" class="fa-solid fa-magnifying-glass"></i>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/c0bfb983cf.js" crossorigin="anonymous"></script>
    <div class="nav-item">
        <a href="accueil.html">
            <img src="SportifyV2.png" height="80px" width="70px" />
        </a>
    </div>
    <div id="nav-latteral" class="nav-latteral">
        <div id="nav-close" class="nav-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="nav-links">
            <a href="accueil.html">
                <div class="nav-link">
                    <ion-icon name="home"></ion-icon>
                    Accueil
                </div>
            </a>
            <a href="connexion.html">
                <div class="nav-link">
                    <ion-icon name="person"></ion-icon>
                    Compte
                </div>
            </a>
            <a href="toutParcourir.html">
                <div class="nav-link">
                    <ion-icon name="book"></ion-icon>
                    Tout Parcourir
                </div>
            </a>
            <a href="rdv.html">
                <div class="nav-link">
                    <ion-icon name="time"></ion-icon>
                    Rendez-Vous
                </div>
            </a>
        </div>
    </div>
    <div id="nav-wrapper"></div>
    <nav>
        <div id="nav-open" class="nav-button">
            <ion-icon name="reorder-three"></ion-icon>
        </div>
    </nav>
    <main>
    <center>';

// Connexion à la BDD coach avec les identifiants ROOT et " "
$database = "coach";
$db_handle = mysqli_connect('localhost', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);

// Vérification si le bouton est cliqué
if (isset($_POST["button1"])) {

    // Récupération de l'ID et du mot de passe depuis POST
    $id = isset($_POST["id"]) ? $_POST["id"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    // Traitement
    if ($db_found) {

        // Recherche du client dans la base de données
        $sql = "SELECT * FROM membreclient WHERE id = '$id' AND password = '$password'";
        $result = mysqli_query($db_handle, $sql);

        if (mysqli_num_rows($result) > 0) { // S'il y a une correspondance dans la base de données
            $row = mysqli_fetch_assoc($result); // Récupération de la première (et unique) ligne de résultat

            // Récupération des données du résultat
            $nom = $row['nom'];
            $prenom = $row['prenom'];
            $tel = $row['telephone'];
            $adresse = $row['adresse'];
            $typeCarte = $row['typeCarte'];
            $numCarte = $row['numCarte'];
            $expCarte = $row['expCarte'];
            $codeSecurite = $row['codeSecurite'];

            // Débogage : Afficher les valeurs des variables
            echo "nom: $nom, prenom: $prenom, id: $id, adresse: $adresse, tel: $tel, typeCarte: $typeCarte, numCarte: $numCarte, expCarte: $expCarte, codeSecurite: $codeSecurite";

            // Redirection vers loginClient.html en passant les données via l'URL
            header("Location: loginClient.html?nom=$nom&prenom=$prenom&id=$id&adresse=$adresse&tel=$tel&typeCarte=$typeCarte&numCarte=$numCarte&expCarte=$expCarte&codeSecurite=$codeSecurite");
            exit;
        } else {
            echo "La connexion a échoué.";
            echo " Il doit y avoir une erreur dans le mot de passe ou l'ID. ";
            echo " Sinon, essayez de créer un nouveau compte.";
        }
    } else {
        echo "<br>Database not found.";
    }
}

// Implémentation du footer
echo '</center><footer class="footer">
<p>Contactez-nous :</p>
<p>
    <ion-icon name="call-outline" style="margin-right: 10px;"></ion-icon>
    <a href="tel:0144876211">01 44 87 62 11</a>
</p>
<p>
    <ion-icon name="storefront-outline" style="margin-right: 10px;"></ion-icon>
    <a href="https://www.google.com/maps/search/?api=1&query=10+Rue+Sextius+Michel,+Paris,+France">10
        rue Sextius Michel, Paris</a>
</p>
<p>
    <ion-icon name="mail-outline" style="margin-right: 10px;"></ion-icon>
    <a href="mailto:salle.sports@omnessports.fr">salle.sports@omnessports.fr</a>
</p>
<br><br>
<iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8767.74803941555!2d2.28749683632621!3d48.84760618152228!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b4f58251b%3A0x167f5a60fb94aa76!2sECE%20-%20Ecole%20d&#39;ing%C3%A9nieurs%20-%20Engineering%20school.!5e0!3m2!1sfr!2sfr!4v1685374726975!5m2!1sfr!2sfr"
    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
    referrerpolicy="no-referrer-when-downgrade">
</iframe>
</footer>
<br><br><br>
</main>
<script src="recherche.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</div>

</body>';

// Fermeture de la connexion
mysqli_close($db_handle);
?>
