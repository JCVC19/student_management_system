<?php 
require_once 'config/Database.php';
require_once 'app/models/User.php';
require_once 'app/models/Subject.php';
require_once 'app/models/Course.php';
require_once 'app/models/Student.php';
require_once 'app/models/Grade.php';


session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

include 'app/views/layout/header.php'; 

if(!isset($_SESSION['email'])){
    header('Location: app/views/authentication/login.php');
}

$database = new Database();
$db = $database->getConnection();
User::setConnection($db);
Subject::setConnection($db);
Course::setConnection($db);
Student::setConnection($db);
Grade::setConnection($db);

$user = User::find($_SESSION['id']);

if($_SESSION['welcome'] == 'success'){
    echo '<script>
        Swal.fire({
            icon: "success",
            title: "WELCOME TO U.A.!",
            text: "' . $user->name . ', You have successfully logged in! Now go beyond, PLUS ULTRA!",
            showConfirmButton: true,
            confirmButtonText: "OK",
            confirmButtonColor: "#3085d6",
            customClass: {
                popup: "my-swal-popup",
                title: "my-swal-title",
                confirmButton: "my-swal-button"
            }
        }).then(function(){
            window.location = "index.php";
        });
    </script>';
    $_SESSION['welcome'] = 'nice';
}




$students = Student::all();
$allstudentscount = !empty($students) ? count($students) : 0;

$course = Course::all();
$coursecount = !empty($course) ? count($course) : 0;

$gradecountnstructors = User::findByRole('instructor');
$gradecountnstructorcount = !empty($gradecountnstructors) ? count($gradecountnstructors) : 0;

$subjects = Subject::all();
$allsubjectcount = !empty($subjects) ? count($subjects) : 0;

$admins = User::findByRole('admin');
$admincount = !empty($admins) ? count($admins) : 0;

if($user->role == 'instructor'){
$grades = Grade::where('remarks', '=', 'pending');
// $gradecount = !empty($grades) ? count($grades) : 0;
$gradecount = 0;

if(!empty($user->subjects())){
    foreach ($user->subjects() as $subject) {
        foreach ($subject->students() as $student) {
            // Check if the student has a grade entry
            $grade = Grade::where('student_id', '=', $student->id);

            if(empty($grade)){
                $gradecount++;
            }
            else if(!empty($grade)){
                foreach ($grade as $g) {
                    if ($g->remarks == 'Pending') {
                        $gradecount++;
                    }
                }
            }

        }
    }
}
}

$subjects = Subject::findByInstructor($_SESSION['id']);
$subjectcount = !empty($subjects) ? count($subjects) : 0;

$students = Student::where('status', '=', 'active');
$studentcount = !empty($students) ? count($students) : 0;

?>

<div class="full-screen-bg">
    <div class="container-fluid">
        <div class="bg">
            <div class="main-title">
                <div class="col-12">
                    <h1 class="index-title text" data-text="Dashboard">Dashboard</h1>
                </div>
            </div>
            <div class="stats-box">
                <?php if(isset($user->role) && ($user->role == 'superadmin' || $user->role == 'admin')): ?>
                    <div class="stat-item green">
                        <a href="app/views/student_management/index.php" class="view-icon d-link"><i class="fas fa-eye"></i></a>
                        <div class="count"><?= $allstudentscount ?></div>
                        <div class="icon"><i class="fas fa-user-graduate"></i></div>
                        <h5>Student Population</h5>
                    </div>
                    <div class="stat-item blue">
                        <a href = "/student_management_system/app/views/course_management/index.php" class="view-icon d-link"><i class="fas fa-eye"></i></a>
                        <div class="count"><?= $coursecount ?></div>
                        <div class="icon"><i class="fas fa-book"></i></div>
                        <h5>Number of Courses</h5>
                    </div>
                    <div class="stat-item yellow">
                        <a href="app/views/user_management/index.php" class="view-icon d-link"><i class="fas fa-eye"></i></a>
                        <div class="count"><?= $gradecountnstructorcount ?></div>
                        <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
                        <h5>Population of Instructors</h5>
                    </div>
                    <div class="stat-item purple">
                        <a href="app/views/subject_management/index.php" class="view-icon d-link"><i class="fas fa-eye"></i></a>
                        <div class="count"><?= $allsubjectcount ?></div>
                        <div class="icon"><i class="fas fa-book-open"></i></div>
                        <h5>Number of Subjects</h5>
                    </div>
                <?php endif; ?>

                <?php if(isset($user->role) && $user->role == "superadmin"): ?>
                    <div class="stat-item orange">
                        <a href="app/views/user_management/index.php" class="view-icon d-link"><i class="fas fa-eye"></i></a>
                        <div class="count"><?= $admincount ?></div>
                        <div class="icon"><i class="fas fa-user-cog"></i></div>
                        <h5>Population of Admins</h5>
                    </div>
                <?php endif; ?>

                <?php if(isset($user->role) && $user->role == "instructor"): ?>
                    <div class="stat-item red">
                        <a href="app/views/grade_management/index.php" class="view-icon d-link"><i class="fas fa-eye"></i></a>
                        <div class="count"><?= $gradecount ?></div>
                        <div class="icon"><i class="fas fa-tasks"></i></div>
                        <h5>Pending Grades</h5>
                    </div>
                    <div class="stat-item blue">
                        <a href="app/views/grade_management/index.php" class="view-icon d-link"><i class="fas fa-eye"></i></a>
                        <div class="count"><?= $subjectcount ?></div>
                        <div class="icon"><i class="fas fa-chalkboard"></i></div>
                        <h5>Assigned Subjects</h5>
                    </div>
                    <div class="stat-item green">
                        <!-- <a href="#" class="view-icon"><i class="fas fa-eye"></i></a> -->
                        <div class="count"><?= $studentcount ?></div>
                        <div class="icon"><i class="fas fa-user-check"></i></div>
                        <h5>Active Students</h5>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/layout/footer.php'; ?>