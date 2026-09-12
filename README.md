# AWS DevOps Application Deployment using Docker, PHP & MySQL

A beginner-friendly DevOps project with an attractive PHP interface and MySQL database.

## What this project teaches

1. Git & GitHub
2. Linux basics
3. Docker and Docker Compose
4. PHP + Apache
5. MySQL database
6. Environment variables
7. Application and database containers
8. Later: Docker Hub
9. Later: AWS EC2 deployment

## Run locally

### Requirements
- Docker Desktop
- Git

### Start
```bash
docker compose up --build
```

Open:
http://localhost:8080

### Stop
```bash
docker compose down
```

### Stop and remove database data
```bash
docker compose down -v
```

## Project structure

```text
aws-devops-php-mysql-docker/
├── database/
│   └── init.sql
├── src/
│   ├── db.php
│   ├── index.php
│   └── style.css
├── Dockerfile
├── docker-compose.yml
├── .gitignore
└── README.md
```

## Next DevOps steps

After confirming the application works locally:

- Create a GitHub repository
- Push this project
- Create a Docker Hub repository
- Build and push the Docker image
- Create an AWS EC2 instance
- Install Docker on EC2
- Clone the GitHub repository
- Run the application on EC2
- Configure AWS Security Group
- Open the application using the EC2 public IP

## Important

This project is for learning. Before production use, change the database passwords and move secrets to environment variables or a secrets manager.
