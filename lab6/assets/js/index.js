// Основные JavaScript-функции
document.addEventListener('DOMContentLoaded', function() {
    // Подтверждение удаления
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Вы уверены, что хотите удалить эту запись?')) {
                e.preventDefault();
            }
        });
    });

    // Динамическая загрузка данных
    if (document.getElementById('projects-container')) {
        fetchProjects();
    }
});

function fetchProjects() {
    fetch('/api/projects.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('projects-container');
            container.innerHTML = '';
            data.forEach(project => {
                container.appendChild(createProjectCard(project));
            });
        });
}

function createProjectCard(project) {
    const card = document.createElement('div');
    card.className = 'col-md-4 mb-4';
    card.innerHTML = `
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">${project.name}</h5>
                <p class="card-text">${project.description}</p>
                <a href="${project.github_url}" target="_blank" class="btn btn-sm btn-outline-primary">GitHub</a>
            </div>
        </div>
    `;
    return card;
}