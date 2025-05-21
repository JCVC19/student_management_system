<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUDENT MANAGEMENT SYSTEM</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/student_management_system/assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/student_management_system/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/student_management_system/assets/favicon-16x16.png">
    <link rel="manifest" href="/student_management_system/assets/site.webmanifest">

    <!-- JQUERY -->
    <script src="/student_management_system/assets/js/jquery-3.4.1.min.js"></script>

    <!-- Bootstrap 5.3 CSS -->
    <link rel="stylesheet" type="text/css" href="/student_management_system/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/student_management_system/assets/css/style.css">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.2.2/af-2.7.0/b-3.2.2/b-colvis-3.2.2/b-html5-3.2.2/b-print-3.2.2/cr-2.0.4/date-1.5.5/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.4/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.2/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.css" rel="stylesheet" integrity="sha384-6gM1RUmcWWtU9mNI98EhVNlLX1LDErxSDu2o/YRIeXq34o77tQYTXLzJ/JLBNkNV" crossorigin="anonymous">
    
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=arrow_drop_down" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=delete" />

    <!-- SweetAlert2 CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
    <body>
        <?php if(isset($_SESSION['email'])): ?>
        <div class = "sidebar close">
            <div class = "logo-details">
                <img src = "/student_management_system/assets/picture/ua_logo.png" alt = "logo" class = "logo">
                <h1 class = "logo_name">PLUS ULTRA!</h1>
            </div>
            <ul class = "nav-links">
                <li class = "nav-list">
                    <a href = "/student_management_system/index.php" class = "l">
                        <i class = "fas fa-tachometer-alt" style = "pointer-events: none;"></i>
                        <span class = "link_name" style = "pointer-events: none;">Dashboard</span>
                    </a>
                    <ul class = "sub-menu blank">
                        <li><a href = "/student_management_system/index.php" class = "link_name l">Dashboard</a></li>
                    </ul>
                </li>
                <?php if($_SESSION['role'] == 'instructor'){} 
                else{?>
                    <li class = "nav-list">
                        <div class = "icon-link">
                            <a href = "#" class = "a-href student_management" style = "pointer-events: none;">
                                <i class = "fas fa-user-graduate"></i>
                                <span class = "link_name">Manage Student</span>
                            </a>
                            <i class = "fas fa-chevron-down arrow"></i>
                        </div>
                        <ul class = "sub-menu">
                            <li><a href = "#" class = "link_name" style = "pointer-events: none;">Student</a></li>
                            <li><a href = "/student_management_system/app/views/student_management/index.php" class = "student_management l">View Student</a></li>
                            <li><a href = "/student_management_system/app/views/student_management/create.php" class = "create_student l">Create Student</a></li>
                        </ul>
                    </li>
                    <li class = "nav-list">
                        <div class = "icon-link">
                            <a href = "#" class = "a-href course_management" style = "pointer-events: none;">
                                <i class = "fas fa-book"></i>
                                <span class = "link_name">Manage Course</span>
                            </a>
                            <i class = "fas fa-chevron-down arrow"></i>
                        </div>
                        <ul class = "sub-menu">
                            <li><a href = "#" class = "link_name" style = "pointer-events: none;">Course</a></li>
                            <li><a href = "/student_management_system/app/views/course_management/index.php" class = "course_management l">View Course</a></li>
                            <li><a href = "/student_management_system/app/views/course_management/create.php" class = "create_course l">Create Course</a></li>
                        </ul>
                    </li>
                    <li class = "nav-list">
                        <div class = "icon-link">
                            <a href = "#" class = "a-href subject_management" style = "pointer-events: none;">
                                <i class = "fas fa-book-open"></i>
                                <span class = "link_name">Manage Subject</span>
                            </a>
                            <i class = "fas fa-chevron-down arrow"></i>
                        </div>
                        <ul class = "sub-menu">
                            <li><a href = "#" class = "link_name" style = "pointer-events: none;">Subject</a></li>
                            <li><a href = "/student_management_system/app/views/subject_management/index.php" class = "subject_management l">View Subject</a></li>
                            <li><a href = "/student_management_system/app/views/subject_management/create.php" class = "create_subject l">Create Subject</a></li>
                        </ul>
                    </li>
                    <li class = "nav-list">
                        <div class="icon-link">
                            <a href = "#" class = "a-href user_management" style = "pointer-events: none;">
                            <i class = "fas fa-users"></i>
                            <span class = "link_name">Manage User</span>
                            </a>
                            <i class = "fas fa-chevron-down arrow"></i>
                        </div>
                        <ul class = "sub-menu">
                            <li><a href = "#" class = "link_name" style = "pointer-events: none;">User</a></li>
                            <li><a href = "/student_management_system/app/views/user_management/index.php" class = "user_management l">View User</a></li>
                            <li><a href = "/student_management_system/app/views/user_management/create.php" class = "create_user l">Create User</a></li>
                        </ul>
                    </li>
                <?php 
                }
                if($_SESSION['role'] == 'instructor'){ ?>
                    <li class = "nav-list">
                        <div class="icon-link">
                            <a href = "#" class = "a-href grade_management" style = "pointer-events: none;">
                                <i class = "fas fa-graduation-cap"></i>
                                <span class = "link_name">Manage Grade</span>
                            </a>
                            <i class = "fas fa-chevron-down arrow"></i>
                        </div>
                        <ul class = "sub-menu">
                            <li><a href = "#" class = "link_name" style = "pointer-events: none;">Grade</a></li>
                            <li><a href = "/student_management_system/app/views/grade_management/index.php" class = "grade_management l">View Grade</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class = "home-section">
            <div class = "home-content">
                <div class="bar d-flex justify-content-between align-items-center">
                    <a href="#" class = "btn btn-primary" id = "menu"><i class = "fas fa-bars " id = "menu-bar"></i></a>
                </div>
                <div class="profile d-flex justify-content-end align-items-center">
                    <a href = "/student_management_system/app/views/authentication/index.php" class = "btn btn-danger p-link" style = "margin-left: 2px; border-radius: 50%;"><i class="fas fa-user p-logo"></i></a>
                </div>
            </div> 
        <?php endif; ?>
        
        