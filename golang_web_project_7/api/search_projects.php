<?php
require_once __DIR__ . '/../includes/db_connect.php';

$query = $_GET['query'] ?? '';
$results = [];

if (!empty($query)) {
    $stmt = $pdo->prepare("SELECT * FROM golang_projects WHERE name LIKE ? LIMIT 5");
    $stmt->execute(["%$query%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

foreach ($results as $project) {
    echo "<div class='project-result'>";
    echo "<h5>{$project['name']}</h5>";
    echo "<p>{$project['description']}</p>";
    echo "</div>";
}
?>