<?php
session_start();

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=comparaison', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_ges = trim($_POST['nom']);
    $mdp_ges = trim($_POST['mdp']);

    if (!empty($nom_ges) && !empty($mdp_ges)) {
        // Préparer et exécuter la requête
        $stmt = $pdo->prepare('SELECT * FROM utilisateur WHERE nom_ges_ap = :nom AND mdp_ges_ap = :mdp');
        $stmt->bindParam(':nom', $nom_ges);
        $stmt->bindParam(':mdp', $mdp_ges, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Enregistrer les informations utilisateur dans la session
            $_SESSION['user_id'] = $user['id_ges_ap'];
            $_SESSION['user_nom'] = $user['nom_ges_ap'];

            // Rediriger vers la page d'accueil
            header('Location: page.php');
            exit();
        } else {
            $error = "Nom ou mot de passe incorrect.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
   Connexion
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
 </head>
 <body class="bg-green-900 flex items-center justify-center min-h-screen">
  <div class="bg-white rounded-lg shadow-lg flex flex-col md:flex-row items-center p-6 md:p-0">
   <img alt="Person holding travel tickets and smiling" class="rounded-lg md:rounded-none md:rounded-l-lg w-full md:w-1/2" height="300" src="https://storage.googleapis.com/a1aa/image/I4JWnOs4fZyUSCesSCfeaIpP7eYocDPmO0yuYbVYvM8b0d1eE.jpg" width="300"/>
   <div class="p-6 md:p-12 w-full md:w-1/2">
    <h2 class="text-2xl font-semibold mb-6 text-center md:text-left">
     Bienvenue sur COMPARATEUR
    </h2>
    <h2 class="text-1xl font-semibold mb-2 text-center md:text-left">
      Remplissez ce formulaire pour vous connecter à l'application
     </h2>
    <form method ="POST">
     <div class="mb-4">
      <label class="block text-gray-700" for="nom">
       Nom
      </label>
      <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600" name="nom" id="nom" placeholder="Votre nom" type="text"/>
     </div>
     <div class="mb-4">
      <label class="block text-gray-700" for="password">
       Mot de passe
      </label>
      <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600" name="mdp" id="password" placeholder="Votre mot de passe" type="password"/>
     </div>
     <div class="p-6 md:p-8">
      <button class="w-full bg-gray-100 text-black py-2 px-4 rounded mb-4">
       Sign in with Google
      </button>
      <button class="w-full bg-blue-800 text-white py-2 px-4 rounded mb-4">
       Sign in with Facebook
      </button>
      <button class="w-full bg-black text-white py-2 px-4 rounded">
       Se connecter via son email
     <button class="w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800" type="submit">
      Se connecter
     </button>
    </form>
    <div class="mt-4 text-center">
     <a class="text-gray-600 hover:text-gray-800" href="#">
      Mot de passe oublié?
     </a>
     <a class="text-gray-600 hover:text-gray-800" href="inscriregesap.html">
        Inscrivez-vous.
       </a>
    </div>
   </div>

<!-- Messaque qui s'affiche à l'utilisateur lorsque le nom ou le mot de passe est incorrect  -->
<?php if (!empty($error)) : ?>
    <div class="text-red-600 text-center mb-4">
        <?php echo htmlspecialchars($error); ?>
    </div>
<?php endif; ?>
  </div>
 </body>
</html>
