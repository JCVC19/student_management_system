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

$couse = new Course();
$course = $couse->create([
    'code' => $_POST['code'],
    'name' => $_POST['name']
]);

if($course){
   echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Record has been saved successfully",
                    showCancelButton: true,
                    confirmButtonText: "Create Another",
                    cancelButtonText: "Go to List",
                    customClass: {
                        container: "custom-container"
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "create.php"; 
                    } else {
                        window.location.href = "index.php"; 
                    }
                });
            </script>';
    }
    else{
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Failed to save the record, please try again!",
                    showConfirmButton: true,
                    confirmButtonText: "Try Again",
                    customClass: {
                        container: "custom-container"
                    }
                }).then(() => {
                    window.location.href = "create.php";
                });
            </script>';
    }
include '../layout/footer.php';

?>