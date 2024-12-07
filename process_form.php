<?php
// Informations de connexion à la base de données
$servername = "localhost"; 
$username = "root";       
$password = "";          
$dbname = "comparaison";  

// Établir la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $pays = $_POST['pays'];
    $ville = $_POST['ville'];
    $quartier = $_POST['quartier'];
    $nom_villa = $_POST['nom_villa'];
    $n_salon = $_POST['n_salon'];
    $n_chambres = $_POST['n_chambres'];
    $n_douches = $_POST['n_douches'];
    $n_cuisines = $_POST['n_cuisines'];
    $prix = $_POST['prix'];
    $superficie = $_POST['superficie'];
    $standing = $_POST['standing'];
    $mobiliers = $_POST['mobiliers'];
    $atouts = $_POST['atouts'];
    $details = $_POST['details'];

    // Préparer la requête SQL
    $sql = "INSERT INTO villas (pays, ville, quartier, nom_villa, n_salon, n_chambres, n_douches, n_cuisines, prix, superficie, standing, mobiliers, atouts, details) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssiiidssssss",
        $pays, $ville, $quartier, $nom_villa, $n_salon, $n_chambres, $n_douches, $n_cuisines, $prix, $superficie, $standing, $mobiliers, $atouts, $details
    );

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Données enregistrées avec succès !";
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
}

// Fermer la connexion
$conn->close();
?>
