<?php
session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if(!isset($_SESSION['email'])){
    header('Location: ../authentication/login.php');
}

include '../layout/header.php';
require '../../../permission.php';
?>

<div class="full-screen-bg">
    <div class = "container">
        <div class="bg">
            <div class = "form-bg">
                <div class="main-title d-flex align-items-center">
                    <h1 class = "index-title mb-0 text" data-text = "Create New User" > Create New User</h1>
                    <a class="btn btn-secondary" href="index.php" style="margin-left: 55px">Cancel</a>
                </div>
                <hr>
                <form action="store.php" method="POST">
                    <div class="row d-flex">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="role" class="form-label">Role</label>
                                        <select class="form-select" id="role" name="role">
                                            <option value="instructor">Instructor</option>
                                            <?php if($_SESSION['role'] == 'superadmin') : ?>
                                            <option value="admin">Admin</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control <?=isset($_SESSION['error']) ? 'is-invalid' : ''?>" id="email" name="email" required>
                                        <?php if(isset($_SESSION['error'])): ?>
                                            <div class="invalid-feedback">
                                                <?= $_SESSION['error'] ?>
                                            </div>
                                            <?php unset($_SESSION['error']); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- <div class="col-4">
                                    
                                </div> -->
                            </div>
                        </div>
                        <div class="col-4  d-flex flex-column" style="border-left: 1.5px solid #ccc; ">
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control <?=isset($_SESSION['password_error']) ? 'is-invalid' : ''?>" id="password" name="password" required>
                                <?php if(isset($_SESSION['password_error'])): ?>
                                    <div class="invalid-feedback">
                                        <?= $_SESSION['password_error'] ?>
                                    </div>
                                    <?php unset($_SESSION['password_error']); ?>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-12 mt-auto">
                                <label for="btn">Save</label>
                                <button type="submit" class="btn btn-primary w-100 mt-2">ADD</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include  '..\layout\footer.php'; ?>