<?php
require_once '../includes/header.php';
require_once '../includes/db_functions.php';

if (!isset($_GET['id'])) {
    header('Location: developers.php');
    exit;
}

$dev_id = $_GET['id'];
$projects = $pdo->query("SELECT project_id, name FROM golang_projects")->fetchAll();

// Получаем данные разработчика
$stmt = $pdo->prepare("SELECT * FROM golang_developers WHERE dev_id = ?");
$stmt->execute([$dev_id]);
$developer = $stmt->fetch();

if (!$developer) {
    header('Location: developers.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $experience = $_POST['experience'];
    $country = $_POST['country'];
    $project_id = $_POST['project_id'];
    
    try {
        $stmt = $pdo->prepare("UPDATE golang_developers SET username = ?, experience = ?, country = ?, project_id = ? WHERE dev_id = ?");
        $stmt->execute([$username, $experience, $country, $project_id, $dev_id]);
        
        header('Location: developers.php');
        exit;
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Ошибка: ' . $e->getMessage() . '</div>';
    }
}
?>

<div class="container mt-4">
    <h2>Редактировать разработчика</h2>
    
    <form method="POST">
        <div class="form-group mb-3">
            <label for="username">Псевдоним разработчика</label>
            <input type="text" class="form-control" id="username" name="username" 
                value="<?= htmlspecialchars($developer['username']) ?>" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="experience">Опыт работы с Golang (лет)</label>
            <input type="number" class="form-control" id="experience" name="experience" 
                   value="<?= $developer['experience'] ?>" min="0" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="country">Страна</label>
            <input type="text" class="form-control" id="country" name="country" 
                   value="<?= htmlspecialchars($developer['country']) ?>" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="project_id">Проект</label>
            <select class="form-control" id="project_id" name="project_id" required>
                <?php foreach ($projects as $project): ?>
                <option value="<?= $project['project_id'] ?>" 
                    <?= $project['project_id'] == $developer['project_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($project['name']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="developers.php" class="btn btn-secondary">Отмена</a>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>