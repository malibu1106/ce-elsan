<?php

header('Content-Type: application/json'); // Déclarer le header JSON
// Inclure le fichier de connexion à la base de données
include '../php_sql/db_connect.php'; 
try {
    // Connexion à la base de données (assurez-vous que $db est bien initialisé)
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $role = isset($_GET['role']) ? $_GET['role'] : '';

    // Requête SQL
    // Requête SQL
$sql = "SELECT first_name, last_name, email, role FROM users WHERE (first_name LIKE :search OR last_name LIKE :search OR email LIKE :search) AND role != 'to_approve'";

    if ($role) {
        $sql .= " AND role = :role";
    }

    $query = $db->prepare($sql);
    $query->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);

    if ($role) {
        $query->bindValue(':role', $role, PDO::PARAM_STR);
    }

    $query->execute();
    $users = $query->fetchAll(PDO::FETCH_ASSOC);

    // Retourner les utilisateurs sous forme de JSON
    echo json_encode($users);

} catch (Exception $e) {
    // Si une erreur survient, retourner une réponse JSON contenant l'erreur
    echo json_encode(['error' => $e->getMessage()]);
}
