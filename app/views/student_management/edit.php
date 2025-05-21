<?php
require_once '../../../config/Database.php';
require_once '../../models/Student.php';
require_once '../../models/Course.php';

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if(!isset($_SESSION['email'])){
    header('Location: ../authentication/login.php');
}

include '../layout/header.php';
require '../../../permission.php';
$studentId = intval($_GET['id']);

$database = new Database();
$db = $database->getConnection();
Student::setConnection($db);
Course::setConnection($db);

$student = Student::find($studentId);

if(empty($student)){
    http_response_code(404);
    echo "<div class='container-full error-container'>
                <div class='error-bg'>
                    <div class = 'error-page'><h1>∑(; °Д°)</h1><br><h4>Student not found</h4><a class = 'btn go-back' href = '/student_management_system/index.php'>Go Back</a></div>
                </div>
            </div>";
    exit();
}
?>
<div class="full-screen-bg">
    <div class = "container">
        <div class="bg">
            <div class = "form-bg">
                <h1 class = "text" data-text = "Edit Student">Edit Student</h1>
                <hr>
                <?php if (isset($_SESSION['error'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
                <form action="update.php" method="POST">
                    <input type="hidden" name="id" value="<?= $student->id ?>"> <!-- Hidden field for ID -->
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($student->name) ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="Male" <?= $student->gender == 'Male' ? 'selected' : '' ?>>Male</option>
                                    <option value="Female" <?= $student->gender == 'Female' ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="birthdate">Birthdate</label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?= htmlspecialchars($student->birthdate) ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="course_id">Course</label>
                        <select class="form-control" id="course_id" name="course_id" required>
                            <?php
                            $courses = Course::all();
                            foreach ($courses as $course) {
                                echo '<option value="' . $course->id . '" ' . ($student->course_id == $course->id ? 'selected' : '') . '>' . htmlspecialchars($course->name) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="year_level">Year Level</label>
                                <select class="form-control" id="year_level" name="year_level" required>
                                    <option value="1" <?= $student->year_level == 1 ? 'selected' : '' ?>>1st Year</option>
                                    <option value="2" <?= $student->year_level == 2 ? 'selected' : '' ?>>2nd Year</option>
                                    <option value="3" <?= $student->year_level == 3 ? 'selected' : '' ?>>3rd Year</option>
                                    <option value="4" <?= $student->year_level == 4 ? 'selected' : '' ?>>4th Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="active" <?= $student->status == 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= $student->status == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                </select>
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
