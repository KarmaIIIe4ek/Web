<?php
require_once '../includes/header.php';
require_once '../includes/db_functions.php';

if (!isset($_GET['id'])) {
    header('Location: projects.php');
    exit;
}

$project_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $github_url = $_POST['github_url'];
    $stars = $_POST['stars'];
    
    if (updateProject($project_id, $name, $description, $github_url, $stars)) {
        header('Location: projects.php');
        exit;
    } else {
        echo '<div class="alert alert-danger">Ошибка при обновлении проекта</div>';
    }
}

$project = $pdo->prepare("SELECT * FROM golang_projects WHERE project_id = ?");
$project->execute([$project_id]);
$project = $project->fetch();

if (!$project) {
    header('Location: projects.php');
    exit;
}
?>

<h2>Редактирование проекта</h2>

<form method="POST">
    <div class="form-group">
        <label>Название проекта</label>
        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($project['name']) ?>" required>
    </div>
    
    <div class="form-group">
        <label>Описание</label>
        <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($project['description']) ?></textarea>
    </div>
    
    <div class="form-group">
        <label>GitHub URL</label>
        <input type="url" name="github_url" class="form-control" value="<?= htmlspecialchars($project['github_url']) ?>" required>
    </div>
    
    <div class="form-group">
        <label>Количество звёзд</label>
        <input type="number" name="stars" class="form-control" value="<?= $project['stars'] ?>" min="0">
    </div>
    
    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="projects.php" class="btn btn-secondary">Отмена</a>
</form>

<?php require_once '../includes/footer.php'; ?>