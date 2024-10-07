    <nav class="bg-blue-800 p-2">
        <ul class="flex justify-between items-center w-full">
            <li class="w-1/4 flex justify-center items-center h-12">
                <h2 class="text-gray-100 text-xl font-bold">CE Elsan</h2>
            </li>


            <?php if (isset($_SESSION)){
                echo          
            '<li class="w-1/4 flex justify-center">
                    <img class="h-12" src="images/icons/home.png" alt="bouton du menu" id="menu_bouton">
            </li>';}
            ?>

            <?php if (isset($_SESSION) && ($_SESSION['role'] === "admin")){
                echo
            '<li class="w-1/4 flex justify-center">
                <a href="back_office/gestion.php">
                    <img class="h-12" src="images/icons/back_office.png" alt="bouton de l\'interface administrateur">
                </a>
            </li>';}
            ?>

            <?php if (isset($_SESSION)){
                echo
            '<li class="w-1/4 flex justify-center">
                <a href="profile.php">
                    <img class="h-12" src="images/icons/user.png" alt="bouton accès profil">
                </a>
            </li>';}
            ?>
        </ul>
    </nav>