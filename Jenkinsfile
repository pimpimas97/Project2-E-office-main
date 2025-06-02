pipeline {
    agent any

    stages {
        stage('Clone repository') {
            steps {
                git branch: 'main', url: 'https://github.com/username/your-laravel-repo.git'
            }
        }

        stage('Build Docker image') {
            steps {
                sh 'docker build -t laravel-app .'
            }
        }

        stage('Run Docker container') {
            steps {
                sh 'docker run -d -p 8000:8000 laravel-app'
            }
        }
    }
}
