<?php
require_once '../includes/header.php';
require_once '../includes/db_functions.php';

$projects = getAllProjects();
?>

<h2 class="mb-4">Управление проектами</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Название</th>
            <th>Описание</th>
            <th>Звёзд</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projects as $project): ?>
        <tr>
            <td><?= htmlspecialchars($project['name']) ?></td>
            <td><?= htmlspecialchars(substr($project['description'], 0, 50)) ?>...</td>
            <td><?= $project['stars'] ?></td>
            <td>
                <a href="edit_project.php?id=<?= $project['project_id'] ?>" class="btn btn-sm btn-warning">Изменить</a>
                <a href="delete_project.php?id=<?= $project['project_id'] ?>" class="btn btn-sm btn-danger delete-btn">Удалить</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="add_project.php" class="btn btn-primary">Добавить проект</a>

<?php require_once '../includes/footer.php'; ?>