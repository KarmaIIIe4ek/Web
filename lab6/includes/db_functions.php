<?php
require_once 'db_connect.php';

// Получение всех проектов
function getAllProjects() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM golang_projects");
    return $stmt->fetchAll();
}

// Получение разработчиков проекта
function getDevelopersByProject($project_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM golang_developers WHERE project_id = ?");
    $stmt->execute([$project_id]);
    return $stmt->fetchAll();
}

// Добавление нового проекта
function addProject($name, $description, $github_url, $stars) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO golang_projects (name, description, github_url, stars) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$name, $description, $github_url, $stars]);
}

// Обновление проекта
function updateProject($project_id, $name, $description, $github_url, $stars) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE golang_projects SET name = ?, description = ?, github_url = ?, stars = ? WHERE project_id = ?");
    return $stmt->execute([$name, $description, $github_url, $stars, $project_id]);
}

// Удаление проекта
function deleteProject($project_id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM golang_projects WHERE project_id = ?");
    return $stmt->execute([$project_id]);
}

// Добавление разработчика
function addDeveloper($username, $experience, $country, $project_id) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO golang_developers (username, experience, country, project_id) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$username, $experience, $country, $project_id]);
}

// Обновление разработчика
function updateDeveloper($dev_id, $username, $experience, $country, $project_id) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE golang_developers SET username = ?, experience = ?, country = ?, project_id = ? WHERE dev_id = ?");
    return $stmt->execute([$username, $experience, $country, $project_id, $dev_id]);
}

// Получение разработчика по ID
function getDeveloperById($dev_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM golang_developers WHERE dev_id = ?");
    $stmt->execute([$dev_id]);
    return $stmt->fetch();
}