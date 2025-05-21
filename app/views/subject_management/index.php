<?php 
require_once '../../../config/Database.php';
require_once '../../models/Subject.php';
require_once '../../models/Subject_enrollment.php';
require_once '../../models/Course.php';
require_once '../../models/User.php';

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if(!isset($_SESSION['email'])){
    header('Location: ../authentication/login.php');
}

include '../layout/header.php';
require '../../../permission.php';
$database = new Database();
$db = $database->getConnection();

Subject::setConnection($db);
Subject_Enrollment::setConnection($db);
Course::setConnection($db);
User::setConnection($db);


$subjects = Subject::all();
$subject_enrollment = Subject_Enrollment::all();
?>


<div class="full-screen-bg">
    <div class="container-fluid">
        <div class="bg index-bg">
            <div class="main-title d-flex align-items-center">
                <h1 class = "index-title text" data-text ="Subject Management">Subject Management</h1>
                <button class="btn btn-danger ms-auto" id="generate_report"><i class="fa-regular fa-file-pdf"></i> PDF</button>
                <div class="report-bg ms-auto" id="filter_bg" style="display: none;">
                    <div class="report-title">GENERATE REPORT</div>
                    <div class="row">
                        <div class="col-12 d-flex align-items-center mt-2">
                            <a class="btn btn-primary filter w-100 text-nowrap" id="filter_data" style = "display: block; "><i class="fas fa-filter"></i> Select Subject</a>
                            <button class="btn btn-secondary filter w-100" id="cancel_filter" style="display: none;"><i class="fas fa-times"></i> Cancel</button>
                            
                            <a class="btn btn-success all w-100" style = "display: block;" id = "filter_all" href="../reports/subjects_report.php" target="_blank"><i class="fas fa-globe"></i> All</a>
                        </div>
                    </div>
                    <form class="mt-2" action="../reports/subjects_report.php" target="_blank" method="GET" id="filter_form">
                        <hr>
                        <h3 style="font-size: 16px;"><i class = "fas fa-calendar"></i>Subject Catalog :</h3>
                        <div class="d-flex align-items-center">
                            <div class="form-group year">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter Subject Catalog No">
                            </div>
                            <button type="submit" class="btn btn-warning filter"><i class="fa-regular fa-file-alt"></i> Generate</button>
                        </div>
                    </form>
                </div>
            </div>
            <table id="subjectsTable" class="table table-striped">
                <thead>
                    <tr class="table-dark">
                        <th>Code</th>
                        <th>Catalog</th>
                        <th>Name</th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Room</th>
                        <th>Course</th>
                        <th>Semester</th>
                        <th>Year</th>
                        <th>Instructor</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($subjects)): ?>
                                
                    <?php else:  
                        foreach ($subjects as $subject):
                            $isEnrolled = false;
                            if(empty($subject_enrollment)){}
                            else{
                                foreach ($subject_enrollment as $enrollment) {
                                    if ($enrollment->subject_id == $subject->id) {
                                        $isEnrolled = true;
                                        break;
                                    }
                                }
                            }
                    ?>
                        <tr>
                            <td><?= $subject->code ?></td>
                            <td><?= $subject->catalog_no ?></td>
                            <td><?= $subject->name ?></td>
                            <td><?= $subject->day ?></td>
                            <td><?= $subject->time ?></td>
                            <td><?= $subject->room ?></td>
                            <td>
                                <?php
                                    $course = Course::find($subject->course_id);
                                    echo $course ? $course->name : 'N/A';
                                ?>
                            </td>
                            <td>
                                <?php
                                    if ($subject->semester == 1) {
                                        echo '1st Semester';
                                    } elseif ($subject->semester == 2) {
                                        echo '2nd Semester';
                                    } else {
                                        echo 'N/A';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if ($subject->year_level == 1) {
                                        echo '1st Year';
                                    } elseif ($subject->year_level == 2) {
                                        echo '2nd Year';
                                    } elseif ($subject->year_level == 3) {
                                        echo '3rd Year';
                                    } elseif ($subject->year_level == 4) {
                                        echo '4th Year';
                                    } else {
                                        echo 'N/A';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    $instructor =User::find($subject->instructor_id);
                                    echo $instructor ? $instructor->name : 'N/A';
                                ?>
                            </td>
                            <td class="text-nowrap">
                                <a href="show.php?id=<?= $subject->id ?>" class="btn btn-info"><i class="fa-regular fa-eye"></i> View</a>
                                <a href="edit.php?id=<?= $subject->id ?>" class="btn btn-warning"><i class="fa-regular fa-edit"></i> Edit</a>
                                <?php if (!$isEnrolled): ?>
                                    <a href="destroy.php?id=<?= $subject->id ?>" class="btn btn-danger delete"><i class="fas fa-trash"></i> Delete</a>
                                <?php else: ?>
                                    <button class="btn btn-danger del" disabled><i class="fas fa-trash"></i> Delete</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include '../layout/footer.php'; ?>
