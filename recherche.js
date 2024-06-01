/* Sélection de l'input de recherche */
var searchInput = document.getElementById("search-input");

/* Ajout d'un détecteur de pression de la touche "Entrée" lors de la recherche */
searchInput.addEventListener("keydown", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();  // Empêche la soumission du formulaire
    performSearch();
  }
});

/* Ajout d'un détecteur de pression du bouton de recherche */
document.getElementById("search-button").addEventListener("click", performSearch);

/* Fonction pour effectuer la recherche */
function performSearch() {
  var query = searchInput.value.toLowerCase();
  var targetFile = "";

  if (query === "coach" || query === "coachs" || query === "personnel" || query === "liste" || query === "coachs sportifs" || query === "coach sportif") {
    targetFile = "personnel.html";
  } else if (query === "accueil" || query ==="acueil"  || query ==="accueils"  || query === "actualite" || query ==="actualites" ||query ==="actualité"   || query ==="actualités"){
    targetFile = "accueil.html";
  } else if (query === "alimentation" || query === "bouffe" || query === "nutrition" || query === "graill" || query === "manger" || query === "à table" || query === "nourriture"){
    targetFile = "alimentation.html";
  } else if (query === "horaires" || query === "horaire" || query === "ouverture" || query === "heures" || query === "regles" || query === "reglement" || query === "heure" || query === "heures d'ouverture" || query === "heure d'ouverture"){
    targetFile = "regles.html";
  } else if (query === "règles" || query === "regles" || query === "regle" || query === "regles" || query === "reglement" || query === "règlement" || query === "reglements" || query === "règlements"){
    targetFile = "regles.html" ;
  } else if (query === "nouveaux clients" || query === "nouveau client" || query === "nouveau" || query === "nouveaux" || query === "new" || query === "inscription" || query === "s'inscrire"){
    targetFile = "creerCompte.html";
  } else if (query === "salle" || query === "salles" || query ==="omnes" || query === "ece" || query ==="équipement" || query ==="équipements" || query === "eiffel"){
    targetFile = "salle.html";
  } else if (query === "Biking" || query === "Velo" || query === "Vélo" || query === "Velos" || query === "Vélos" || query === "Cyclisme"|| query === "Cycliste"|| query === "Sylvain Saroule"|| query === "Saroule"|| query === "Sylvain"|| query === "Pédaler"|| query === "Coach Sylvain"){
    targetFile = "biking.php";
  } else if (query === "Cardio-Taining" || query === "cardio" || query === "training" || query === "Maxime Détente" || query === "Maxime" || query === "coach Maxime"|| query === "Détente"|| query === "coach Détente"){
    targetFile = "cardio.php"
  } else if (query === "Cours colectif" || query === "collectif" || query === "cours collectif" || query === "Angela Baha" || query === "Angela" || query === "Baha"|| query === "coach Angela"|| query === "coach Baha"){
    targetFile = "coursCo.php"
  } else if (query === "basketball" || query === "basket"|| query === "basketeur" || query === "Kim Possible" || query === "Kim" || query === "coach Kim"|| query === "coach Possible"|| query === "Possible"){
    targetFile = "basket.html"
  } else if (query === "football" || query === "foot"|| query === "footballeur" || query === "Zizzou Legrand" || query === "Zizzou" || query === "Legrand"|| query === "coach Zizzou"|| query === "coach Legrand"){
    targetFile = "foot.html"
  } else if (query === "rugby" || query === "rugbyman" || query === "Côme Unfrigo" || query === "Côme" || query === "coach Côme"|| query === "coach Unfrigo"|| query === "Unfrigo"){
    targetFile = "rugby.php"
  } else if (query === "tenis" || query === "tennis" || query === "Nina Iguess" || query === "Nina" || query === "Iguess"|| query === "coach Nina"|| query === "coach Iguess"){
    targetFile = "tennis.php"
  } else if (query === "natation" || query === "nager" || query === "piscine" || query === "Ariel Lapetitesirene" || query === "Ariel"|| query === "Lapetitesirene"|| query === "coach Ariel"|| query === "coach Lapetitesirene" || query === "nageur"|| query === "croal"|| query === "brasse"){
    targetFile = "natation.php"
  } else if (query === "plongeon" || query === "plongoir" || query === "plonger" || query === "plongeur" || query === "Nicolas Latetenbas"|| query === "Nicolas"|| query === "Latetenbas"|| query === "coach Nicolas"|| query === "coach Latetenbas"|| query === "coach Nico"){
    targetFile = "plongeon.php"
  } else if (query === "musculation" || query === "muscu" || query === "muscle" || query === "masse" || query === "bodybuilding"|| query === "Iliès Matrixé"|| query === "Iliès"|| query === "Matrixé"|| query === "coach Iliès"|| query === "Iliès"|| query === "coach Matrixé"|| query === "Ilies" || query === "coach Matrixe"){
    targetFile = "muscu.php"
  } else if (query === "fitness" || query === "fitnesse" || query === "fit" || query === "guy" || query === "fit"|| query === "Guy Fit"|| query === "coach guy"|| query === "coach fit"){
    targetFile = "fitness.php"
  } else {
    alert("Pas de résultat trouvé !");
  }

  // Rediriger vers le fichier ciblé si un fichier cible est défini
  if (targetFile !== "") {
    window.location.href = targetFile;
  }
}
