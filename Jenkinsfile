pipeline {
    agent any

    environment {
        SNYK_TOKEN = credentials('snyk-api-token') // Lấy api từ credential jenkins
    }
    
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
                    snykTokenId: 'SNYK_TOKEN',
                    failOnError: false
                )
            }
        }

        stage('Test Snyk SAST Scan!') {
            steps {
                echo 'Testing...'
                sh "snyk config set api=${SNYK_TOKEN}" // Cấu hình Snyk token
                sh "snyk code test --json-file-output=snyk-report.json --severity-threshold=high" // Thực hiện Snyk test
                // Xử lý kết quả quét
                script {
                    def snykResult = readJSON file: 'snyk-report.json'
                    if (snykResult.vulnerabilities.size() > 0) {
                        error("Snyk found vulnerabilities!")
                    }
                }
            }
        }

        stage('Stop current Webapp!') {
            steps {
                sh 'docker-compose down'
                sleep time: 10, unit: 'SECONDS'
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
            // Chuyển đổi báo cáo JSON thành HTML và lưu trữ báo cáo Snyk
            sh 'snyk-to-html -i snyk-report.json -o snyk-report.html'
            archiveArtifacts artifacts: 'snyk-report.html'
        }
    }
}
