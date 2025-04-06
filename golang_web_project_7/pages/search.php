<?php
require_once '../includes/header.php';
?>

<div class="container mt-4">
    <h2>Поиск проектов</h2>
    
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label for="search-project" class="form-label">Название проекта:</label>
                <input type="text" class="form-control" id="search-project" placeholder="Начните вводить...">
            </div>
            
            <div id="project-results" class="mt-3"></div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/search.js"></script>

<?php
require_once '../includes/footer.php';
?>