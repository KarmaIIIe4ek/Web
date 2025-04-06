/**
 * AJAX поиск проектов с использованием jQuery
 * Обрабатывает ввод в поле поиска и отправляет запросы к API
 */

$(document).ready(function() {
    // Элементы DOM
    const $searchInput = $('#search-project');
    const $resultsContainer = $('#project-results');
    const $loadingIndicator = $('<div class="loading-indicator">Загрузка...</div>');
    
    // Конфигурация
    const config = {
        minQueryLength: 2,      // Минимальная длина запроса
        debounceDelay: 300,     // Задержка между запросами (мс)
        apiUrl: '../api/search_projects.php' // Правильный относительный путь
    };
    
    // Таймер для debounce
    let searchTimer = null;
    
    // Обработчик ввода
    $searchInput.on('input', function() {
        const query = $(this).val().trim();
        
        // Очищаем предыдущий таймер
        clearTimeout(searchTimer);
        
        // Показываем индикатор загрузки
        $resultsContainer.empty().append($loadingIndicator);
        
        // Проверяем минимальную длину запроса
        if (query.length < config.minQueryLength) {
            $resultsContainer.empty();
            return;
        }
        
        // Устанавливаем новый таймер с debounce
        searchTimer = setTimeout(() => {
            performSearch(query);
        }, config.debounceDelay);
    });
    
    // Функция выполнения поиска
    function performSearch(query) {
        $.ajax({
            url: config.apiUrl,
            method: 'GET',
            data: { query: query },
            dataType: 'html',
            beforeSend: function() {
                $loadingIndicator.show();
            },
            success: function(data) {
                $resultsContainer.html(data);
                
                // Логирование для отладки
                console.log('Успешный запрос к:', config.apiUrl);
                console.log('Результаты:', data);
            },
            error: function(xhr, status, error) {
                const errorMsg = `
                    <div class="alert alert-danger">
                        Ошибка загрузки: ${xhr.status} ${error}<br>
                        URL: ${config.apiUrl}?query=${encodeURIComponent(query)}
                    </div>
                `;
                $resultsContainer.html(errorMsg);
                
                console.error('Ошибка AJAX запроса:', {
                    status: xhr.status,
                    error: error,
                    url: xhr.responseURL
                });
            },
            complete: function() {
                $loadingIndicator.hide();
            }
        });
    }
    
    // Инициализация
    console.log('Search module initialized');
    console.log('Base API URL:', config.apiUrl);
});