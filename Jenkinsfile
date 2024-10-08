pipeline {
  agent any
  environment {
    staging_server="103.49.239.60" // app server ip 
    remote_dir="/home/app/rolebase" // app server directory
    remote_user="app" // app server user
  }
  stages {
    stage('Deploy') {
      steps {
        sh 'chmod 777 -R ${WORKSPACE}/*'
        sh 'rsync -avP --exclude .env --exclude vendor --exclude .git --exclude=storage --delete -e "ssh -vvv" /var/lib/jenkins/workspace/auto-deployment/ app@103.49.239.60:/home/app/rolebase'
        sh 'scp -r ${WORKSPACE}/docker ${remote_user}@${staging_server}:${remote_dir}'
        
      }
    }
    
  }
}
