<?php
require_once '../../../config/Database.php';
require_once '../../models/Subject.php';
require_once '../../models/Student.php';

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

$subject = Subject::find($_GET['id']);
include '../layout/header.php';
require '../../../permission.php';
if(empty($subject)){
    http_response_code(404);
    echo "<div class='container-full error-container'>
                <div class='error-bg'>
                    <div class = 'error-page'><h1>∑(; °Д°)</h1><br><h4>Error not found</h4><a class = 'btn go-back' href = '/student_management_system/index.php'>Go Back</a></div>
                </div>
            </div>";
    exit();
}

$students = Student::all();
$enrolled_students = $subject->students();


?>

<div class="full-screen-bg">
    <div class="container">
        <div class="bg">
            <div class="form-bg">
                <div class="main-title d-flex align-items-center">
                    <h1 class="text mb-0" data-text="Enroll Student" style="margin-right: 10px;">Enroll Student</h1>
                    <a href="../subject_management/show.php?id=<?= $subject->id ?>" class="btn btn-secondary ms-auto">Back</a>
                </div>
                <hr>
                <form action="store.php" method="POST">
                    <input type="hidden" name="subject_id" value="<?= $_GET['id'] ?>">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="subject_id">Subject</label>
                                <select class="form-control" name="subject_id" id="subject_id" required>
                                    <option value="<?= $subject->id ?>"><?= $subject->code . ' - ' . $subject->name ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="student_id">Student</label>
                                <select class="form-control" name="student_id" id="student_id" required>
                                    <option value="">Select Student</option>
                                    <?php foreach ($students as $student): ?>
                                        <?php 
                                            $isEnrolled = false;
                                            foreach ($enrolled_students as $enrolled_student) {
                                                if ($student->id == $enrolled_student->id) {
                                                    $isEnrolled = true;
                                                    break;
                                                }
                                            }
                                        ?>
                                        <?php if (!$isEnrolled && $subject->year_level == $student->year_level && $subject->course_id == $student->course_id && $student->status == 'active'): ?>
                                            <option value="<?= $student->id ?>"><?= $student->name ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="enrolled">Enrolled</option>
                                    <option value="drop">Drop</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4 d-flex flex-column" style="border-left: 1.5px solid #ccc;">
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

<?php include '../layout/footer.php'; ?>
