<?php require_once '../../../config/Database.php'; 
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
$users = User::all();

?>  

<div class="full-screen-bg">
    <div class="container-fluid">
        <div class="bg index-bg">
            <div class="main-title  d-flex align-items-center">
                <h1 class = "index-title text" data-text = "User Management">User Management</h1>
                <button class="btn btn-danger ms-auto" id="generate_report"><i class="fa-regular fa-file-pdf"></i> PDF</button>
                <div class="report-bg ms-auto" id="filter_bg" style="display: none;">
                    <div class="report-title">GENERATE REPORT</div>
                    <div class="row">
                        <div class="col-12 d-flex align-items-center mt-2">
                            <a class="btn btn-primary filter w-100 text-nowrap" id="filter_data" style = "display: block; "><i class="fas fa-filter"></i> Select User</a>
                            <button class="btn btn-secondary filter w-100" id="cancel_filter" style="display: none;"><i class="fas fa-times"></i> Cancel</button>
                            
                            <a class="btn btn-success all w-100" style = "display: block;" id = "filter_all" href="../reports/users_report.php" target="_blank"><i class="fas fa-globe"></i> All</a>
                        </div>
                    </div>
                    <form class="mt-2" action="../reports/users_report.php" target="_blank" method="GET" id="filter_form">
                        <hr>
                        <h3 style="font-size: 16px;"><i class = "fas fa-calendar"></i> Select User :</h3>
                        <div class="d-flex align-items-center">
                            <div class="form-group year">
                                <select class="form-control" name="users" id="users">
                                        <option value="" selected disabled>Select Course</option>
                                    <?php
                                        if ($_SESSION['role'] == 'superadmin') {
                                            echo "<option value='all_instructor'>All Instructors</option>";
                                            echo "<option value='all_admin'>All Admins</option>";
                                            foreach($users as $user){
                                                if($user->role != 'superadmin'){ 
                                                    echo "<option value='$user->id'>$user->name</option>";
                                                }
                                            }
                                        }else if ($_SESSION['role'] == 'admin') {
                                            echo "<option value='all_instructor'>All Instructor</option>";
                                            foreach($users as $user){
                                                if($user->role == 'instructor'){
                                                    echo "<option value='$user->id'>$user->name</option>";
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-warning filter"><i class="fa-regular fa-file-alt"></i> Generate</button>
                        </div>
                    </form>
                </div>
            </div>
            <table id="usersTable" class="table table-striped">
                <thead>
                    <tr class="table-dark">
                        <th>Users #</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created_At</th>
                        <th>Updated_At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        foreach($users as $user):
                            if($user->role == 'superadmin'){
                                continue;
                            }
                            if($_SESSION['role'] == 'admin' && $user->role == 'admin'){
                                continue;
                            }
                    ?>
                        <tr>
                            <td><?=$i++ ?></td>
                            <td><?=$user->name ?></td>
                            <td><?=$user->email?></td>
                            <td><?=$user->role ?></td>
                            <td>
                                <?php if($user->designation == 0): $user->status = 'inactive'; $user->save();?>
                                    <span class="badge bg-danger">Inactive</span>
                                <?php else: $user->status = 'active'; $user->save();?>
                                    <span class="badge bg-success">Active</span>
                                <?php endif; ?>
                            </td>
                            <td><?=$user->created_at ?></td>
                            <td><?=$user->updated_at ?></td>
                            <td>
                                <a href="show.php?id=<?=$user->id?>" class="btn btn-info"><i class ="fa-regular fa-eye"></i> View</a>
                                <a href="edit.php?id=<?=$user->id?>" class="btn btn-warning"><i class ="fa-regular fa-edit"></i> Edit</a>
                                <a href="destroy.php?id=<?=$user->id?>" class="btn btn-danger delete"><i class ="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include '../layout/footer.php';?>