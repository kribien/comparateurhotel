<?php
// Connexion à la base de données (à ajuster en fonction de votre configuration)
$host = 'localhost'; // hôte de la base de données
$dbname = 'comparaison'; // nom de la base de données
$username = 'root'; // nom d'utilisateur
$password = ''; // mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    exit;
}

// Vérification et traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pays = $_POST['pays'];
    $ville = $_POST['ville'];
    $quartier = $_POST['quartier'];
    $chambre = $_POST['chambre'];
    $cuisine = $_POST['cuisine'];
    $salon = $_POST['salon'];
    $prix = $_POST['prix'];

    // Préparation de la requête SQL
    $sql = "SELECT * FROM appartement WHERE pays_ap = :pays AND ville_ap = :ville AND quartier_ap = :quartier 
            AND chambre_ap >= :chambre AND cuisine_ap >= :cuisine AND salon_ap >= :salon
            AND prix_ap <= :prix";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':pays' => $pays,
        ':ville' => $ville,
        ':quartier' => $quartier,
        ':chambre' => $chambre,
        ':cuisine' => $cuisine,
        ':salon' => $salon,
        ':prix' => $prix
    ]);
    $appartements = $stmt->fetchAll();

    if (empty($appartements)) {
        $message = "Aucun résultat trouvé pour vos critères.";
    }
}
?>
<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Apartment Listings
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
 </head>
 <body class="bg-green-900 text-white font-sans">
  <header class="flex items-center justify-between p-4 bg-green-800">
   <div class="flex items-center">
    <div class="w-10 h-10 bg-gray-300 rounded-full">
    </div>
    <span class="ml-2 text-xl">
     Logo
    </span>
   </div>
   <div class="flex items-center">
    <input class="p-2 rounded-md bg-white text-black" placeholder="Appartements..." type="text"/>
    <i class="fas fa-bell ml-4 text-xl">
    </i>
    <i class="fas fa-shopping-cart ml-4 text-xl">
    </i>
   </div>
  </header>
  <main class="flex p-4">
   <aside class="w-1/4 p-4 bg-green-800 rounded-md">
    <h2 class="text-xl mb-4">
     Rechercher
    </h2>
    <Form method="POST">
    <div class="space-y-2">
      <select name="pays" id="" class="w-full p-2 rounded-md bg-white text-black" type="text">Pays
      <option class=""  selected>Choisir un pays....</option>
                    <option value="CAMEROUN">CAMEROUN</option>
                    <option value="NIGERIA">NIGERIA</option>
                    <option value="BENIN">BENIN</option>
                    <option value="SENEGAL">SENEGAL</option>
      </select>
      <select name="ville" id="" class="w-full p-2 rounded-md bg-white text-black" type="text">Ville
      <option class=""  selected>Choisir une ville....</option>
                    <option value="Yaounde">Yaounde</option>
                    <option value="Limbe">Limbe</option>
                    <option value="Douala">Douala</option>
                    <option value="Kribi">Kribi</option>
      </select>
     <input class="w-full p-2 rounded-md bg-white text-black" placeholder="Quartier" name="quartier" type="text"/>
     <div class="flex items-center justify-between">
      <span>
       Nombres de chambres
      </span>
      <input class="w-16 p-2 rounded-md bg-white text-black" type="number" name="chambre" value="1"/>
     </div>
     <div class="flex items-center justify-between">
      <span>
       Nombres de cuisines
      </span>
      <input class="w-16 p-2 rounded-md bg-white text-black" type="number" name="cuisine" value="1"/>
     </div>
     <div class="flex items-center justify-between">
      <span>
       Nombres de salons
      </span>
      <input class="w-16 p-2 rounded-md bg-white text-black" type="number" name="salon" value="1"/>
     </div>
    </div>
    <h2 class="text-xl mt-6 mb-4">
     Durée de séjour
    </h2>
    <div class="space-y-2">
     <input class="w-full p-2 rounded-md bg-white text-black" placeholder="Date d'arrivée" name="datede" type="date"/>
     <input class="w-full p-2 rounded-md bg-white text-black" placeholder="Date de départ" name="datefin" type="date"/>
    </div>
    <h2 class="text-xl mt-6 mb-4">
     Votre budget
    </h2>
    <div class="space-y-2">
     <div class="flex items-center justify-between">
      <span>
       Prix
      </span>
      <span>
       XAF
      </span>
      <input class="w-24 p-2 rounded-md bg-white text-black" type="number" name="prix" value="90000"/>
     </div>
     <input class="w-full" max="100000" min="0" type="range" value="90000"/>
    </div>
    <br>
    <div class="">
    <button class="w-full p-2 bg-black rounded-md">
      Rechercher
     </button>
    </div>
     <br>
     <div>
     <button class="w-full p-2 bg-black rounded-md" onclick="showResults()">
      Comparer
     </button>
    </div>
    </div>
    </Form>
   </aside>
   <section class="w-3/4 p-4">
    <div class="space-y-4">
   <?php if (isset($message)): ?>
    <p class="text-red-500"><?php echo $message; ?></p>
