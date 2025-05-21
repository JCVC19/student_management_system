<?php
include_once '../../../config/Database.php';
$db = new Database();
$conn = $db->getConnection();
require_once '../../models/User.php';
require '../../../plugins/fpdf/fpdf.php';
?>

<?php 
session_start();
User::setConnection($conn);

$pdf = new FPDF('P', 'mm', 'Legal');
$pdf->AddPage();    

if($_SESSION['role'] == 'admin'){
    if(empty($_GET['users'])) {
        $users = User::findByRole('instructor');
    }
    else if($_GET['users'] == 'all_instructor') {
    $users = User::findByRole('instructor');
    } 
    else {
        $users = [User::find($_GET['users'])];
    }
} 
else if($_SESSION['role'] == 'superadmin'){
    if(empty($_GET['users'])) {
        $users = User::all();
    }
    else if($_GET['users'] == 'all_instructor') {
    $users = User::findByRole('instructor');
    } 
    else if($_GET['users'] == 'all_admin') {
        $users = User::findByRole('admin');
    } 
    else {
        $users = [User::find($_GET['users'])];
    }
}


$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 10, 'User List', 0, 1, 'C');
$pdf->Ln(7);



if($users){ 
    $i = 0;
    $totaluser = 0;
    foreach ($users as $user) {
            if ($user->role == 'instructor' || $user->role == 'admin'){
                 $totaluser++;
            }
        }
        foreach ($users as $user) {
        if ($user->role == 'instructor'){
            $i++;
            $pdf->SetFont('Arial', 'B', 13);
            $pdf->Cell(20, 5, 'Name: ', 0, 0,'L');
            $pdf->SetFont('Arial', '', 13);
            $pdf->cell(0, 5, $user->name, 0, 1,'L');
            $pdf->Ln(2);

            $pdf->SetFont('Arial', 'B', 13);
            $pdf->Cell(20, 5, 'Email:', 0, 0,'L');
            $pdf->SetFont('Arial', '', 13);
            $pdf->cell(0, 5, $user->email, 0, 1,'L');
            $pdf->Ln(2);

            $pdf->SetFont('Arial', 'B', 13);
            $pdf->Cell(20, 5, 'Role:', 0, 0,'L');
            $pdf->SetFont('Arial', '', 13);
            $pdf->cell(0, 5, $user->role, 0, 1,'L');
            $pdf->Ln(2);

            $pdf->SetFont('Arial', 'B', 13);
            $pdf->Cell(20, 5, 'Status:', 0, 0,'L');
            $pdf->SetFont('Arial', '', 13);
            $pdf->cell(0, 5, $user->status, 0, 1,'L');

            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 13);
            $pdf->Cell(0, 10, 'Subject List', 0, 1, 'C');
            $pdf->SetFont('Arial', 'B', 12);
            
            $pdf->SetFillColor(200, 220, 255);
            $pdf->Cell(35, 10, 'Subject Code', 1, 0,'C', true);
            $pdf->Cell(100, 10, 'Subject Name', 1, 0,'C', true);
            $pdf->Cell(30, 10, 'Year Level', 1, 0,'C', true);
            $pdf->Cell(0, 10, 'Semester', 1, 0,'C', true);
            $pdf->Ln(10);
            $subs = $user->subjects();
            $pdf->SetFont('Arial', '', 11);

            if ($subs){
                foreach($user->subjects() as $subject){
                    $year_level;
                    if ($subject->year_level == 1) {
                        $year_level = '1st Year';
                    } else if ($subject->year_level == 2) {
                        $year_level = '2nd Year';
                    } else if ($subject->year_level == 3) {
                        $year_level = '3rd Year';
                    } else if ($subject->year_level == 4) {
                        $year_level = '4th Year';
                    } else if ($subject->year_level == 5) {
                        $year_level = '5th Year';
                    }else{
                        $year_level = 'N/A';
                    }
                    $pdf->Cell(35, 10, $subject->code, 1, 0,'C');
                    $pdf->Cell(100, 10, $subject->name, 1, 0,'C');
                    $pdf->Cell(30, 10, $year_level, 1, 0,'C');
                    $pdf->Cell(0, 10, $subject->semester, 1, 0,'C');
                    $pdf->Ln(10);
                }
            }else{
                $pdf->Cell(0, 10, 'No Subject Data found', 0, 1, 'C');
            }
            if ($i < $totaluser){
                $pdf->AddPage();
            }
        }else if ($user->role == 'admin' && $_SESSION['role'] == 'superadmin') {
        
        foreach ($users as $user) {
            if ($user->role == 'instructor' || $user->role == 'superadmin'){
                continue;
            }
            $i++;
            $pdf->SetFont('Arial', 'B', 13);
            $pdf->Cell(0, 10, 'Admin Information', 0, 1, 'C');
            $pdf->Ln(2);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetFillColor(200, 220, 255);
            $pdf->Cell(40, 8, 'Field', 1, 0, 'C', true);
            $pdf->Cell(0, 8, 'Details', 1, 1, 'C', true);

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(40, 8, 'Name', 1, 0, 'L');
            $pdf->Cell(0, 8, $user->name, 1, 1, 'L');

            $pdf->Cell(40, 8, 'Email', 1, 0, 'L');
            $pdf->Cell(0, 8, $user->email, 1, 1, 'L');

            $pdf->Cell(40, 8, 'Role', 1, 0, 'L');
            $pdf->Cell(0, 8, ucfirst($user->role), 1, 1, 'L');

            $pdf->Cell(40, 8, 'Status', 1, 0, 'L');
            $pdf->Cell(0, 8, ucfirst($user->status), 1, 1,'L');

                if ($i < $totaluser){
                    $pdf->AddPage();
                }
            }
        }
    }

}else if($users && $_GET['users'] == 'all_admin'){
    $users = User::all();
    $i = 0;
    $totaladmin = 0;
    foreach ($users as $user) {
            if ($user->role == 'admin'){
                 $totaladmin++;
            }
        }
    foreach ($users as $user) {
        
        if ($user->role == 'admin') {
            $i++;
            $pdf->SetFont('Arial', 'B', 13);
            $pdf->Cell(0, 10, 'Admin Information', 0, 1, 'C');
            $pdf->Ln(2);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetFillColor(200, 220, 255);
            $pdf->Cell(40, 8, 'Field', 1, 0, 'C', true);
            $pdf->Cell(0, 8, 'Details', 1, 1, 'C', true);

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(40, 8, 'Name', 1, 0, 'L');
            $pdf->Cell(0, 8, $user->name, 1, 1, 'L');

            $pdf->Cell(40, 8, 'Email', 1, 0, 'L');
            $pdf->Cell(0, 8, $user->email, 1, 1, 'L');

            $pdf->Cell(40, 8, 'Role', 1, 0, 'L');
            $pdf->Cell(0, 8, ucfirst($user->role), 1, 1,'L');

            $pdf->Cell(40, 8, 'Status', 1, 0,'L');
            $pdf->Cell(0, 8,$user->status ,1 ,1,'L');
            
            if ($i < $totaladmin){
                $pdf->AddPage();
            } 
            
        }
    }

}else if($_GET['users'] == 'all_instructor'){
    $users = User::all();
    $i = 0;
    $totalinst = 0;
    foreach ($users as $user) {
            if ($user->role == 'instructor'){
                 $totalinst++;
            }
        }
    foreach ($users as $user) {
        if ($user->role == 'instructor'){
            $i++;
            $pdf->SetFont('Arial', 'B', 13);
            $pdf->Cell(20, 5, 'Name: ', 0, 0,'L');
            $pdf->SetFont('Arial', '', 13);
            $pdf->cell(0, 5, $user->name, 0, 1,'L');
            $pdf->Ln(2);

            $pdf->SetFont('Arial', 'B', 13);
            $pdf->Cell(20, 5, 'Email:', 0, 0,'L');
            $pdf->SetFont('Arial', '', 13);
            $pdf->cell(0, 5, $user->email, 0, 1,'L');
            $pdf->Ln(2);

            $pdf->SetFont('Arial', 'B', 13);
            $pdf->Cell(20, 5, 'Role:', 0, 0,'L');
            $pdf->SetFont('Arial', '', 13);
            $pdf->cell(0, 5, $user->role, 0, 1,'L');
            $pdf->Ln(2);

            $pdf->SetFont('Arial', 'B', 13);
            $pdf->Cell(20, 5, 'Status:', 0, 0,'L');
            $pdf->SetFont('Arial', '', 13);
            $pdf->cell(0, 5, $user->status, 0, 1,'L');

            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 13);
            $pdf->Cell(0, 10, 'Subject List', 0, 1, 'C');
            $pdf->SetFont('Arial', 'B', 12);
            
            $pdf->SetFillColor(200, 220, 255);
            $pdf->Cell(35, 10, 'Subject Code', 1, 0,'C', true);
            $pdf->Cell(100, 10, 'Subject Name', 1, 0,'C', true);
            $pdf->Cell(30, 10, 'Year Level', 1, 0,'C', true);
            $pdf->Cell(0, 10, 'Semester', 1, 0,'C', true);
            $pdf->Ln(10);

            $subs = $user->subjects();
            $pdf->SetFont('Arial', '', 11);

            if ($subs){
                foreach($user->subjects() as $subject){
                    $pdf->Cell(35, 10, $subject->code, 1, 0,'C');
                    $pdf->Cell(100, 10, $subject->name, 1, 0,'C');
                    $pdf->Cell(30, 10, $subject->year_level, 1, 0,'C');
                    $pdf->Cell(0, 10, $subject->semester, 1, 0,'C');
                    $pdf->Ln(10);
                }
            }else{
                $pdf->Cell(0, 10, 'No Subject Data found', 0, 1, 'C');
            }
            if ($i < $totalinst){
               $pdf->AddPage();
            }
            
             
        }
        
    }

}else{
    $pdf->Ln(10);
 
    $pdf->SetTextColor(255, 0, 0);
    $pdf->SetFont('Arial', 'B', 48);

    $pdf->Cell(0, 10, 'No User Data found', 0, 1, 'C');
}
$pdf->Output('I', 'User_report.pdf');
?>