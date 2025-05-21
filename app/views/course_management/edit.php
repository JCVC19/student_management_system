<?php
require_once '../../../config/Database.php';
require_once '../../models/Course.php';

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if(!isset($_SESSION['email'])){
    header('Location: ../authentication/login.php');
}

include '../layout/header.php';
 require '../../../permission.php';
$db = new Database();
$conn = $db->getConnection();
Course::setConnection($conn);

$course = Course::find($_GET['id']);
if(empty($course)){
    http_response_code(404);
    echo "<div class='container-full error-container'>
                <div class='error-bg'>
                    <div class = 'error-page'><h1>∑(; °Д°)</h1><br><h4>Course not found</h4><a class = 'btn go-back' href = '/student_management_system/index.php'>Go Back</a></div>
                </div>
            </div>";
    exit();
}
?>

<div class="full-screen-bg">
    <div class = "container">
        <div class="bg">
            <div class = "form-bg">
            <h1 class = "text" data-text = "Edit Course">Edit Course</h1>
                <hr>
                <form action="update.php" method="POST">
                    <input type="hidden" name="id" value="<?=$course->id?>">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="code" class="form-label">Code</label>
                                <input type="text" class="form-control" id="code" name="code" value="<?=$course->code?>" required>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?=$course->name?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 d-flex justify-content-center text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="index.php" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../layout/footer.php'; ?>