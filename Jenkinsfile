pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                echo 'Hello World!'
            }
        }

        stage('Install Dependencies') {
            steps {
                // Cài đặt các dependencies cần thiết (ví dụ: npm install)!
                sh 'npm install'
            }
        }

        stage('Test Snyk SCA Scan!') {
            steps {
                echo 'Testing...'
                snykSecurity(
                    severity: 'high', 
                    snykInstallation: 'Snyk', 
                    snykTokenId: 'snyk_api_token',
                    failOnError: false
                )
            }
        }

        stage('Test Snyk SAST Scan!') {
            steps {
                echo 'Testing...'
            }
        }

        stage('Stop current Webapp!') {
            steps {
                sh 'docker-compose down'
                sleep time: 15, unit: 'SECONDS'
            }
        }
        
        stage('Build and Run with Docker Compose') {
            steps {
                sh 'docker-compose up -d --build' 
            }
        }

        stage('Test Web App') { // (Tùy chọn) Thêm các bước kiểm thử nếu cần
            steps {
                echo 'Done!' // ứng dụng đang chạy
            }
        }
    }

    post {
        always {
            // Các bước cần thực hiện sau khi hoàn thành pipeline, ví dụ: lưu trữ kết quả kiểm tra
            archiveArtifacts artifacts: '**/target/*.xml', allowEmptyArchive: true
            junit '**/target/surefire-reports/*.xml'
        }
    }
}
