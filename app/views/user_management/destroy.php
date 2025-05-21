<?php require_once  '../../../config/Database.php'; 
    $db = new Database();
    $conn = $db->getConnection();
?>
<?php 
require_once '../../models/User.php'; 
require_once '../../models/Subject.php';

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if(!isset($_SESSION['email'])){
    header('Location: ../authentication/login.php');
}

include '../layout/header.php';
require '../../../permission.php';
?>

<?php

User::setConnection($conn);
$user = User::find($_GET['id']);
$subjects = Subject::findByInstructor($user->id);

if($subjects){
    include  '../layout/footer.php'; 
    echo '<script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Cannot delete user with subjects",
                showConfirmButton: false,
                timer: 1500,
                    customClass: {
                        container: "custom-container"
                    }
            }).then(function(){
                window.location = "index.php";
            });
        </script>';
    exit();
}

if ($user->role == 'admin'){
    include  '../layout/footer.php'; 
    echo '<script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Cannot delete admin",
                showConfirmButton: false,
                timer: 1500,
                    customClass: {
                        container: "custom-container"
                    }
            }).then(function(){
                window.location = "index.php";
            });
        </script>';
    exit();
}

if(empty($user)){
    http_response_code(404);
    echo "<div class='container-full error-container'>
                <div class='error-bg'>
                    <div class = 'error-page'><h1>∑(; °Д°)</h1><br><h4>User not found</h4><a class = 'btn go-back' href = '/student_management_system/index.php'>Go Back</a></div>
                </div>
            </div>";
    exit();
}



$user->delete();

    
if($user){
    echo '<script>
            Swal.fire({
                icon: "success",
                title: "Deleted",
                text: "Record has been deleted successfully!",
                showConfirmButton: false,
                timer: 1500,
                    customClass: {
                        container: "custom-container"
                    }
            }).then(function(){
                window.location = "index.php";
            });
        </script>';
}else{
    echo '<script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Record has been failed to delete!",
                showConfirmButton: false,
                timer: 1500,
                    customClass: {
                        container: "custom-container"
                    }
            }).then(function(){
                window.location = "index.php";
            });
        </script>';
}
    
include  '../layout/footer.php'; 
?>