<?php endif; ?>

<?php if (!empty($appartements)): ?>
    <section class="w-3/4 p-4">
        <?php foreach ($appartements as $appartement): ?>
            <div class="space-y-4">
                <div class="flex items-start space-x-4">
                    <img alt="Image de l'appartement" class="w-32 h-32 rounded-md" src="<?php echo $appartement['image_url']; ?>" />
                    <div class="flex-1">
                        <h3 class="text-xl"><?php echo $appartement['nom_ap']; ?></h3>
                        <p><?php echo $appartement['ville_ap']; ?></p>
                        <p>Detail bref</p>
                        <p>Standing:<?php echo $appartement['standing_ap']; ?></p>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi delectus</p>
                        
                    </div>
                    <div class="flex flex-col items-end">
                        <span><?php echo $appartement['prix_ap']; ?> XAF / jour</span>
                        <button class="mt-2 px-4 py-2 bg-black rounded-md">
                            <a href="voirplusapp.php?id=<?php echo $appartement['id_ap']; ?>">Voir</a>
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
<?php endif; ?>
<script>
// Fonction pour ouvrir la pop-up et afficher les résultats
//function showResults() {
    // On empêche la soumission classique du formulaire
    //event.preventDefault();

    // Afficher la modale
    //const modal = document.getElementById("resultsModal");
    //Modale pour afficher les résultats -->
//<div id="resultsModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center" style="display:none;">
    //<div class="bg-white w-3/4 h-3/4 overflow-auto rounded-md p-4">
        //<button class="p-2 bg-red-500 text-white rounded-md" onclick="closeModal()">Fermer</button>
        //<h2 class="text-xl mb-4">Résultats de la recherche</h2>
        <?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'comparaison';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    exit;
}

// Vérification de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pays = $_POST['pays'];
    $ville = $_POST['ville'];
    $prix = $_POST['prix'];

    // Calcul de la fourchette de prix (de 10% en dessous à 60% au-dessus du prix)
    $prix_min = $prix * 0.9;  // 10% de moins
    $prix_max = $prix * 1.6;  // 60% de plus

    // Préparation de la requête SQL pour rechercher les appartements
    $sql = "SELECT * FROM appartement WHERE pays_ap = :pays AND ville_ap = :ville 
            AND prix_ap BETWEEN :prix_min AND :prix_max ORDER BY prix_ap ASC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':pays' => $pays,
        ':ville' => $ville,
        ':prix_min' => $prix_min,
        ':prix_max' => $prix_max
    ]);

    // Récupérer tous les résultats
    $appartements = $stmt->fetchAll();

    // Afficher les résultats
    if (empty($appartements)) {
        echo "<p>Aucun résultat trouvé pour ces critères.</p>";
    } else {
        echo '<section class="w-3/4 p-4">';
        foreach ($appartements as $appartement) {
            echo '
                <div class="space-y-4">
                    <div class="flex items-start space-x-4">
                        <img alt="Image de l\'appartement" class="w-32 h-32 rounded-md" src="' . $appartement['image_url'] . '" />
                        <div class="flex-1">
                            <h3 class="text-xl">' . $appartement['nom_ap'] . '</h3>
                            <p>' . $appartement['ville_ap'] . '</p>
                            <p>Detail bref</p>
                            <p>Standing: ' . $appartement['standing_ap'] . '</p>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi delectus</p>
                        </div>
                        <div class="flex flex-col items-end">
                            <span>' . $appartement['prix_ap'] . ' XAF / jour</span>
                            <button class="mt-2 px-4 py-2 bg-black rounded-md">
                                <a href="voirplusapp.php?id=' . $appartement['id_ap'] . '">Voir</a>
                            </button>
                        </div>
                    </div>
                </div>';
        }
        echo '</section>';
    }
}
?>
        //<!-- Zone où les résultats seront affichés -->
        //<div id="resultsContainer">
            //<!-- Les résultats seront injectés ici via JavaScript ou PHP -->
            //</div>
    //</div>
