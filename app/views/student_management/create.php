<?php
require_once '../../../config/Database.php';
require_once '../../models/Student.php';
require_once '../../models/Course.php';

$database = new Database();
$db = $database->getConnection();
Course::setConnection($db);

$courses = Course::all();
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
                <h1 class = "text" data-text = "Create Student">Create Student</h1>
                <hr>
                <?php if (isset($_SESSION['error'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
                <form action="store.php" method="POST">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="student_id">Student ID</label>
                                <input type="text" class="form-control <?=isset($_SESSION['student_error']) ? 'is-invalid' : ''?>" id="student_id" name="student_id" required>
                                <?php if(isset($_SESSION['student_error'])): ?>
                                    <div class="invalid-feedback">
                                        <?= $_SESSION['student_error'] ?>
                                    </div>
                                    <?php unset($_SESSION['student_error']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="birthdate">Birthdate</label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="course_id">Course</label>
                        <select class="form-control" id="course_id" name="course_id" required>
                            <option value="">Select Course</option>
                            <?php foreach ($courses as $course): ?>
                                <option value="<?= $course->id ?>"><?= htmlspecialchars($course->name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="year_level">Year Level</label>
                                <select class="form-control" id="year_level" name="year_level" required>
                                    <option value="">Select Year Level</option>
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 d-flex justify-content-center align-items-center text-center">
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
