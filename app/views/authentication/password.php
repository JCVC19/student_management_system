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
$user = User::find($_GET['id']);


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['password'] == $_POST['confirm_password']) {
        if (empty($_POST['password']) || empty($_POST['confirm_password'])) {
            $_SESSION['error'] = "Password cannot be empty!";
            header('Location: password.php?id=' . $user->id);
            exit();
        }
        else if (strlen($_POST['password']) < 4) {
            $_SESSION['error'] = "Password must be at least 4 characters long!";
            header('Location: password.php?id=' . $user->id);
            exit();
        }
        $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user->save();
        if($user){
            $_SESSION['password_change'] = "Password has been changed successfully!";
            header('Location: index.php');
        }
        
    } else {
        $_SESSION['error'] = "Passwords do not match!";
    }
}

include '../layout/header.php';
if($user->id != $_SESSION['id']){
    http_response_code(403);
    echo "<div class='container-full error-container'>
                <div class='error-bg'>
                    <div class = 'error-page'><h1>∑(; °Д°)</h1><br><h4>You do not have access to this page</h4><a class = 'btn go-back' href = '/student_management_system/index.php'>Go Back</a></div>
                </div>
            </div>";
    exit();
}

?>

<div class="full-screen-bg">
    <div class="container">
        <div class="bg">
            <div class="form-bg">
                <div class="main-title d-flex justify-content-between align-items-center">
                    <h1 class = "text" data-text = "CHANGE PASSWORD">CHANGE PASSWORD</h1>
                </div>
                <hr>
                <?php if(isset($_SESSION['error'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $_SESSION['error'] ?>
                    </div>
                <?php unset($_SESSION['error']); endif; ?>
                <form action="" method="POST" class="row g-3 needs-validation" novalidate>
                    <div class="col-md-6">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control <?= isset($_SESSION['error']) ? 'is-invalid' : '' ?>" id="password" name="password" required>
                        <div class="invalid-feedback">
                            <?= $_SESSION['error'] ?? 'Please provide a valid password.' ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control <?= isset($_SESSION['error']) ? 'is-invalid' : '' ?>" id="confirm_password" name="confirm_password" required>
                        <div class="invalid-feedback">
                            <?= $_SESSION['error'] ?? 'Please provide a valid password.' ?>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center mt-3">
                        <div class="col-12 text-center"> <!-- Centering the buttons -->
                            <button type="submit" class="btn btn-primary">Change Password</button>
                            <a href="index.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../layout/footer.php'; ?>