<?php
require_once '../../../config/Database.php';
require_once '../../models/Subject.php';
require_once '../../models/Course.php';
require_once '../../models/User.php';
require_once '../../models/Student.php';
require_once '../../models/Subject_Enrollment.php';
require_once '../../models/Grade.php';

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if(!isset($_SESSION['email'])){
    header('Location: ../authentication/login.php');
}

include '../layout/header.php';

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
if(empty($subject)){
    http_response_code(404);
    echo "<div class='container-full error-container'>
                <div class='error-bg'>
                    <div class = 'error-page'><h1>∑(; °Д°)</h1><br><h4>Error not found</h4><a class = 'btn go-back' href = '/student_management_system/index.php'>Go Back</a></div>
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
        $instructor_id = $instructor->id;
        $instructor_name = $instructor->name;
    }
}


?>

<div class="full-screen-bg">
    <div class = "container">
        <div class="bg index-bg">
            <div class="list-details">
                <div class="row">
                    <div class="col-11">
                        <h1 class = "card-title text" data-text = "View Subject">View Subject</h1>
                    </div>
                    <div class="col-1">
                        <a href="index.php" class = "btn btn-secondary float-end">Back</a>
                    </div>
                </div>
                <hr>
                <table class = "table">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Instructor</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?=$subject->code . ' - ' . $subject->name?></td>
                            <td>
                                <?php
                                    foreach($courses as $course){
                                        if($course->id == $subject->course_id){
                                            echo $course->name;
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($subject->year_level == 1){
                                        echo '1st Year';
                                    } elseif($subject->year_level == 2){
                                        echo '2nd Year';
                                    } elseif($subject->year_level == 3){
                                        echo '3rd Year';
                                    } elseif($subject->year_level == 4){
                                        echo '4th Year';
                                    }
                                ?>
                            </td>
                            <td><?=$instructor_name?></td>
                            <td><?=count($students)?></td>
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
                            $student_id = Null;
                            $subject_id = Null;
                            $grades = Grade::findGradesByStudent($student->id);  
                            if($grades){
                                foreach($grades as $g){
                                    if($g->subject_id == $subject->id && $g->student_id == $student->id){
                                        $grade = $g->grade;
                                        $remarks = $g->remarks;
                                        $id = $g->id;
                                        $student_id = $g->student_id;
                                        $subject_id = $g->subject_id;
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
                                <td>
                                    <?php if($student->id == $student_id && $subject->id == $subject_id): ?>
                                        <a href="edit.php?id=<?=$id?>&student_id=<?=$student->id?>&subject_id=<?=$subject->id?>" class="btn btn-warning w-100"><i class="fa-regular fa-pen-to-square"></i>Edit Grade</a>
                                    <?php else: ?>
                                        <a href="create.php?student_id=<?=$student->id?>&subject_id=<?=$subject->id?>&instructor_id=<?=$instructor_id?>" class="btn btn-primary w-100"><i class="fa-solid fa-plus"></i> Add Grade</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9" class="text-center"><strong>List of Enrolled Students</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include '../layout/footer.php'; ?>
            