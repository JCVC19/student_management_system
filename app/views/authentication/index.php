<?php
require_once '../../../config/Database.php';
require_once '../../models/User.php';


session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if(!isset($_SESSION['email'])){
    header('Location: login.php');
}

$database = new Database();
$db = $database->getConnection();

User::setConnection($db);
$user = User::findByEmail($_SESSION['email']);

include '../layout/header.php';

if(isset($_SESSION['password_change'])){
    echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "'.$_SESSION['password_change'].'",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>';
    unset($_SESSION['password_change']);
}
?>
<div class="full-screen-bg">
    <div class = "container">
        <div class="bg auth-bg">
            <div class = "form-bg">
                <div class="main-title d-flex justify-content-between align-items-center gap-3">
                    <h1 class = "text mb-0 " data-text = "Authentication" style = "padding-right: 3px;">Authentication</h1>
                    <a href = "../../../index.php" class = "btn btn-secondary" style = "margin-left: 25px">Back</a>
                </div>
                <hr>
                <p>Role: <strong><?=$user->role?></strong></p>
                <p>Name: <strong><?=$user->name?></strong></p>
                <p>Email: <strong><?=$user->email?></strong></p>
                <p>Status: <strong><?=$user->status?></strong></p>
                <hr>
                <a href = "password.php?id=<?=$user->id?>" class = "btn btn-primary">Change Password</a>
                <a href = "logout.php" class = "btn btn-danger logout float-end">Logout</a>
            </div>
        </div>
    </div>
</div>
<script>
    // <LOGOUT CONFIRMATION>
document.addEventListener("DOMContentLoaded", function() {
    var logoutButton = document.querySelector(".logout");
    logoutButton.addEventListener("click", function (e) {
        e.preventDefault(); 
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, logout!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = logoutButton.getAttribute("href");
            }
        });
    });
});
// </LOGOUT CONFIRMATION>
</script>
<?php include '../layout/footer.php'; ?>