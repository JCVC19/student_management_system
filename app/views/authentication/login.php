<?php
    require_once '../../../config/Database.php';
    require_once '../../models/User.php';

    session_start([
        'cookie_lifetime' => 86400, // seconds (1 day)
    ]);

    if(isset($_SESSION['email'])){
        header('Location: ../../../index.php');
    }

    $database = new Database();
    $db = $database->getConnection();

    User::setConnection($db);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user = User::findByEmail($_POST['email']);
        if($user){
            if(password_verify($_POST['password'], $user->password)){
                if($user->status == 'inactive'){
                    $_SESSION['error'] = "This user is deactivated.";
                }
                else{
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['role'] = $user->role;
                    $_SESSION['id'] = $user->id;
                    $_SESSION['welcome'] = 'success';
                    header('Location: ../../../index.php');
                }
            }
            else{
                $_SESSION['error'] = "Invalid email or password.";
            }
        }
        else{
            $_SESSION['error'] = "Invalid email or password.";
        }
    }
?>
<?php include '../layout/header.php'; ?>
<div class="full-screen-bg authentication-body">
    <div class="container">
        <div class="form-bg mx-auto w-100 p-4" style="max-width: 500px;">
            <div class="main-title d-flex justify-content-between align-items-center">
                <h1 class = "text" data-text = "LOGIN">LOGIN</h1>
            </div>
            <div class="form-group">
                <form action="login.php" method="POST">
                    <?php if(isset($_SESSION['success'])) : 
                        echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Record has been saved successfully",
                            showConfirmButton: false,
                            timer: 1500
                            }).then(function(){
                                window.location = "../index.php";
                            });
                            </script>';
                        ?>
                    <?php
                        unset($_SESSION['success']);
                        endif;
                    ?>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control <?=(isset($_SESSION['error']) ? 'is-invalid' : '')?>" id="email" name="email">
                            <?php if(isset($_SESSION['error'])) : ?>
                            <div class="invalid-feedback">
                                <?=$_SESSION['error'] ?>
                            </div>
                            <?php
                                unset($_SESSION['error']);
                                endif;
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 position-relative d-inline-block">
                            <button type="submit" class="btn btn-primary">Login</button>
                            <!-- <a class = "btn shadow">Login</a> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../layout/footer.php'; ?>
