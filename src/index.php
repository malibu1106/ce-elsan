<?php 
// session_start();
// $_SESSION['role'] = "fdf";
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <script src="js/script.js"></script>
</head>
<body class="">

<?php include 'includes/nav.php';?>

<h1 class="text-blue-800 font-bold text-4xl text-center mt-8 mb-8">Bienvenue !</h1>

<section class="login w-[96%] bg-blue-800 p-4 mx-auto mt-2">
    <h2 class="text-gray-100 font-bold text-3xl text-center m-4">Connexion</h2>
    <form class="flex flex-col p-4" action="php_sql/login_handler.php">
        <input class="mb-6 h-16 text-3xl text-center" type="mail" placeholder="Adresse mail">
        <input class="mb-6 h-16 text-3xl text-center" type="password" placeholder="Mot de passe">
        <input class="bg-gray-100 h-16 w-[50%] mx-auto text-3xl font-semibold text-green-700" type="submit" value="Valider">
    </form>
</section>

<section class="signup w-[96%] bg-blue-800 p-2 mx-auto mt-2">
    <h2 class="text-gray-100 font-bold text-3xl text-center m-4">Inscription</h2>
    <form class="flex flex-col p-4" action="php_sql/signup_handler.php">
        <input class="mb-6 h-16 text-3xl text-center" type="text" placeholder="Nom">
        <input class="mb-6 h-16 text-3xl text-center" type="text" placeholder="Prénom">
        <input class="mb-6 h-16 text-3xl text-center" type="mail" placeholder="Adresse mail">
        <input class="mb-6 h-16 text-3xl text-center" type="password" placeholder="Mot de passe">
        <input class="mb-6 h-16 text-3xl text-center" type="password" placeholder="Confirmer mot de passe">
        <input class="bg-gray-100 h-16 w-[50%] mx-auto text-3xl font-semibold text-green-700" type="submit" value="Valider">
    </form>
</section>
    
    

</body>
</html>