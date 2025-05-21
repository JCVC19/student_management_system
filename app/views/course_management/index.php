<?php 
    require '../../../config/Database.php';
    require_once '../../models/Subject.php';

    session_start([
    'cookie_lifetime' => 86400, // seconds (1 day)
    ]);

    if(!isset($_SESSION['email'])){
        header('Location: ../authentication/login.php');
    }

    include '../layout/header.php';
    require '../../../permission.php';
    require_once '../../models/Course.php';
    $db = new Database();
    $conn = $db->getConnection();

    Course::setConnection($conn);

    $courses = Course::all();
    $subjects = Subject::all();
    



?>


<div class="full-screen-bg">
    <div class="container-fluid index">
        <div class="bg index-bg">
            <div class="main-title d-flex align-items-center">
                    <h1 class = "index-title text" data-text = "Course Management">Course Management</h1>
                    <button class="btn btn-danger ms-auto" id="generate_report"><i class="fa-regular fa-file-pdf"></i> PDF</button>
                    <div class="report-bg ms-auto" id="filter_bg" style="display: none;">
                        <div class="report-title">GENERATE REPORT</div>
                        <div class="row">
                            <div class="col-12 d-flex align-items-center mt-2">
                                <a class="btn btn-primary filter w-100 text-nowrap" id="filter_data" style = "display: block; "><i class="fas fa-filter"></i> Select Course</a>
                                <button class="btn btn-secondary filter w-100" id="cancel_filter" style="display: none;"><i class="fas fa-times"></i> Cancel</button>
                                
                                <a class="btn btn-success all w-100" style = "display: block;" id = "filter_all" href="../reports/course_report.php" target="_blank"><i class="fas fa-globe"></i> All</a>
                            </div>
                        </div>
                        <form class="mt-2" action="../reports/course_report.php" target="_blank" method="GET" id="filter_form">
                            <hr>
                            <h3 style="font-size: 16px;"><i class = "fas fa-calendar"></i> Select Course :</h3>
                            <div class="d-flex align-items-center">
                                <div class="form-group year">
                                    <select class="form-control" name="course_id" id="course_id">
                                            <option value="" selected disabled>Select Course</option>
                                        <?php
                                            foreach($courses as $course){
                                                echo "<option value='$course->id'>$course->name</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-warning filter"><i class="fa-regular fa-file-alt"></i> Generate</button>
                            </div>
                        </form>
                    </div>
            </div>
            <table class="table table-striped" id="usersTable">
                <thead>
                    <tr class="table-dark">
                        <th>ID</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Create At</th>
                        <th class = "d-flex" style = "white-space: nowrap;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($courses == null) {

                    }
                    else {
                        foreach($courses as $course):
                            $isEnrolled = false;
                            foreach ($subjects as $subject) {
                                if ($subject->course()->id == $course->id) {
                                    $isEnrolled = true;
                                    break;
                                }
                            }
                    ?>
                        <tr>
                            <td><?=$course->id ?></td>  
                            <td><?=$course->code ?></td>
                            <td><?=$course->name?></td>
                            <td><?=$course->created_at ?></td>
                            <td style = "white-space: nowrap;">
                                <a href="show.php?id=<?=$course->id?>" class="btn btn-info"><i class="fa-regular fa-eye"></i> View</a>
                                
                                <a href="edit.php?id=<?=$course->id?>" class="btn btn-warning"><i class="fa-regular fa-edit"></i> Edit</a>
                                <?php if (!$isEnrolled): ?>
                                    <a href="destroy.php?id=<?= $course->id ?>" class="btn btn-danger delete"><i class="fas fa-trash"></i> Delete</a>
                                <?php else: ?>
                                    <button class="btn btn-danger del" disabled><i class="fas fa-trash"></i> Delete</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; 
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include '../layout/footer.php';?>