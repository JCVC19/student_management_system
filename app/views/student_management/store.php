<?php
require_once '../../../config/Database.php';
require_once '../../models/Student.php';

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);



if(!isset($_SESSION['email'])){
    header('Location: ../authentication/login.php');
}



$database = new Database();
$db = $database->getConnection();

Student::setConnection($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $existingStudentId = Student::findByStudentId($_POST['student_id']);

    if($existingStudentId){
        $_SESSION['student_error'] = "Student ID is already taken.";
        header('Location: create.php');
        exit();
    }
    else{
        $student_id = trim($_POST['student_id']);
        $name = trim($_POST['name']);
        $gender = $_POST['gender'];
        $birthdate = $_POST['birthdate'];
        $course_id = intval($_POST['course_id']);
        $year_level = intval($_POST['year_level']);
        $status = $_POST['status'];

        $data = [
            'student_id' => $student_id,
            'name' => $name,
            'gender' => $gender,
            'birthdate' => $birthdate,
            'course_id' => $course_id,
            'year_level' => $year_level,
            'status' => $status
        ];

        $newStudent = Student::create($data);
        include '../layout/header.php';
        if ($newStudent) {
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
    }
}
include '../layout/footer.php';
?>
