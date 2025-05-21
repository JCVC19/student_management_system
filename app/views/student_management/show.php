<?php
require_once '../../../config/Database.php';
require_once '../../models/Student.php';
require_once '../../models/Grade.php';
require_once '../../models/Course.php';
require_once '../../models/Subject.php';
require_once '../../models/Subject_Enrollment.php';

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if(!isset($_SESSION['email'])){
    header('Location: ../authentication/login.php');
}

include '../layout/header.php';
require '../../../permission.php';
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400);
    die("400 Bad Request: Student ID is missing.");
}

$studentId = intval($_GET['id']);

$database = new Database();
$db = $database->getConnection();

Student::setConnection($db);
Grade::setConnection($db);
Course::setConnection($db);
Subject::setConnection($db);
Subject_Enrollment::setConnection($db);



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
        <div class="bg index-bg">
            <div class="list-details">
                <div class="main-title d-flex align-items-center">
                    <h1 class = "text mb-0" data-text = "Student Details">Student Details</h1>
                    <a href = "index.php" class = "btn btn-secondary ms-auto">Back</a>
                </div>
                <hr>
                <table class = "table">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Gender</th>
                            <th>Birthdate</th>
                            <th>Course</th>
                            <th>Year Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= htmlspecialchars($student->student_id) ?></td>
                            <td><?= htmlspecialchars($student->name) ?></td>
                            <td><?= htmlspecialchars($student->gender) ?></td>
                            <td><?= date('F j, Y', strtotime($student->birthdate)) ?></td>
                            <td>
                                <?php 
                                    $course = $student->course();
                                    echo htmlspecialchars($course->name); 
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if ($student->year_level == 1) {
                                        echo '1st Year';
                                    } elseif ($student->year_level == 2) {
                                        echo '2nd Year';
                                    } elseif ($student->year_level == 3) {
                                        echo '3rd Year';
                                    } elseif ($student->year_level == 4) {
                                        echo '4th Year';
                                    } else {
                                        echo 'N/A';
                                    }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="list-table">
                <table id = "listsTable" class="table table-striped">
                    <!-- <caption class="text-center"><h4>Enrolled Subjects:</h4></caption> -->
                    <thead class="table-light">
                        <tr class="table-dark">
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Room</th>
                            <th>Semester</th>
                            <th>Instructor</th>
                            <th>Grade</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $enrolledSubjects = $student->subjects();

                            if (empty($enrolledSubjects)) {
                                
                            } else {
                                foreach ($enrolledSubjects as $subject):
                                    $grade = 'N/A';
                                    $remarks = 'Pending';
                                    $grades = $student->grades(); 
                                    if($grades){
                                        foreach($grades as $g){
                                            if($g->subject_id == $subject->id && $g->student_id == $student->id){
                                                $grade = $g->grade;
                                                $remarks = $g->remarks;
                                                break;
                                            }
                                        }
                                    }
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($subject->code) ?></td>
                            <td><?= htmlspecialchars($subject->name) ?></td>
                            <td><?= htmlspecialchars($subject->day) ?></td>
                            <td><?= htmlspecialchars($subject->time) ?></td>
                            <td><?= htmlspecialchars($subject->room) ?></td>
                            <td>
                                <?php
                                    if($subject->semester == 1){
                                        echo '1st Semester';
                                    } elseif($subject->semester == 2){
                                        echo '2nd Semester';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    $instructor = $subject->instructor();
                                    if($instructor){
                                        echo htmlspecialchars($instructor->name);
                                    } else {
                                        echo 'N/A';
                                    }
                                ?>
                            </td>
                            <td><?= htmlspecialchars($grade) ?></td>
                            <td><?= htmlspecialchars($remarks) ?></td>
                        </tr>
                        <?php 
                                endforeach;
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9" class="text-center"><strong>List of Enrolled Subject</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include '../layout/footer.php'; ?>