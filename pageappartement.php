<?php
// Connexion à la base de données avec PDO
$host = "localhost";
$dbname = "comparaison";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer les données de la table "appartement"
$query = "SELECT id_ap, nom_ap, vendeur_ap, prix_ap, pays_ap, ville_ap, quartier_ap, tel_ap FROM appartement";
$stmt = $pdo->prepare($query);
$stmt->execute();
$appartements = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Vérifier que l'ID est fourni dans l'URL
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Supprimer l'appartement
    $query = "DELETE FROM appartement WHERE id_ap = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirection après la suppression
        header("Location: dashbordapp.php?message=success");
        exit();
    } else {
        echo "Erreur lors de la suppression de l'appartement.";
    }
} else {
    echo "ID non fourni.";
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appartement Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-green-900 text-white">
    <div class="flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div class="w-full md:w-1/5 bg-black p-4">
            <div class="flex flex-col items-center">
                <div class="w-16 h-16 bg-white rounded-full mb-4"></div>
                <p class="mb-8">PROFILE</p>
                <p class="mb-4">Menu</p>
                <div class="flex items-center mb-4">
                    <div class="w-4 h-4 bg-white rounded-full mr-2"></div>
                    <p>TABLEAU DE BORD</p>
                </div>
                <div class="flex items-center mb-4">
                    <div class="w-4 h-4 bg-white rounded-full mr-2"></div>
                    <p class="bg-gray-700 p-2 rounded">Mes Appartements</p>
                </div>
                <div class="flex items-center mb-4">
                    <div class="w-4 h-4 bg-white rounded-full mr-2"></div>
                    <p><a href="mesreserapp.php">Mes Reservations</a></p>
                </div>
                <div class="flex items-center mb-4">
                    <div class="w-4 h-4 bg-white rounded-full mr-2"></div>
                    <p><a href="statiticsapp.php">Statistiques</a></p>
                </div>
                <div class="flex items-center mb-8">
                    <div class="w-4 h-4 bg-white rounded-full mr-2"></div>
                    <p>Paiement</p>
                </div>
                <p class="mb-4">PROFILE</p>
                <div class="flex items-center mb-4">
                    <div class="w-4 h-4 bg-white rounded-full mr-2"></div>
                    <p>Paramètres</p>
                </div>
                <div class="flex items-center mb-4">
                    <div class="w-4 h-4 bg-white rounded-full mr-2"></div>
                    <p><a href="pageapp.php">Ajouter un Appartement</a></p>
                </div>
                <div class="flex items-center mb-4">
                    <div class="w-4 h-4 bg-white rounded-full mr-2"></div>
                    <p>Ajouter un Hotel</p>
                </div>
                <div class="flex items-center mb-4">
                    <div class="w-4 h-4 bg-white rounded-full mr-2"></div>
                    <p>Ajouter une villa</p>
                </div>
                <div class="flex items-center mb-4">
                    <div class="w-4 h-4 bg-white rounded-full mr-2"></div>
                    <p>Ajouter une airbnb</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="w-full md:w-4/5">
            <!-- Header -->
            <div class="flex flex-col md:flex-row items-center justify-between bg-black p-4">
                <div class="flex items-center mb-4 md:mb-0">
                    <p class="mr-4">BIENVENUE, JOHN DOE</p>
                    <button class="bg-black text-white px-4 py-2 rounded"><a href="rechercheapp.php">Faire une recherche</a></button>
                    <div class="flex items-center">
                        <input type="text" placeholder="Rechercher..." class="p-2 rounded text-black">
                        <i class="fas fa-search ml-2"></i>
                    </div>
                </div>
                <button class="bg-red-500 text-white px-4 py-2 rounded">Déconnexion</button>
                <div class="flex items-center">
                    <i class="fas fa-bell mr-4"></i>
                    <i class="fas fa-cog mr-4"></i>
                    <div class="w-8 h-8 bg-white rounded-full"></div>
                </div>
            </div>

            <!-- Table -->
            <div class="p-4">
                <div class="bg-gray-300 p-4 rounded mb-4 overflow-x-auto">
                    <table class="w-full text-black text-sm">
                        <thead class="bg-gray-200">
                        <tr>
                            <th class="px-2 py-1">N*</th>
                            <th class="px-2 py-1">Nom Appart</th>
                            <th class="px-2 py-1">Vendeur</th>
                            <th class="px-2 py-1">Prix</th>
                            <th class="px-2 py-1">Pays</th>
                            <th class="px-2 py-1">Ville</th>
                            <th class="px-2 py-1">Quartier</th>
                            <th class="px-2 py-1">Contact</th>
                            <th class="px-2 py-1">ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                            <!-- Example PHP loop for data -->
                            <?php if (count($appartements) > 0): ?>
                                <?php foreach ($appartements as $index => $appartement): ?>
                                    <tr class="border-t">
                                        <td class="px-2 py-1 text-center"><?= htmlspecialchars($index + 1) ?></td>
                                        <td class="px-2 py-1"><?= htmlspecialchars($appartement['nom_ap']) ?></td>
                                        <td class="px-2 py-1"><?= htmlspecialchars($appartement['vendeur_ap']) ?></td>
                                        <td class="px-2 py-1"><?= htmlspecialchars($appartement['prix_ap']) ?> XAF</td>
                                        <td class="px-2 py-1"><?= htmlspecialchars($appartement['pays_ap']) ?></td>
                                        <td class="px-2 py-1"><?= htmlspecialchars($appartement['ville_ap']) ?></td>
                                        <td class="px-2 py-1"><?= htmlspecialchars($appartement['quartier_ap']) ?></td>
                                        <td class="px-2 py-1"><?= htmlspecialchars($appartement['tel_ap']) ?></td>
                                        <td class="px-2 py-1">
                                            <a href="Modapp.php?id=<?= $appartement['id_ap'] ?>" class="bg-black text-white px-2 py-1 rounded">Modifier</a>
                                            <a href="voirplusapp.php?id=<?= $appartement['id_ap'] ?>" class="bg-black text-white px-2 py-1 rounded">Voir+</a>
                                            <a href="supprimer_appartement.php?id=<?= $appartement['id_ap'] ?>" 
                                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet appartement ?')" 
                                               class="bg-red-500 text-white px-2 py-1 rounded">Supprimer</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="px-2 py-1 text-center text-red-500">Aucun appartement trouvé.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-green-900 p-4">
                <div class="flex flex-col md:flex-row justify-between text-gray-400">
                    <div class="mb-4 md:mb-0">
                        <p class="font-semibold mb-2">Explore</p>
                        <ul>
                            <li>Design</li>
                            <li>Prototyping</li>
                            <li>Development</li>
                            <li>Design Systems</li>
                        </ul>
                    </div>
                    <div class="mb-4 md:mb-0">
                        <p class="font-semibold mb-2">Resources</p>
                        <ul>
                            <li>Blog</li>
                            <li>Best Practices</li>
                            <li>Support</li>
                            <li>Developers</li>
                            <li>Library</li>
                        </ul>
                    </div>
                    <div class="flex items-center space-x-4">
                        <i class="fab fa-facebook-f"></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-linkedin-in"></i>
                        <i class="fab fa-youtube"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
