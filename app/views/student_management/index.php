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
$database = new Database();
$db = $database->getConnection();

Student::setConnection($db);
Course::setConnection($db);

$students = Student::all();
$courses = Course::all();
?>


<div class="full-screen-bg">
    <div class="container-fluid">
        <div class="bg index-bg">
            <div class="main-title d-flex align-items-center">
                <h1 class = "index-title text" data-text = "Student Management">Student Management</h1>
                <button class="btn btn-danger ms-auto" id="generate_report"><i class="fa-regular fa-file-pdf"></i> PDF</button>
                <div class="report-bg ms-auto" id="filter_bg" style="display: none;">
                    <div class="report-title">GENERATE REPORT</div>
                    <div class="row">
                        <div class="col-12 d-flex align-items-center mt-2">
                            <a class="btn btn-primary filter w-100 text-nowrap" id="filter_data" style = "display: block; "><i class="fas fa-filter"></i> Select Student</a>
                            <button class="btn btn-secondary filter w-100" id="cancel_filter" style="display: none;"><i class="fas fa-times"></i> Cancel</button>
                            
                            <a class="btn btn-success all w-100" style = "display: block;" id = "filter_all" href="../reports/students_report.php" target="_blank"><i class="fas fa-globe"></i> All</a>
                        </div>
                    </div>
                    <form class="mt-2" action="../reports/students_report.php" target="_blank" method="GET" id="filter_form">
                        <hr>
                        <h3 style="font-size: 16px;"><i class = "fas fa-calendar"></i>Student ID :</h3>
                        <div class="d-flex align-items-center">
                            <div class="form-group year">
                                <input type="text" class="form-control" name="student_id" id="student_id" placeholder="Enter Student ID">
                            </div>
                            <button type="submit" class="btn btn-warning filter"><i class="fa-regular fa-file-alt"></i> Generate</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- <div>
            <a href="../reports/students_report.php" class="btn btn-primary">Generate All Students Report</a>
            <a href="../reports/students_report.php?status=active" class="btn btn-success">Active Students</a>
            <a href="../reports/students_report.php?status=inactive" class="btn btn-danger">Inactive Students</a>
            <a href="create.php" class="btn btn-primary">Create New Student</a>
            </div> -->
            <table id="usersTable" class="table table-striped">
                <thead>
                    <tr class="table-dark">
                        <th>ID</th>
                        <th class = "text-nowrap">Student ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Birthdate</th>
                        <th>Course ID</th>
                        <th>Year</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($students):
                            foreach($students as $student):
                    ?>
                        <tr>
                            <td><?= $student->id ?></td>
                            <td><?= $student->student_id ?></td>
                            <td><?= $student->name ?></td>
                            <td><?= $student->gender ?></td>
                            <td><?= date('F j, Y', strtotime($student->birthdate)) ?></td>
                            <td>
                                <?php
                                    foreach($courses as $course){
                                        if($course->id == $student->course_id){
                                            echo $course->name;
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($student->year_level == 1){
                                        echo '1st Year';
                                    } elseif($student->year_level == 2){
                                        echo '2nd Year';
                                    } elseif($student->year_level == 3){
                                        echo '3rd Year';
                                    } elseif($student->year_level == 4){
                                        echo '4th Year';
                                    }
                                ?>
                            </td>
                            <td><?= $student->status ?></td>
                            <td class = "text-nowrap">
                                <a href="show.php?id=<?= $student->id ?>" class="btn btn-info"><i class="fa-regular fa-eye"></i> View</a>
                                <a href="edit.php?id=<?= $student->id ?>" class="btn btn-warning"><i class="fa-regular fa-edit"></i> Edit</a>
                                <a href="destroy.php?id=<?= $student->id ?>" class="btn btn-danger delete"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php 
                            endforeach;
                        endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../layout/footer.php'; ?>
