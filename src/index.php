<?php 
session_start();
if (isset($_SESSION['logged_in'])){
    header('Location: ../pages/home.php');
}

?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <script src="js/script.js"></script>
  <title>Elsan</title>
</head>
<body class="">

<?php include 'includes/nav.php';?>

<h1 class="text-blue-800 font-bold text-4xl text-center m-8 2xl:m-16">Bienvenue !</h1>
<main class="p-1 flex flex-col gap-8 lg:flex-row lg:p-4 max-w-screen-2xl mx-auto">
<section class="login w-[96%] bg-blue-800 mx-auto p-1 max-w-xl">
    <h2 class="text-gray-100 font-bold text-3xl text-center m-4">Connexion</h2>
    <form class="flex flex-col p-4" action="php_sql/signin_handler.php" method="POST">
        <input class="mb-6 h-16 text-3xl text-center" type="mail" placeholder="Adresse mail" name="email" required>
        <input class="mb-6 h-16 text-3xl text-center" type="password" placeholder="Mot de passe" name="password" required>
        <input class="bg-gray-100 h-16 w-[50%] mx-auto text-3xl font-semibold text-green-700" type="submit" value="Valider">
    </form>
</section>

<section class="signup w-[96%] bg-blue-800 mx-auto p-1 max-w-xl">
    <h2 class="text-gray-100 font-bold text-3xl text-center m-4">Inscription</h2>
    <form class="flex flex-col p-4" action="php_sql/signup_handler.php" method="POST">
        <input class="mb-6 h-16 text-3xl text-center" type="text" placeholder="Nom" name="last_name" required>
        <input class="mb-6 h-16 text-3xl text-center" type="text" placeholder="Prénom" name="first_name" required>
        <input class="mb-6 h-16 text-3xl text-center" type="email" placeholder="Adresse mail" name="su_email" required>
        <input class="mb-6 h-16 text-3xl text-center" type="password" placeholder="Mot de passe" name="su_password" required>
        <input class="mb-6 h-16 text-3xl text-center" type="password" placeholder="Confirmer mot de passe" name="su_retyped_password" required>
        <input class="bg-gray-100 h-16 w-[50%] mx-auto text-3xl font-semibold text-green-700" type="submit" value="Valider">
    </form>
</section>
</main>    
    

</body>
</html>