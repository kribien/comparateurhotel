<html>
 <head>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
 </head>
 <body class="bg-green-900 text-white font-sans">
  <header class="flex items-center justify-between p-4 bg-white text-black">
   <div class="flex items-center">
    <img alt="Logo" class="rounded-full" height="40" src="https://storage.googleapis.com/a1aa/image/WWie2ZCV6xzPfkWsUC4lxd2cHMCRRj5fEWcTnvrfF2rPTuaPB.jpg" width="40"/>
    <span class="ml-2">
     Logo
    </span>
   </div>
   <div class="flex items-center space-x-4">
    <i class="fas fa-calendar-alt">
    </i>
    <i class="fas fa-bell">
    </i>
    <img alt="User Avatar" class="rounded-full" height="40" src="https://storage.googleapis.com/a1aa/image/mLuoImZBFtaFJpHKZKS9HbXBzJa9vvZo4NsKPyIkjtiN5q9E.jpg" width="40"/>
   </div>
  </header>
  <main class="flex flex-col items-center justify-center min-h-screen p-4">
   <h1 class="text-center text-xl mb-4">
    Bienvenue dans notre espace reservé aux chambres d'Hotels.
    <br/>
    Veuillez remplir les champs suivant:
   </h1>
   <div class="flex space-x-4 mb-8">
    <div class="w-10 h-10 flex items-center justify-center border-2 border-white rounded-full">
     1
    </div>
    <div class="w-10 h-10 flex items-center justify-center bg-white text-green-900 rounded-full">
     2
    </div>
    <div class="w-10 h-10 flex items-center justify-center border-2 border-white rounded-full">
     3
    </div>
   </div>
   <h2 class="text-center text-lg mb-4">
    Informations détaillées
   </h2>
   <form class="bg-green-800 p-6 rounded-lg w-full max-w-md space-y-4">
    <span>
       Ajouter une(des) photo(s)
      </span>
     <label class="flex items-center space-x-2">
      <input class="w-1/2 p-10 rounded bg-white-700 text-black" name="photoun" type="photo"/>
      <input class="w-1/2 p-10 rounded bg-white-700 text-black" name="photodeux" type="photo"/>

     </label>

    <div>
     <label>
      Nom de la chambre
     </label>
     <input class="w-full p-2 mt-1 rounded bg-white text-black" name="nom" placeholder="Nom de la chambre ou de la suite " type="text"/>
    </div>
    <div>
     <label>
      Catégorie
     </label>
     <div class="flex flex-col space-y-2 mt-1">
      <label class="flex items-center">
      <select class="text-black mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" id="pays" name="categorie" required>
            <option selected>Choisir une catégorie....</option>
            <option value="vip">VIP</option>
            <option value="Standard">Standard</option>
            <option value="suite">Suite</option>
            <option value="Double">Double</option>
        </select>
       
      </label>
     </div>
    </div>
    <div>
     <label>
      Prix
     </label>
     <input class="w-full p-2 mt-1 rounded bg-white text-black" name="prix" type="text"/>
    </div>
    <div>
     <label>
      Nombre d'adultes
     </label>
     <input class="w-full p-2 mt-1 rounded bg-white text-black" name="adult" type="number"/>
    </div>
    <div>
     <label>
      Nombre d'enfants
     </label>
     <input class="w-full p-2 mt-1 rounded bg-white text-black" name="enft" type="number"/>
    </div>
    <div>
     <label>
      Options
     </label>
     <textarea class="w-full p-8 mt-1 rounded bg-white text-black" name="option"></textarea>
    </div>
    <div>
     <label>
        Atouts
     </label>
     <textarea class="w-full p-8 mt-1 rounded bg-white text-black" name="atout"></textarea>
    </div>
    <div>
     <label>
      Détail
     </label>
     <textarea class="w-full p-8 mt-1 rounded bg-white text-black" name="detail"></textarea>
    </div>
    <div class="flex space-x-4">
     <div class="flex-1">
      <label>
       Disponibilité
      </label>
      <div class="flex space-x-2 mt-1">
        <div><span>Date de début</span>
       <input class="w-full p-2 rounded bg-white text-black" name="debut" placeholder="Du :" type="date"/>
       </div>
       <div><span>Date de fin</span>
       <input class="w-full p-2 rounded bg-white text-black" name="fin" placeholder="Au :" type="date"/>
       </div>
      </div>
      <div>
     <label>
      Familial
     </label>
     <div class="flex flex-col space-y-2 mt-1">
     <select class="text-black mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" id="pays" name="famille" required>
            <option selected>Choisir....</option>
            <option value="oui">Oui</option>
            <option value="non">Non</option>
    
        </select>
     </div>
    </div>
      <br>
      <p>Remplissez les informations suivantes pour une suite : </p>
      <br>
       <div>
     <label>
      Nombre de chambres
     </label>
     <input class="w-full p-2 mt-1 rounded bg-white text-black" name="chambre" type="number"/>
    </div>
    <div>
     <label>
      Nombre de douches
     </label>
     <input class="w-full p-2 mt-1 rounded bg-white text-black" name="douche" type="number"/>
    </div>
    <div>
     <label>
      Nombre de salons
     </label>
     <input class="w-full p-2 mt-1 rounded bg-white text-black" name="salon" type="number"/>
    </div>
     </div>
    </div>
    
    <div class="flex justify-center">
     <button class="bg-black text-white py-2 px-4 rounded" type="submit">
      Valider
     </button>
    </div>
   </form>
   <div class="flex justify-between w-full max-w-md mt-8">
    <button class="flex items-center space-x-2">
     <i class="fas fa-arrow-left">
     </i>
     <span>
      Previous
     </span>
    </button>
    <button class="flex items-center space-x-2">
     <span>
      Next
     </span>
     <i class="fas fa-arrow-right">
     </i>
    </button>
   </div>
  </main>
 </body>
</html>
