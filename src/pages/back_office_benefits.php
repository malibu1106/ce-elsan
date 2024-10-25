<?php 
session_start();
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
  $_SESSION['info_message'] = "Vous devez être connecté pour accéder à cette page";
  header("Location: ../index.php");
  exit();
}

if ($_SESSION['role'] !== "admin") {
  $_SESSION['info_message'] = "Vous n'avez pas l'autorisation pour accéder à cette page";
  header("Location: ../pages/home.php");
  exit();
} 

require_once('../php_sql/db_connect.php');
// Récupération des avantages avec des dates à venir
$sql = "SELECT benefit_id, company_name, image_url, category FROM benefits";
$query = $db->prepare($sql);
$query->execute();
$avantages = $query->fetchAll(PDO::FETCH_ASSOC);
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

<h1 class="text-blue-800 font-bold text-4xl text-center m-8">Gérer les avantages</h1>
<main class="p-1 flex flex-col gap-4 flex-wrap max-w-screen-2xl mx-auto">

<section class="w-[96%] bg-red-600 mx-auto p-1 max-w-xl text-gray-100 pb-4">
<h3 class="font-bold text-xl text-center mb-4"><a href="add_or_edit_avantage.php">+ Ajouter un avantage</a></h3>
    <div class="container">

    <?php


foreach ($avantages as $avantage) {

  // Affichage de l'avantage
  echo '<div class="avantage_row flex justify-between p-2">
      <div class="container flex justify-between items-center w-3/4">
          <img class="h-16 w-16 bg-white p-1 " src="'.$avantage['image_url'].'" alt="logo de l\'entreprise">
          <p class="w-3/4 text-center truncate text-2xl">'.$avantage['company_name'].'</p>
      </div>
      <div class="container flex items-center justify-end gap-4 w-1/4">
          <a href="add_or_edit_avantage.php?avantage_id='.$avantage['benefit_id'].'">
            <img src="../images/icons/edit.png" class="h-8 w-8" alt="editer l\'avantage">
          </a>
          <img src="../images/icons/delete_white.png" class="h-8 w-8 delete_avantage" alt="supprimer l\'avantage">
          <div class="confirm_delete_avantage">
              <a href="../php_sql/delete_avantage.php?avantage_id='.$avantage['benefit_id'].'">
                <img src="../images/icons/cancel.png" class="h-8 w-8 rounded-full border border-white bg-white" alt="Confirmer la suppression de l\'avantage">
              </a>
          </div>
      </div>    
  </div>
  <p class="cancel_delete_avantage text-center m-2 font-bold text-red-200">Annuler la suppression</p>';
}

?>

           
    </div>
</section>
    
</main> 

<script>
  // Fonction pour ajouter les gestionnaires d'événements
function addEventListeners() {
  // Gestion des événements pour supprimer une avantage
  document.querySelectorAll('.delete_avantage').forEach((deleteBtn, index) => {
    const confirmDelete = document.querySelectorAll('.confirm_delete_avantage')[index]; // Récupère la zone de confirmation
    const cancelDelete = document.querySelectorAll('.cancel_delete_avantage')[index]; // Récupère le bouton d'annulation

    // Au clic sur le bouton de suppression
    deleteBtn.addEventListener('click', () => {
      deleteBtn.style.display = 'none';  // Masque le bouton de suppression
      confirmDelete.style.display = 'block'; // Affiche la confirmation de suppression
      cancelDelete.style.display = 'block'; // Affiche le bouton d'annulation
    });

    // Au clic sur le bouton d'annulation
    cancelDelete.addEventListener('click', () => {
      deleteBtn.style.display = 'block';  // Réaffiche le bouton de suppression
      confirmDelete.style.display = 'none'; // Masque la confirmation de suppression
      cancelDelete.style.display = 'none'; // Masque le bouton d'annulation
    });
  });
}

// Appel des gestionnaires d'événements
addEventListeners();
</script>
</body>
</html>
