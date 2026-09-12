CREATE DATABASE IF NOT EXISTS devops_app;
USE devops_app;

CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    status ENUM('Pending','In Progress','Completed') NOT NULL DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO tasks (title, description, status) VALUES
('Docker environment ready', 'Application and MySQL are running with Docker Compose.', 'Completed'),
('Connect PHP with MySQL', 'Verify database connectivity from the PHP application.', 'In Progress'),
('Deploy on AWS EC2', 'Next step: deploy this project to an AWS EC2 instance.', 'Pending');
