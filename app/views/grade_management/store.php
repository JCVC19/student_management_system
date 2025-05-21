<?php
require_once '../../../config/Database.php';
require_once '../../models/Grade.php';

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

include '../layout/header.php';

if (!isset($_SESSION['email'])) {
    header('Location: ../authentication/login.php');
}

$database = new Database();
$db = $database->getConnection();
Grade::setConnection($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $grade = Grade::create([
        'subject_id' => $_GET['subject_id'],
        'student_id' => $_GET['student_id'],
        'instructor_id' => $_GET['instructor_id'],
        'grade' => $_POST['grade'],
        'remarks' => $_POST['remarks']
    ]);

    if ($grade) {
        echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Student has been graded successfully",
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        container: "custom-container"
                    }
                }).then(function(){
                    window.location.href = "show.php?id=' . $_GET['subject_id'] . '";
                });
            </script>';

    } else {
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Failed to grade the student, please try again!",
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        container: "custom-container"
                    }
                }).then(function(){
                    window.location.href = "create.php?student_id=' . $_GET['student_id'] . '&subject_id=' . $_GET['subject_id'] . '&instructor_id=' . $_GET['instructor_id'] . '";
                });
            </script>';
     
    }
}

include '../layout/footer.php';
?>
