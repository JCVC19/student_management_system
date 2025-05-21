<?php
require_once '../../../config/Database.php';
require_once '../../models/Subject.php';
require_once '../../models/Subject_enrollment.php';
$database = new Database();
$db = $database->getConnection();
User::setConnection($db);
Course::setConnection($db);
$courses = Course::all();

$instructors = User::findByRole('instructor');

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
    <div class = "container-fluid">
        <div class="bg">
            <div class = "form-bg">
                <h1 class = "text" data-text = "Create Subject">Create Subject</h1>
                <hr>
                <form action="store.php" method="POST">
                    <div class="row">
                        <div class="col-3">
                            <div class = "form-group">
                                <label for = "catalog_no">Catalog No</label>
                                <input type="text" class="form-control" name="catalog_no" id="catalog_no" required>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class = "form-group">
                                <label for = "name">Subject Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-4">
                                <div class = "form-group">
                                    <label for = "day">Day</label>
                                    <input type="text" class="form-control" name="day" id="day" required>
                                </div>
                            </div>    
                            <div class="col-4">
                                <div class = "form-group">
                                    <label for = "time">Time</label>
                                    <input type="text" class="form-control" name="time" id="time" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class = "form-group">
                                    <label for = "room">Room</label>
                                    <input type="text" class="form-control" name="room" id="room" required>
                                </div>
                            </div>
                        </div>
                    <div class = "form-group">
                        <label for = "Course">Course</label>
                        <select class="form-control" name="course_id" id="course_id" required>
                            <option value="">Select Course</option>
                            <?php foreach($courses as $course): ?>
                                <option value="<?=$course->id?>"><?=$course->name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class = "form-group">
                                <label for = "year_level">Year Level</label>
                                <select class="form-control" name="year_level" id="year_level" required>
                                    <option value="">Select Year Level</option>
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class = "form-group">
                                <label for = "semester">Semester</label>
                                <select class="form-control" name="semester" id="semester" required>
                                    <option value="">Select Semester</option>
                                    <option value="1">1st Semester</option>
                                    <option value="2">2nd Semester</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for = "instructor_id">Instructor</label>
                        <select class="form-control" name="instructor_id" id="instructor_id" required>
                            <option value="">Select Instructor</option>
                            <?php foreach($instructors as $instructor): ?>
                                <?php if ($instructor->status != 'inactive'): ?>
                                    <option value="<?=$instructor->id?>"><?=$instructor->name?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class = "form-group mt-3">
                        <button type="submit" class="btn btn-primary">Create Subject</button>
                        <a href="index.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../layout/footer.php'; ?>
                    