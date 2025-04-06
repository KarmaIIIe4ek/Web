<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/db_connect.php';

$username = $_GET['username'] ?? '';
$response = ['exists' => false, 'message' => ''];

if (!empty($username)) {
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM golang_developers WHERE username = ?");
        $stmt->execute([$username]);
        $exists = $stmt->fetchColumn();
        
        $response = [
            'exists' => $exists > 0,
            'message' => $exists ? 'Псевдоним уже занят!' : 'Псевдоним свободен.',
            'browser' => $_SERVER['HTTP_USER_AGENT'] // Для расширенного задания
        ];
    } catch (PDOException $e) {
        $response['message'] = 'Ошибка сервера';
    }
}

echo json_encode($response);
?>