<?php
require_once '../../../config/Database.php';
require_once '../../models/Course.php';
require_once '../../models/Subject.php';

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if(!isset($_SESSION['email'])){
    header('Location: ../authentication/login.php');
}

include '../layout/header.php';
 require '../../../permission.php';
$db = new Database();
$conn = $db->getConnection();
Course::setConnection($conn);

$course = Course::find($_GET['id']);

if(empty($course)){
    http_response_code(404);
    echo "<div class='container-full error-container'>
                <div class='error-bg'>
                    <div class = 'error-page'><h1>∑(; °Д°)</h1><br><h4>Course not found</h4><a class = 'btn go-back' href = '/student_management_system/index.php'>Go Back</a></div>
                </div>
            </div>";
    exit();
}
if($course){
    $course->delete();

    if($course){
        echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Course deleted successfully!",
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
                    text: "Failed to delete course!",
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
}
include '../layout/footer.php';
?>