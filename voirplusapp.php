<?php
 $serveur="localhost";  
 $login="root";
 $password="";

 try{
  $connexion=new PDO("mysql:host=$serveur;dbname=comparaison",$login,$password);

// Vous pouvez également activer le mode d'erreur PDO pour voir s'il y a des erreurs lors de l'exécution :
  $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  echo 'connexion réussie';
 }catch(PDOException $e){
  die('Echec:'.$e->getMessage());
 }



?>

<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Appartement Page
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
 </head>
 <body class="bg-green-900 text-white font-sans">
  <header class="flex items-center justify-between p-4 bg-green-800">
   <div class="flex items-center">
    <img alt="Logo" class="rounded-full" height="40" src="https://storage.googleapis.com/a1aa/image/s3fUhvoJfPt3aEPn5niIzgbn95w3a4OI0LCspgxxrJuulV4TA.jpg" width="40"/>
   </div>
   <div class="flex items-center space-x-4">
    <i class="fas fa-bell text-white">
    </i>
    <i class="fas fa-user text-white">
    </i>
   </div>
  </header>
  <main class="p-4">
   <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
    <div class="bg-green-800 p-4 rounded-lg">
     <?php
          // Récupérer l'identifiant depuis l'URL
$id_espace = isset($_GET['id']) ? intval($_GET['id']) : 0;
//echo "ID récupéré : " . $id_ap; // Ajoutez cette ligne pour déboguer

