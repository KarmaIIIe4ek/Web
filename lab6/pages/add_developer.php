<?php
require_once '../includes/header.php';
require_once '../includes/db_functions.php';

// Получаем список проектов для выпадающего списка
$projects = $pdo->query("SELECT project_id, name FROM golang_projects")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $experience = $_POST['experience'];
    $country = $_POST['country'];
    $project_id = $_POST['project_id'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO golang_developers (username, experience, country, project_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $experience, $country, $project_id]);
        
        header('Location: developers.php');
        exit;
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Ошибка: ' . $e->getMessage() . '</div>';
    }
}
?>

<div class="container mt-4">
    <h2>Добавить разработчика</h2>
    
    <form method="POST">
        <div class="form-group mb-3">
            <label for="username">Полное имя</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="experience">Опыт работы с Golang (лет)</label>
            <input type="number" class="form-control" id="experience" name="experience" min="0" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="country">Страна</label>
            <input type="text" class="form-control" id="country" name="country" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="project_id">Проект</label>
            <select class="form-control" id="project_id" name="project_id" required>
                <option value="">-- Выберите проект --</option>
                <?php foreach ($projects as $project): ?>
                <option value="<?= $project['project_id'] ?>"><?= htmlspecialchars($project['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Добавить</button>
        <a href="developers.php" class="btn btn-secondary">Отмена</a>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>