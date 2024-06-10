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
                // sh 'npm install --package-lock-only'
                // sh 'npm ci'
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

        // stage('Test Snyk SAST Scan!') {
        //     steps {
        //         echo 'Testing...'
        //         sh 'snyk auth ${SNYK_TOKEN}'
        //         sh "snyk code test  --severity-threshold=high --json-file-output=snyk-report.json" // Thực hiện Snyk test
        //         // Xử lý kết quả quét
        //         sh 'snyk-to-html -i snyk-report.json -o snyk-report.html'
        //         archiveArtifacts artifacts: 'snyk-report.html' 
        //     }
        // }
            
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
    
}  // Chỉnh sửa file để kích hoạt trigger jenkins pipeline!