//<///div>
    //modal.style.display = "block";
    
    // Soumettre le formulaire pour obtenir les résultats
    //document.getElementById("searchForm").submit();
//}

// Fonction pour fermer la modale
//function closeModal() {
    //const modal = document.getElementById("resultsModal");
    //modal.style.display = "none";
//}
</script>


     <div class="flex items-start space-x-4">
      <img alt="Image of Q &amp; R Complex apartment" class="w-32 h-32 rounded-md" height="150" src="https://storage.googleapis.com/a1aa/image/iC4uGCZ0TapnHFqr6CE7ff3c0TfF34upR9te4KG5uvBatVhPB.jpg" width="150"/>
      <div class="flex-1">
       <h3 class="text-xl">
        Q &amp; R Complex
       </h3>
       <p>
        Ville
       </p>
       <p>
        Detail bref
       </p>
       <p>
        Lorem ipsum trepasis torsimis namani loren ninnimatce osiri typogratis minnepolis ni foriminos portis nir allerinis vonriss
       </p>
      </div>
      <div class="flex flex-col items-end">
       <span>
        60000 XAF / nuitée
       </span>
       <button class="mt-2 px-4 py-2 bg-black rounded-md"><a href="voirplusapp.php">
        Voir
        </a></button>
      </div>
     </div>
     <div class="flex items-start space-x-4">
      <img alt="Image of MiMi's Villa apartment" class="w-32 h-32 rounded-md" height="150" src="https://storage.googleapis.com/a1aa/image/sPRdgpwjG874Nx081MAwkk666hYySopdgGPzTCpY7aertK8JA.jpg" width="150"/>
      <div class="flex-1">
       <h3 class="text-xl">
        MiMi's Villa
       </h3>
       <p>
        Ville
       </p>
       <p>
        Detail bref
       </p>
       <p>
        Lorem ipsum trepasis torsimis namani loren ninnimatce osiri typogratis minnepolis ni foriminos portis nir allerinis vonriss
       </p>
      </div>
      <div class="flex flex-col items-end">
       <span>
        60000 XAF / nuitée
       </span>
       <button class="mt-2 px-4 py-2 bg-black rounded-md"><a href="voirplusapp.php">
        Voir
        </a></button>
      </div>
     </div>
     <div class="flex items-start space-x-4">
      <img alt="Image of Rhodd Complex apartment" class="w-32 h-32 rounded-md" height="150" src="https://storage.googleapis.com/a1aa/image/FkiIb15OKzIKAN8qZe1Pip0bNsy0AOwml2KbDcetyGRabV4TA.jpg" width="150"/>
      <div class="flex-1">
       <h3 class="text-xl">
        Rhodd Complex
       </h3>
       <p>
        Ville
       </p>
       <p>
        Detail bref
       </p>
       <p>
        Lorem ipsum trepasis torsimis namani loren ninnimatce osiri typogratis minnepolis ni foriminos portis nir allerinis vonriss
       </p>
      </div>
      <div class="flex flex-col items-end">
       <span>
        60000 XAF / nuitée
       </span>
       <button class="mt-2 px-4 py-2 bg-black rounded-md"><a href="voirplusapp.php">
        Voir
        </a></button>
      </div>
     </div>
    </div>
    <div class="flex justify-between mt-4">
     <button class="flex items-center space-x-2 bg-blue">
      <i class="fas fa-arrow-left">
      </i>
      <span>
       Previous
      </span>
     </button>
     <button class="flex items-center space-x-2 bg-blue">
      <span>
       Next
      </span>
      <i class="fas fa-arrow-right">
      </i>
     </button>
    </div>
   </section>
  </main>
  <footer class="p-4 bg-gray-800">
   <div class="flex justify-between">
    <div class="flex space-x-4">
     <i class="fab fa-facebook-f">
     </i>
     <i class="fab fa-twitter">
     </i>
     <i class="fab fa-instagram">
     </i>
     <i class="fab fa-youtube">
     </i>
     <i class="fab fa-linkedin-in">
     </i>
    </div>
    <div class="flex space-x-8">
     <a class="hover:underline" href="#">
      Explore
     </a>
     <a class="hover:underline" href="#">
      Design
     </a>
     <a class="hover:underline" href="#">
      Blog
     </a>
    </div>
    <div class="flex space-x-8">
     <a class="hover:underline" href="#">
      Resources
     </a>
     <a class="hover:underline" href="#">
      Contact
     </a>
    </div>
   </div>
  </footer>
 </body>
</html>
