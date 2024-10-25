<?php
session_start();
require_once('../php_sql/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $company_name = $_POST['company_name'];
    $description = $_POST['description'];
    $address = $_POST['address'];
    $user_id = $_SESSION['user_id']; // Récupérer l'user_id de la session
    $avantage_id = $_POST['avantage_id'] ?? null; // Récupérer l'ID de l'avantage à modifier

    // Initialiser la variable pour l'URL de l'image
    $image_url = null;

    // Gérer l'upload de l'image
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === 0) {
        $upload_dir = '../images/uploads/'; // Répertoire où les fichiers seront stockés
        $file_tmp = $_FILES['image_url']['tmp_name'];

        // Obtenir l'extension du fichier uploadé
        $file_extension = strtolower(pathinfo($_FILES['image_url']['name'], PATHINFO_EXTENSION));
        $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Vérifier que l'extension du fichier est valide
        if (!in_array($file_extension, $valid_extensions)) {
            die("Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.");
        }

        // Générer un nom de fichier unique avec uniqid() et l'extension d'origine
        $unique_file_name = uniqid('img_', true) . '.' . $file_extension;
        $target_file = $upload_dir . $unique_file_name;

        // Déplacer le fichier uploadé vers le répertoire cible
        if (!move_uploaded_file($file_tmp, $target_file)) {
            die("Erreur lors du téléchargement de l'image.");
        }

        // Assignation de l'URL de l'image
        $image_url = $upload_dir.''.$unique_file_name;
    }

    try {
        if ($avantage_id) {
            // Mise à jour de l'avantage
            $sql = "
                UPDATE benefits 
                SET company_name = :company_name, description = :description, address = :address" .
                ($image_url ? ", image_url = :image_url" : "") . " 
                WHERE benefit_id = :avantage_id
            ";
            $query = $db->prepare($sql);
            $query->bindValue(':avantage_id', $avantage_id, PDO::PARAM_INT);

            // Lier les valeurs
            $query->bindValue(':company_name', $company_name);
            $query->bindValue(':description', $description);
            $query->bindValue(':address', $address);

            // Lier l'URL de l'image uniquement si elle existe
            if ($image_url) {
                $query->bindValue(':image_url', $image_url);
            }
        } else {
            // Insertion d'un nouvel avantage
            $sql = "
                INSERT INTO benefits (company_name, description, address, image_url) 
                VALUES (:company_name, :description, :address, :image_url)
            ";
            $query = $db->prepare($sql);

            // Lier les valeurs
            $query->bindValue(':company_name', $company_name);
            $query->bindValue(':description', $description);
            $query->bindValue(':address', $address);
            $query->bindValue(':image_url', $image_url); // L'URL de l'image peut être NULL si aucun fichier n'est uploadé
        }

        // Exécuter la requête
        $query->execute();

        // Rediriger vers la page de confirmation ou d'accueil
        $_SESSION['info_message'] = "Avantage enregistré avec succès.";
        header("Location: ../pages/back_office_benefits.php");
        exit();
    } catch (Exception $e) {
        // Gérer les erreurs
        $_SESSION['info_message'] = "Erreur lors de l'enregistrement de l'avantage : " . $e->getMessage();
        header("Location: ../pages/back_office_benefits.php");
        exit();
    }
} else {
    // Rediriger si la requête n'est pas POST
    $_SESSION['info_message'] = "Erreur lors du traitement de la requête";
    header("Location: ../pages/back_office_benefits.php");
    exit();
}
?>
