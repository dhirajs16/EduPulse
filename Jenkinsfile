pipeline {
    agent any
    stages {
        stage('Checkout') {
            echo 'Checking out code from GitHub...'
        }

        stage('Build') {
            echo 'Building Laravel Project...'
            bat 'composer install --no-interaction --prefer-dist --no-dev'
            bat 'php artisan key:generate --no-interaction --force'
            bat 'php artisan config:cache'
            bat 'php artisan route:cache'
            bat 'php artisan view:cache'
        }

        stage('Test') {
            echo 'Testing Laravel Project...'
            bat 'php artisan test --filter="critical"'
        }
    }
    post {
        always {
            echo 'Cleaning up...'
            bat 'php artisan config:clear'
            bat 'php artisan route:clear'
            bat 'php artisan view:clear'
        }
    }
}
