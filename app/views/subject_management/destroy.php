<?php

require_once '../../../config/Database.php';
require_once '../../models/Subject.php';

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if(!isset($_SESSION['email'])){
    header('Location: ../authentication/login.php');
}

include '../layout/header.php';
require '../../../permission.php';
$database = new Database();
$db = $database->getConnection();
Subject::setConnection($db);

$subject = Subject::find($_GET['id']);

if(empty($subject)){
    http_response_code(404);
    echo "<div class='container-full error-container'>
                <div class='error-bg'>
                    <div class = 'error-page'><h1>∑(; °Д°)</h1><br><h4>Subject not found</h4><a class = 'btn go-back' href = '/student_management_system/index.php'>Go Back</a></div>
                </div>
            </div>";
    exit();
}

$subject->delete();

if($subject){
    echo '<script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "Record has been deleted successfully",
                showConfirmButton: false,
                timer: 1500,
                        customClass: {
                            container: "custom-container"
                        }
            }).then(function(){
                window.location = "index.php";
            });
        </script>';
} else {
    echo '<script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Failed to delete the record, please try again!",
                showConfirmButton: false,
                timer: 1500
            }).then(function(){
                window.location = "index.php";
            });
        </script>';
}
include '../layout/footer.php';