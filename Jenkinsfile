pipeline {
  agent any
  environment {
    staging_server="103.49.239.60"
    remote_dir="/home/app/"
    remote_user="app"
  }
  stages {
    stage('Deploy') {
      steps {
        sh 'chmod 777 -R ${WORKSPACE}/*'
        sh """
            rsync -avP --exclude=".env" --exclude="vendor" --exclude=".git" --exclude="storage" --delete --rsh="ssh -i /path/to/private_key -o StrictHostKeyChecking=no" ${WORKSPACE}/ ${remote_user}@${staging_server}:${remote_dir}
        """
        sh 'scp -r ${WORKSPACE}/docker ${remote_user}@${staging_server}:${remote_dir}'

      }
    }
    stage('Project Build'){
        steps{
            //sh 'ssh ${remote_user}@${staging_server} "rm -rf ${remote_dir}/.editorconfig .env .env.example .idea"'
            sh 'ssh ${remote_user}@${staging_server} "cd ${remote_dir} && cp .env.example .env"'
            sh 'ssh ${remote_user}@${staging_server} "cd ${remote_dir} && sudo -u ${remote_user} docker compose up --build -d"'
            sh 'ssh ${remote_user}@${staging_server} "cd ${remote_dir} && sudo -u ${remote_user} docker compose run --rm app composer install"'
        }
    }
    stage('config:cache'){
        steps{
            sh 'ssh ${remote_user}@${staging_server} "cd ${remote_dir} && sudo -u ${remote_user} docker compose run --rm app php artisan config:cache"'

        }
    }
    stage('Migration') {
      steps {
        sh 'ssh ${remote_user}@${staging_server} "cd ${remote_dir} && sudo -u ${remote_user} docker compose run --rm app php artisan migrate"'
        
      }
    }

    /* stage('Seed') {
      steps {
        sh 'ssh ${remote_user}@${staging_server} "cd ${remote_dir} && sudo -u ${remote_user} docker compose run --rm app php artisan db:seed"'
      }
    } */
  }
}
