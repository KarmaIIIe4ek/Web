<?php
require_once '../includes/header.php';
require_once '../includes/db_functions.php';

$projects = getAllProjects();
?>

<div class="container">
    <h1 class="mt-5">Проекты на Golang</h1>
    
    <a href="add_project.php" class="btn btn-primary mb-3">Добавить проект</a>
    
    <div class="row">
        <?php foreach ($projects as $project): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($project['name']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($project['description']) ?></p>
                    <p class="text-muted">Звёзд: <?= $project['stars'] ?></p>
                    <a href="<?= htmlspecialchars($project['github_url']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">GitHub</a>
                    <a href="edit_project.php?id=<?= $project['project_id'] ?>" class="btn btn-sm btn-outline-secondary">Изменить</a>
                    <a href="delete_project.php?id=<?= $project['project_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Удалить проект?')">Удалить</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>