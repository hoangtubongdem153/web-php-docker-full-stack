pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                echo 'Hello World!'
            }
        }

        stage('Stop current Webapp!') {
            steps {
                sh 'docker-compose stop'
            }
        }

        stage('Build and Run with Docker Compose') {
            steps {
                sh 'docker-compose up -d' 
            }
        }

        stage('Test Web App') { // (Tùy chọn) Thêm các bước kiểm thử nếu cần
            steps {
                sh 'curl http://localhost:80' // Hoặc cổng mà ứng dụng của bạn chạy
            }
        }
    }
}
