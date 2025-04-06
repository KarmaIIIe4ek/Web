<?php
require_once '../includes/db_functions.php';

if (isset($_GET['id'])) {
    $dev_id = $_GET['id'];
    
    try {
        $stmt = $pdo->prepare("DELETE FROM golang_developers WHERE dev_id = ?");
        $stmt->execute([$dev_id]);
    } catch (PDOException $e) {
        // Можно добавить логирование ошибки
    }
}

header('Location: developers.php');
exit;
?>