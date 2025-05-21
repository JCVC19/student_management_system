<?php require_once  '../../../config/Database.php'; 
    $db = new Database();
    $conn = $db->getConnection();
    require_once '../../models/User.php'; 

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if(!isset($_SESSION['email'])){
    header('Location: ../authentication/login.php');
}

include '../layout/header.php';
require '../../../permission.php';

User::setConnection($conn);
$users = User::find($_GET['id']);

if(empty($users)){
    http_response_code(404);
    echo "<div class='container-full error-container'>
                <div class='error-bg'>
                    <div class = 'error-page'><h1>∑(; °Д°)</h1><br><h4>User not found</h4><a class = 'btn go-back' href = '/student_management_system/index.php'>Go Back</a></div>
                </div>
            </div>";
    exit();
}
?>
    
<div class="full-screen-bg">
    <div class = "container">
        <div class="bg">
            <div class = "form-bg">
                <div class="main-title d-flex align-items-center">
                    <h1 class = "text mb-0" data-text = "Edit User">Edit User</h1>
                    <a href = "index.php" class = "btn btn-secondary ms-auto">Back</a>
                </div>
                <hr>
                <form action="update.php" method="POST">
                    <div class="row d-flex">
                        <input type="hidden" name="id" value="<?=$users->id ?>">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?=$users->name ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="role" class="form-label">Role</label>
                                        <select class="form-select" id="role" name="role">
                                            <option value="instructor" <?=($users->role == 'instructor' ? 'selected' : '');?>>Instructor</option>
                                            <option value="admin"<?=($users->role == 'admin' ? 'selected' : '');?>>Admin</option>
                                        </select>
                                    </div>  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control <?=isset($_SESSION['error']) ? 'is-invalid' : ''?>" id="email" name="email" value="<?=$users->email ?>">
                                        <?php if(isset($_SESSION['error'])): ?>
                                            <div class="invalid-feedback">
                                                <?= $_SESSION['error'] ?>
                                            </div>
                                            <?php unset($_SESSION['error']); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4" style="border-left: 1.5px solid #ccc; ">
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label><br>
                                <button type="button" class="btn btn-warning w-100" id="reset_password" style="position: relative; top: -3px;">RESET PASSWORD</button>
                                <input type="hidden" class="form-control" id="password" name="password" value="" >
                            </div>
                            <div class="row" style = "display:none;">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <input type="hidden" id="prev_stat" name="designation" value="<?=$users->designation?>" />
                                        <input type="hidden" id="prev_stat" name="status" value="<?=$users->status?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <?php
                                    if ($users->status == 'inactive'){ 
                                        echo "<a href='activate.php?id=" . $users->id . "' class='btn btn-success w-100'>ACTIVATE</a>";
                                    }
                                    else{
                                        echo "<a href='deactivate.php?id=" . $users->id . "' class='btn btn-danger w-100'>DEACTIVATE</a>";
                                    }
                                ?>
                            </div>
                            <div class="col-12">
                                <label for="btn">Save</label>
                                <button type="submit" class="btn btn-primary w-100 mt-2">UPDATE</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("reset_password").addEventListener("click", function() {
        var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        var password = "";
        for (var i = 0; i < 6; i++) {
            var randomIndex = Math.floor(Math.random() * charset.length);
            password += charset[randomIndex];
        }
        document.getElementById("password").value = password;

        swal.fire({
            title: "Password Reset",
            text: "New password: " + password,
            icon: "success",
            confirmButtonText: "OK",
            timer: 5000
        }).then((result) => {
            if (result.isConfirmed) {
                // User clicked "OK"
            } else {
                // User clicked outside the modal or closed it
            }
        });
    });

</script>
 <?php include  '../layout/footer.php';?>
