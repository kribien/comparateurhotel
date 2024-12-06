<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Reservation Form
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
 </head>
 <body class="bg-green-900 text-white font-sans">
  <div class="max-w-screen-lg mx-auto p-4">
   <header class="flex justify-between items-center mb-8">
    <div class="flex items-center">
     <img alt="Logo" class="rounded-full" height="40" src="https://storage.googleapis.com/a1aa/image/HfeLnNf9FhdhCpByHjI7NeKf6IbKOPtfgexRDSMNQ8uPEC97JA.jpg" width="40"/>
     <span class="ml-2 text-lg">
      Logo
     </span>
    </div>
    <div class="flex items-center space-x-4">
     <i class="fas fa-calendar-alt text-xl">
     </i>
     <i class="fas fa-bell text-xl">
     </i>
    </div>
   </header>
   <main>
    <h1 class="text-center text-xl mb-4">
     Bienvenue dans notre espace reserver aux Appartements.
     <br/>
     Veuillez remplir les champs suivant.
    </h1>
    <div class="flex justify-center mb-8">
    <div class="flex items-center space-x-4">
     <div class="w-8 h-8 bg-white text-gray-900 rounded-full flex items-center justify-center">
      1
     </div>
     <div class="w-8 h-8 bg-black -500 text-white rounded-full flex items-center justify-center">
      2
     </div>
    </div>
   </div>
   <div class="bg-green-800 p-4 rounded-lg">
    <h2 class="text-center mb-4">
     Informations générales
    </h2>
    <div class="mb-4">
    <span>
       Ajouter sa localisation maps
      </span>
     <label class="flex items-center space-x-2 mt-2">
     <input class="w-1/6 p-10 rounded bg-white-700 text-black" name="photo" type="photo"/>
     </label>
    <span>
       Ajouter une(des) photo(s)
      </span>
     <label class="flex items-center space-x-2">
      <input class="w-1/6 p-10 rounded bg-white-700 text-black" name="photo" type="photo"/>
      <input class="w-1/6 p-10 rounded bg-white-700 text-black" name="photo" type="photo"/>
      <input class="w-1/6 p-10 rounded bg-white-700 text-black" name="photo" type="photo"/>
      <input class="w-1/6 p-10 rounded bg-white-700 text-black" name="photo" type="photo"/>
      <input class="w-1/6 p-10 rounded bg-white-700 text-black" name="photo" type="photo"/>
      <input class="w-1/6 p-10 rounded bg-white-700 text-black" name="photo" type="photo"/>
     </label>
     </label>
    </div>
    <div class="space-y-10">
    <div>
     <label for="Pays" class=" text-white">Pays</label>
      <select class="w-full p-2 rounded bg-white-700 text-black" placeholder="Pays" type="text">
      <option selected>Choisir un pays....</option>
            <option value="CAMEROUN">CAMEROUN</option>
            <option value="NIGERIA">NIGERIA</option>
            <option value="BENIN">BENIN</option>
            <option value="SENEGAL">SENEGAL</option>
    </select>
    </div>
    <div>
    <label for="ville" class=" text-white">Ville</label>
      <select class="w-full p-2 rounded bg-white-700 text-black" placeholder="ville" name="ville" type="text">
      <option selected>Choisir une ville....</option>
            <option value="yaounde">Yaounde</option>
            <option value="Limbe">Limbe</option>
            <option value="Kribi">Kribi</option>
            <option value="dakar">Dakar</option>
    </select>
      </div>
     <div class="">
     <label for="quartier" class=" text-white">Quartier</label>
     <input class="w-full p-2 rounded bg-white-700 text-black" placeholder="Quartier" type="text"/>
     </div>
     <div class="">
     <label for="nom" class=" text-white">Nom</label>
     <input class="w-full p-2 rounded bg-white-700 text-black" placeholder="Nom de l'appartement" type="text"/>
     </div>
     <div class="">
     <label for="salon" class=" text-white">Nombre de salons</label>
     <input class="w-full p-2 rounded bg-white-700 text-black" placeholder="Nombres de salon" type="number"/>
     </div>
     <div class="">
     <label for="chambre" class=" text-white">Nombre de chambres</label>
     <input class="w-full p-2 rounded bg-white-700 text-black" placeholder="Nombres de chambres" type="number"/>
     </div>
     <div class="">
     <label for="douche" class=" text-white">Nombre de douches</label>
     <input class="w-full p-2 rounded bg-white-700 text-black" placeholder="Nombres de douches" type="number"/>
    </div>
     <div class="">
     <label for="cuisine" class=" text-white">Nombre de cuisines</label>
     <input class="w-full p-2 rounded bg-white-700 text-black" placeholder="Nombres de cuisines" type="number"/>
     </div>
     <div class="">
     <label for="prix" class=" text-white">Prix</label>
     <input class="w-full p-2 rounded bg-white-700 text-black" placeholder="Prix" type="number"/>
     </div>
     <div class="">
     <label for="super" class=" text-white">Superficie</label>
     <input class="w-full p-2 rounded bg-white-700 text-black" placeholder="Superficie" type="number"/>
     </div>
     <div class="">
     <label for="contact" class=" text-white">Contact</label>
     <input class="w-full p-2 rounded bg-white-700 text-black" placeholder="Contact" type="number"/>
     </div>

            <div>
                <label for="standing" class="block text-white">Standing</label>
                <input type="text" id="standing" class="w-full p-2 rounded-lg text-black">
            </div>
            <div>
                <label for="mobiliers" class="block text-white">Mobiliers</label>
                <textarea id="mobiliers" class="w-full p-4 rounded-lg h-32 text-black"></textarea>
            </div>
            <div>
                <label for="atouts" class="block text-white">Atouts</label>
                <textarea id="atouts" class="w-full p-4 rounded-lg h-32 text-black"></textarea>
            </div>
            <div>
                <label for="options" class="block text-white">Options</label>
                <textarea id="options" class="w-full p-4 rounded-lg h-32 text-black"></textarea>
            </div>
            <div>
                <label for="details" class="block text-white">Details</label>
                <textarea id="details" class="w-full p-4 rounded-lg h-32 text-black"></textarea>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-black text-white py-2 px-4 rounded-full">Valider</button>
            </div>
    </div>
   </div>
   <div class="flex justify-between items-center mt-8">
        <button
          class="bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none"
        >
          ← Previous
        </button>
        <button
          class="bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none"
        ><a href="">
          Next →
          </a></button>
      </div>
  </div>
  
            

     </form>
 </body>
</html>
