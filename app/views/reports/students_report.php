<?php
require_once '../../../config/Database.php';
$db = new Database();
$conn = $db->getConnection();
require_once '../../models/Student.php';
require_once '../../models/Subject.php';
require_once '../../models/Grade.php';
require '../../../plugins/fpdf/fpdf.php';
?>

<?php 

Student::setConnection($conn);
Subject::setConnection($conn);
Grade::setConnection($conn);



$pdf = new FPDF('L', 'mm', 'Legal');
$pdf->AddPage();

if (isset($_GET['student_id'])) {
    $_GET['student_id'] = strtoupper($_GET['student_id']);
}

// if (isset($_GET['student_id']) && $_GET['student_id'] != 'all') {
//     $students = Student::findByStudentId($_GET['student_id']);
// } else if (!isset($_GET['student_id']) || $_GET['student_id'] == 'all') {
//     $students = Student::all();
// }

if(empty($_GET['student_id'])){
    $students = Student::all();
}else{
    $students = Student::findByStudentId($_GET['student_id']);
}

$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 10, 'Student List', 0, 1, 'C');
$pdf->Ln(7);
$i = 0;
if ($students) {
        foreach ($students as $student) {
        $i++;
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(30, 7, 'Student ID: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 13);
        $pdf->Cell(0, 7, $student->student_id, 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(30, 7, 'Name: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 13);
        $pdf->Cell(0, 7, $student->name, 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(30, 7, 'Gender:', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 13);
        $pdf->Cell(0, 7, $student->gender, 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(30, 7, 'Birthdate:', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 13);
        $pdf->Cell(0, 7, date('F j, Y', strtotime($student->birthdate)), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(30, 7, 'Course:', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 13);
        $pdf->Cell(0, 7, $student->course()->name, 0, 1, 'L');

        $year_level;
        if ($student->year_level == 1) {
            $year_level = '1st Year';
        } else if ($student->year_level == 2) {
            $year_level = '2nd Year';
        } else if ($student->year_level == 3) {
            $year_level = '3rd Year';
        } else if ($student->year_level == 4) {
            $year_level = '4th Year';
        } else if ($student->year_level == 5) {
            $year_level = '5th Year';
        }else{
            $year_level = 'N/A';
        }

        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(30, 7, 'Year Level:', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 13);
        $pdf->Cell( 0, 7, $year_level, 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(30, 7, 'Status:', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 13);
        $pdf->Cell(0, 7, $student->status, 0, 1, 'L');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(0, 10, 'Enrolled Subjects', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetFillColor(200, 220, 255); 
        $pdf->Cell(40, 10, 'Subject Code', 1, 0, 'C', true);
        $pdf->Cell(80, 10, 'Subject Name', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'Day', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'Time', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'Room', 1, 0, 'C', true);
        $pdf->Cell(25, 10, 'Semester', 1, 0,'C', true);
        $pdf->Cell(35, 10, 'Instructor', 1, 0, 'C', true);
        $pdf->Cell(20, 10, 'Grade', 1, 0, 'C', true);
        $pdf->Cell(0, 10, 'Remarks', 1, 1, 'C', true);
        $pdf->SetFont('Arial', '', 11);
        $subs = $student->subjects();
        if ($subs){
            foreach($student->subjects() as $subject){
                $pdf->Cell(40, 10, $subject->code, 1, 0, 'C');
                $pdf->Cell(80, 10, $subject->name, 1, 0, 'C');
                $pdf->Cell(30, 10, $subject->day, 1, 0, 'C');
                $pdf->Cell(40, 10, $subject->time, 1, 0, 'C');
                $pdf->Cell(30, 10, $subject->room, 1, 0, 'C');
                $pdf->Cell(25, 10, $subject->semester, 1, 0, 'C');
                $pdf->Cell(35, 10, $subject->instructor()->name, 1, 0,'C');
                $grade = 'N/A';
                $remarks = 'Pending';
                $grades = $student->grades();
                if ($grades){
                    foreach($grades as $g){
                        if ($g->subject_id == $subject->id && $g->student_id == $student->id) {
                            $grade = $g->grade;
                            $remarks = $g->remarks;
                            break;
                        }
                    }
                }
                $pdf->Cell(20, 10, $grade, 1, 0,'C');
                $pdf->Cell(0, 10, $remarks, 1, 1,'C');
                
                
            }
        }else{
            $pdf->Cell(0, 10, 'No subjects enrolled', 1, 1, 'C');
            $pdf->Ln(10);
        } 
        if ($i < count($students)){
            $pdf->AddPage();
        }
    }
           
} else {

    $pdf->Ln(30);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->SetFont('Arial', 'B', 36);
    $pdf->Cell(0, 20, 'No Student Data Found', 0, 1, 'C');
}

$pdf->Output('I', 'course_report.pdf');
?>