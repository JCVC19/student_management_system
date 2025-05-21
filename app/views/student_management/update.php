<?php
require_once '../../../config/Database.php';
require_once '../../models/Student.php';

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if(!isset($_SESSION['email'])){
    header('Location: ../authentication/login.php');
}

if (!isset($_POST['id']) || empty($_POST['id'])) {
    http_response_code(400);
    die("400 Bad Request: Student ID is missing.");
}

$studentId = intval($_POST['id']);

$database = new Database();
$db = $database->getConnection();

Student::setConnection($db);

$student = Student::find($studentId);

if ($student) {
    include '../layout/header.php';
    $updateData = [
        'id' => trim($_POST['id']),
        'name' => trim($_POST['name']),
        'gender' => $_POST['gender'],
        'birthdate' => $_POST['birthdate'],
        'course_id' => intval($_POST['course_id']),
        'year_level' => intval($_POST['year_level']),
        'status' => $_POST['status'],
        'updated_at' => date('Y-m-d H:i:s') // You already have a timestamp column
    ];

    $student->update($updateData);

    echo '<script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "Record has been updated successfully",
                showCancelButton: true,
                confirmButtonText: "Update Another",
                cancelButtonText: "Go to List",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-secondary"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "create.php";
                } else {
                    window.location.href = "index.php";
                }
            });
        </script>';
} else {
    echo '<script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Failed to update the record, please try again!",
                showConfirmButton: true,
                confirmButtonText: "Try Again",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            }).then(() => {
                window.location.href = "create.php";
            });
        </script>';
}
include '../layout/footer.php';
?>
