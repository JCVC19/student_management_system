<?php
require_once '../../../config/Database.php';
require_once '../../models/Subject_Enrollment.php';

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

include '../layout/header.php';

if (!isset($_SESSION['email'])) {
    header('Location: ../authentication/login.php');
}

$database = new Database();
$db = $database->getConnection();
Subject_Enrollment::setConnection($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enroll_student = Subject_Enrollment::create([
        'subject_id' => $_POST['subject_id'],
        'student_id' => $_POST['student_id'],
        'status' => $_POST['status']
    ]);

    if ($enroll_student) {
        echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Student has been enrolled successfully",
                    showCancelButton: true,
                    confirmButtonText: "Enroll Another",
                    cancelButtonText: "Go Back",
                    customClass: {
                        container: "custom-container"
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "create.php?id=' . $_POST['subject_id'] . '"; 
                    } else {
                        window.location.href = "../subject_management/show.php?id=' . $_POST['subject_id'] . '";
                    }
                });
            </script>';
    } else {
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Failed to enroll the student, please try again!",
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        container: "custom-container"
                    }
                }).then(() => {
                    window.location.href = "create.php?id=' . $_POST['subject_id'] . '";
                });
            </script>';
    }
}
include '../layout/footer.php';
?>
