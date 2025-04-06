-- Создание базы данных
CREATE DATABASE IF NOT EXISTS golang_db;
USE golang_db;

-- Таблица проектов на Golang
CREATE TABLE IF NOT EXISTS golang_projects (
    project_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    github_url VARCHAR(255) NOT NULL,
    stars INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Таблица разработчиков
CREATE TABLE IF NOT EXISTS golang_developers (
    dev_id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NOT NULL,
    username VARCHAR(100) NOT NULL,
    experience INT NOT NULL,
    country VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES golang_projects(project_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Добавление тестовых данных
INSERT INTO golang_projects (name, description, github_url, stars) VALUES
('Docker', 'Контейнеризация приложений', 'https://github.com/docker', 65000),
('Kubernetes', 'Оркестрация контейнеров', 'https://github.com/kubernetes', 95000),
('Gin', 'HTTP веб-фреймворк', 'https://github.com/gin-gonic/gin', 65000);

INSERT INTO golang_developers (project_id, username, experience, country) VALUES
(1, 'John Smith', 5, 'USA'),
(1, 'Anna Lee', 3, 'Canada'),
(2, 'Robert Chen', 7, 'Germany'),
(3, 'Mikhail Petrov', 4, 'Russia');