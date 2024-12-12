<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "crud";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check if the database connection is successful
if (!$conn) {
  die("Connection Error". mysqli_error($conn));
}

// Check if the form is submitted using the POST method
if (isset($_POST["submit"])) {

  // Retrieve user inputs from the form
 $photo_hotel = $_POST['photo_hotel'];
 $pays_hotel = $_POST['pays_hotel'];
 $ville_hotel = $_POST['ville_hotel'];
 $quartier_hotel = $_POST['quartier_hotel'];
 $nom_hotel = $_POST['nom_hotel']; // Correction ici
 $nbre_etoile = $_POST['nbre_etoile'];
 $atout_hotel = $_POST['atout_hotel'];
 $detail_hotel = $_POST['detail_hotel'];

  // Validate if all fields are filled
  if (empty($photo_hotel) || empty($pays_hotel) || empty($ville_hotel) || empty($quartier_hotel)|| empty($nom_hotel)|| empty($nbre_etoile)|| empty($atout_hotel)|| empty($detail_hotel)) {
    echo "All fields are required";
  } else {
    // Construct SQL query to insert data into the 'userdetails' table
    $sql = "UPDATE `hotel` SET `id_hotel`='[value-1]',`id_ges_ap`='[value-2]',
    `id_chambre`='[value-3]',`nom_hotel`='[value-4]',`pays_hotel`='[value-5]',
    `ville_hotel`='[value-6]',`quartier_hotel`='[value-7]',`nbre_etoile`='
    [value-8]',`commentaire_hotel`='[value-9]',`photo_hotel`='[value-10]',
    `detail_hotel`='[value-11]',`atout_hotel`='[value-12]',`maps_hotel`='
    [value-13]' WHERE 1";

    // Execute the SQL query
    $result = mysqli_query($conn,$sql);

    // Check if the query execution was successful
    if ($result) {
      echo "Updated successfully";
    } else {
      die(mysqli_error($conn));
    }
  }
}

