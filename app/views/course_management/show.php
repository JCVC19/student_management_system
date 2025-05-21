<?php
    require_once '../../../config/Database.php';
    require_once '../../models/Course.php';
    require_once '../../models/Student.php';

    session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
    ]);

    if(!isset($_SESSION['email'])){
        header('Location: ../authentication/login.php');
    }

    include '../layout/header.php';
    require '../../../permission.php';
    $db = new Database();
    $conn = $db->getConnection();
    Course::setConnection($conn);
    Student::setConnection($conn);  

   $course = Course::find($_GET['id']);

   if(empty($course)){
    http_response_code(404);
    echo "<div class='container-full error-container'>
                <div class='error-bg'>
                    <div class = 'error-page'><h1>∑(; °Д°)</h1><br><h4>Course not found</h4><a class = 'btn go-back' href = '/student_management_system/index.php'>Go Back</a></div>
                </div>
            </div>";
    exit();
}

?>

<div class="full-screen-bg">
    <div class="container">
        <div class="bg index-bg">
            <div class="list-details">
                <div class="main-title d-flex align-items-center">
                    <h1 class = "text mb-0" data-text = "Course Details">Course Details</h1>
                    <a href = "index.php" class = "btn btn-secondary ms-auto">Back</a>
                </div>
                <hr>
                <table class = "table">
                    <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Course Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?=$course->code?></td>
                            <td><?=$course->name?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="list-table">
                <table class="table table-striped" id="listsTable">
                    <thead>
                        <tr class="table-dark">
                            <th>Student Id</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Year Level</th>
                        </tr>   
                    </thead>
                    <tbody>
                        <?php
                            if(empty($course->student())){

                            }
                            else{
                            foreach($course->student() as $student):
                        ?>
                        <tr>      
                                <td><?=$student->student_id ?></td>  
                                <td><?=$student->name ?></td>
                                <td><?=$student->gender?></td>
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
                        </tr>
                        <?php endforeach; }?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" class="text-center">
                                <strong>List of Enrolled Students</strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../layout/footer.php';?>