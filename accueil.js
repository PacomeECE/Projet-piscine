/* Sélection des éléments du DOM */
let openBtn = document.getElementById("nav-open");
let closeBtn = document.getElementById("nav-close");
let navWrapper = document.getElementById("nav-wrapper");
let navLatteral = document.getElementById("nav-latteral");

/* Fonction pour ouvrir la navigation */
const openNav = () => {
  navWrapper.classList.add("active");
  navLatteral.style.left = "0";
};

/* Fonction pour fermer la navigation */
const closeNav = () => {
  navWrapper.classList.remove("active");
  navLatteral.style.left = "-100%";
};

/* Ajout des écouteurs d'événements pour les boutons d'ouverture et de fermeture de la navigation */
openBtn.addEventListener("click", openNav);
closeBtn.addEventListener("click", closeNav);
navWrapper.addEventListener("click", closeNav);

/* Sélection de l'input de recherche */
var searchInput = document.getElementById("search-input");

/* Ajout d'un détecteur de pression de la touche "Entrée" lors de la recherche */
searchInput.addEventListener("keydown", function(event) {
  if (event.key === "Enter") {
    performSearch();
  }
});

/* Ajout d'un détecteur de pression du bouton de recherche */
document.getElementById("search-button").addEventListener("click", performSearch);

/* Fonction pour effectuer la recherche */
function performSearch() {
  var query = document.getElementById("search-input").value.toLowerCase();
  var targetFile = "";
  
    if (query === "coach" || query === "coachs" || query === "personnel" || query === "liste" || query === "coachs spotifs" || query === "coach sportif") {
      targetFile = "personnel.html";
    } else if (query === "accueil" || query ==="acueil"  || query ==="accueils"  || query === "actualite" || query ==="actualites" ||query ==="actualité"   || query ==="actualités"){
      targetFile = "projet4.html";
    } else if (query === "alimentation" || query === "bouffe" || query === "nutrition" || query === "graill" || query === "manger" || query === "à table" || query === "nourriture"){
      targetFile = "alimentation.html";
    } else if (query === "horaires" || query === "horaire" || query === "ouverture" || query === "heures" || query === "dates" || query === "date" || query === "heure" || query === "heures d'ouverture" || query === "heure d'ouverture"){
      targetFile = "horaires.html";
    } else if (query === "règles" || query === "regles" || query === "regle" || query === "regles" || query === "reglement" || query === "règlement" || query === "reglements" || query === "règlements"){
      targetFile = "regles.html" ;
    } else if (query === "nouveaux clients" || query === "nouveau client" || query === "nouveau" || query === "nouveaux" || query === "new"){
      targetFile = "nouveauClient.html";
    } else if (query === "salle" || query === "salles" || query ==="omnes" || query === "ece" || query === "inseec" || query === "supdepub" || query === "heip" ||query === "esce" || query === "ifg" || query === "ceds" || query === "supdecreation" || query === "crea" || query === "supcareer" || query === "univesity of monaco" || query === "eu business school" || query === "ebs" | query ==="cei" || query === "datascientist" || query === "eiffel"){
      targetFile = "salle.html";
    } else if (query === "Biking" || query === "Velo" || query === "Vélo" || query === "Velos" || query === "Vélos" || query === "Cyclisme"|| query === "Cycliste"|| query === "Leonardio diCarpaccio"|| query === "Leo diCarpaccio"|| query === "Leonardo"|| query === "Leo"|| query === "Coach Leo"){
      targetFile = "biking.html";
    } else if (query === "Cardio-Taining" || query === "cardio" || query === "training" || query === "Brad beat" || query === "brad" || query === "coach brad"|| query === "beat"|| query === "coach beat"){
      targetFile = "cardio.html"
    } else if (query === "Cours colectif" || query === "collectif" || query === "cours-collectif" || query === "vin gasoil" || query === "vin" || query === "gasoil"|| query === "coach vin"|| query === "coach gasoil"){
      targetFile = "coursCo.html"
    } else if (query === "basketball" || query === "basket"|| query === "basketeur" || query === "Antonin doat" || query === "antonin" || query === "coach antonin"|| query === "coach doat"|| query === "doat" || query === "coach chauve"){
      targetFile = "basket.html"
    } else if (query === "football" || query === "foot"|| query === "footballeur" || query === "gilles ollivier" || query === "gilles" || query === "ollivier"|| query === "coach gilles"|| query === "coach ollivier"){
      targetFile = "foot.html"
    } else if (query === "rugby" || query === "rugbyman" || query === "sebastien charal" || query === "sebastien charalle" || query === "coach sebastien"|| query === "coach seb"|| query === "seb"|| query === "coach charal"|| query === "coach charalle"){
      targetFile = "rugby.html"
    } else if (query === "tenis" || query === "tennis" || query === "roger la ferrière" || query === "roger la ferriere" || query === "roger"|| query === "la ferriere"|| query === "la ferrière"|| query === "coach roger"|| query === "coach la ferrière"|| query === "coach la ferriere"){
      targetFile = "tennis.html"
    } else if (query === "natation" || query === "nager" || query === "piscine" || query === "pacome golvet" || query === "pacôme golvet"|| query === "coach pacome"|| query === "coach pacôme"|| query === "coach golvet"|| query === "golvet"|| query === "nageur"|| query === "croal"|| query === "brasse" || query === "coach pas doué" || query === "coach peu doué" || query === "coach copieur" || query === "coach 0/20"){
      targetFile = "natation.html"
    } else if (query === "plongeon" || query === "plongoir" || query === "plonger" || query === "plongeur" || query === "man aleau"|| query === "man"|| query === "aleau"|| query === "coach man"|| query === "coach aleau"|| query === "bouteille"){
      targetFile = "plongeon.html"
    } else if (query === "musculation" || query === "muscu" || query === "muscle" || query === "masse" || query === "bodybuilding"|| query === "nicolas pinier"|| query === "nicolas"|| query === "pinier"|| query === "coach nico"|| query === "nico"|| query === "coach nicolas"|| query === "coach pinier" || query === "coach pignouf"){
      targetFile = "muscu.html"
    } else if (query === "fitness" || query === "fitnesse" || query === "fit" || query === "margot" || query === "margaux"|| query === "margo"|| query === "robinet"|| query === "raubinait"|| query === "margot raubinait"|| query === "margaux raubinait"|| query === "margot robinet"|| query === "margaux robinet"|| query === "coach margot"|| query === "coach margaux"|| query === "coach robinet"|| query === "coach raubinait"|| query === "coach margo"){
      targetFile = "fitness.html"
    } 

  
    
    
    
    else {
      alert("Pas de résultat trouvé !");
    }
  
    // Rediriger vers le fichier ciblé
    window.location.href = targetFile;
  };