// Close the database connection
$conn->close();
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Gestion des Hotels</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
    <style>
      /* Custom CSS 
      .file-input {
          display: block;
          width: 100%;
          text-sm;
          text-gray-500;
          file:mr-4;
          file:py-2;
          file:px-4;
          file:rounded-full;
          file:border-0;
          file:text-sm;
          file:font-semibold;
          file:bg-black;
          file:text-white;
          hover:file:bg-gray-700;
      }
      #map {
          width: 100%;
          height: 16rem;
      }*/
    </style>
  </head>
  <body class="bg-green-900 text-white" onload="initMap()">
    <div class="flex flex-col min-h-screen"> 
      <header class="bg-black flex items-center justify-between p-4">
        <div class="flex items-center">
          <img
            alt="logo"
            class="mr-4"
            height="40"
            src="https://storage.googleapis.com/a1aa/image/ernH5dMdya02c6lhVuZuy9GTFAj0GR1UefgXlfWFR3k5lLhPB.jpg"
            width="40"
          />
          <span class="text-xl">BIENVENU, JOHN DOE</span>
        </div>
        <div class="flex items-center">
          <input
            class="p-2 rounded-l-md"
            placeholder="Rechercher..."
            type="text"
          />
          <button class="bg-white text-black p-2 rounded-r-md">
            <i class="fas fa-search"></i>
          </button>
        </div>
        <div class="flex items-center">
          <a href="profile.php"><span class="mr-4">PROFILE</span>
          <img
            alt="profile"
            class="rounded-full"
            height="40"
            src="https://storage.googleapis.com/a1aa/image/EM4TC3CR1t40IZFEleJlf6JP6Y4LrAe4Zxq5npqy99H6ylwnA.jpg"
            width="40"
          />
          </a>
        </div>
      </header>

      <div class="flex flex-1 flex-col lg:flex-row">
        <!-- Sidebar -->
        <aside
          class="bg-black w-full lg:w-64 p-4 flex flex-col justify-between"
        >
          <div>
            <div class="mb-8">
              <div class="flex items-center mb-4">
                <img
                  alt="profile"
                  class="rounded-full mr-2"
                  height="40"
                  src="https://storage.googleapis.com/a1aa/image/EM4TC3CR1t40IZFEleJlf6JP6Y4LrAe4Zxq5npqy99H6ylwnA.jpg"
                  width="40"
                />
                
                <a href="profile.php"><span>PROFILE</span></a>
              </div>
              <nav>
                <ul>
                  <li class="mb-4">
                    <a class="flex items-center" href="#">
                      <i class="fas fa-tachometer-alt mr-2"></i>
                      TABLEAU DE BORD
                    </a>
                  </li>


                  <li class="mb-4">
                    <a
                      class="flex items-center bg-gray-700 p-2 rounded"
                      href="Dashboard gestion Hotel.php"
                    >
                      <i class="fas fa-hotel mr-2"></i>
                      GESTION DES HOTELS
                      <span class="text-red-500 ml-2">•</span>
                    </a>
                  </li>



                  <li class="mb-4">
                    <a class="flex items-center" href="Statistics.php">
                      <i class="fas fa-chart-bar mr-2"></i>
                      STATISTICS
                    </a>
                  </li>



                  <li class="mb-4">
                    <a class="flex items-center" href="Payement.php">
                      <i class="fas fa-credit-card mr-2"></i>
                      PAYEMENT
                    </a>
                  </li>

                </ul>
              </nav>
            </div>


            <div>
              <ul>

                <li class="mb-4">
                  <a class="flex items-center" href="profile.php">
                    <i class="fas fa-user mr-2"></i>
                    PROFILE
                  </a>
                </li>


                <li class="mb-4">
                  <a class="flex items-center" href="parametre.php">
                    <i class="fas fa-cog mr-2"></i>
                    PARAMETRE
                  </a>
                </li>


              </ul>
            </div>
          </div>

          <!-- What should we do with the logout ? -->
          <div>
            <a class="flex items-center" href="">
              <i class="fas fa-sign-out-alt mr-2"></i>
              LOG OUT
            </a>
          </div>
        </aside>

        
        <main class="flex-1 bg-gray-300 p-8">
          <div class="mb-4">

            <a class="text-black" href="accueil.html">
              <i class="fas fa-arrow-left"></i>
              Retour
            </a>

          </div>
     <!-- Main Content -->
     <div class="flex-1 bg-gray-100 text-black p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Statistics -->
                    <div class="bg-white p-4 rounded shadow">
                        <h2 class="text-lg font-bold">STATISTICS</h2>
                        <img alt="Statistics graph" class="mt-4" height="200" src="https://storage.googleapis.com/a1aa/image/eReDvk30pKsIP0cz10jzK3azGXPgYQJfBHeGrFgRHvWfi5CfE.jpg" width="300"/>
                    </div>
                    <!-- Payments -->
                    <div class="bg-white p-4 rounded shadow">
                        <h2 class="text-lg font-bold">PAYEMENTS</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full mt-4">
                                <thead>
                                    <tr>
                                        <th class="text-left">ID</th>
                                        <th class="text-left">NOM DU CLIENT</th>
                                        <th class="text-left">CHAMBRE</th>
                                        <th class="text-left">DUREE</th>
                                        <th class="text-left">DUREE</th>
                                        <th class="text-left">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="checkbox"/></td>
                                        <td>MARY JANE</td>
                                        <td>CHAMBRE 259</td>
                                        <td>280000 XAF</td>
                                        <td>12/06 au 21/06</td>
                                        <td><span class="bg-yellow-500 text-white px-2 py-1 rounded">EN COURS</span></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"/></td>
                                        <td>CLAUDE AMARIS</td>
                                        <td>SUITES 501</td>
                                        <td>300000 XAF</td>
                                        <td>23/05 au 01/06</td>
                                        <td><span class="bg-red-500 text-white px-2 py-1 rounded">ANNULE</span></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"/></td>
                                        <td>SANDJON THERESA</td>
                                        <td>CHAMBRE A53B</td>
                                        <td>150000 XAF</td>
                                        <td>30/05 au 01/06</td>
                                        <td><span class="bg-green-500 text-white px-2 py-1 rounded">PAYE</span></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"/></td>
                                        <td>THOMAS S. JUNIOR</td>
                                        <td>CHAMBRE 111</td>
                                        <td>200000 XAF</td>
                                        <td>04/06 au 07/07</td>
                                        <td><span class="bg-green-500 text-white px-2 py-1 rounded">PAYE</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Hotel Management -->
                <div class="bg-white p-4 rounded shadow mt-4">
                    <h2 class="text-lg font-bold">GESTION DES HOTEL</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full mt-4">
                            <thead>
                                <tr>
                                    <th class="text-left">NO</th>
                                    <th class="text-left">HOTEL</th>
                                    <th class="text-left">CHAMBRE</th>
                                    <th class="text-left">CHAMBRE</th>
                                    <th class="text-left">CATEGORIE</th>
                                    <th class="text-left">PRIX</th>
                                    <th class="text-left">DETAIL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Star Land Hotel</td>
                                    <td>Chambre 3CA</td>
                                    <td>Lorem ipsum</td>
                                    <td>Standard</td>
                                    <td>50000 XAF/ nuit</td>
                                    <td><button class="bg-blue text-white px-2 py-1 rounded" type="submit" >Modifier</button></td>
                                    <td><button class="bg-red text-white px-2 py-1 rounded">Supprimer</button></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Star Land Hotel</td>
                                    <td>Suites 216</td>
                                    <td>Lorem ipsum</td>
                                    <td>Suite</td>
                                    <td>90000 XAF/ nuit</td>
                                    <td><button class="bg-blue text-white px-2 py-1 rounded" type="submit" >Modifier</button></td>
                                    <td><button class="bg-red text-white px-2 py-1 rounded">Supprimer</button></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Star Land Hotel</td>
                                    <td>Chambre 401</td>
                                    <td>Lorem ipsum</td>
                                    <td>Deluxe</td>
                                    <td>70000 XAF/nuit</td>
                                    <td><button class="bg-blue text-white px-2 py-1 rounded" type="submit"  >Modifier</button></td>
                                    <td><button class="bg-red text-white px-2 py-1 rounded">Supprimer</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
  </div>
   <!-- Footer -->
   <footer class="bg-green-900 text-gray-400 p-4 text-center">
        <div class="flex justify-center space-x-4 mb-4">
          <i class="fab fa-facebook"></i>
          <i class="fab fa-twitter"></i>
          <i class="fab fa-instagram"></i>
          <i class="fab fa-youtube"></i>
        </div>
        <div
          class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-8 mb-4"
        >
          <a class="hover:underline" href="#">Explore</a>
          <a class="hover:underline" href="#">Design</a>
          <a class="hover:underline" href="#">Prototyping</a>
          <a class="hover:underline" href="#">Collaboration</a>
          <a class="hover:underline" href="#">Design systems</a>
        </div>
        <div
          class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-8"
        >
          <a class="hover:underline" href="#">Blog</a>
          <a class="hover:underline" href="#">Best practices</a>
          <a class="hover:underline" href="#">Support</a>
          <a class="hover:underline" href="#">Developers</a>
          <a class="hover:underline" href="#">Resources library</a>
        </div>
      </footer>

</body>

</html>
