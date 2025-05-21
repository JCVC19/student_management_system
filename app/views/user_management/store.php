<?php 
require_once '../../../config/Database.php'; 
require_once '../../models/User.php';

$db = new Database();
$conn = $db->getConnection();
User::setConnection($conn); 


session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if(!isset($_SESSION['email'])){
    header('Location: ../authentication/login.php');
}

require '../../../permission.php';



$user = User::findByEmail($_POST['email']);
if($user){
    if($_SESSION['error'] = "Email is already taken."){
        header('Location: create.php');
        exit();
    }
}
else if(strlen($_POST['password']) < 4) {
    $_SESSION['password_error'] = "Password must be at least 4 digits long.";
    header('Location: create.php');
    exit();
}
else{

    include '../layout/header.php';

    $statement = User::create([
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'role' => $_POST['role'],
        'status' => $_POST['status']
    ]);

    if($statement){
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


include '../layout/footer.php';
?>
