<?php
require_once '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../includes/db_functions.php';
    
    $name = $_POST['name'];
    $description = $_POST['description'];
    $github_url = $_POST['github_url'];
    $stars = $_POST['stars'];
    
    if (addProject($name, $description, $github_url, $stars)) {
        header('Location: projects.php');
        exit;
    } else {
        echo '<div class="alert alert-danger">Ошибка при добавлении проекта</div>';
    }
}
?>

<h2>Добавление нового проекта</h2>

<form method="POST">
    <div class="form-group">
        <label>Название проекта</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label>Описание</label>
        <textarea name="description" class="form-control" rows="3" required></textarea>
    </div>
    
    <div class="form-group">
        <label>GitHub URL</label>
        <input type="url" name="github_url" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label>Количество звёзд</label>
        <input type="number" name="stars" class="form-control" min="0">
    </div>
    
    <button type="submit" class="btn btn-primary">Добавить</button>
    <a href="projects.php" class="btn btn-secondary">Отмена</a>
</form>

<?php require_once '../includes/footer.php'; ?>