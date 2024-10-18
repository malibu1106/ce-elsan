<?php 
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    $_SESSION['info_message'] = "Vous devez être connecté pour accéder à cette page";
    header("Location: ../index.php?");
    exit();}
if (($_SESSION['role']) !== "admin") {
    $_SESSION['info_message'] = "Vous n'avez pas l'autorisation pour accéder à cette page";
    header("Location: ../pages/home.php?");
    exit();}

include '../php_sql/db_connect.php'; // Inclure le fichier de connexion à la base de données

// Récupérer les utilisateurs en attente d'approbation
$sql = "SELECT first_name, last_name, user_id FROM users where role = 'to_approve'";
$query = $db->prepare($sql);
$query->execute();
$users_to_approve = $query->fetchAll(PDO::FETCH_ASSOC);


?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../output.css" rel="stylesheet">
  <title>Elsan</title>
</head>
<body class="pb-8">
<?php include '../includes/nav.php';?>

<h1 class="text-blue-800 font-bold text-4xl text-center m-8">Gérer les utilisateurs</h1>
<main class="p-1 flex flex-col gap-4 flex-wrap max-w-screen-2xl mx-auto">

<section class="w-[96%] bg-blue-800 mx-auto p-4 max-w-xl text-gray-100">
    <?php
    if ($users_to_approve){
        echo'
    <h2 class="m-4 mb-6 text-2xl text-center">Inscriptions en attente</h2>';
    foreach ($users_to_approve as $user_to_approve){
        echo '<div class="container flex justify-between items-center max-w-[420px] mx-auto">';
        echo '<a href="../php_sql/change_user_status.php?role=blocked&user_id='.$user_to_approve['user_id'].'">';
        echo '<img src="../images/icons/delete_white.png" alt"Refuser l\'inscription" class="h-12">';
        echo '</a>';
        echo '<p class="text-xl">'. $user_to_approve['first_name'] .' '. $user_to_approve['last_name'] . '</p>';
        echo '<a href="../php_sql/change_user_status.php?role=user&user_id='.$user_to_approve['user_id'].'">';
        echo '<img src="../images/icons/checked.png" alt"Accepter l\'inscription" class="h-12">';
        echo '</a>';
        echo '</div>';
    }

    echo '<hr class="mt-4">';
}
    ?>

    
    <h2 class="m-4 mb-8 text-2xl text-center">Tous les utilisateurs</h2>

    <div class="p-4">
  <!-- Barre de recherche -->
  <input type="text" id="searchInput" class="border p-2 rounded w-full mb-4 text-blue-800" placeholder="Rechercher par nom, prénom ou email...">

  <!-- Sélecteur de rôle -->
  <select id="roleSelect" class="border p-2 rounded w-full mb-4  text-blue-800">
    <option value="">Tous les rôles</option>
    <option value="admin">Admin</option>
    <option value="user">User</option>
    <option value="blocked">Blocked</option>
  </select>

  <!-- Liste des utilisateurs -->
  <div id="userList" class="space-y-2">
    <!-- Les utilisateurs seront listés ici -->
  </div>
</div>

<script>
// Fonction pour récupérer et afficher les utilisateurs
function fetchUsers() {
  const searchInput = document.getElementById('searchInput').value;
  const roleSelect = document.getElementById('roleSelect').value;

  // Appel AJAX pour récupérer les utilisateurs
  fetch(`back_office_get_users.php?search=${searchInput}&role=${roleSelect}`)
    .then(response => response.json())
    .then(users => {
      // Sélectionner l'élément où lister les utilisateurs
      const userList = document.getElementById('userList');
      userList.innerHTML = '';

      // Afficher les utilisateurs dans le DOM
      users.forEach(user => {
        const userDiv = document.createElement('div');
        userDiv.className = 'p-2 flex flex-col mt-4';
        userDiv.innerHTML = `<p class=""><strong>${user.first_name} ${user.last_name}</strong><em>(${user.role})</em></p><p><br>${user.email}</p>`;
        userDiv.innerHTML = `
        <div class="container flex justify-between">
            <p class="text-xl font-bold">${user.first_name} ${user.last_name}</p>
            <p><em>(${user.role})</em></p>
        </div>
        <div class="relative h-8 flex items-center">
        <p class="mx-12">${user.email}</p>
        <span class="absolute right-0"><img src="../images/icons/edit.png" alt="Éditer l'utilisateur" class="h-8 w-8"></span>
        </div>
        `;
        userList.appendChild(userDiv);
      });
    })
    .catch(error => console.error('Erreur:', error));
}

// Ajout des événements pour la recherche en direct et la sélection du rôle
document.getElementById('searchInput').addEventListener('input', fetchUsers);
document.getElementById('roleSelect').addEventListener('change', fetchUsers);

// Appel initial pour afficher tous les utilisateurs
fetchUsers();
</script>

</section>
    
</main> 
</body>
</html>
