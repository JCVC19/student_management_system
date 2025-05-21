<?php
    require_once 'config/Database.php';
    require_once 'app/models/User.php';

    
    $database = new Database();
    $db = $database->getConnection();
    
    User::setConnection($db);
  
    
    $user = User::findByEmail($_SESSION['email']);

    if($user->role != 'superadmin' && $user->role != 'admin') {
        http_response_code(403);
            echo "<div class='container-full error-container'>
                    <div class='error-bg'>
                        <div class = 'error-page'><h1>(ノ-_-)ノ┴┴</h1><br><h4>You do not have access to this page</h4><a class = 'btn go-back' href = '/student_management_system/index.php'>Go Back</a></div>
                    </div>
                  </div>";
            exit();
    }
?>