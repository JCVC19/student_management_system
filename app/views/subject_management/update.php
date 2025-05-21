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
    $subject = Subject::find($_GET['id']);
    
    $subject->update([
        'code' => $_POST['code'],
        'catalog_no' => $_POST['catalog_no'],
        'name' => $_POST['name'],
        'day' => $_POST['day'],
        'time' => $_POST['time'],
        'room' => $_POST['room'],
        'course_id' => $_POST['course_id'],
        'year_level' => $_POST['year_level'],
        'semester' => $_POST['semester'],
        'instructor_id' => $_POST['instructor_id'],
        'id' => $_GET['id']
    ]);

    if($subject){
        echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Record has been updated successfully",
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
                    text: "Failed to update the record, please try again!",
                    showConfirmButton: false,
                    timer: 1500,
                        customClass: {
                            container: "custom-container"
                        }
                }).then(function(){
                    window.location = "edit.php?id='.$_GET['id'].'";
                });
            </script>';
    }
}

include '../layout/footer.php';