<?php
// Connexion à la base de données
$host = "localhost";
$dbname = "Comparaison";
$username = "root"; // Remplacez par votre utilisateur MySQL
$password = "";     // Remplacez par votre mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et validation des données du formulaire
    $nom = $_POST['nom'] ?? null;
    $email = $_POST['email'] ?? null;
    $date_naissance = $_POST['date'] ?? null;
    $mdp = $_POST['mdp'] ?? null;
    $contact = $_POST['contact'] ?? null;
    $ville = $_POST['ville'] ?? null;
    $pays = $_POST['pays'] ?? null;
    $quartier = $_POST['quartier'] ?? null;
    $nationalite = $_POST['nation'] ?? null;
    $fonction = $_POST['fonction'] ?? null;
    $cni = $_POST['cni'] ?? null;
    $passport = $_POST['passport'] ?? null;
    $permis = $_POST['permis'] ?? null;

    // Récupération des clés étrangères (optionnelles)
    $id_ap = !empty($_POST['id_ap']) ? $_POST['id_ap'] : null;
    $id_villa = !empty($_POST['id_villa']) ? $_POST['id_villa'] : null;
    $id_chambre = !empty($_POST['id_chambre']) ? $_POST['id_chambre'] : null;
    $id_hotel = !empty($_POST['id_hotel']) ? $_POST['id_hotel'] : null;

    // Vérification des clés étrangères (si nécessaire)
    function checkForeignKey($pdo, $table, $column, $value) {
        if ($value === null) return null;
        $stmt = $pdo->prepare("SELECT $column FROM $table WHERE $column = :value");
        $stmt->execute(['value' => $value]);
        return $stmt->fetch() ? $value : null;
    }

    $id_ap = checkForeignKey($pdo, 'appartement', 'id_ap', $id_ap);
    $id_villa = checkForeignKey($pdo, 'villa', 'id_villa', $id_villa);
    $id_chambre = checkForeignKey($pdo, 'chambre', 'id_chambre', $id_chambre);
    $id_hotel = checkForeignKey($pdo, 'hotel', 'id_hotel', $id_hotel);

    // Si une clé étrangère est invalide, arrêtez l'exécution
    if ($_POST['id_ap'] && !$id_ap) die("Erreur : L'identifiant d'appartement n'existe pas.");
    if ($_POST['id_villa'] && !$id_villa) die("Erreur : L'identifiant de villa n'existe pas.");
    if ($_POST['id_chambre'] && !$id_chambre) die("Erreur : L'identifiant de chambre n'existe pas.");
    if ($_POST['id_hotel'] && !$id_hotel) die("Erreur : L'identifiant d'hôtel n'existe pas.");

    // Vérifier si le nom et l'email existent déjà
