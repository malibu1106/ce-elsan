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

    ?>
<?php 

 // UPDATE USER STATUS
 require_once('../php_sql/db_connect.php');

 if (isset($_GET) && !empty($_GET['user_id']) && !empty($_GET['role'])){
// Initialisation de la requête SQL
$sql = "UPDATE users SET role = :role WHERE user_id = :user_id";

// Préparation de la requête
$query = $db->prepare($sql);

// Bind des valeurs pour éviter les injections SQL
$query->bindValue(':user_id', $_GET['user_id'], PDO::PARAM_INT);
$query->bindValue(':role', $_GET['role'], PDO::PARAM_STR);

// Exécution de la requête
$query->execute();

if ($_GET['role'] === "blocked"){
    $_SESSION['info_message'] = "Utilisateur bloqué";
    header("Location: ../pages/back_office_users.php?");
    exit();}
    else{
    $_SESSION['info_message'] = "Utilisateur validé";
    header("Location: ../pages/back_office_users.php?");
    exit();}
 }
 else{
    $_SESSION['info_message'] = "Erreur de traitement de la requête";
    header("Location: ../pages/back_office_users.php?");
    exit();
 }
?>