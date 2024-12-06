Page d’Ajout d »un formulaire lié à la base de données

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

Style.css
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(#c0e3cf,#cbe0f5, #f5deb480);
        }
    .container {
    display: flex;
    flex-wrap: wrap;
    min-height: 100vh;
    }
    .sidebar {
        background: linear-gradient(#49d6eb,#6c7a8f) ;
        color: rgb(5, 5, 5);
        width: 250px;
        margin-left: 20px;
        margin-right: 10px;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 20px;
        flex-shrink: 0;
        box-shadow: 0 2px 10px rgb(0, 0, 0);
        }
    .user-info {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    }
    .user-info img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
    }
    .sidebar nav ul {
    list-style: none;
    }
    .sidebar nav ul li {
    margin-bottom: 10px;
    }
    .sidebar nav ul li a {
    color: rgb(4, 4, 4);
    text-decoration: none;
    padding: 10px;
    display: block;
    border-radius: 5px;
    transition: background 0.3s;
    }
    .sidebar nav ul li a.active,
    .sidebar nav ul li a:hover {
    background: #213c4183;
    }
    .main-content {
        background:linear-gradient(#eff0ef);
        padding: 20px;
        background-position: center;
        background-repeat: no-repeat;  
        background-size: cover;
        flex: 1;
        margin-bottom: 20px;
        margin-top: 20px;
        margin-right: 20px;
        margin-left: 15px;
        box-shadow: 0 2px 10px rgb(0, 0, 0);
        overflow-y: auto; /* Permettre le défilement si le contenu dépasse la hauteur */
        max-height: calc(100vh - 40px); /* Limiter la hauteur pour permettre le défilement */
        border:10px;

        }
    header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    }
    h1 {
    font-size: 24px;
    color: #262728;
    }
    h2 {
        font-size: 18px;
        color: #262728;
        margin-bottom: 10px;
        }
    span {
    font-size: 18px;
    color: #1a1b1c;
    }
    .baggage-form h2 {
    margin-bottom: 20px;
    color: #1e2021;
    }
    .form-group {
    margin-bottom: 20px;
    }
    fieldset {
    border: 1px solid #ecf0f3;
    padding: 10px;
    margin-top: 20px;
    border-radius: 5px;
    box-shadow: 0 5px 3px rgb(0, 0, 0);
    
    }
    legend {
    padding: 0 10px;
    color: #021d1d;
    }
    label {
    display: block;
    margin-bottom: 5px;
    color: #020f22;
    }
    input[type="text"],
    input[type="date"],
    input[type="number"],
    select[type="text"],
    textarea {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #0f0f10;
    border-radius: 5px;
    backdrop-filter: blur(-200px);
    box-shadow: 0 0px 1px rgb(242, 237, 237);
    background: linear-gradient(#edeff0, #7aabb8ab) ;
    }
    input[type="checkbox"]{
    padding: 10px;
    margin-top: 15px;
    margin-left: 10px;
    border: 1px solid #bdc3c7;
    border-radius: 5px;
    backdrop-filter: blur(-200px);
    box-shadow: 0 0px 1px rgb(242, 237, 237);
    background: linear-gradient(#f8fafbec, #3e9fbcab) ;
    }
    textarea {
    height: 100px;
    resize: none;
    overflow-y: auto;
    }

    .form-buttons {
    display: flex;
    justify-content: space-between;
    }
    .btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
    }
    .quitter {
    background: linear-gradient(#49d6eb,#6c7a8f) ;
    color: rgb(0, 0, 0);
    margin-top: 15px;
    margin-right: 15px;
    }²
    .Ajouter {
    background: linear-gradient(#49d6eb,#6c7a8f) ;
    color: rgb(2, 2, 2);
    margin-left:12px ;
    }
    @media (max-width: 768px) {
    .sidebar {
    width: 100%;
    flex-shrink: 1;
    }
    .main-content {
    width: 100%;
    }
    }

Page de sauvegardes des informations du formulaire après le clic du bouton « Ajouter »

<?php

// Vérification de l'authentification de l'utilisateur
//if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    //header('Location: login.html');
    //exit;
//}

// Récupérer le nom d'utilisateur
//$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Invité';

 $serveur="localhost";  
 $login="root";
 $password="";

 try{
  $connexion=new PDO("mysql:host=$serveur;dbname=voyage",$login,$password);
  $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  echo 'connexion réussie';
 }catch(PDOException $e){
  die('Echec:'.$e->getMessage());
 }
 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="MesBagages.css">
<title>Mes Bagages</title>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="user-info">
                <img src="user-avatar.png" alt="User Avatar">
                <span>SpaceEvent</span>
            </div>
            <nav>
                <ul>
                    <li><a href="Acceuil.php">Accueil</a></li>
                    <li><a href="MesReser.php">Mes Réservations</a></li>
                    <li><a href="MesBagages.php" class="active">Mes Bagages</a></li>
                    <li><a href="Ajout.php">Ajouter Un Bagage</a></li>
                    <li><a href="Reserver.php">Réserver un Bagage</a></li>
                    <li><a href="Compte.php">Mon Compte</a></li>
                </ul>
            </nav>
        </aside>
        <div class="main-content">
            <header>
                <h1>Mes Bagages</h1>
                <div class="user-info">
                    <button type="button" class="btn quitter"><a href="login.html" style="color: black; text-decoration: none;">Deconnexion</a></button>
                    <img src="C:\xamppp\htdocs\Space.WEB\Espace de Voyage\20240302_230635.jpg" alt="User Avatar">
                    <span><?php //echo htmlspecialchars($username); ?></span>
                </div>
            </header>
            <div class="form-buttons">
                <button type="button" class="btn retour">Retour</button>
                <button type="submit" class="btn rechercher">Rechercher</button>
            </div>
            <div class="container1">
                <table>
                    <thead>
                        <tr>
                            <th>Espace disponible (en Kg) </th>
                            <th>Nom du voyageur</th>
                            <th>Contact</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Connexion à la base de données
                        $serveur = "localhost";
                        $login = "root";
                        $password = "";
                        $database = "voyage";

                        try {
                            $connexion = new PDO("mysql:host=$serveur;dbname=$database", $login, $password);
                            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        } catch (PDOException $e) {
                            die('Echec :' . $e->getMessage());
                        }

                        // Récupérer les enregistrements
                        $query = $connexion->query("SELECT * FROM espace");

                        // Supprimer l'enregistrement si l'ID est passé via l'URL
                        if (isset($_GET['supprimer'])) {
                            $id = intval($_GET['supprimer']);
                            if ($id > 0) {
                                $deleteQuery = $connexion->prepare("DELETE FROM espace WHERE ID_ESPACE = ?");
                                $deleteQuery->execute([$id]);
                                // Rediriger pour éviter les doublons
                                header("Location: MesBagages.php");
                                exit();
                            }
                        }
                        ?>

                        <?php while ($row = $query->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['POIDS']); ?></td>
                                <td><?php echo htmlspecialchars($row['NOM_VENDEUR']); ?></td>
                                <td><?php echo htmlspecialchars($row['CONTACT']); ?></td>
                                <td>
                                    <a href="MettreAjour.php?id=<?php echo htmlspecialchars($row['ID_ESPACE']); ?>" class="btn supprimer" style="color: black; text-decoration: none;">Modifier</a>
                                    <a href="?supprimer=<?php echo htmlspecialchars($row['ID_ESPACE']); ?>" class="btn supprimer" style="color: black; text-decoration: none;">Supprimer</a>
                                    <a href="Ajout2.php?id=<?php echo htmlspecialchars($row['ID_ESPACE']); ?>" class="btn supprimer" style="color: black; text-decoration: none;">Voir+</a>
                                    <a href="Ajout2.php?id=<?php echo htmlspecialchars($row['ID_ESPACE']); ?>" class="btn supprimer" style="color: black; text-decoration: none;">Vendu</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>


* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(#c0e3cf,#cbe0f5, #f5deb480) ;
        }
    .container {
    display: flex;
    flex-wrap: wrap;
    min-height: 100vh;
    }
    .sidebar {
        background: linear-gradient(#49d6eb,#6c7a8f) ;
        color: rgb(5, 5, 5);
        width: 250px;
        margin-left: 20px;
        margin-right: 10px;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 20px;
        flex-shrink: 0;
        box-shadow: 0 2px 10px rgb(0, 0, 0);
        }
    .user-info {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    }
    .user-info img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
    }
    .sidebar nav ul {
    list-style: none;
    }
    .sidebar nav ul li {
    margin-bottom: 10px;
    }
    .sidebar nav ul li a {
    color: rgb(4, 4, 4);
    text-decoration: none;
    padding: 10px;
    display: block;
    border-radius: 5px;
    transition: background 0.3s;
    }
    .sidebar nav ul li a.active,
    .sidebar nav ul li a:hover {
    background: #213c4183;
    }
    .main-content {
        background:linear-gradient(#eff0ef);
        padding: 20px;
        background-image:url('C:\Users\Administrator\Pictures\freepik image\Espace de Voyage\058b7ac20e11f3ce88a8a396af62f211.jpg');
        background-position: center;
        background-repeat: no-repeat;  
        background-size: cover;
        flex: 1;
        margin-bottom: 20px;
        margin-top: 20px;
        margin-right: 20px;
        margin-left: 15px;
        box-shadow: 0 2px 10px rgb(0, 0, 0);
        overflow-y: auto; /* Permettre le défilement si le contenu dépasse la hauteur */
        max-height: calc(100vh - 40px); /* Limiter la hauteur pour permettre le défilement */
        border:10px;

        }
    .container1 {
        background: rgba(239, 243, 245, 0.2);
        border-radius: 10px;
        padding: 20px;
        width: 100%;
        max-width: 1400px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        margin-top: 40px;
        }
    h1 {
text-align: center;
color: #fff;
}
table {
width: 100%;
border-collapse: collapse;
margin-top: 20px;
}
th, td {
padding: 10px;
text-align:left;
color: #171616;
}

    header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    }
    h1 {
    font-size: 24px;
    color: #2c3e50;
    }
    .username {
    font-size: 18px;
    color: #2c3e50;
    }

   
    .btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
    }
    .quitter {
    margin-top:15px ;
    background:linear-gradient(#49d6eb,#6c7a8f) ;
    color: rgb(19, 19, 19);
    }
    .retour {
    background: linear-gradient(#49d6eb,#6c7a8f) ;
    color: rgb(8, 8, 8);
    }
    .supprimer {
    background: linear-gradient(#49d6eb,#6c7a8f) ;
    color: rgb(9, 9, 9);
    margin-top:5px ;
    }
    .mettre {
    background: linear-gradient(#49d6eb,#6c7a8f) ;
    color: rgb(10, 10, 10);
    margin-right: 15px;
        }
    @media (max-width: 768px) {
    .sidebar {
    width: 100%;
    flex-shrink: 1;
    }
    .main-content {
    width: 100%;
    }
    }
Page de modification du formulaire

<?php
$serveur = "localhost";
$login = "root";
$password = "";
$database = "voyage";

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$database", $login, $password);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Echec :' . $e->getMessage());
}
// Vérifier que l'ID est passé dans l'URL
$id = isset($_GET['id']) ? $_GET['id'] : '';

if (!$id) {
    die("ID non spécifié.");
}

// Préparer et exécuter la requête pour récupérer les données
$query = $connexion->prepare("SELECT * FROM espace WHERE ID_ESPACE = ?");
$query->execute([$id]);
$data = $query->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    die("Aucune donnée trouvée pour cet ID.");
}

/// Traitement du formulaire de mise à jour
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $vild = $_POST['villede'];
    $paysd = $_POST['paysde'];
    $vila = $_POST['villear'];
    $paysa = $_POST['paysar'];
    $prix = $_POST['prix'];
    $poids = $_POST['esp'];
    $date = $_POST['date'];
    
    // Gestion des cases à cocher : combine les valeurs en une seule chaîne
    $bag =$_POST['bag'];

    $liv = $_POST['liv'];
    $nom_vendeur = $_POST['nom'];
    $contact = $_POST['num'];
    $detail = $_POST['details'];

   

    // Mise à jour des données
    $updateQuery = $connexion->prepare("
        UPDATE espace 
        SET VILLE_DEPART = ?, PAYS_DEPART = ?, VILLE_ARRIVE = ?, PAYS_ARRIVE = ?, 
            PRIX = ?, POIDS = ?, NOM_VENDEUR = ?, TYPE_BAGAGE = ?, LIVRAISON = ?, 
            DETAIL_BAGAGE = ?, CONTACT = ?, DATE_DEPART = ? 
        WHERE ID_ESPACE = ?
    ");
    $updateQuery->execute([$vild, $paysd, $vila, $paysa, $prix, $poids, $nom_vendeur, $bag, $liv, $detail, $contact, $date, $id]);

    // Rediriger vers la page de liste après la mise à jour
    //header("Location: MesBagages.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mettre à jour</title>
<link rel="stylesheet" href="MettreAJour.css">
</head>
<body>
<div class="container">
<aside class="sidebar">
<div class="user-info">
<img src="user-avatar.png" alt="User Avatar">
<span>SpaceEvent</span>
</div>
<nav>
<ul>
<li><a href="Acceuil.php">Accueil</a></li>
<li><a href="MesReser.php">Mes Réservations</a></li>
<li><a href="MesBagages.php" class="active">Mes Bagages</a></li>
<li><a href="Ajout.php" >Ajouter Un Bagage</a></li>
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
                <span>Username</span>
            </div>
</header>
<h2>Remplissez le formulaire suivant :</h2>
    <button type="button" class="btn quitter">Quitter</button>
    <button type="button" class="btn quitter"><a href="MesBagages.php" class= "MesBagages.php" style="color: black; text-decoration: none;" >Retour</a></button>
    
<div class="form-group">
<form id="myForm" action="MettreAjour.php?id=<?php echo htmlspecialchars($data['ID_ESPACE']); ?>" method="POST"><!--l'action permet de relier la page de mise à jour  -->
<!--le paramètre hidden permet de cacher la valeur de ce que l'on souhaite éxécuter, au navigateur, la valeur de l'ID'ESPACE ne s'affichera pas pourtant il est spécifié dans le code-->
<input type="hidden" name="id" value="<?php echo htmlspecialchars($data['ID_ESPACE']); ?>"><!--le value permet de récupérer l'information enregistré dans la BD -->
    <fieldset>
    <legend>INFORMATIONS DE DEPART</legend>
    <label for="ville-depart">Ville de départ</label>
    <select type="text" id="ville-depart" name="villede" class="form-select" required>
    <option selected>Choisir une ville</option>
    <option value="Yaoundé" <?php if ($data['VILLE_DEPART'] == 'Yaoundé') echo 'selected'; ?>>Yaoundé</option> <!--le value permet de récupérer et afficher l'information de la BD pour des balises option-->
        <option value="Lagos" <?php if ($data['VILLE_DEPART'] == 'Lagos') echo 'selected'; ?>>Lagos</option>
        <option value="Abidjan" <?php if ($data['VILLE_DEPART'] == 'Abidjan') echo 'selected'; ?>>Abidjan</option>
        <option value="Dakar" <?php if ($data['VILLE_DEPART'] == 'Dakar') echo 'selected'; ?>>Dakar</option>
    </select>
    <label for="pays-depart">Pays de départ</label>
    <select type="text" id="pays-depart" name="paysde" class="form-select" required>
    <option value="CAMEROUN" <?php if ($data['PAYS_DEPART'] == 'CAMEROUN') echo 'selected'; ?>>CAMEROUN</option>
        <option value="NIGERIA" <?php if ($data['PAYS_DEPART'] == 'NIGERIA') echo 'selected'; ?>>NIGERIA</option>
        <option value="COTE D'IVOIRE" <?php if ($data['PAYS_DEPART'] == 'COTE D\'IVOIRE') echo 'selected'; ?>>COTE D'IVOIRE</option>
        <option value="SENEGAL" <?php if ($data['PAYS_DEPART'] == 'SENEGAL') echo 'selected'; ?>>SENEGAL</option>
    </select>
    </fieldset>
    <fieldset>
    <legend>INFORMATIONS D'ARRIVEE</legend>
    <label for="ville-arrivee">Ville d'arrivée</label>
    <select type="text" id="ville-arrive" name="villear" class="form-select" required>
        <option selected>Choisir une ville</option>
        <option value="Yaoundé" <?php if ($data['VILLE_ARRIVE'] == 'Yaoundé') echo 'selected'; ?>>Yaoundé</option>
        <option value="Lagos" <?php if ($data['VILLE_ARRIVE'] == 'Lagos') echo 'selected'; ?>>Lagos</option>
        <option value="Abidjan" <?php if ($data['VILLE_ARRIVE'] == 'Abidjan') echo 'selected'; ?>>Abidjan</option>
        <option value="Dakar" <?php if ($data['VILLE_ARRIVE'] == 'Dakar') echo 'selected'; ?>>Dakar</option>
    </select>
        </select>
    <label for="pays-arrivee">Pays d'arrivée</label>
    <select type="text" id="pays-arrive" name="paysar" class="form-select" required>
        <option selected>Choisir un pays</option>
        <option value="CAMEROUN" <?php if ($data['PAYS_ARRIVE'] == 'CAMEROUN') echo 'selected'; ?>>CAMEROUN</option>
        <option value="NIGERIA" <?php if ($data['PAYS_ARRIVE'] == 'NIGERIA') echo 'selected'; ?>>NIGERIA</option>
        <option value="COTE D'IVOIRE" <?php if ($data['PAYS_ARRIVE'] == 'COTE D\'IVOIRE') echo 'selected'; ?>>COTE D'IVOIRE</option>
        <option value="SENEGAL" <?php if ($data['PAYS_ARRIVE'] == 'SENEGAL') echo 'selected'; ?>>SENEGAL</option>
    </select>
    </select>
    </fieldset>
    </div>
    <div class="form-group">
    <fieldset>
    <legend>INFORMATIONS DU BAGAGE</legend>
    <label for="prix-kg">Prix du kg</label>
    <input type="number" id="prix" name="prix" placeholder="Entrez un prix" value="<?php echo htmlspecialchars($data['PRIX']); ?>" required><!--le value permet de récupérer et afficher l'information sauvegardée dans la BD-->
    <label for="espace-disponible">Espace disponible</label>
    <input type="number" id="espace" name="esp" placeholder="Entrez un espace" value="<?php echo htmlspecialchars($data['POIDS']); ?>"required>
    <label for="date-depart">Date de départ</label>
    <input type="date" id="date-depart" name="date" placeholder="Entrez une date" value="<?php echo htmlspecialchars($data['DATE_DEPART']); ?>" required>
    <div>
        <!-- Valeur cachée pour 'bag' -->
<input type="hidden" name="bag" value="">
        <input type="checkbox" id="bagage1" name="bag" value="bagage à main" <?php if (in_array('bagage à main', explode(',', $data['TYPE_BAGAGE']))) echo 'checked'; ?>>Bagage à main<!--le value permet de récupérer et afficher l'information sauvegardée dans la BD pour les checkboxs-->
        <input type="checkbox" id="bagage2" name="bag" value="bagage à la soute" <?php if (in_array('bagage à la soute', explode(',', $data['TYPE_BAGAGE']))) echo 'checked'; ?>>Bagage à la soute
        <!-- Valeur cachée pour 'liv' -->
<input type="hidden" name="liv" value="">
        <input type="checkbox" id="second" name="liv" value="livraison valide" <?php if (in_array('livraison valide', explode(',', $data['LIVRAISON']))) echo 'checked'; ?> >Livraison du bagage
    </div>
    </fieldset>
    <fieldset>
        <legend>INFORMATIONS DU TENANCIER</legend>
        <label for="nom">Nom du tenancier</label>
        <input type="text" id="nom" name="nom" placeholder="Entrez votre nom"  value="<?php echo htmlspecialchars($data['NOM_VENDEUR']); ?>" required>
        <label for="nom">Contact</label>
        <input type="text" id="nom" name="num" placeholder="Entrez votre numéro de téléphone" value="<?php echo htmlspecialchars($data['CONTACT']); ?>" required>
        </fieldset>
    <fieldset>
    <legend for="details">Ajouter des détails</legend>
    <textarea id="detail" name="details" placeholder="Entrez un détail" required><?php echo htmlspecialchars($data['DETAIL_BAGAGE']); ?></textarea><!--la balise php ouverte permet de récupérer et afficher l'information sauvegardée dans la BD pour les textarea-->
    </fieldset>
    </div>

    <button class="btn quitter" name="update" type="submit" >Modifier</button>

    
</form>

</main>
</div>
</body>
</html>

<?php
?>
CSS
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(#c0e3cf,#cbe0f5, #f5deb480) ;
        }
    .container {
    display: flex;
    flex-wrap: wrap;
    min-height: 100vh;
    }
    .sidebar {
        background: linear-gradient(#49d6eb,#6c7a8f) ;
        color: rgb(5, 5, 5);
        width: 250px;
        margin-left: 20px;
        margin-right: 10px;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 20px;
        flex-shrink: 0;
        box-shadow: 0 2px 10px rgb(0, 0, 0);
        }
    .user-info {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    }
    .user-info img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
    }
    .sidebar nav ul {
    list-style: none;
    }
    .sidebar nav ul li {
    margin-bottom: 10px;
    }
    .sidebar nav ul li a {
    color: rgb(4, 4, 4);
    text-decoration: none;
    padding: 10px;
    display: block;
    border-radius: 5px;
    transition: background 0.3s;
    }
    .sidebar nav ul li a.active,
    .sidebar nav ul li a:hover {
    background: #213c4183;
    }
    .main-content {
        background:linear-gradient(#eff0ef);
        padding: 20px;
        background-image:url('C:\Users\Administrator\Pictures\freepik image\Espace de Voyage\058b7ac20e11f3ce88a8a396af62f211.jpg');
        background-position: center;
        background-repeat: no-repeat;  
        background-size: cover;
        flex: 1;
        margin-bottom: 20px;
        margin-top: 20px;
        margin-right: 20px;
        margin-left: 15px;
        box-shadow: 0 2px 10px rgb(0, 0, 0);
        overflow-y: auto; /* Permettre le défilement si le contenu dépasse la hauteur */
        max-height: calc(100vh - 40px); /* Limiter la hauteur pour permettre le défilement */
        border:10px;

        }
    header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    }
    h1 {
    font-size: 24px;
    color: #262728;
    }
    h2 {
        font-size: 24px;
        color: #262728;
        margin-bottom: 10px;
        }
    span {
    font-size: 18px;
    color: #1a1b1c;
    }
    .baggage-form h2 {
    margin-bottom: 20px;
    color: #1e2021;
    }
    .form-group {
    margin-bottom: 20px;
    }
    fieldset {
    border: 1px solid #ecf0f3;
    padding: 10px;
    margin-top: 20px;
    border-radius: 5px;
    box-shadow: 0 5px 3px rgb(0, 0, 0);
    
    }
    legend {
    padding: 0 10px;
    color: #021d1d;
    }
    label {
    display: block;
    margin-bottom: 5px;
    color: #020f22;
    }
    input[type="text"],
    input[type="date"],
    input[type="number"],
    select[type="text"],
    textarea {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #0f0f10;
    border-radius: 5px;
    backdrop-filter: blur(-200px);
    box-shadow: 0 0px 1px rgb(242, 237, 237);
    background: linear-gradient(#edeff0, #7aabb8ab) ;
    }
    input[type="checkbox"]{
    padding: 10px;
    margin-top: 15px;
    margin-left: 10px;
    border: 1px solid #bdc3c7;
    border-radius: 5px;
    backdrop-filter: blur(-200px);
    box-shadow: 0 0px 1px rgb(242, 237, 237);
    background: linear-gradient(#f8fafbec, #3e9fbcab) ;
    }
    textarea {
    height: 100px;
    resize: none;
    overflow-y: auto;
    }

    .form-buttons {
    display: flex;
    justify-content: space-between;
    }
    .btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
    margin-top: 10px;
    }
    .quitter {
    background: linear-gradient(#49d6eb,#6c7a8f) ;
    color: rgb(12, 12, 12);
    margin-left: 15px;
    }
    .lien{
        text-decoration: none;
        color: #101010;
    }
    
    @media (max-width: 768px) {
    .sidebar {
    width: 100%;
    flex-shrink: 1;
    }
    .main-content {
    width: 100%;
    }
    }


PAGE DE VOIRPLUS DES INFORMATIONS D4UN FORMULAIRE

<?php
 $serveur="localhost";  
 $login="root";
 $password="";

 try{
  $connexion=new PDO("mysql:host=$serveur;dbname=voyage",$login,$password);

// Vous pouvez également activer le mode d'erreur PDO pour voir s'il y a des erreurs lors de l'exécution :
  $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  echo 'connexion réussie';
 }catch(PDOException $e){
  die('Echec:'.$e->getMessage());
 }


?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="Ajout2.css">
<title>Mes Bagages</title>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
        <div class="user-info">
        <button type="button" class="btn quitter"><a href="login.html" style="color: black; text-decoration: none;">Deconnexion</a></button>
        <img src="" alt="User Avatar">
        <span>SpaceEvent</span>
        </div>
        <nav>
        <ul>
        <li><a href="Acceuil.php">Accueil</a></li>
        <li><a href="MesReser.php" >Mes Réservations</a></li>
        <li><a href="MesBagages.php" class="active" >Mes Bagages</a></li>
        <li><a href="Ajout.php" >Ajouter Un Bagage</a></li>
        <li><a href="Reserver.php">Réserver un Bagage</a></li>
        <li><a href="Compte.php">Mon Compte</a></li>
        </ul>
        </nav>
        </aside>
        <div class="main-content">
            <header>
                <h1>Détails de mes bagages</h1>  
                <div class="user-info"><img src="C:\xamppp\htdocs\Space.WEB\Espace de Voyage\20240302_230635.jpg" alt="User Avatar">
                <span>Username</span>
            </div>
                </header>
            <button type="button" class="btn quitter"><a href="MesBagages.php" class="lien">Retour</a></button>
            <div class='container1' id='infodisplay'>
        <tbody>
            <?php
          // Récupérer l'identifiant depuis l'URL
$id_espace = isset($_GET['id']) ? intval($_GET['id']) : 0;
//echo "ID récupéré : " . $id_espace; // Ajoutez cette ligne pour déboguer

// Vérifiez si l'ID est valide
if ($id_espace > 0) {
    // Préparer la requête SQL pour sélectionner l'enregistrement correspondant à l'ID
    $sql = "SELECT * FROM espace WHERE ID_ESPACE = :id"; // Utilisez le paramètre :id ici
    $stmt = $connexion->prepare($sql);
    
    // Lier le paramètre à la requête
    $stmt->bindParam(':id', $id_espace, PDO::PARAM_INT);
    
    // Exécuter la requête
    if ($stmt->execute()) {
        // Récupérer le résultat
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Vérifiez si des résultats ont été trouvés
        if ($result) {
            echo "<h1>Détails du bagage</h1><br>";
            echo "<p><strong>Espace disponible (en kg):</strong> " . htmlspecialchars($result["POIDS"]) . "</p>";
            echo "<p><strong>Nom du voyageur:</strong> " . htmlspecialchars($result["NOM_VENDEUR"]) . "</p>";
            echo "<p><strong>Contact:</strong> " . htmlspecialchars($result["CONTACT"]) . "</p>";
            echo "<p><strong>Ville de départ :</strong> " . htmlspecialchars($result["VILLE_DEPART"]) . "</p>";
            echo "<p><strong>Pays de départ :</strong> " . htmlspecialchars($result["PAYS_DEPART"]) . "</p>";
            echo "<p><strong>Ville d'arrivée :</strong> " . htmlspecialchars($result["VILLE_ARRIVE"]) . "</p>";
            echo "<p><strong>Pays d'arrivée :</strong> " . htmlspecialchars($result["PAYS_ARRIVE"]) . "</p>";
            echo "<p><strong>Prix :</strong> " . htmlspecialchars($result["PRIX"]) . "</p>";
            echo "<p><strong>Date de départ :</strong> " . htmlspecialchars($result["DATE_DEPART"]) . "</p>";
            echo "<p><strong>Bagage :</strong> " . htmlspecialchars($result["TYPE_BAGAGE"]) . "</p>";
            echo "<p><strong>Livraison:</strong> " . htmlspecialchars($result["LIVRAISON"]) . "</p>";
            echo "<p><strong>Détails :</strong> " . htmlspecialchars($result["DETAIL_BAGAGE"]) . "</p>";
        } else {
            echo "<div><p>Aucun enregistrement trouvé.</p></div>";
        }
    } else {
        echo "<div><p>Erreur lors de l'exécution de la requête.</p></div>";
    }
} else {
    echo "<div><p>ID invalide.</p></div>";
}

            ?>
        </tbody>
    </table>
            </div>
        <p></p><br>
        </div>
        
<script>
     //function getQueryParam(param) {
            //const urlParams = new URLSearchParams(window.location.search);
            //return urlParams.get(param);
        //}

       // const jsonData = decodeURIComponent(getQueryParam('data'));
        //const formData = JSON.parse(jsonData);

        //document.getElementById('ville1').textContent = `Ville de départ: ${formData.villedepart}`;
        //document.getElementById('pays1').textContent = `Pyas de départ: ${formData.paysdepart}`;
        //document.getElementById('ville2').textContent = `Ville de départ: ${formData.villearrive}`;
        //document.getElementById('pays2').textContent = `Pays de départ: ${formData.paysarrive}`;


        //document.getElementById('espace').textContent = `Ville de départ: ${formData.espace}`;
        //document.getElementById('prix').textContent = `Pays de départ: ${formData.prix}`;
        //document.getElementById('date').textContent = `Ville de départ: ${formData.datedepart}`;
        //document.getElementById('nom').textContent = `Pays de départ: ${formData.nom}`;
        //document.getElementById('detail').textContent = `Ville de départ: ${formData.detail}`;

//window.onload = function() {
    //console.log('Page d\'affichage chargée');
   // const villedepart = localStorage.getItem('ville-depart');
    //const paysdepart = localStorage.getItem('pays-depart');
    //if (villedepart && paysdepart) {
        //document.getElementById('infodisplay').innerHTML = `<p>Ville de départ: ${villedepart}</p><p>Pays de départ: ${paysdepart}</p>`;
        //console.log('Données affichées');
    //} else {
        //console.error('Les données ne sont pas disponibles dans le localStorage.');
    //}
//};

//const villedepart = localStorage.getItem('ville-depart');
//const paysdepart = localStorage.getItem('pays-depart');
//const infodisplay = document.getElementById('infodisplay');
//if (villedepart || paysdepart){
    //infodisplay.innerHTML= '<p>Villededépart:${ville-depart}</p>'
//'<p>paysdedépart:${pays-depart}</p>' 
//}else{
    //'<p>Aucune information</p>';   
//}

//function getQueryParams(){
    //const params = {};
    //const queryString = window.location.search.substring(1);
    //const regex = /([^&=]+)=([^&]*)/g;
    //let m ;
    //while (m=regex.exec(queryString)){
        //params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
    //}
    //return params;
//}
//const queryParams = getQueryParams();
//const villedepart = queryParams.villedepart ;
//const paysdepart = queryParams.paysdepart;
//const infodisplay = document.getElementById('infodisplay');
//infodisplay.innerHTML = '<p>Villededépart:${ville-depart}</p>'
//infodisplay.innerHTML = '<p>paysdedépart:${pays-depart}</p>' 
</script>
</body>
</html>

CSS
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(#c0e3cf,#cbe0f5, #f5deb480) ;
        }
    .container {
    display: flex;
    flex-wrap: wrap;
    min-height: 100vh;
    }
    .sidebar {
        background: linear-gradient(#49d6eb,#6c7a8f) ;
        color: rgb(5, 5, 5);
        width: 250px;
        margin-left: 20px;
        margin-right: 10px;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 20px;
        flex-shrink: 0;
        box-shadow: 0 2px 10px rgb(0, 0, 0);
        }
    .user-info {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    }
    .user-info img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
    }
    .sidebar nav ul {
    list-style: none;
    }
    .sidebar nav ul li {
    margin-bottom: 10px;
    }
    .sidebar nav ul li a {
    color: rgb(4, 4, 4);
    text-decoration: none;
    padding: 10px;
    display: block;
    border-radius: 5px;
    transition: background 0.3s;
    }
    .sidebar nav ul li a.active,
    .sidebar nav ul li a:hover {
    background: #213c4183;
    }
    .main-content {
        background:linear-gradient(#eff0ef);
        padding: 20px;
        background-image:url('C:\Users\Administrator\Pictures\freepik image\Espace de Voyage\058b7ac20e11f3ce88a8a396af62f211.jpg');
        background-position: center;
        background-repeat: no-repeat;  
        background-size: cover;
        flex: 1;
        margin-bottom: 20px;
        margin-top: 20px;
        margin-right: 20px;
        margin-left: 15px;
        box-shadow: 0 2px 10px rgb(0, 0, 0);
        overflow-y: auto; /* Permettre le défilement si le contenu dépasse la hauteur */
        max-height: calc(100vh - 40px); /* Limiter la hauteur pour permettre le défilement */
        border:10px;

        }
    .container1 {
        background: rgba(239, 243, 245, 0.2);
        border-radius: 10px;
        padding: 20px;
        width: 100%;
        max-width: 1400px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        margin-top: 40px;
        }
    h1 {
text-align: center;
color: #fff;
}
table {
width: 100%;
border-collapse: collapse;
margin-top: 20px;
}
th, td {
padding: 10px;
text-align:left;
color: #171616;
}

    header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    }
    h1 {
    font-size: 24px;
    color: #2c3e50;
    }
    .username {
    font-size: 18px;
    color: #2c3e50;
    }

   
    .btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
    }
    .quitter {
    margin-top:15px ;
    background:linear-gradient(#49d6eb,#6c7a8f) ;
    color: rgb(19, 19, 19);
    }
    .lien{
        text-decoration: none;
        color: #101010;
    }
    
    @media (max-width: 768px) {
    .sidebar {
    width: 100%;
    flex-shrink: 1;
    }
    .main-content {
    width: 100%;
    }
    }

PAGE DE SUPPRESSION DES INFORMATIONS APRES LE CLIC SUR LE BOUTON SUPPRIMER

// Récupérer les enregistrements
                        $query = $connexion->query("SELECT * FROM espace");

                        // Supprimer l'enregistrement si l'ID est passé via l'URL
                        if (isset($_GET['supprimer'])) {
                            $id = intval($_GET['supprimer']);
                            if ($id > 0) {
                                $deleteQuery = $connexion->prepare("DELETE FROM espace WHERE ID_ESPACE = ?");
                                $deleteQuery->execute([$id]);
                                // Rediriger pour éviter les doublons
                                header("Location: MesBagages.php");
                                exit();
                            }
                        }
PAGE DE RECHERCHE ET RESULTATS

<?php

session_start();
// Vérification de l'authentification de l'utilisateur
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: login.html');
    exit;
}

// Récupérer le nom d'utilisateur
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Invité';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reserver</title>
<link rel="stylesheet" href="Reserver.css">
</head>
<body>
<div class="container">
<aside class="sidebar">
<div class="user-info">
<img src="C:\Users\Administrator\Pictures\freepik image\LOGO\20240302_230620.jpg" alt="User Avatar">
<span>SpaceEvent</span>
</div>
<nav>
<ul>
<li><a href="Acceuil.php">Accueil</a></li><!---->
<li><a href="MesReser.php">Mes Réservations</a></li>
<li><a href="MesBagages.php">Mes Bagages</a></li>
<li><a href="Ajout.php" >Ajouter Un Bagage</a></li>
<li><a href="Reserver.php" class="active">Réserver un Bagage</a></li>
<li><a href="Compte.php">Mon Compte</a></li>
</ul>
</nav>

</aside>
<main class="main-content">
<header class="user-infos">
<h1>Réserver un bagage</h1>
<div class="user-info">
<button type="button" class="btn quitter"><a href="login.html" style="color: black; text-decoration: none;">Deconnexion</a></button>
<img src="C:\xamppp\htdocs\Space.WEB\Espace de Voyage\20240302_230635.jpg" alt="User Avatar">
    <span><?php echo htmlspecialchars($username); ?></span>
</div>
</header>
<div class="form-buttons">
    
    </div>

    <form class="baggage-form" action="" method="POST">
        <h2>Remplissez le formulaire suivant :</h2>
        <button type="submit" class="btn rechercher" name="rechercher" >Rechercher</button>
        <div class="form-group">
            <fieldset>
                <legend>INFORMATIONS</legend>
                <label for="ville-depart">Ville de départ</label>
                <select type="text" id="ville-depart" class="form-select" name="villed">
                    <option selected>Choisir une ville</option>
                    <option value="Yaoundé">Yaoundé</option><!--Ce sont les données des value que la bd sauvegarde-->
                    <option value="Lagos">Lagos</option>
                    <option value="Abidjan">Abidjan</option>
                    <option value="Dakar">Dakar</option>
                </select>
                <label for="pays-depart">Pays de départ</label>
                <select type="text" id="pays-depart" class="form-select" name="paysd">
                    <option selected>Choisir un pays</option>
                    <option value="CAMEROUN">CAMEROUN</option>
                    <option value="NIGERIA">NIGERIA</option>
                    <option value="COTE D'IVOIRE">COTE D'IVOIRE</option>
                    <option value="SENEGAL">SENEGAL</option>
                </select>
                <label for="ville-arrivee">Ville d'arrivée</label>
                <select type="text" id="ville-arrivee" class="form-select" name="villea">
                    <option selected>Choisir une ville</option>
                    <option value="Yaoundé">Yaoundé</option>
                    <option value="Lagos">Lagos</option>
                    <option value="Abidjan">Abidjan</option>
                    <option value="Dakar">Dakar</option>
                </select>
                <label for="pays-arrivee">Pays d'arrivée</label>
                <select type="text" id="pays-arrivee" class="form-select" name="paysa">
                    <option selected>Choisir un pays</option>
                    <option selected>Choisir un pays</option>
                    <option value="CAMEROUN">CAMEROUN</option>
                    <option value="NIGERIA">NIGERIA</option>
                    <option value="COTE D'IVOIRE">COTE D'IVOIRE</option>
                    <option value="SENEGAL">SENEGAL</option>
                </select>
                <label for="espace-disponible">Poids</label>
                <input type="number" id="espace-disponible" name="esp" placeholder="Entrez un espace">
                <label for="date-depart">Date de départ</label>
                <input type="date" id="date-depart" name="date" placeholder="Entrez une date">
            </fieldset>
            
        </div>
    </form>

<?php
// Initialisation de la variable pour éviter les erreurs

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $serveur = "localhost";
    $login = "root";
    $password = "";
    $dbname = "voyage";

    try {
        $connexion = new PDO("mysql:host=$serveur;dbname=$dbname", $login, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

    // Récupération des données du formulaire
    $ville_depart = htmlspecialchars($_POST['villed']);
    $pays_depart = htmlspecialchars($_POST['paysd']);
    $ville_arrivee = htmlspecialchars($_POST['villea']);
    $pays_arrivee = htmlspecialchars($_POST['paysa']);
    $date_depart = htmlspecialchars($_POST['date']);

    // Affichage des valeurs récupérées
    //var_dump($ville_depart, $pays_depart, $ville_arrivee, $pays_arrivee, $espace_disponible, $date_depart);

    // Préparation de la requête SQL
    $sql = "SELECT * FROM espace 
            WHERE VILLE_DEPART = :villed 
              AND PAYS_DEPART = :paysd 
              AND VILLE_ARRIVE = :villea 
              AND PAYS_ARRIVE = :paysa 
              AND DATE_DEPART = :date";

    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':villed', $ville_depart);
    $stmt->bindParam(':paysd', $pays_depart);
    $stmt->bindParam(':villea', $ville_arrivee);
    $stmt->bindParam(':paysa', $pays_arrivee);
    $stmt->bindParam(':date', $date_depart);
    $stmt->execute();
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Vérification des résultats
    if ($stmt->rowCount() > 0) {
        // Stockage des résultats dans la session
        $_SESSION['resultats'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<!DOCTYPE html>
    <html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='MesReser.css'>
        <title>Résultats de Recherche</title>
    </head>
    <body>
        <div class='container'>
            <div class='main-content'>
                <header>
                    <h1>Résultats Trouvés</h1>
                    <!-- User info -->
                </header>
                <div class='container1'>
                    <table>
                        <thead>
                            <tr>
                                <th>Espace</th>
                                <th>Prix</th>
                                <th>Ville de départ</th>
                                <th>Pays de départ</th>
                                <th>Ville d'arrivée</th>
                                <th>Pays d'arrivée</th>
                                <th>Nom du client</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>";
    foreach ($resultats as $row) {
        echo "<tr>
                <td>" . htmlspecialchars($row['POIDS']) . "</td>
                <td>" . htmlspecialchars($row['PRIX']) . "</td>
                <td>" . htmlspecialchars($row['VILLE_DEPART']) . "</td>
                <td>" . htmlspecialchars($row['PAYS_DEPART']) . "</td>
                <td>" . htmlspecialchars($row['VILLE_ARRIVE']) . "</td>
                <td>" . htmlspecialchars($row['PAYS_ARRIVE']) . "</td>
                <td>" . htmlspecialchars($row['NOM_VENDEUR']) . "</td>
                <td>
                    <button type='button' class='btn supprimer'><a href='Voir2.php?id=" . htmlspecialchars($row['ID_ESPACE']) . "' style='color: black; text-decoration: none;'>Voir+</a></button>
                    <button type='button' class='btn supprimer'>Chat</button>
                    <button type='button' class='btn supprimer'>Contact</button>
                </td>
            </tr>";
    }
    echo "                </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </body>
    </html>";

    // Optionally clear the session data after displaying results
    unset($_SESSION['resultats']);
} else {
        echo "Aucun résultat trouvé.";
    }

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

?>
</main>
</div>
</body>
</html>
CSS

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(#c0e3cf,#cbe0f5, #f5deb480) ;
        }
    .container {
    display: flex;
    flex-wrap: wrap;
    min-height: 100vh;
    }
    .sidebar {
        background: linear-gradient(#49d6eb,#6c7a8f) ;
        color: rgb(5, 5, 5);
        width: 250px;
        margin-left: 20px;
        margin-right: 10px;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 20px;
        flex-shrink: 0;
        box-shadow: 0 2px 10px rgb(0, 0, 0);
        }
    .user-info {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    }
    .user-info img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
    }
    .sidebar nav ul {
    list-style: none;
    }
    .sidebar nav ul li {
    margin-bottom: 10px;
    }
    .sidebar nav ul li a {
    color: rgb(4, 4, 4);
    text-decoration: none;
    padding: 10px;
    display: block;
    border-radius: 5px;
    transition: background 0.3s;
    }
    .sidebar nav ul li a.active,
    .sidebar nav ul li a:hover {
    background: #213c4183;
    }
    .main-content {
        background:linear-gradient(#eff0ef);
        padding: 20px;
        background-image:url('C:\Users\Administrator\Pictures\freepik image\Espace de Voyage\058b7ac20e11f3ce88a8a396af62f211.jpg');
        background-position: center;
        background-repeat: no-repeat;  
        background-size: cover;
        flex: 1;
        margin-bottom: 20px;
        margin-top: 20px;
        margin-right: 20px;
        margin-left: 15px;
        box-shadow: 0 2px 10px rgb(0, 0, 0);
        overflow-y: auto; /* Permettre le défilement si le contenu dépasse la hauteur */
        max-height: calc(100vh - 40px); /* Limiter la hauteur pour permettre le défilement */
        border:10px;

        }
    header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    }
    h1 {
    font-size: 24px;
    color: #262728;
    }
    h2 {
        font-size: 18px;
        color: #262728;
        margin-bottom: 10px;
        }
    span {
    font-size: 18px;
    color: #1a1b1c;
    }
    .baggage-form h2 {
    margin-bottom: 20px;
    color: #1e2021;
    }
    .form-group {
    margin-bottom: 20px;
    }
    fieldset {
    border: 1px solid #ecf0f3;
    padding: 10px;
    margin-top: 20px;
    border-radius: 5px;
    box-shadow: 0 5px 3px rgb(0, 0, 0);
    
    }
    legend {
    padding: 0 10px;
    color: #021d1d;
    }
    label {
    display: block;
    margin-bottom: 5px;
    color: #020f22;
    }
    input[type="text"],
    input[type="date"],
    input[type="number"],
    select[type="text"],
    textarea {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #0f0f10;
    border-radius: 5px;
    backdrop-filter: blur(-200px);
    box-shadow: 0 0px 1px rgb(242, 237, 237);
    background: linear-gradient(#edeff0, #7aabb8ab) ;
    }
    input[type="checkbox"]{
    padding: 10px;
    margin-top: 15px;
    margin-left: 10px;
    border: 1px solid #bdc3c7;
    border-radius: 5px;
    backdrop-filter: blur(-200px);
    box-shadow: 0 0px 1px rgb(242, 237, 237);
    background: linear-gradient(#f8fafbec, #3e9fbcab) ;
    }
    textarea {
    height: 100px;
    resize: none;
    overflow-y: auto;
    }

    .form-buttons {
    display: flex;
    justify-content: space-between;
    }
    .btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
    margin-top: 10px;
    }
    .quitter {
    background: linear-gradient(#49d6eb,#6c7a8f) ;
    color: rgb(12, 12, 12);
    }
    .rechercher {
        background: linear-gradient(#49d6eb,#6c7a8f) ;
        color: rgb(12, 12, 12);
    margin-left:15px ;
    }
    @media (max-width: 768px) {
    .sidebar {
    width: 100%;
    flex-shrink: 1;
    }
    .main-content {
    width: 100%;
    }
    }

PAGE VOIRPLUS DE RESULTATS

<?php
 $serveur="localhost";  
 $login="root";
 $password="";

 try{
  $connexion=new PDO("mysql:host=$serveur;dbname=voyage",$login,$password);

// Vous pouvez également activer le mode d'erreur PDO pour voir s'il y a des erreurs lors de l'exécution :
  $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  echo 'connexion réussie';
 }catch(PDOException $e){
  die('Echec:'.$e->getMessage());
 }


?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="Voir2.css">
<title>Mes Bagages</title>
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
        <li><a href="MesReser.php" >Mes Réservations</a></li>
        <li><a href="MesBagages.php"  >Mes Bagages</a></li>
        <li><a href="Ajout.php" >Ajouter Un Bagage</a></li>
        <li><a href="Reserver.php" class="active">Réserver un Bagage</a></li>
        <li><a href="Compte.php">Mon Compte</a></li>
        </ul>
        </nav>
        </aside>
        <div class="main-content">
            <header>
                <h1>Détails de mes bagages</h1>  
                <div class="user-info">
                <button type="button" class="btn quitter"><a href="login.html" style="color: black; text-decoration: none;">Deconnexion</a></button>
                <img src="C:\xamppp\htdocs\Space.WEB\Espace de Voyage\20240302_230635.jpg" alt="User Avatar">
                <span>Username</span>
            </div>
                </header>
            <button type="button" class="btn quitter"><a href="Reserver.php" class="Reserver.php" style="color: black; text-decoration: none;">Retour</a></button>
            <br>

            <button type="button" class="btn quitter">Commander</button>
            <!-- Code d'intégration de Tawk.to -->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/YOUR_TAWK_ID/default'; // Remplacez YOUR_TAWK_ID par votre ID
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>

            <button type="button" class="btn quitter" id="chatButton"><a href="chat.php?id=<?php echo $id_espace; ?>" style="color: black; text-decoration: none;">Chatter</a></button>
            <button type="button" class="btn quitter">Contacter</button>
            <div class='container1' id='infodisplay'>
        <tbody>
            <?php
          // Récupérer l'identifiant depuis l'URL
$id_espace = isset($_GET['id']) ? intval($_GET['id']) : 0;
//echo "ID récupéré : " . $id_espace; // Ajoutez cette ligne pour déboguer

// Vérifiez si l'ID est valide
if ($id_espace > 0) {
    // Préparer la requête SQL pour sélectionner l'enregistrement correspondant à l'ID
    $sql = "SELECT * FROM espace WHERE ID_ESPACE = :id"; // Utilisez le paramètre :id ici
    $stmt = $connexion->prepare($sql);
    
    // Lier le paramètre à la requête
    $stmt->bindParam(':id', $id_espace, PDO::PARAM_INT);
    
    // Exécuter la requête
    if ($stmt->execute()) {
        // Récupérer le résultat
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Vérifiez si des résultats ont été trouvés
        if ($result) {
            echo "<h1>Détails du bagage</h1><br>";
            echo "<p><strong>Espace disponible (en kg):</strong> " . htmlspecialchars($result["POIDS"]) . "</p>";
            echo "<p><strong>Nom du voyageur:</strong> " . htmlspecialchars($result["NOM_VENDEUR"]) . "</p>";
            echo "<p><strong>Contact:</strong> " . htmlspecialchars($result["CONTACT"]) . "</p>";
            echo "<p><strong>Ville de départ :</strong> " . htmlspecialchars($result["VILLE_DEPART"]) . "</p>";
            echo "<p><strong>Pays de départ :</strong> " . htmlspecialchars($result["PAYS_DEPART"]) . "</p>";
            echo "<p><strong>Ville d'arrivée :</strong> " . htmlspecialchars($result["VILLE_ARRIVE"]) . "</p>";
            echo "<p><strong>Pays d'arrivée :</strong> " . htmlspecialchars($result["PAYS_ARRIVE"]) . "</p>";
            echo "<p><strong>Prix :</strong> " . htmlspecialchars($result["PRIX"]) . "</p>";
            echo "<p><strong>Date de départ :</strong> " . htmlspecialchars($result["DATE_DEPART"]) . "</p>";
            echo "<p><strong>Bagage :</strong> " . htmlspecialchars($result["TYPE_BAGAGE"]) . "</p>";
            echo "<p><strong>Livraison:</strong> " . htmlspecialchars($result["LIVRAISON"]) . "</p>";
            echo "<p><strong>Détails :</strong> " . htmlspecialchars($result["DETAIL_BAGAGE"]) . "</p>";
            
            echo "<br>";
            echo '<a href="MesReser.php?poids=' . urlencode($result['POIDS']) . '&nom_vendeur=' . urlencode($result['NOM_VENDEUR']) . '&contact=' . urlencode($result['CONTACT']) . '" class="btn quitter">Ajouter</a>';
        } else {
            echo "<div><p>Aucun enregistrement trouvé.</p></div>";
        }
    } else {
        echo "<div><p>Erreur lors de l'exécution de la requête.</p></div>";
    }
} else {
    echo "<div><p>ID invalide.</p></div>";
}

            ?>
        </tbody>
    </table>
            </div>
        <p></p><br>
        </div>

CSS

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(#c0e3cf,#cbe0f5, #f5deb480) ;
        }
    .container {
    display: flex;
    flex-wrap: wrap;
    min-height: 100vh;
    }
    .sidebar {
        background: linear-gradient(#49d6eb,#6c7a8f) ;
        color: rgb(5, 5, 5);
        width: 250px;
        margin-left: 20px;
        margin-right: 10px;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 20px;
        flex-shrink: 0;
        box-shadow: 0 2px 10px rgb(0, 0, 0);
        }
    .user-info {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    }
    .user-info img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
    }
    .sidebar nav ul {
    list-style: none;
    }
    .sidebar nav ul li {
    margin-bottom: 10px;
    }
    .sidebar nav ul li a {
    color: rgb(4, 4, 4);
    text-decoration: none;
    padding: 10px;
    display: block;
    border-radius: 5px;
    transition: background 0.3s;
    }
    .sidebar nav ul li a.active,
    .sidebar nav ul li a:hover {
    background: #213c4183;
    }
    .main-content {
        background:linear-gradient(#eff0ef);
        padding: 20px;
        background-image:url('C:\Users\Administrator\Pictures\freepik image\Espace de Voyage\058b7ac20e11f3ce88a8a396af62f211.jpg');
        background-position: center;
        background-repeat: no-repeat;  
        background-size: cover;
        flex: 1;
        margin-bottom: 20px;
        margin-top: 20px;
        margin-right: 20px;
        margin-left: 15px;
        box-shadow: 0 2px 10px rgb(0, 0, 0);
        overflow-y: auto; /* Permettre le défilement si le contenu dépasse la hauteur */
        max-height: calc(100vh - 40px); /* Limiter la hauteur pour permettre le défilement */
        border:10px;

        }
    .container1 {
        background: rgba(239, 243, 245, 0.2);
        border-radius: 10px;
        padding: 20px;
        width: 100%;
        max-width: 1400px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        margin-top: 40px;
        }
    h1 {
text-align: center;
color: #fff;
}
table {
width: 100%;
border-collapse: collapse;
margin-top: 20px;
}
th, td {
padding: 10px;
text-align:left;
color: #171616;
}

    header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    }
    h1 {
    font-size: 24px;
    color: #2c3e50;
    }
    .username {
    font-size: 18px;
    color: #2c3e50;
    }

   
    .btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
    }
    .quitter {
    margin-top:15px ;
    background:linear-gradient(#49d6eb,#6c7a8f) ;
    color: rgb(19, 19, 19);
    }
    .lien{
        text-decoration: none;
        color: #101010;
    }
    
    @media (max-width: 768px) {
    .sidebar {
    width: 100%;
    flex-shrink: 1;
    }
    .main-content {
    width: 100%;
    }
    }

PAGE D’AJOUT DES RESULTATS A LA PAGE DE RESERVATION AU CLIC SUR LE BOUTON AJOUTER OU RESERVER DE LA PAGE DE DETAILS

<?php
session_start(); // Start the session

// Vérification de l'authentification de l'utilisateur
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: login.html');
    exit;
}

// Récupérer le nom d'utilisateur
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Invité';

$serveur="localhost";  
 $login="root";
 $password="";

 try{
  $connexion=new PDO("mysql:host=$serveur;dbname=voyage",$login,$password);
  $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Vérifiez si les données ont été envoyées via l'URL
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET)) {
    // Vérifiez si une demande de suppression a été faite
    if (isset($_GET['delete'])) {
        $deleteIndex = intval($_GET['delete']);
        if (isset($_SESSION['reservations'][$deleteIndex])) {
            unset($_SESSION['reservations'][$deleteIndex]);
            // Réindexer le tableau
            $_SESSION['reservations'] = array_values($_SESSION['reservations']);
        }
        // Redirection pour éviter le double clic
        header("Location: MesReser.php");
        exit();
    }
}
    // Vérifiez si les données ont été envoyées via l'URL
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET)) {
        // Récupérer les données de l'URL
        $reservation = [
            'POIDS' => isset($_GET['poids']) ? $_GET['poids'] : '',
            'NOM_VENDEUR' => isset($_GET['nom_vendeur']) ? $_GET['nom_vendeur'] : '',
            'CONTACT' => isset($_GET['contact']) ? $_GET['contact'] : '',
            
        ];

        // Vérifiez si une session pour les réservations existe, sinon, créez-la
        if (!isset($_SESSION['reservations'])) {
            $_SESSION['reservations'] = [];
        }

        // Ajoutez la réservation à la session
        $_SESSION['reservations'][] = $reservation;
    }
}catch(PDOException $e){
    die('Echec:'.$e->getMessage());
   }
// Récupérer les enregistrements
$query = $connexion->query("SELECT * FROM espace");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="MesReser.css">
    <title>Mes Réservations</title>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="user-info">
                <img src="user-avatar.png" alt="User Avatar">
                <span>SpaceEvent</span>
            </div>
            <nav>
                <ul>
                    <li><a href="Acceuil.php">Accueil</a></li>
                    <li><a href="MesReser.php" class="active">Mes Réservations</a></li>
                    <li><a href="MesBagages.php" >Mes Bagages</a></li>
                    <li><a href="Ajout.php">Ajouter Un Bagage</a></li>
                    <li><a href="Reserver.php">Réserver un Bagage</a></li>
                    <li><a href="Compte.php">Mon Compte</a></li>
                </ul>
            </nav>
        </aside>
        <div class="main-content">
            <header>
                <h1>Mes Réservations</h1>
                <div class="user-info">
                    <button type="button" class="btn quitter"><a href="login.html" style="color: black; text-decoration: none;">Deconnexion</a></button>
                    <img src="C:\xamppp\htdocs\Space.WEB\Espace de Voyage\20240302_230635.jpg" alt="User Avatar">
                    <span><?php echo htmlspecialchars($username); ?></span>
                </div>
        </header>
        <div class="container1">
            <table>
                <thead>
                    <tr>
                        <th>Espace commandé</th>
                        <th>Nom du client</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($_SESSION['reservations'])): ?>
                        <?php foreach ($_SESSION['reservations'] as $reservation): ?>
                            <?php foreach ($_SESSION['reservations'] as $key => $reservation): ?> <!-- vous passez l'index $key correctement dans votre boucle foreach.-->
                                <tr>
                                    <td><?= htmlspecialchars($reservation['POIDS']) ?></td>
                                    <td><?= htmlspecialchars($reservation['NOM_VENDEUR']) ?></td>
                                    <td><?= htmlspecialchars($reservation['CONTACT']) ?></td>
                                    <td>
                                        <button type="button" class="btn supprimer"><a href="Ajout2.php?id=<?= htmlspecialchars($reservation['ID_ESPACE'] ?? '') ?>" style="color: black; text-decoration: none;">Voir+</a></button>
                                        <button type="button" class="btn supprimer"><a href="MesReser.php?delete=<?= $key ?>"style="color: black; text-decoration: none;">Supprimer</a></button>
                                        <button type="button" class="btn supprimer">Contacter</button>
                                        <button type="button" class="btn supprimer">Acheté</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Aucune réservation trouvée.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
CSS
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(#c0e3cf,#cbe0f5, #f5deb480) ;
        }
    .container {
    display: flex;
    flex-wrap: wrap;
    min-height: 100vh;
    }
    .sidebar {
        background: linear-gradient(#49d6eb,#6c7a8f) ;
        color: rgb(5, 5, 5);
        width: 250px;
        margin-left: 20px;
        margin-right: 10px;
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 20px;
        flex-shrink: 0;
        box-shadow: 0 2px 10px rgb(0, 0, 0);
        }
    .user-info {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    }
    .user-info img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
    }
    .sidebar nav ul {
    list-style: none;
    }
    .sidebar nav ul li {
    margin-bottom: 10px;
    }
    .sidebar nav ul li a {
    color: rgb(4, 4, 4);
    text-decoration: none;
    padding: 10px;
    display: block;
    border-radius: 5px;
    transition: background 0.3s;
    }
    .sidebar nav ul li a.active,
    .sidebar nav ul li a:hover {
    background: #213c4183;
    }
    .main-content {
        background:linear-gradient(#eff0ef);
        padding: 20px;
        background-image:url('C:\Users\Administrator\Pictures\freepik image\Espace de Voyage\058b7ac20e11f3ce88a8a396af62f211.jpg');
        background-position: center;
        background-repeat: no-repeat;  
        background-size: cover;
        flex: 1;
        margin-bottom: 20px;
        margin-top: 20px;
        margin-right: 20px;
        margin-left: 15px;
        box-shadow: 0 2px 10px rgb(0, 0, 0);
        overflow-y: auto; /* Permettre le défilement si le contenu dépasse la hauteur */
        max-height: calc(100vh - 40px); /* Limiter la hauteur pour permettre le défilement */
        border:10px;

        }
    .container1 {
        background: rgba(239, 243, 245, 0.2);
        border-radius: 10px;
        padding: 20px;
        width: 100%;
        max-width: 1400px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        margin-top: 40px;
        }
    h1 {
text-align: center;
color: #fff;
}
table {
width: 100%;
border-collapse: collapse;
margin-top: 20px;
}
th, td {
padding: 10px;
text-align:left;
color: #171616;
}

    header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    }
    h1 {
    font-size: 24px;
    color: #2c3e50;
    }
    .username {
    font-size: 18px;
    color: #2c3e50;
    }

   
    .btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
    }
    .quitter {
    margin-top:15px ;
    background:linear-gradient(#49d6eb,#6c7a8f) ;
    color: rgb(19, 19, 19);
    }
    .retour {
    background: linear-gradient(#49d6eb,#6c7a8f) ;
    color: rgb(8, 8, 8);
    }
    .supprimer {
    background: linear-gradient(#49d6eb,#6c7a8f) ;
    color: rgb(9, 9, 9);
    margin-top:5px ;
    }
    .mettre {
    background: linear-gradient(#49d6eb,#6c7a8f) ;
    color: rgb(10, 10, 10);
    margin-right: 15px;
        }
    @media (max-width: 768px) {
    .sidebar {
    width: 100%;
    flex-shrink: 1;
    }
    .main-content {
    width: 100%;
    }
    }



