<?php
require_once '../includes/header.php';
?>

<div class="container mt-4">
    <h2>Проверка псевдонима</h2>
    
    <div class="card">
        <div class="card-body">
            <form id="username-form">
                <div class="mb-3">
                    <label for="username" class="form-label">Введите псевдоним:</label>
                    <input type="text" class="form-control" id="username" required>
                    <div id="username-status" class="form-text"></div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="mt-3">
        <h5>Информация о браузере:</h5>
        <div id="browser-info" class="alert alert-info"></div>
    </div>
</div>

<script src="../assets/js/ajax.js"></script>

<?php
require_once '../includes/footer.php';
?>