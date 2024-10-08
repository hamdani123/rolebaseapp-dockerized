pipeline{
    agent any
    environment{
        staging_server="103.49.239.60"
    }

    stages{
        stage('Deploy to remote'){
            steps{
                sh'scp ${WORKSPACE}/* root@${staging_server}:/home/app/'
            }
        }
    }
}
