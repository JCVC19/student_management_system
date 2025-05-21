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
$database = new Database();
$db = $database->getConnection();

Subject::setConnection($db);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $code = date('YmdHis');
    $subject = Subject::create([
        'code' => $code,
        'catalog_no' => $_POST['catalog_no'],
        'name' => $_POST['name'],
        'day' => $_POST['day'],
        'time' => $_POST['time'],
        'room' => $_POST['room'],
        'course_id' => $_POST['course_id'],
        'year_level' => $_POST['year_level'],
        'semester' => $_POST['semester'],
        'instructor_id' => $_POST['instructor_id']
    ]);
    if($subject){
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
                        window.location.href = "create.php"; // Redirect to the form again
                    } else {
                        window.location.href = "index.php"; // Redirect to the main list
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

include '../layout/footer.php';
?>