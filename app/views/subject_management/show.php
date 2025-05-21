<?php
require_once '../../../config/Database.php';
require_once '../../models/Subject.php';
require_once '../../models/Course.php';
require_once '../../models/User.php';
require_once '../../models/Student.php';
require_once '../../models/Subject_Enrollment.php';
require_once '../../models/Grade.php';

$database = new Database();
$db = $database->getConnection();

Subject::setConnection($db);
Course::setConnection($db);
User::setConnection($db);
Student::setConnection($db);
Subject_Enrollment::setConnection($db);
Grade::setConnection($db);

//enrolled student
$subject = Subject::find($_GET['id']);

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

$students = $subject->students();

$courses = Course::all();
$instructors = User::findByRole('instructor');


foreach($courses as $course){
    if($course->id == $subject->course_id){
        $course_name = $course->name;
    }
}

if($subject->year_level == 1){
    $year_level = '1st Year';
} elseif($subject->year_level == 2){
    $year_level = '2nd Year';
} elseif($subject->year_level == 3){
    $year_level = '3rd Year';
} elseif($subject->year_level == 4){
    $year_level = '4th Year';
}

foreach($instructors as $instructor){
    if($instructor->id == $subject->instructor_id){
        $instructor_name = $instructor->name;
    }
}



?>

<div class="full-screen-bg">
    <div class = "container">
        <div class="bg index-bg">
            <div class="list-details">
                <div class="row">
                    <div class="col-7">
                        <h1 class = "card-title text" data-text ="Subject Details">Subject Details</h1>
                    </div>
                    <div class="col-5 d-flex justify-content-end align-items-center">
                        <a href = "../subject_enrollment_management/create.php?id=<?=$subject->id?>" class = "btn btn-primary float-right">Enroll Student</a>
                        <a href = "index.php" class = "btn btn-secondary float-right" style="margin-left: 3px;">Back</a>
                    </div>
                    <hr>
                </div>
                <table class = "table">
                    <thead>
                        <tr>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Course</th>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>Instructor</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?=$subject->code?></td>
                            <td><?=$subject->name?></td>
                            <td><?php echo $course_name ?></td>
                            <td><?php echo $year_level ?></td>
                            <td><?php if($subject->semester == 1){
                                echo '1st Semester';
                            } else {
                                echo '2nd Semester';
                            }?></td>
                            <td><?=$instructor_name?></td>
                            <td><?php if($students == NULL ){
                                echo '0';
                            } else {
                                echo count($students);
                            }?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="list-table">
                <table id = "listsTable" class = "table table-striped">
                    <thead>
                        <tr class="table-dark">
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Year Level</th>
                            <th>Grade</th>
                            <th>Remarks</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($students)): ?>
                            
                        <?php else: ?>

                        <?php foreach($students as $student): 
                            $grade = 'N/A';
                            $remarks = 'Pending';
                            $id = 'N/A';
                            $grades = $student->grades(); 
                            if($grades){
                                foreach($grades as $g){
                                    if($g->subject_id == $subject->id && $g->student_id == $student->id){
                                        $grade = $g->grade;
                                        $remarks = $g->remarks;
                                        $id = $g->id;
                                        break;
                                    }
                                }
                            }
                            ?>
                            <tr>
                                <td><?=$student->id?></td>
                                <td><?=$student->name?></td>
                                <td>
                                    <?php
                                        if($student->year_level == 1){
                                            echo "1st Year";
                                        }else if($student->year_level == 2){
                                            echo "2nd Year";
                                        }else if($student->year_level == 3){
                                            echo "3rd Year";
                                        }else if($student->year_level == 4){
                                            echo "4th Year";
                                        }
                                    ?>
                                </td>
                                <td><?=$grade?></td>
                                <td><?=$remarks?></td>
                                <td><?php 
                                    $subject_enrollment = Subject_Enrollment::all();
                                    foreach($subject_enrollment as $enrollment){
                                        if($student->id == $enrollment->student_id && $subject->id == $enrollment->subject_id){
                                            if($enrollment->status == 'enrolled'){
                                                echo 'Active';
                                            }
                                            else if($enrollment->status == 'dropped'){
                                                echo 'Dropped';
                                            }
                                            else if($enrollment->status == 'completed'){
                                                echo 'Completed';
                                            }
                                        }
                                    }
                                ?></td>
                                <td class = "text-nowrap">
                                    <a href="../subject_enrollment_management/edit.php?id=<?=$student->id?>" class="btn btn-warning"><i class ="fa-regular fa-edit"></i> Edit</a>
                                    <a href="../subject_enrollment_management/destroy.php?id=<?=$student->id?>" class="btn btn-danger delete"><i class ="fas fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" class="text-center">
                                <strong>List of Enrolled Students</strong>
                            </td>
                        </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include '../layout/footer.php'; ?>
            