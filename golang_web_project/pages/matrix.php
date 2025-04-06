<?php
require_once '../includes/header.php';

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rows = (int)$_POST['rows'];
    $cols = (int)$_POST['cols'];
    
    // Генерация матрицы
    $matrix = generateMatrix($rows, $cols);
    
    // Отрисовка матрицы
    $image = drawMatrix($matrix);
}
?>

<div class="container mt-4">
    <h2>Генератор матриц</h2>
    
    <form method="POST" class="mb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <label for="rows" class="form-label">Количество строк (1-12):</label>
                <input type="number" class="form-control" id="rows" name="rows" 
                       min="1" max="12" value="<?= $_POST['rows'] ?? 12 ?>" required>
            </div>
            
            <div class="col-md-3">
                <label for="cols" class="form-label">Количество столбцов (1-19):</label>
                <input type="number" class="form-control" id="cols" name="cols" 
                       min="1" max="19" value="<?= $_POST['cols'] ?? 19 ?>" required>
            </div>
            
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Сгенерировать</button>
            </div>
        </div>
    </form>

    <?php if (isset($matrix)): ?>
    <div class="row">
        <div class="col-md-6">
            <h4>Матрица:</h4>
            <pre><?= printMatrix($matrix) ?></pre>
        </div>
        <div class="col-md-6">
            <h4>Визуализация:</h4>
            <?= $image ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php
require_once '../includes/footer.php';

// Функции для работы с матрицами
function generateMatrix($rows, $cols) {
    $matrix = [];
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            // Логика заполнения матрицы как в JS-коде
            if ($i % 2 == 0) {
                $numRectangles = $cols;
            } else {
                $numRectangles = floor($cols / 2);
            }
            
            if (($cols - $j - 1) < $numRectangles) {
                $matrix[$i][$j] = (($j - $i % 2) % 2 == 0) ? 2 : 1;
            } else {
                $matrix[$i][$j] = 0;
            }
        }
    }
    return $matrix;
}

function printMatrix($matrix) {
    $output = "";
    foreach ($matrix as $row) {
        foreach ($row as $cell) {
            $output .= sprintf("%2d ", $cell);
        }
        $output .= "\n";
    }
    return $output;
}

function drawMatrix($matrix) {
    $size = 10;
    $spacing = 30;
    $width = count($matrix[0]) * $spacing + $size;
    $height = count($matrix) * $spacing + $size;
    
    $svg = '<svg width="'.$width.'" height="'.$height.'" style="border:1px solid #ccc">';
    
    foreach ($matrix as $i => $row) {
        foreach ($row as $j => $cell) {
            $x = $j * $spacing;
            $y = $i * $spacing;
            
            if ($cell == 1) {
                $color = "#8d6";
            } elseif ($cell == 2) {
                $color = "#44f";
            } else {
                continue;
            }
            
            $svg .= '<rect x="'.$x.'" y="'.$y.'" width="'.$size.'" height="'.$size.'" 
                     stroke="'.$color.'" fill="'.$color.'" />';
        }
    }
    
    $svg .= '</svg>';
    return $svg;
}
?>