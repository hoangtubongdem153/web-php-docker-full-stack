pipeline {
    agent any   

    environment {  
        SNYK_TOKEN = credentials('snyk-api-token') // Lấy api từ credential jenkins
    }
    
    stages {
        stage('Checkout') {
            steps {
                echo 'Hello World!'
                checkout scm
            }
        }

        stage('Install Dependencies') {
            steps {
                // Cài đặt , cập nhậtnhật các dependencies cần thiết!
                sh 'npm install'
            }
        }

        stage('Test Snyk SCA Scan!') {
            steps {
                echo 'Testing...'
                snykSecurity(
                    severity: 'high', // chỉnh sửa mức độ quét lỗ hổng mức high!   
                    snykInstallation: 'Snyk', 
                    snykTokenId: 'snyk_api_token',
                    failOnError: true 
                )
            }
        }

        stage('Test Snyk SAST Scan!') {
            steps {
                echo 'Testing...'
                sh 'snyk auth ${SNYK_TOKEN}'
                sh "snyk code test  --severity-threshold=high --json > snyk-report.json" // Thực hiện Snyk test
                // Xử lý kết quả quét
                sh 'snyk-to-html -i snyk-report.json -o snyk-report.html'
                // lưu kết quả vào file html
                archiveArtifacts artifacts: 'snyk-report.html' 
            }
        }
            
        stage('Stop current Webapp!') {
            steps {
                sh 'docker-compose down'
                sleep time: 5, unit: 'SECONDS'
            }
        }
        
        stage('Build and Run with Docker Compose') {
            steps {
                sh 'docker-compose up -d --build' 
            }
        }

        stage('Test Web App') { // Thêm các bước kiểm thử nếu cần
            steps {
                echo 'Done!' // 
            }
        }
    }
    
    post {
        failure {
            echo 'Resetting local changes...'
            // Hoàn nguyên các thay đổi đã fetch từ GitHub
            sh 'git reset --hard HEAD~1'
        }
        always {
            echo 'Pipeline finished.'
        }
    } 
    
} 