$checkStmt = $pdo->prepare("
SELECT COUNT(*) 
FROM utilisateur 
WHERE nom_ges_ap = :nom AND email_ges_ap = :email
");
$checkStmt->execute([
'nom' => $_POST['nom'],
'email' => $_POST['email']
]);
$existingUserCount = $checkStmt->fetchColumn();

if ($existingUserCount > 0) {
// Si un utilisateur existe avec le même nom et email, afficher un message d'erreur
die("Erreur : Un utilisateur avec ce nom et cet email existe déjà.");
}

    // Requête d'insertion
    $stmt = $pdo->prepare("
        INSERT INTO utilisateur 
        (nom_ges_ap, email_ges_ap, date_nais_ges_ap, mdp_ges_ap, tel_ges_ap, ville_ges_ap, pays_ges_ap, quartier_ges_ap, nationalite_ges_ap, num_cni_ges_ap, num_pass_ges_ap, num_permis_ges_ap, fonction_ges_ap, id_ap, id_villa, id_chambre, id_hotel) 
        VALUES (:nom_ges_ap, :email_ges_ap, :date_nais_ges_ap, :mdp_ges_ap, :tel_ges_ap, :ville_ges_ap, :pays_ges_ap, :quartier_ges_ap, :nationalite_ges_ap, :num_cni_ges_ap, :num_pass_ges_ap, :num_permis_ges_ap, :fonction_ges_ap, :id_ap, :id_villa, :id_chambre, :id_hotel)
    ");

    // Exécution de la requête avec les données
    $stmt->execute([
        'nom_ges_ap' => $nom,
        'email_ges_ap' => $email,
        'date_nais_ges_ap' => $date_naissance,
        'mdp_ges_ap' => password_hash($mdp, PASSWORD_DEFAULT),
        'tel_ges_ap' => $contact,
        'ville_ges_ap' => $ville,
        'pays_ges_ap' => $pays,
        'quartier_ges_ap' => $quartier,
        'nationalite_ges_ap' => $nationalite,
        'num_cni_ges_ap' => $cni,
        'num_pass_ges_ap' => $passport,
        'num_permis_ges_ap' => $permis,
        'fonction_ges_ap' => $fonction,
        'id_ap' => $id_ap,
        'id_villa' => $id_villa,
        'id_chambre' => $id_chambre,
        'id_hotel' => $id_hotel
    ]);

    // Vérifier si le champ "fonction" est rempli
if (empty($fonction)) {
    die("Erreur : Veuillez sélectionner une fonction.");
}
    // Redirection selon la fonction
    switch ($fonction) {
        case "GESAP":
            $_SESSION['authenticated'] = true; // Marquer l'utilisateur comme authentifié
            $_SESSION['username'] = $username; // Stocker le nom d'utilisateur dans la session
            header("Location: page_gestionnaire_appartement.php");
            break;
        case "GESHO":
            $_SESSION['authenticated'] = true; // Marquer l'utilisateur comme authentifié
            $_SESSION['username'] = $username; // Stocker le nom d'utilisateur dans la session
            header("Location: page_gestionnaire_hotel.php");
            break;
        case "GESMH":
            $_SESSION['authenticated'] = true; // Marquer l'utilisateur comme authentifié
            $_SESSION['username'] = $username; // Stocker le nom d'utilisateur dans la session
            header("Location: page_gestionnaire_maison_hote.php");
            break;
        case "CLIENT":
            $_SESSION['authenticated'] = true; // Marquer l'utilisateur comme authentifié
            $_SESSION['username'] = $username; // Stocker le nom d'utilisateur dans la session
            header("Location: page_client.php");
            break;
        default:
            echo "<script>alert('Fonction non valide.');</script>";
    }
    exit;
}
?>


<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Inscription
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
 </head>
 <body class="bg-green-900 flex items-center justify-center min-h-screen">
  <div class="bg-white rounded-lg shadow-lg flex flex-col md:flex-row">
   <img alt="A person holding travel documents and smiling" class="rounded-t-lg md:rounded-l-lg md:rounded-t-none w-full md:w-1/2" height="400" src="https://storage.googleapis.com/a1aa/image/3DRhlVxve4VOeEgU7qaMAv6IzMJE56PebPRdvHlg0Ne2luaPB.jpg" width="400"/>
   <div class="p-8 md:w-1/2">
    <h2 class="text-center text-2xl font-semibold mb-6">
     Inscription de l'Utilisateur
    </h2>
    <h4 class="text-center text-1xl font-semibold mb-2">
        Remplissez le formulaire suivant pour vous inscrire sur l'application
    </h4>
    <form class="space-y-4" method= "POST">
     <div>
      <label class="block text-sm font-medium text-gray-700" for="nom">
       Nom
      </label>
      <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="nom" name="nom" placeholder="Votre nom" type="text"/>
     </div>
     <div>
      <label class="block text-sm font-medium text-gray-700" for="email">
       Email
      </label>
      <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="prenom" name="email" placeholder="Votre email" type="text"/>
     </div>
     <div>
      <label class="block text-sm font-medium text-gray-700" for="datenais">
       Date de naissance
      </label>
      <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="password" name="date" placeholder="Votre date de naissance" type="date"/>
     </div>
     <div>
      <label class="block text-sm font-medium text-gray-700" for="mot de passe">
       Mot de passe
      </label>
      <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="mdp" name="mdp" placeholder="Votre mot de passe" type="text"/>
     </div>
     <div>
      <label class="block text-sm font-medium text-gray-700" for="contact">
      Contact 
      </label>
      <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="contact" name="contact" placeholder="Votre contact" type="number"/>
     </div>
     <div>
        <label class="block text-sm font-medium text-gray-700" for="ville">
        Ville
        </label>
        <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" id="ville" name="ville" required>
            <option selected>Choisir ue ville....</option>
            <option value="YAOUNDE">Yaoundé</option>
            <option value="DOUALA">Douala</option>
            <option value="LAGOS">Lagos</option>
            <option value="DAKAR">Dakar</option>
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700" for="pays">
        Pays
        </label>
        <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" id="pays" name="pays" required>
            <option selected>Choisir un pays....</option>
            <option value="CAMEROUN">CAMEROUN</option>
            <option value="NIGERIA">NIGERIA</option>
            <option value="BENIN">BENIN</option>
            <option value="SENEGAL">SENEGAL</option>
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700" for="quartier">
         Quartier
        </label>
        <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="quartier" name="quartier" placeholder="Votre quartier" type="text"/>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700" for="nationalite">
         Nationalité
        </label>
        <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="nation" name="nation" placeholder="Votre nationalite" type="text"/>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700" for="fonction">
        Fonction
        </label>
        <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" id="ville" name="fonction" required>
            <option selected>Choisir une fonction</option>
            <option value="GestionnaireAppartement">Gestionnaire d'Appartement</option>
            <option value="GestionnaireHotel">Gestionnaire d'Hotel</option>
            <option value="GestionnaiireVilla">Gestionnaire de Maison d'Hote</option>
            <option value="Client">Client</option>
        </select>
    </div>
     <h4 class="text-center text-1xl font-semibold mb-2">
        Remplissez l'un des champs suivants pour votre identification valide
    </h4>
     <div>
        <label class="block text-sm font-medium text-gray-700" for="cni">
        Numéro de CNI
        </label>
        <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="cni" name="cni" placeholder="Votre numéro de cni" type="text"/>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700" for="passport">
        Numéro du passport
        </label>
        <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="passport" name="passport" placeholder="Votre numero de passport" type="text"/>
       </div>
    <div>
        <label class="block text-sm font-medium text-gray-700" for="permis">
        Permis de conduire
        </label>
        <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="permis" name="permis" placeholder="Votre numero de permis de conduire" type="text"/>
    </div>
    <div>
    
    <input type="nhidden" name="id_ap" id="id_ap" placeholder="">
</div>
<div>
    
    <input type="hidden" name="id_villa" id="id_villa" placeholder="">
</div>
<div>
    
    <input type="hidden" name="id_chambre" id="id_chambre" placeholder="">
</div>
<div>
    
    <input type="hidden" name="id_hotel" id="id_hotel" placeholder="">
</div>
       
     <div>
      <button class="w-full py-2 px-4 bg-black text-white font-semibold rounded-md shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">
       S'inscrire
      </button>
     </div>
    </form>
   </div>

  </div>
 </body>
</html> 
