<?php
require_once '../../../config/Database.php';
require_once '../../models/Subject.php';
require_once '../../models/Student.php';
require_once '../../models/Grade.php';

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
Grade::setConnection($db);

$student = Student::find($_GET['student_id']);
$subject = Subject::find($_GET['subject_id']);

include '../layout/header.php';

?>

<div class="full-screen-bg">
    <div class="container">
        <div class="bg">
            <div class="form-bg">
                <h1 class="text" data-text="GRADE STUDENT">GRADE STUDENT</h1>
                <hr>
                <form action="store.php?student_id=<?= $_GET['student_id'] ?>&subject_id=<?= $_GET['subject_id'] ?>&instructor_id=<?= $_GET['instructor_id'] ?>" method="POST">
                    <div class="form-group">
                        <label for="subject_id">Subject</label>
                        <select class="form-control" name="subject_id" id="subject_id" required>
                            <option value="<?= $subject->id ?>"><?= $subject->name . ' - ' . $subject->code ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="student_id">Student</label>
                        <select class="form-control" name="student_id" id="student_id" required>
                            <option value="<?= $student->id ?>"><?= $student->name ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <select class="form-control" name="grade" id="grade" required>
                            <option value="">Select Grade</option>
                            <option value="1.00">1.00</option>
                            <option value="1.25">1.25</option>
                            <option value="1.50">1.50</option>
                            <option value="1.75">1.75</option>
                            <option value="2.00">2.00</option>
                            <option value="2.25">2.25</option>
                            <option value="2.50">2.50</option>
                            <option value="2.75">2.75</option>
                            <option value="3.00">3.00</option>
                            <option value="5.00">5.00</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="remarks">Remarks</label>
                        <select class="form-control" name="remarks" id="remarks" required>
                            <option value="Pending">Pending</option>
                            <option value="Passed">Passed</option>
                            <option value="Failed">Failed</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="show.php?id=<?= $subject->id ?>" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../layout/footer.php'; ?>
