pipeline {
  agent any
  environment {
    staging_server="103.49.239.60"
    remote_dir="/home/app/rolebase1"
    remote_user="app"

  }
  stages {
    stage('Deploy') {
      steps {
        /*  
        // Change permissions securely
        sh 'find ${WORKSPACE} -type d -exec chmod 755 {} \\;'
        sh 'find ${WORKSPACE} -type f -exec chmod 644 {} \\;'

        // Sync files excluding certain directories
        sh "rsync -avP --exclude='.env' --exclude='vendor' --exclude='.git' --exclude='storage' --delete '${WORKSPACE}/' '${remote_user}@${staging_server}:${remote_dir}'"
        
        // Copy the docker directory
        sh "scp -r '${WORKSPACE}/docker' '${remote_user}@${staging_server}:${remote_dir}'"
        */
        sh 'chmod 777 -R ${WORKSPACE}/*'
        sh 'rsync -avP --exclude ".env" --exclude "vendor" --exclude ".git" --exclude="storage" --delete ${WORKSPACE}/ ${remote_user}@${staging_server}:${remote_dir}'
        sh 'scp -r ${WORKSPACE}/docker ${remote_user}@${staging_server}:${remote_dir}'  
      }
    }
  }
}
