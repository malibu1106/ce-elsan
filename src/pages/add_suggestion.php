<?php 
session_start();
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
  $_SESSION['info_message'] = "Vous devez être connecté pour accéder à cette page";
  header("Location: ../index.php?");
  exit();  
}
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../output.css" rel="stylesheet">
  <script src="js/script.js"></script>
  <title>Elsan</title>
</head>
<body class="pb-8">

<?php include '../includes/nav.php';?>

    <h1 class="text-blue-800 font-bold text-4xl text-center m-8">Faire une suggestion</h1>




<main class="p-1 flex flex-col gap-4 flex-wrap max-w-screen-2xl mx-auto">

<section class="w-[96%] bg-yellow-500 mx-auto max-w-xl pb-4 text-gray-100 relative">
<span class="absolute right-5 top-5 h-12 w-12"><a href="../pages/suggestions.php"><img src="../images/icons/delete_white.png" alt="fermer le popup"></a></span>

<form id="signup_form" class="flex flex-col p-4 w-[96%] mx-auto max-w-xl text-blue-800 mt-16" action="../php_sql/create_suggestion.php" method="post" enctype="multipart/form-data">
    <input class="mb-6 h-16 text-3xl text-center" type="text" id="company_name" name="company_name" placeholder="Nom de l'entreprise" required>
    <textarea class="mb-6 h-48 text-3xl p-4 resize-none" id="description" name="description" placeholder="Description" required></textarea>
    
    <!-- Champ personnalisé pour l'image -->
    <div class="mb-6 h-16 flex items-center justify-center">
        <label class="bg-gray-100 text-blue-800 text-3xl p-4 cursor-pointer w-full text-center text-opacity-75 truncate" for="image_url">Ajouter l'image</label>
        <input type="file" id="image_url" name="image_url" accept="image/*" class="hidden" required>
    </div>
    
    <input class="mb-6 h-16 text-3xl text-center" type="text" id="address" name="address" placeholder="Adresse de l'entreprise" required>
    <input class="bg-gray-100 h-16 w-[50%] mx-auto text-3xl font-semibold text-green-700" type="submit" value="Valider">
</form>

<script>
    // Sélectionner les éléments du DOM
    const imageUrlInput = document.getElementById('image_url');
    const label = document.querySelector('label[for="image_url"]');

    // Gestion du changement de fichier
    imageUrlInput.addEventListener('change', function() {
        const fileName = this.files.length > 0 ? this.files[0].name : 'Ajouter l\'image';
        label.textContent = fileName;

        // Si un fichier est sélectionné, retirer l'opacité
        if (this.files.length > 0) {
            label.classList.remove('text-opacity-75');
        } else {
            label.classList.add('text-opacity-75');
        }
    });

</script>





        

    


</section>

</main> 
   
</body>
</html>
