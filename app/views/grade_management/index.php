<?php 
require_once '../../../config/Database.php';
require_once '../../models/subject.php';
require_once '../../models/subject_enrollment.php';
require_once '../../models/user.php';
$database = new Database();
$db = $database->getConnection();

Subject::setConnection($db);
Subject_Enrollment::setConnection($db);
User::setConnection($db);

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if(!isset($_SESSION['email'])){
    header('Location: ../authentication/login.php');
}

$instructor = User::find($_SESSION['id']);

include '../layout/header.php';

?>
<div class="full-screen-bg">
    <div class="container">
        <div class="bg index-bg">
            <div class="main-title">
                <div class="col-12">
                    <h1 class = "index-title text" data-text = "Grade Management">Grade Management</h1>
                </div>
                <div class="row justify-content-center">
                <div class="col-md-12">
                    <table class="table table-striped" id="usersTable">
                        <thead>
                            <tr class="table-dark">
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th>Year Level</th>
                                <th>Semester</th>
                                <th>Action</th>
                            </tr>   
                        </thead>
                        <tbody>
                            <?php foreach($instructor->subjects() as $subject): ?>
                                <tr>      
                                    <td><?=$subject->code ?></td>  
                                    <td><?=$subject->name ?></td>
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
                                    <td>
                                        <?php
                                            if($subject->semester == 1){
                                                echo '1st Semester';
                                            } elseif($subject->semester == 2){
                                                echo '2nd Semester';
                                            } 
                                        ?>
                                    </td>
                                    <td><a href="show.php?id=<?=$subject->id?>" class="btn btn-info"><i class="fa-regular fa-eye"></i> View</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include '../layout/footer.php'; ?>
                        
                        