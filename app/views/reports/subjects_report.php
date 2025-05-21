<?php
require_once '../../../config/Database.php';
$db = new Database();
$conn = $db->getConnection();
require_once '../../models/Subject.php';
require_once '../../models/Course.php';

require '../../../plugins/fpdf/fpdf.php';
?>

<?php 

Subject::setConnection($conn);
if (empty($_GET['subject'])) {
    $subjects = Subject::all();
} else {
    $subjects = Subject::findByCatalogNo($_GET['subject']);
}


$pdf = new FPDF('P', 'mm', 'Legal');
$pdf->AddPage();


$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 10, 'Subject Student List', 0, 1, 'C');
$pdf->Ln(7);

if ($subjects) {
    $i = 0;
    $totalsubs = 0;
    foreach ($subjects as $subject) {
        $totalsubs++;
    }
    foreach ($subjects as $subject) {
        $i++;
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetFillColor(200, 220, 255);
        $pdf->Cell(30, 5, 'Catalog log: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 5, $subject->catalog_no, 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetFillColor(200, 220, 255);
        $pdf->Cell(30, 5, 'Subject: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 5, "$subject->code - $subject->name", 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(30, 5, 'Course:', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 5, $subject->course()->name, 0, 1, 'L');

        $year_level = 'N/A';    
        if($subject->year_level == 1){
            $year_level = '1st Year';
        }else if($subject->year_level == 2){
            $year_level = '2st Year';
        }else if($subject->year_level == 3){
            $year_level = '3st Year';
        }else if($subject->year_level == 4){
            $year_level = '4st Year';
        }
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(30, 5, 'Year Level:', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 5, $year_level, 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(30, 5, 'Instructor:', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 5, ucwords($subject->instructor()->name), 0, 1, 'L');

        $totalstudents = 0;
        if($subject->students() != NULL ){
            $totalstudents = count($subject->students());
        }
        $pdf->SetFont('Arial', 'B', 11);    
        $pdf->Cell(30, 5, 'Total Student:', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 5, $totalstudents, 0, 1, 'L');

        $pdf->Ln(7);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Enrolled Students', 0, 1, 'C');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetFillColor(200, 220, 255);
        $pdf->Cell(30, 10, 'Student ID', 1, 0, 'C', true);
        $pdf->Cell(50, 10, 'Name', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'Year Level', 1, 0, 'C', true);
        $pdf->Cell(25, 10, 'Grade', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'Remarks', 1, 0, 'C', true);
        $pdf->Cell(0, 10, 'Status', 1, 1, 'C', true);

        


        $pdf->SetFont('Arial', '', 11);
        $students = $subject->students();

        if($students == NULL){
            $pdf->Cell(0, 10, 'No Student Found', 0, 1, 'C');
        }else{

            foreach ($students as $student) {
                $grade = 'N/A';
                $remarks = 'Pending';
                $id = 'N/A';
                $grades = $student->grades(); 
                if($grades){
                    foreach($grades as $g){
                        if($g->subject_id == $subject->id && $g->student_id == $student->id){
                            $grade = $g->grade;
                            $remarks = $g->remarks;
                            $id = $g->id;
                            break;
                        }
                    }
                }


                $year_level = 'N/A';    
                 if($student->year_level == 1){
                        $year_level = '1st Year';
                    }else if($student->year_level == 2){
                        $year_level = '2st Year';
                    }else if($student->year_level == 3){
                        $year_level = '3st Year';
                    }else if($student->year_level == 4){
                        $year_level = '4st Year';
                    }
                
                $pdf->Cell(30, 10, $student->id, 1, 0, 'C');
                $pdf->Cell(50, 10, $student->name, 1, 0, 'C');
                $pdf->Cell(30, 10, $year_level, 1, 0, 'C');
                $pdf->Cell(25, 10, $grade, 1, 0, 'C');
                $pdf->Cell(30, 10, $remarks, 1, 0, 'C');
                $pdf->Cell(0, 10, $student->status, 1, 1, 'C');

            }

        }
        if ($i < $totalsubs){
            $pdf->AddPage();
        }
    }
    // }else if (!isset($_GET['subject']) || $_GET['subject'] == 'all') {
    //     $subjects = Subject::all();
    //     $i = 0;
    //     foreach ($subjects as $subject) {
    //     $i++;
    //     $pdf->SetFont('Arial', 'B', 13);
    //     $pdf->SetFillColor(200, 220, 255);

    //     $pdf->SetFont('Arial', 'B', 12);
    //     $pdf->Cell(0, 10, "$subject->code - $subject->name", 0, 1, 'C');
    //     $pdf->Ln(7);

    //     $pdf->SetFont('Arial', 'B', 11);
    //     $pdf->SetFillColor(200, 220, 255);
    //     $pdf->Cell(40, 10, 'Student ID', 1, 0, 'C');
    //     $pdf->Cell(80, 10, 'Name', 1, 0, 'C');
    //     $pdf->Cell(40, 10, 'Gender', 1, 0, 'C');
    //     $pdf->Cell(0, 10, 'Year Level', 1, 1, 'C');
    //     $pdf->SetFont('Arial', '', 11);
        
    //     foreach ($subject->student() as $student) {
    //         $pdf->Cell(40, 10, $student->student_id, 1, 0, 'C');
    //         $pdf->Cell(80, 10, $student->name, 1, 0, 'C');
    //         $pdf->Cell(40, 10, $student->gender, 1, 0, 'C');
    //         $pdf->Cell(0, 10, $student->year_level, 1, 1, 'C');
    //     }
    //     if ($i < count($subjects)){
    //         $pdf->AddPage();
    //     }
        
    // }
} else {

    $pdf->Ln(30);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->SetFont('Arial', 'B', 36);
    $pdf->Cell(0, 20, 'No Subject Data Found', 0, 1, 'C');
}

$pdf->Output('I', 'subject_report.pdf');
?>