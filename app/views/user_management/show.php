<?php require_once  '../../../config/Database.php';
    $db = new Database();
    $conn = $db->getConnection();
?>
<?php require_once '../../models/User.php'; 

session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
]);

if(!isset($_SESSION['email'])){
    header('Location: ../authentication/login.php');
}

include '../layout/header.php';
require '../../../permission.php';

User::setConnection($conn);
$user = User::find($_GET['id']);

if(empty($user)){
    http_response_code(404);
    echo "<div class='container-full error-container'>
                <div class='error-bg'>
                    <div class = 'error-page'><h1>∑(; °Д°)</h1><br><h4>User not found</h4><a class = 'btn go-back' href = '/student_management_system/index.php'>Go Back</a></div>
                </div>
            </div>";
    exit();
}
?>
<div class="full-screen-bg">
    <div class = "container">
        <div class="bg index-bg">
            <!-- <div class = "list-bg"> -->
            <div class="list-details">
                <div class="main-title d-flex align-items-center">
                    <h1 class = "text mb-0" data-text = "User Details">User Details</h1>
                    <a href = "index.php" class = "btn btn-secondary ms-auto" >Back</a>
                </div>
                <hr>
                <table class = "table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?=$user->name?></td>
                            <td><?=$user->email?></td>
                            <td><?=$user->role?></td>
                            <td><?=$user->status?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="list-table">
                <?php if($user->role == 'instructor'): ?>
                <!-- <h4 class="text-center">Handled Subjects:</h4> -->
                <table id = "listsTable" class = "table table-striped">
                    <!-- <caption class="text-center"><h4>Handled Subjects:</h4></caption> -->
                    <thead>
                        <tr class="table-dark">
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Year Level</th>
                            <th>Semester</th>
                        </tr>   
                    </thead>
                    <tbody>
                        <?php if(empty($user->subjects())){
                        
                        } 
                        else{?>
                        <?php foreach($user->subjects() as $subject): ?>

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
                            </tr>
                        <?php endforeach; }?>
                    </tbody>      
                    <tfoot>
                        <tr>
                            <td colspan="9" class="text-center"><strong>List of Handled Subjects</strong></td>
                        </tr>
                    </tfoot>     
                </table>
            <?php endif; ?> 
            </div>
   
        <!-- </div> -->
    </div>
</div>
<?php include '../layout/footer.php'; ?>