// Vérifiez si l'ID est valide
if ($id_espace > 0) {
    // Préparer la requête SQL pour sélectionner l'enregistrement correspondant à l'ID
    $sql = "SELECT * FROM appartement WHERE id_ap = :id"; // Utilisez le paramètre :id ici
    $stmt = $connexion->prepare($sql);
    
    // Lier le paramètre à la requête
    $stmt->bindParam(':id', $id_espace, PDO::PARAM_INT);
    
    // Exécuter la requête
    if ($stmt->execute()) {
        // Récupérer le résultat 
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Requête pour récupérer les photos de l'appartement
$sql = "SELECT photo_ap FROM appartement WHERE id = :id";
$stmt = $connexion->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

// Vérifier si l'appartement existe et récupérer les photos
$row = $stmt->fetch(PDO::FETCH_ASSOC); // On essaie de récupérer la ligne

// Vérifier si la requête a renvoyé une ligne
        if ($row) {
            // Si une ligne est trouvée, on traite les photos
            $photos = explode(',', $row['photo_ap']); // Supposons que les photos sont stockées séparées par des virgules
            echo "<h1>Photos de l'appartement</h1>";
            foreach ($photos as $photo) {
                // Assurez-vous que le chemin d'accès est correct
                echo "<img src='$photo' alt='Photo de l\'appartement' style='width: 200px; margin: 10px;'>";
            }
    } else {
        echo "Aucune photo disponible pour cet appartement.";
    }
    $stmt->closeCursor();
$conn = null; // Fermer la connexion
        
        // Vérifiez si des résultats ont été trouvés
        if ($result) {
            echo "<div><h1>DETAILS DE L'APPARTEMENT</h1></div><br>";
            echo "<div><p><strong>Nom de l'appartement:</strong> " . htmlspecialchars($result["nom_ap"]) . "</p></div>";
            echo "<p><strong>Nom du vendeur:</strong> " . htmlspecialchars($result["vendeur_ap"]) . "</p>";
            echo "<p><strong>Contact:</strong> " . htmlspecialchars($result["tel_ap"]) . "</p>";
            echo "<p><strong>Ville du site:</strong> " . htmlspecialchars($result["ville_ap"]) . "</p>";
            echo "<p><strong>Pays du site:</strong> " . htmlspecialchars($result["pays_ap"]) . "</p>";
            echo "<p><strong>Quartier du site:</strong> " . htmlspecialchars($result["quartier_ap"]) . "</p>";
            echo "<p><strong>Superficie de l'appartement:</strong> " . htmlspecialchars($result["superficie_ap"]) . "</p>";
            echo "<p><strong>Prix de l'appartement:</strong> " . htmlspecialchars($result["prix_ap"]) . "</p>";
            echo "<p><strong>Disponibilité:</strong> " . htmlspecialchars($result["disponible_ap"]) . "</p>";
            echo "<p><strong>Nombre de salons:</strong> " . htmlspecialchars($result["salon_ap"]) . "</p>";
            echo "<p><strong>Nombre de chambres:</strong> " . htmlspecialchars($result["chambre_ap"]) . "</p>";
            echo "<p><strong>Nombre de douches:</strong> " . htmlspecialchars($result["douche_ap"]) . "</p>";
            echo "<p><strong>Nombre de cuisines:</strong> " . htmlspecialchars($result["cuisine_ap"]) . "</p>";
            echo "<p><strong>Standing:</strong> " . htmlspecialchars($result["standing_ap"]) . "</p>";
            echo "<p><strong>Mobilier:</strong><textarea class='w-full bg-green-600 p-4 rounded-lg h-32 text-white' >" . htmlspecialchars($result["mobilier"]) . "</textarea> ";
            echo "<p><strong>Atouts:</strong><textarea class='w-full bg-green-600 p-4 rounded-lg h-32 text-white' >" . htmlspecialchars($result["atouts_ap"]) . "</textarea> ";
            echo "<p><strong>Options:</strong><textarea class='w-full bg-green-600 p-4 rounded-lg h-32 text-white' >" . htmlspecialchars($result["option_ap"]) . "</textarea> ";
            echo "<p><strong>Détails:</strong><textarea class='w-full bg-green-600 p-4 rounded-lg h-32 text-white' >" . htmlspecialchars($result["salon_ap"]) . "</textarea> ";
            echo "<br>";
            echo '<a href="MesReser.php?poids=' . urlencode($result['nom_ap']) . '&vendeur_ap=' . urlencode($result['vendeur_ap']) . '&contact=' . urlencode($result['tel_ap']) . '" class="btn quitter">Ajouter</a>';
        } else {
            echo "<div><p>Aucun enregistrement trouvé.</p></div>";
        }
    } else {
        echo "<div><p>Erreur lors de l'exécution de la requête.</p></div>";
    }

}
            ?>
    
    </div>
    <div class="lg:col-span-3">
     <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
      <img alt="Hotel Room" class="rounded-lg" height="200" src="https://storage.googleapis.com/a1aa/image/qNsvVqDW3XraCd9nfy8H4olPZZpKwYDVuC3YFGF1eIvylV4TA.jpg" width="300"/>
      <img alt="Hotel Exterior" class="rounded-lg" height="200" src="https://storage.googleapis.com/a1aa/image/xkDqseW7AMQ9E64usIjEgVSvWIWlL2r5gufArOQkvzT0lV4TA.jpg" width="300"/>
      <img alt="Hotel Room" class="rounded-lg" height="200" src="https://storage.googleapis.com/a1aa/image/qNsvVqDW3XraCd9nfy8H4olPZZpKwYDVuC3YFGF1eIvylV4TA.jpg" width="300"/>
      <img alt="Hotel Bathroom" class="rounded-lg" height="200" src="https://storage.googleapis.com/a1aa/image/Rn8RAX1OipLjGBat9W7nrC5IWvu0bfrKtdzkRLKi5Ix2yK8JA.jpg" width="300"/>
      <img alt="Hotel Pool" class="rounded-lg" height="200" src="https://storage.googleapis.com/a1aa/image/fhNNxB4j1qWJG6Df500ggZakL8ea8pOEnup7FX7lPe4YXWhPB.jpg" width="300"/>
      <img alt="Hotel Breakfast" class="rounded-lg" height="200" src="https://storage.googleapis.com/a1aa/image/VY1OL54tin6PMdpzNkfXBHVOY1dbb6tZPeqX8osQFzwxlV4TA.jpg" width="300"/>
     </div>
     <div class="flex justify-between items-center mb-4">
   
      <button class="bg-black text-white px-4 py-2 rounded-lg"><a href="reserapp.php">
       Réserver
       </a></button>
       <button class="bg-black text-white px-4 py-2 rounded-lg"><a href="mesreserapp.php">
       Ajouter
       </a></button>
     </div>
    </div>
   </div>
   <div class="mt-8">
    <h2 class="text-2xl font-bold mb-4">
     Commentaires
    </h2>
    <div class="bg-white text-black p-4 rounded-lg mb-4">
     <div class="flex items-center mb-2">
      <img alt="User Avatar" class="rounded-full mr-2" height="40" src="https://storage.googleapis.com/a1aa/image/r2wrAvstLzJQDdELVCx8KxciMTNdfp26UACUdhmuhnA4yK8JA.jpg" width="40"/>
      <div>
       <p class="font-bold">
        Devla
       </p>
       <p>
        Best place ever. Try and see for yourself !
       </p>
      </div>
     </div>
     <div class="flex items-center">
      <i class="fas fa-star text-yellow-500">
      </i>
      <i class="fas fa-star text-yellow-500">
      </i>
      <i class="fas fa-star text-yellow-500">
      </i>
      <i class="fas fa-star text-yellow-500">
      </i>
      <i class="fas fa-star text-gray-500">
      </i>
     </div>
    </div>
    <div class="bg-white text-black p-4 rounded-lg mb-4">
     <div class="flex items-center mb-2">
      <img alt="User Avatar" class="rounded-full mr-2" height="40" src="https://storage.googleapis.com/a1aa/image/r2wrAvstLzJQDdELVCx8KxciMTNdfp26UACUdhmuhnA4yK8JA.jpg" width="40"/>
      <div>
       <p class="font-bold">
        John Doe
       </p>
       <p>
        Endroit très accueillant. Je recommande !
       </p>
      </div>
     </div>
     <div class="flex items-center">
      <i class="fas fa-star text-yellow-500">
      </i>
      <i class="fas fa-star text-yellow-500">
      </i>
      <i class="fas fa-star text-yellow-500">
      </i>
      <i class="fas fa-star text-gray-500">
      </i>
      <i class="fas fa-star text-gray-500">
      </i>
     </div>
    </div>
    <div class="bg-white text-black p-4 rounded-lg">
     <textarea class="w-full p-2 rounded-lg" placeholder="Laissez un commentaire"></textarea>
    </div>
   </div>
  </main>
 </body>
</html>
