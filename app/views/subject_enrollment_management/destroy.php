<?php

require_once '../../../config/Database.php';
require_once '../../models/Subject_Enrollment.php';
require_once '../../models/Student.php';
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

Student::setConnection($db);
Subject_Enrollment::setConnection($db);

$student = Student::find($_GET['id']);

if(empty($student)){
    http_response_code(404);
    echo "<div class='container-full error-container'>
                <div class='error-bg'>
                    <div class = 'error-page'><h1>∑(; °Д°)</h1><br><h4>Error not found</h4><a class = 'btn go-back' href = '/student_management_system/index.php'>Go Back</a></div>
                </div>
            </div>";
    exit();
}

$subjects = $student->subjects();

$subject_enrollment = Subject_Enrollment::all();

foreach($subject_enrollment as $enrollment){
    foreach($subjects as $subject){
        if($enrollment->student_id == $_GET['id'] && $enrollment->subject_id == $subject->id){
            $enrollment->delete();
        }
    }
}

if($enrollment){
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
                window.location = "../subject_management/show.php?id='.$subject->id.'";
            });
        </script>';
} else {
    echo '<script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Failed to delete the record, please try again!",
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    container: "custom-container"
                }
            }).then(function(){
                window.location = "../subject_management/show.php?id='.$subject->id.'";
            });
        </script>';
}
include '../layout/footer.php';