<?php
require_once '../includes/header.php';
require_once '../includes/db_functions.php';

$developers = $pdo->query("
    SELECT d.*, p.name as project_name 
    FROM golang_developers d
    JOIN golang_projects p ON d.project_id = p.project_id
")->fetchAll();
?>

<h2 class="mb-4">Управление разработчиками</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Имя</th>
            <th>Опыт (лет)</th>
            <th>Страна</th>
            <th>Проект</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($developers as $dev): ?>
        <tr>
            <td><?= htmlspecialchars($dev['username']) ?></td>
            <td><?= $dev['experience'] ?></td>
            <td><?= htmlspecialchars($dev['country']) ?></td>
            <td><?= htmlspecialchars($dev['project_name']) ?></td>
            <td>
                <a href="edit_developer.php?id=<?= $dev['dev_id'] ?>" class="btn btn-sm btn-warning">Изменить</a>
                <a href="delete_developer.php?id=<?= $dev['dev_id'] ?>" class="btn btn-sm btn-danger delete-btn">Удалить</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="add_developer.php" class="btn btn-primary">Добавить разработчика</a>

<?php require_once '../includes/footer.php'; ?>