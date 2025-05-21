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

$grade = Grade::find($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $grade->update([
        'subject_id' => $_GET['subject_id'],
        'student_id' => $_GET['student_id'],
        'grade' => $_POST['grade'],
        'remarks' => $_POST['remarks'],
        'id' => $_GET['id']
    ]);

    if ($grade) {
        echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Student grade updated successfully",
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        container: "custom-container"
                    }
                }).then(function(){
                    window.location.href = "show.php?id=' . $_GET['subject_id'] . '";
                });
            </script>';
    } 
    else{
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Failed to update grade, please try again!",
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        container: "custom-container"
                    }
                }).then(function(){
                    window.location.href = "edit.php?id=' . $_GET['id'] . '&subject_id=' . $_GET['subject_id'] . '&student_id=' . $_GET['student_id'] . '";
                });
            </script>';
    }
}

include '../layout/footer.php';
?>
