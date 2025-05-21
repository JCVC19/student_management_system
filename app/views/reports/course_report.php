<?php
require_once '../../../config/Database.php';
$db = new Database();
$conn = $db->getConnection();
require_once '../../models/Course.php';
require '../../../plugins/fpdf/fpdf.php';
?>

<?php 

Course::setConnection($conn);

// $courses = Course::find($_GET['course_id']);

if (empty($_GET['course_id'])) {
    $courses = Course::all();
} else {
    $courses = [Course::find($_GET['course_id'])];
}

$pdf = new FPDF('P', 'mm', 'Legal');
$pdf->AddPage();


$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 10, 'Course Student List', 0, 1, 'C');
$pdf->Ln(7);
if ($courses) {
        $i = 0;
        foreach ($courses as $course) {
        $i++;
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->SetFillColor(200, 220, 255);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "$course->code - $course->name", 0, 1, 'C');
        $pdf->Ln(7);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetFillColor(200, 220, 255);
        $pdf->Cell(40, 10, 'Student ID', 1, 0, 'C', true);
        $pdf->Cell(80, 10, 'Name', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'Gender', 1, 0, 'C', true);
        $pdf->Cell(0, 10, 'Year Level', 1, 1, 'C', true);
        $pdf->SetFont('Arial', '', 11);
        $students = $course->student();
        if ($course->student() == null) {
            $pdf->SetTextColor(255, 0, 0);
            $pdf->Cell(0, 10, 'No Student Data Found', 1, 1, 'C');
            $pdf->SetTextColor(0, 0, 0);
        }else{
        
            foreach ($students as $student) {
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
                } else {
                    $year_level = 'N/A';
                }

                $pdf->Cell(40, 10, $student->student_id, 1, 0, 'C');
                $pdf->Cell(80, 10, $student->name, 1, 0, 'C');
                $pdf->Cell(40, 10, $student->gender, 1, 0, 'C');
                $pdf->Cell(0, 10, $year_level, 1, 1, 'C');
            }
        }
        if ($i < count($courses)){
            $pdf->AddPage();
        }
        
    }
} else {

    $pdf->Ln(30);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->SetFont('Arial', 'B', 36);
    $pdf->Cell(0, 20, 'No Course Data Found', 0, 1, 'C');
}

$pdf->Output('I', 'course_report.pdf');
?>