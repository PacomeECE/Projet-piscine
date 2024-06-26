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

  if (query === "coach" || query === "coachs" || query === "personnel" || query === "liste" || query === "coachs spotifs" || query === "coach sportif") {
    targetFile = "personnel.html";
  } else if (query === "accueil" || query ==="acueil"  || query ==="accueils"  || query === "actualite" || query ==="actualites" ||query ==="actualité"   || query ==="actualités"){
    targetFile = "accueil.html";
  } else if (query === "alimentation" || query === "bouffe" || query === "nutrition" || query === "graill" || query === "manger" || query === "à table" || query === "nourriture"){
    targetFile = "alimentation.html";
  } else if (query === "horaires" || query === "horaire" || query === "ouverture" || query === "heures" || query === "dates" || query === "date" || query === "heure" || query === "heures d'ouverture" || query === "heure d'ouverture"){
    targetFile = "horaires.html";
  } else if (query === "règles" || query === "regles" || query === "regle" || query === "regles" || query === "reglement" || query === "règlement" || query === "reglements" || query === "règlements"){
    targetFile = "regles.html" ;
  } else if (query === "nouveaux clients" || query === "nouveau client" || query === "nouveau" || query === "nouveaux" || query === "new"){
    targetFile = "creerCompte.html";
  } else if (query === "salle" || query === "salles" || query ==="omnes" || query === "ece" || query === "inseec" || query === "supdepub" || query === "heip" ||query === "esce" || query === "ifg" || query === "batiment" || query === "supdecreation" || query === "locaux" || query === "local" || query === "bâtiments" || query === "eu business school" || query === "ebs" | query ==="cei" || query === "datascientist" || query === "eiffel"){
    targetFile = "salle.html";
  } else if (query === "Biking" || query === "Velo" || query === "Vélo" || query === "Velos" || query === "Vélos" || query === "Cyclisme"|| query === "Cycliste"|| query === "Leonardio diCarpaccio"|| query === "Leo diCarpaccio"|| query === "Leonardo"|| query === "Leo"|| query === "Coach Leo"){
    targetFile = "biking.php";
  } else if (query === "cardio-training" || query === "cardio" || query === "training" || query === "maxime détente" || query === "maxime" || query === "coach maxime" || query === "détente" || query === "coach détente" || query === "endurance" || query === "exercice" || query === "activité physique") {
    targetFile = "cardio.php";
  } else if (query === "cours collectif" || query === "collectif" || query === "angela baha" || query === "angela" || query === "baha" || query === "coach angela" || query === "coach baha" || query === "classe" || query === "cours en groupe" || query === "séance collective") {
    targetFile = "coursCo.php";
  } else if (query === "basketball" || query === "basket" || query === "basketeur" || query === "kim possible" || query === "kim" || query === "coach kim" || query === "coach possible" || query === "possible" || query === "ballon panier" || query === "match de basket" || query === "équipe de basket") {
    targetFile = "basket.html";
  } else if (query === "football" || query === "foot" || query === "footballeur" || query === "zizzou legrand" || query === "zizzou" || query === "legrand" || query === "coach zizzou" || query === "coach legrand" || query === "soccer" || query === "match de foot" || query === "équipe de foot") {
    targetFile = "foot.html";
  } else if (query === "rugby" || query === "rugbyman" || query === "côme unfrigo" || query === "côme" || query === "coach côme" || query === "coach unfrigo" || query === "unfrigo" || query === "rugby à XV" || query === "rugby à XIII" || query === "match de rugby") {
    targetFile = "rugby.php";
  } else if (query === "tenis" || query === "tennis" || query === "nina iguess" || query === "nina" || query === "iguess" || query === "coach nina" || query === "coach iguess" || query === "raquette" || query === "court de tennis" || query === "match de tennis") {
    targetFile = "tennis.php";
  } else if (query === "natation" || query === "nager" || query === "piscine" || query === "ariel lapetitesirene" || query === "ariel" || query === "lapetitesirene" || query === "coach ariel" || query === "coach lapetitesirene" || query === "nageur" || query === "crawl" || query === "brasse" || query === "nage libre" || query === "natation synchronisée") {
    targetFile = "natation.php";
  } else if (query === "plongeon" || query === "plongoir" || query === "plonger" || query === "plongeur" || query === "nicolas latetenbas" || query === "nicolas" || query === "latetenbas" || query === "coach nicolas" || query === "coach latetenbas" || query === "coach nico" || query === "saut" || query === "plongeoir" || query === "figure") {
    targetFile = "plongeon.php";
  } else if (query === "musculation" || query === "muscu" || query === "muscle" || query === "masse" || query === "bodybuilding" || query === "iliès matrixé" || query === "iliès" || query === "matrixé" || query === "coach iliès" || query === "coach matrixé" || query === "ilies" || query === "coach matrixe" || query === "force" || query === "poids" || query === "haltères") {
    targetFile = "muscu.php";
  } else if (query === "fitness" || query === "fitnesse" || query === "fit" || query === "guy fit" || query === "coach guy" || query === "coach fit" || query === "gymnastique" || query === "entraînement" || query === "exercice physique" || query === "forme physique" || query === "guy") {
    targetFile = "fitness.php";
  } else if (query === "abonnement" || query === "adhésion" || query === "souscription" || query === "souscrire" || query === "adhérer" || query === "s'abonner" || query === "payer" || query === "payant" || query === "mensuel" || query === "annuel" || query === "trimestriel") {
    targetFile = "abonnement.php";
  } else if (query === "nutritioniste" || query === "nathalie" || query === "Célerie" || query === " Nathalie Célerie " || query === " Nat" ) {
    targetFile = "nutritioniste.php";
  } else {
    alert("Pas de résultat trouvé !");
  }

        // Rediriger vers le fichier ciblé si un fichier cible est défini
        if (targetFile !== "") {
            window.location.href = targetFile;
        }
      }

      function addMessage(text) {
        // Create a new message div
        var messageDiv = document.createElement("div");
        messageDiv.className = "message";
    
        var userSpan = document.createElement("span");
        userSpan.className = "sender";
        userSpan.textContent = "Utilisateur:";
    
        var userText = document.createElement("span");
        userText.className = "text";
        userText.textContent = text;
    
        messageDiv.appendChild(userSpan);
        messageDiv.appendChild(userText);
    
        var chatlogs = document.getElementById("chatlogs");
        chatlogs.appendChild(messageDiv);
        chatlogs.scrollTop = chatlogs.scrollHeight;
    
        // Simuler une réponse automatique du coach après un délai
        setTimeout(function() {
            var responseDiv = document.createElement("div");
            responseDiv.className = "message";
    
            var coachSpan = document.createElement("span");
            coachSpan.className = "sender";
            coachSpan.textContent = "Coach virtuel:";
    
            var responseText = document.createElement("span");
            responseText.className = "text";
    
            var responsesDebutants = [
                "Bien sûr ! Tout le monde doit bien commencer quelque part.",
                "Oui, nous accueillons les débutants avec plaisir.",
                "Absolument, nous avons des programmes spécialement conçus pour les débutants.",
                "Oui, nous proposons des séances adaptées pour tous les niveaux, y compris les débutants."
            ];
    
            var responsesTarifs = [
                "Mes tarifs sont de 50€ par séance sans abonnement.",
                "Le tarif standard est de 50€ par séance, avec des réductions pour les forfaits.",
                "Chaque séance coûte 50€, mais nous offrons des forfaits à prix réduit.",
                "Le coût est de 50€ par séance, avec des options d'abonnement disponibles."
            ];
    
            var responsesServices = [
                "Je propose des services de coaching personnalisé dans ma discipline, de nutrition et de préparation physique.",
                "Nos services incluent le coaching personnalisé, des conseils en nutrition et la préparation physique.",
                "Nous offrons des séances de coaching personnalisé, des plans de nutrition et des programmes de préparation physique.",
                "Les services comprennent le coaching personnalisé, la nutrition et la préparation physique."
            ];
    
            if (text.includes("débutants")) {
                responseText.textContent = responsesDebutants[Math.floor(Math.random() * responsesDebutants.length)];
            } else if (text.includes("tarifs")) {
                responseText.textContent = responsesTarifs[Math.floor(Math.random() * responsesTarifs.length)];
            } else if (text.includes("services")) {
                responseText.textContent = responsesServices[Math.floor(Math.random() * responsesServices.length)];
            } else {
                responseText.textContent = "Je vais examiner votre demande et vous répondre bientôt.";
            }
    
            responseDiv.appendChild(coachSpan);
            responseDiv.appendChild(responseText);
    
            chatlogs.appendChild(responseDiv);
            chatlogs.scrollTop = chatlogs.scrollHeight;
        }, 1000);
    }
    
  
  
    
    
    
    
