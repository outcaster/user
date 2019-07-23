pipeline {
    agent any
    environment {
        // Specify your environment variables.
        APP_VERSION = '1'
    }
    stages {
        stage('Build') {
            steps {
                // Print all the environment variables.
                sh 'printenv'
                sh 'echo $GIT_BRANCH'
                sh 'echo $GIT_COMMIT'
                echo 'Install non-dev composer packages and test a symfony cache clear'
                sh 'cmd/composer install'
            }
        }
        stage('QA') {
            steps {
                echo 'Complete QA'
                sh 'cmd/qa'
            }
        }
    }
    post {
        always {
            // Always cleanup after the build.
            sh 'rm .env'
        }
    }
}