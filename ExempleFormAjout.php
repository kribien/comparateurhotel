<?php
session_start();

// Vérification de l'authentification de l'utilisateur
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: login.html');
    exit;
}

// Récupérer le nom d'utilisateur
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Invité';

// Configurer les paramètres de connexion à la base de données
$host = 'localhost'; // ou l'adresse de votre serveur MySQL
$dbname = 'voyage';
$login = 'root';
$password = '';

try {
    // Créer une connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connexion réussie';

// commander le clique du bouton ajouter pour éxécuter l'instruction
if(isset($_POST['validate'])) {
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
$vild = trim($_POST['villede']);
$paysd = trim($_POST['paysde']);
$vila = trim($_POST['villear']);
$paysa = trim($_POST['paysar']);
$prix = trim($_POST['prix']);
$espace = trim($_POST['esp']);
$datede = trim($_POST['date']);
$bagmain = trim($_POST['bag']);
$livraison = trim($_POST['liv']);
$vendeur = trim($_POST['nom']);
$contact = trim($_POST['num']);
$detail = trim($_POST['details']);

    // Vérifier que tous les champs sont remplis
    if (!empty($vild) && !empty($vila) && !empty($vila) && !empty($paysa) && !empty($vendeur) && !empty($contact) && !empty($datede) && !empty($espace)) {
        // Préparer la requête SQL pour insérer les données
        $stmt = $pdo->prepare("INSERT INTO espace (VILLE_DEPART,PAYS_DEPART,VILLE_ARRIVE,PAYS_ARRIVE,PRIX,POIDS,NOM_VENDEUR,TYPE_BAGAGE,LIVRAISON,DETAIL_BAGAGE,CONTACT,DATE_DEPART) VALUES (:villede, :paysde, :villear, :paysar, :prix, :esp, :nom, :bag, :liv, :details, :num, :date)");
        $stmt->bindParam(':villede', $vild);
        $stmt->bindParam(':paysde', $paysd);
        $stmt->bindParam(':villear', $vila);
        $stmt->bindParam(':paysar', $paysa);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':esp', $espace);
        $stmt->bindParam(':nom', $vendeur);
        $stmt->bindParam(':bag', $bagmain);
        $stmt->bindParam(':liv', $livraison);
        $stmt->bindParam(':details', $detail);
        $stmt->bindParam(':num', $contact);
        $stmt->bindParam(':date', $datede);


        // Exécuter la requête
        if ($stmt->execute()) {
            // Rediriger vers une autre page si l'insertion est réussie
            header("Location: MesBagages.php"); // Remplacez par l'URL de votre page de succès
            echo "Vos informations ont été sauvegardées";
            exit();
        } else {
            echo "Erreur lors de l'ajout de l'utilisateur.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
}

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ajouter un bagage</title>
<link rel="stylesheet" href="Ajout.css">
</head>
<body>
<div class="container">
<aside class="sidebar">
<div class="user-info">
<img src="" alt="User Avatar">
<span>SpaceEvent</span>
</div>
<nav>
<ul>
<li><a href="Acceuil.php">Accueil</a></li>
<li><a href="MesReser.php">Mes Réservations</a></li>
<li><a href="MesBagages.php">Mes Bagages</a></li>
<li><a href="Ajout.php" class="active">Ajouter Un Bagage</a></li>
<li><a href="Reserver.php">Réserver un Bagage</a></li>
<li><a href="Compte.php">Mon Compte</a></li>
</ul>
</nav>
</aside>
<main class="main-content">
<header>
    <h1>Ajouter un bagage</h1>
    <div class="user-info">
    <button type="button" class="btn quitter"><a href="login.html" style="color: black; text-decoration: none;">Deconnexion</a></button>
    <img src="C:\xamppp\htdocs\Space.WEB\Espace de Voyage\20240302_230635.jpg" alt="User Avatar">
    <span><?php echo htmlspecialchars($username); ?></span>
    </div>
    </header>
    <h2>Remplissez le formulaire suivant :</h2>
    <br>
    <div class="form-group">

<form id="myForm" action="Ajout.php" method="POST">
    <button type="submit" class="btn quitter" onclick=sendFormData() name="validate">Ajouter</button>
    <fieldset>
    <legend>INFORMATIONS DE DEPART</legend>
    <label for="ville-depart">Ville de départ</label>
    <select type="text" id="ville-depart" name="villede" class="form-select" required>
    <option selected>Choisir une ville</option>
        <option value="Yaoundé">Yaoundé</option>
        <option value="Lagos">Lagos</option>
        <option value="Abidjan">Abidjan</option>
        <option value="Dakar">Dakar</option>
    </select>
    <label for="pays-depart">Pays de départ</label>
    <select type="text" id="pays-depart" name="paysde" class="form-select" required>
        <option selected>Choisir un pays</option>
        <option value="CAMEROUN">CAMEROUN</option>
        <option value="NIGERIA">NIGERIA</option>
        <option value="COTE D'IVOIRE ">COTE D'IVOIRE</option>
        <option value="SENEGAL">SENEGAL</option>
    </select>
    </fieldset>
    <fieldset>
    <legend>INFORMATIONS D'ARRIVEE</legend>
    <label for="ville-arrivee">Ville d'arrivée</label>
    <select type="text" id="ville-arrive" name="villear" class="form-select" required>
        <option selected>Choisir une ville</option>
            <option value="Yaoundé">Yaoundé</option>
            <option value="Lagos">Lagos</option>
            <option value="Abidjan">Abidjan</option>
            <option value="Dakar">Dakar</option>
        </select>
    <label for="pays-arrivee">Pays d'arrivée</label>
    <select type="text" id="pays-arrive" name="paysar" class="form-select" required>
        <option selected>Choisir un pays</option>
        <option value="CAMEROUN">CAMEROUN</option>
        <option value="NIGERIA">NIGERIA</option>
        <option value="COTE D'IVOIRE ">COTE D'IVOIRE</option>
        <option value="SENEGAL">SENEGAL</option>
    </select>
    </fieldset>
    </div>
    <div class="form-group">
    <fieldset>
    <legend>INFORMATIONS DU BAGAGE</legend>
    <label for="prix-kg">Prix du kg</label>
    <input type="number" id="prix" name="prix" placeholder="Entrez un prix" required>
    <label for="espace-disponible">Espace disponible</label>
    <input type="number" id="espace" name="esp"
    placeholder="Entrez un espace" required>
    <label for="date-depart">Date de départ</label>
    <input type="date" id="date-depart" name="date" placeholder="Entrez une date" required>
    <div>
        <input type="checkbox" value="bagage à main" id="bagage1" name="bag" >Bagage à main
        <input type="checkbox" value="bagage à la soute" id="bagage2" name="bag" >Bagage à la soute
        <input type="checkbox" value="livraison valide" id="second" name="liv" >Livraison du bagage
    </div>
    </fieldset>
    <fieldset>
        <legend>INFORMATIONS DU TENANCIER</legend>
        <label for="nom">Nom du tenancier</label>
        <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" required>
        <label for="nom">Contact</label>
        <input type="text" id="nom" name="num" placeholder="Entrez votre numéro de téléphone" required>
        </fieldset>
    <fieldset>
    <legend for="details">Ajouter des détails</legend>
    <textarea id="detail" name="details" placeholder="Entrez un détail" required></textarea>
    </fieldset>
    </div>
    
</form>

</main>
</div>
