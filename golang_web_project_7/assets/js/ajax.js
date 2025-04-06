/**
 * AJAX модуль для проверки имени пользователя с выводом информации о браузере
 */

document.addEventListener('DOMContentLoaded', function() {
    // Конфигурация
    const config = {
        minLength: 3,
        debounceTime: 300,
        apiBaseUrl: '../api/check_username.php',
        uiSelectors: {
            input: '#username',
            status: '#username-status',
            browserInfo: '#browser-info' // Новый элемент для вывода информации
        }
    };

    // Получаем элементы DOM
    const elements = {
        input: document.querySelector(config.uiSelectors.input),
        status: document.querySelector(config.uiSelectors.status),
        browserInfo: document.querySelector(config.uiSelectors.browserInfo)
    };

    // Проверяем наличие элементов
    if (!elements.input || !elements.status) {
        console.error('Не найдены необходимые элементы DOM');
        return;
    }

    /**
     * Получает информацию о браузере
     */
    function getBrowserInfo() {
        const userAgent = navigator.userAgent;
        let browserName;
        
        // Определяем браузер
        if (userAgent.includes('Firefox')) browserName = 'Mozilla Firefox';
        else if (userAgent.includes('Chrome')) browserName = 'Google Chrome';
        else if (userAgent.includes('Safari')) browserName = 'Apple Safari';
        else if (userAgent.includes('Opera')) browserName = 'Opera';
        else if (userAgent.includes('Edge')) browserName = 'Microsoft Edge';
        else browserName = 'Неизвестный браузер';
        
        return {
            name: browserName,
            version: userAgent.match(/(?:Chrome|Firefox|Safari|Opera|Edge|Version)[\s\/](\d+(\.\d+)?)/)?.[1] || 'неизвестна',
            userAgent: userAgent,
            platform: navigator.platform,
            cookiesEnabled: navigator.cookieEnabled ? 'да' : 'нет'
        };
    }

    /**
     * Показывает информацию о браузере
     */
    function displayBrowserInfo() {
        const browser = getBrowserInfo();
        const infoHTML = `
            <div class="browser-info-card">
                <h4>Информация о браузере</h4>
                <p><strong>Браузер:</strong> ${browser.name} (версия ${browser.version})</p>
                <p><strong>Платформа:</strong> ${browser.platform}</p>
                <p><strong>Cookies:</strong> ${browser.cookiesEnabled}</p>
                <p><strong>User Agent:</strong> <small>${browser.userAgent}</small></p>
                <p><strong>XHR поддержка:</strong> ${window.XMLHttpRequest ? 'есть' : 'отсутствует'}</p>
            </div>
        `;
        
        if (elements.browserInfo) {
            elements.browserInfo.innerHTML = infoHTML;
        } else {
            console.warn('Элемент для вывода информации о браузере не найден');
        }
    }

    /**
     * Выполняет проверку имени пользователя
     */
    function checkUsername(username) {
        const xhr = new XMLHttpRequest();
        const url = `${config.apiBaseUrl}?username=${encodeURIComponent(username)}`;
        
        xhr.open('GET', url, true);
        xhr.setRequestHeader('Accept', 'application/json');
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        updateUI(response, xhr);
                    } catch (e) {
                        showError('Ошибка обработки ответа сервера');
                    }
                } else {
                    showError(`Ошибка сервера: ${xhr.status}`);
                }
            }
        };
        
        xhr.send();
    }

    /**
     * Обновляет интерфейс на основе ответа сервера
     */
    function updateUI(response, xhr) {
        if (response.exists) {
            showStatus('Это имя уже занято', 'error');
        } else {
            showStatus('Имя доступно', 'success');
        }
        
        // Дополнительная информация для отладки
        console.group('Информация о запросе');
        console.log('Браузер:', navigator.userAgent);
        console.log('XHR объект:', xhr);
        console.log('Ответ сервера:', response);
        console.groupEnd();
    }

    /**
     * Показывает статус
     */
    function showStatus(message, type) {
        elements.status.textContent = message;
        elements.status.className = `status ${type}`;
    }

    /**
     * Показывает ошибку
     */
    function showError(message) {
        showStatus(message, 'error');
    }

    // Инициализация
    elements.input.addEventListener('input', function() {
        const username = this.value.trim();
        
        clearTimeout(this.debounceTimer);
        
        if (username.length >= config.minLength) {
            showStatus('Проверка...', 'info');
            this.debounceTimer = setTimeout(() => {
                checkUsername(username);
            }, config.debounceTime);
        } else {
            showStatus(`Введите минимум ${config.minLength} символа`, 'warning');
        }
    });

    // Показываем информацию о браузере при загрузке
    displayBrowserInfo();
    console.log('AJAX модуль инициализирован');
});