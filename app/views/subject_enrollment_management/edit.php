<?php
require_once '../../../config/Database.php';
require_once '../../models/Subject.php';
require_once '../../models/Student.php';
require_once '../../models/Subject_Enrollment.php';

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if (!isset($_SESSION['email'])) {
    header('Location: ../authentication/login.php');
}

$database = new Database();
$db = $database->getConnection();

Subject::setConnection($db);
Student::setConnection($db);
Subject_Enrollment::setConnection($db);

$student = Student::find($_GET['id']);

$subject_enrollment = Subject_Enrollment::all();

include '../layout/header.php';
require '../../../permission.php';
if(empty($student)){
    http_response_code(404);
    echo "<div class='container-full error-container'>
                <div class='error-bg'>
                    <div class = 'error-page'><h1>∑(; °Д°)</h1><br><h4>Error not found</h4><a class = 'btn go-back' href = '/student_management_system/index.php'>Go Back</a></div>
                </div>
            </div>";
    exit();
}

$subjects = $student->subjects();
$subject_id = null;
$enrollment_status = null;

foreach ($subject_enrollment as $enrollment) {
    foreach ($subjects as $subject) {
        if ($enrollment->student_id == $_GET['id'] && $enrollment->subject_id == $subject->id) {
            $subject_id = $enrollment->subject_id;
            $enrollment_status = $enrollment->status;
        }
    }
}


?>

<div class="full-screen-bg">
    <div class="container">
        <div class="bg">
            <div class="form-bg">
                <div class="main-title d-flex align-items-center">
                    <h1 class="text mb-0" data-text="Edit Enrollment" style="margin-right: 10px;">Edit Enrollment</h1>
                    <a href="../subject_management/show.php?id=<?= $subject_id ?>" class="btn btn-secondary ms-auto">Back</a>
                </div>
                <hr>
                <form action="update.php?id=<?= $_GET['id'] ?>" method="POST">
                    <div class="row">
                        <div class="col-8">
                            <input type="hidden" name="student_id" value="<?= $student->id ?>">
                            <div class="form-group">
                                <label for="subject_id">Subject</label>
                                <select class="form-control" name="subject_id" id="subject_id" required>
                                    <option value="<?= $subject_id ?>"><?= $subject->name . ' - ' . $subject->code ?></option>
                                </select>
                            </div>
                            <div class = "form-group">
                                <label for = 'student_id'>Student</label>
                                <select class="form-control" name="student_id" id="student_id" required>
                                    <option value="<?=$student->id?>"><?=$student->name?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="enrolled" <?= $enrollment_status == 'enrolled' ? 'selected' : '' ?>>Enrolled</option>
                                    <option value="dropped" <?= $enrollment_status == 'dropped' ? 'selected' : '' ?>>Dropped</option>
                                    <option value="completed" <?= $enrollment_status == 'completed' ? 'selected' : '' ?>>Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4 d-flex flex-column" style="border-left: 1.5px solid #ccc;">
                            <div class="col-12 mt-auto">
                                <label for="btn">Save</label>
                                <button type="submit" class="btn btn-primary w-100 mt-2">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../layout/footer.php'; ?>
