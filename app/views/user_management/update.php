<?php require_once '../../../config/Database.php';
    $db = new Database();
    $conn = $db->getConnection();
?>
<?php require_once '../../models/User.php'; 

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if(!isset($_SESSION['email'])){
    header('Location: ../authentication/login.php');
}

require '../../../permission.php';

User::setConnection($conn);
$user = User::find($_POST['id']);

$existingUser = User::findByEmail($_POST['email']);

if($existingUser->id != $user->id){
    $_SESSION['error'] = "Email is already taken.";
    header('Location: edit.php?id='.$user->id);
    exit();
}
else{
    if(empty($_POST['password'])){
            $password = $user->password;
    }
    else{
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    if($_POST['status'] == 'inactive'){ 
        $_POST['designation'] = 0;
    } 
    else if($_POST['status'] == 'active'){
        $_POST['designation'] = 1;
    }

    $statement = $user->update([
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'role' => $_POST['role'],
        'status' => $_POST['status'],
        'designation' => $_POST['designation'],
        'password' => $password
    ]);

    include '../layout/header.php';
    
    if(!$statement){
        echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Record has been saved successfully",
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        container: "custom-container"
                    }
                }).then(function(){
                    window.location = "index.php";
                });
            </script>';
    }
    else{   
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Record has been failed to save, try again!",
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        container: "custom-container"
                    }
                }).then(function(){
                    window.location = "edit.php?id='.$user->id.'";
                });
            </script>';
    }
}

?>
<?php include '../layout/footer.php';?>