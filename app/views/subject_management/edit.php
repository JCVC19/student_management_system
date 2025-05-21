<?php

require_once '../../../config/Database.php';
require_once '../../models/Subject.php';
require_once '../../models/Course.php';
require_once '../../models/User.php';

$database = new Database();
$db = $database->getConnection();
Subject::setConnection($db);
Course::setConnection($db);
User::setConnection($db);
$subject = Subject::find($_GET['id']);
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
if(empty($subject)){
    http_response_code(404);
    echo "<div class='container-full error-container'>
                <div class='error-bg'>
                    <div class = 'error-page'><h1>∑(; °Д°)</h1><br><h4>Subject not found</h4><a class = 'btn go-back' href = '/student_management_system/index.php'>Go Back</a></div>
                </div>
            </div>";
    exit();
}
?>

<div class="full-screen-bg">
    <div class = "container">
        <div class="bg">
            <div class = "form-bg">
                <h1 class = "text" data-text = "Edit Subject">Edit Subject</h1>
                <hr>
                <form action="update.php?id=<?=$subject->id?>" method="POST">
                    <input type="hidden" name="code" value="<?=$subject->code?>">
                    <div class="row">
                        <div class="col-3">
                            <div class = "form-group">
                                <label for = "catalog_no">Catalog No</label>
                                <input type="text" class="form-control" name="catalog_no" id="catalog_no" value="<?=$subject->catalog_no?>" required>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class = "form-group">
                                <label for = "name">Subject Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?=$subject->name?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class = "form-group">
                                <label for = "day">Day</label>
                                <input type="text" class="form-control" name="day" id="day" value="<?=$subject->day?>" required>
                            </div>
                        </div>    
                        <div class="col-4">
                            <div class = "form-group">
                                <label for = "time">Time</label>
                                <input type="text" class="form-control" name="time" id="time" value="<?=$subject->time?>" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class = "form-group">
                                <label for = "room">Room</label>
                                <input type="text" class="form-control" name="room" id="room" value="<?=$subject->room?>" required>
                            </div>
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for = "Course">Course</label>
                        <select class="form-control" name="course_id" id="course_id" required>
                            <?php foreach($courses as $course): ?>
                                <option value="<?=$course->id?>" <?= $course->id == $subject->course_id ? 'selected' : '' ?>><?=$course->name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class = "form-group">
                                <label for = "year_level">Year Level</label>
                                <select class="form-control" name="year_level" id="year_level" required>
                                    <option value="1" <?= $subject->year_level == 1 ? 'selected' : '' ?>>1st Year</option>
                                    <option value="2" <?= $subject->year_level == 2 ? 'selected' : '' ?>>2nd Year</option>
                                    <option value="3" <?= $subject->year_level == 3 ? 'selected' : '' ?>>3rd Year</option>
                                    <option value="4" <?= $subject->year_level == 4 ? 'selected' : '' ?>>4th Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class = "form-group">
                                <label for = "semester">Semester</label>
                                <select class="form-control" name="semester" id="semester" required>
                                    <option value="1" <?= $subject->semester == 1 ? 'selected' : '' ?>>1st Semester</option>
                                    <option value="2" <?= $subject->semester == 2 ? 'selected' : '' ?>>2nd Semester</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for = "instructor_id">Instructor</label>
                        <select class="form-control" name="instructor_id" id="instructor_id" required>
                            <?php foreach($instructors as $instructor): ?>
                                <option value="<?=$instructor->id?>" <?= $instructor->id == $subject->instructor_id ? 'selected' : '' ?>><?=$instructor->name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class = "form-group mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="index.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../layout/footer.php'; ?>