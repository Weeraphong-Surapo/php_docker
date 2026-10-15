pipeline {
    agent any

    environment {
        IMAGE_NAME   = 'php-test'
        CONTAINER    = 'php-test-8090'
        HOST_PORT    = '8090'
        REGISTRY     = ''
    }

    stages {

        // ----------------------------------------------------------------
        // 1. Checkout source code
        // ----------------------------------------------------------------
        stage('Checkout') {
            steps {
                echo '📥 Checking out source code...'
                checkout scm
            }
        }

        // ----------------------------------------------------------------
        // 2. Build Docker image
        // ----------------------------------------------------------------
        stage('Build') {
            steps {
                echo "🔨 Building Docker image: ${IMAGE_NAME}:${BUILD_NUMBER}"
                sh """
                    docker build \
                        -t ${IMAGE_NAME}:${BUILD_NUMBER} \
                        -t ${IMAGE_NAME}:latest \
                        .
                """
            }
        }

        // ----------------------------------------------------------------
        // 3. Test – ตรวจสอบว่า container start ได้และตอบกลับ HTTP 200
        // ----------------------------------------------------------------
        stage('Test') {
            steps {
                echo '🧪 Running smoke test...'
                sh """
                    docker run -d \
                        --name test-${BUILD_NUMBER} \
                        -p 8099:80 \
                        ${IMAGE_NAME}:${BUILD_NUMBER}

                    sleep 3

                    STATUS=\$(curl -s -o /dev/null -w "%{http_code}" http://localhost:8099)
                    echo "HTTP Status: \$STATUS"

                    docker stop test-${BUILD_NUMBER}
                    docker rm  test-${BUILD_NUMBER}

                    [ "\$STATUS" = "200" ] || { echo "❌ Smoke test failed (status \$STATUS)"; exit 1; }
                    echo "✅ Smoke test passed"
                """
            }
        }

        // ----------------------------------------------------------------
        // 4. Deploy – หยุด container เก่า แล้วรันตัวใหม่บน port 8090
        // ----------------------------------------------------------------
        stage('Deploy') {
            steps {
                echo "🚀 Deploying container on port ${HOST_PORT}..."
                sh """
                    docker stop ${CONTAINER} 2>/dev/null || true
                    docker rm   ${CONTAINER} 2>/dev/null || true

                    docker run -d \
                        --name ${CONTAINER} \
                        --restart unless-stopped \
                        -p ${HOST_PORT}:80 \
                        ${IMAGE_NAME}:${BUILD_NUMBER}

                    echo "✅ Container ${CONTAINER} is running on port ${HOST_PORT}"
                """
            }
        }

        // ----------------------------------------------------------------
        // 5. Clean up – ลบ image เก่าที่ไม่ได้ใช้
        // ----------------------------------------------------------------
        stage('Cleanup') {
            steps {
                echo '🧹 Removing dangling images...'
                sh 'docker image prune -f'
            }
        }
    }

    post {
        success {
            echo "🎉 Build #${BUILD_NUMBER} deployed successfully → http://<server-ip>:${HOST_PORT}"
        }
        failure {
            echo "💥 Build #${BUILD_NUMBER} failed. Check logs above."
            sh """
                docker stop test-${BUILD_NUMBER} 2>/dev/null || true
                docker rm   test-${BUILD_NUMBER} 2>/dev/null || true
            """
        }
        always {
            echo "📋 Pipeline finished with status: ${currentBuild.currentResult}"
        }
    }
}
