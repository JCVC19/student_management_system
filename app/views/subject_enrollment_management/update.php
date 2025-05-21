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
    $subject_enrollment = Subject_Enrollment::all();
    $updated = false;

    foreach ($subject_enrollment as $enrollment) {
        if ($enrollment->student_id == $_GET['id'] && $enrollment->subject_id == $_POST['subject_id']) {
            $enrollment->update([
                'subject_id' => $_POST['subject_id'],
                'student_id' => $_POST['student_id'],
                'status' => $_POST['status'],
                'id' => $_GET['id']
            ]);
            break;
        }
    }

    if ($enrollment) {
        echo '<script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "Record updated successfully",
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    container: "custom-container"
                }
            }).then(function(){
                window.location.href = "../subject_management/show.php?id=' . $_POST['subject_id'] . '";
            });
        </script>';
    }
    else{
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Failed to update record, please try again!",
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    container: "custom-container"
                }
            }).then(function(){
                window.location.href = "../subject_management/show.php?id=' . $_POST['subject_id'] . '";
            });
        </script>';
    }
}

include '../layout/footer.php';
?>
