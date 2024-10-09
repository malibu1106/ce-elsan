<?php 
session_start();
// Récupération des permanences
require_once('../php_sql/db_connect.php');

// Vérification si une catégorie a été sélectionnée
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

// Récupération des permanences avec des dates à venir
$sql = "SELECT * FROM benefits";
if ($categoryFilter) {
    $sql .= " WHERE category = :category";
}

$query = $db->prepare($sql);
if ($categoryFilter) {
    $query->bindParam(':category', $categoryFilter, PDO::PARAM_STR);
}
$query->execute();
$benefits = $query->fetchAll(PDO::FETCH_ASSOC);
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
<body class="">

<?php include '../includes/nav.php';?>

<h1 class="text-blue-800 font-bold text-4xl text-center m-8">Vos avantages</h1>
<main class="p-1 flex flex-col gap-4 flex-wrap max-w-screen-2xl mx-auto">

<section class="w-[96%] bg-red-600 mx-auto p-1 max-w-xl text-gray-100">
    <div class="filter p-4">
    <form method="GET" action="">
        <select name="category" class="category-select text-blue-800 w-full h-12 font-bold text-xl text-center" onchange="this.form.submit()">
            <option value="">Toutes les catégories</option>
            <option value="culture" <?php if ($categoryFilter == 'culture') echo 'selected'; ?>>Culture</option>
            <option value="alimentation" <?php if ($categoryFilter == 'alimentation') echo 'selected'; ?>>Alimentation</option>
            <option value="loisirs" <?php if ($categoryFilter == 'loisirs') echo 'selected'; ?>>Loisirs</option>
            <option value="bien-etre" <?php if ($categoryFilter == 'bien-etre') echo 'selected'; ?>>Bien-être</option>
            <option value="transport" <?php if ($categoryFilter == 'transport') echo 'selected'; ?>>Transport</option>
            <option value="education" <?php if ($categoryFilter == 'education') echo 'selected'; ?>>Éducation</option>
            <option value="famille" <?php if ($categoryFilter == 'famille') echo 'selected'; ?>>Famille</option>
            <option value="vacances" <?php if ($categoryFilter == 'vacances') echo 'selected'; ?>>Vacances</option>
            <option value="technologie" <?php if ($categoryFilter == 'technologie') echo 'selected'; ?>>Technologie</option>
        </select>
    </form>
    </div>  
    <div class="container flex gap-2 p-2">

    <?php
    foreach ($benefits as $benefit) {
        // Affichage de l'avantage
        echo
            '<div class="benefit w-1/3 flex flex-col p-2 items-center">
                <img class="h-12 w-12" src="'.$benefit['image_url'].'" alt="logo de l\'entreprise">
                '.$benefit['company_name'].'
            </div>';
    }
    ?>

    </div>
</section>
    
</main> 
</body>
</html>
