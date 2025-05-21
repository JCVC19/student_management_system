<?php
require_once '../../../config/Database.php';
require_once '../../models/Course.php';

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
$course = Course::find($_POST['id']);

if($course){
    $course = $course->update([
        'id' => $_POST['id'],
        'code' => $_POST['code'],
        'name' => $_POST['name']
    ]);

    if(!$course){
        echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Course updated successfully!",
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
                    text: "Failed to update course!",
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
?>

