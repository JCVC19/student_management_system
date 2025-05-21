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
                <h1 class = "text" data-text = "Create Course">Create Course</h1>
                <hr>
                <form action="store.php" method="POST">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="code" class="form-label">Code</label>
                                <input type="text" class="form-control" id="code" name="code" required>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 d-flex justify-content-center text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <a href="index.php" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../layout/footer.php'; ?>