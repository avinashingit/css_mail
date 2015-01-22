
<?php
require("fpdf.php");
require("check.php");
/*require('table_h.php');

class PDF extends PDF_MySQL_Table
{
function Header()
{
    //Title
    $this->SetFont('Arial','',18);
    $this->Cell(0,6,'World populations',0,1,'C');
    $this->Ln(10);
    //Ensure table header is output
    parent::Header();
}
}*/

$pdf = new FPDF('L');

$pdf->AddPage();

$pdf->SetFont('Arial');


$con=mysqli_connect("localhost","root","rootpw","faculty_recruitment");

	//$usrid1 = $_GET['usrid'];
	$usrid1 = $_SESSION['userid'];

	$retrieve = "SELECT * FROM form3 where userid = $usrid1";

	$result = mysqli_query($con,$retrieve);


	while($row = mysqli_fetch_array($result))
  	{
		$undergrad = $row['undergrad'];
		$postgrad = $row['postgrad'];
		$doctoral = $row['doctoral'];
		$research_deg = $row['research_deg'];
		$courses_undergrad = $row['courses_undergrad'];
		$courses_postgrad = $row['courses_postgrad'];
		$wrkshps = $row['wrkshps'];
		$patents = $row['patents'];
		$experience = $row['experience'];
		$memberships = $row['memberships'];
		$awards = $row['awards'];
  	}



$retrieve = "SELECT * FROM work_experience where userid = $usrid1";

	$result = mysqli_query($con,$retrieve);

	$num_rows1 = mysqli_num_rows($result);

	while($row = mysqli_fetch_array($result))
  	{
		$sno[] = $row['sno'];
		$name[] = $row['name'];
		$designation[] = $row['designation'];
		$doj[] = $row['doj'];
		$dol[] = $row['dol'];
		$duration[] = $row['duration'];
		$scale[] = $row['scale'];

  	}



$pdf->SetFont('Arial','B');
$head = '16. Work Experience (in reverse chronological order) :';

$pdf->Cell(strlen($head),10,$head);
$pdf->Ln();
$pdf->SetFont('Arial');
$head = 'Sr.No   ';
$sno_len = 2*strlen($head);
$pdf->Cell($sno_len,10,$head,1,0);
$head = 'Name of the Employer    ';
$name_len = 2*strlen($head);
$pdf->Cell($name_len,10,$head,1,0);
$head = 'Designation    ';
$desig_len = 2*strlen($head);
$pdf->Cell($desig_len,10,$head,1,0);
$head = 'Date of Joining    ';
$doj_len = 2*strlen($head);
$pdf->Cell($doj_len,10,$head,1,0);
$head = 'Date of Leaving    ';
$dol_len = 2*strlen($head);
$pdf->Cell($dol_len,10,$head,1,0);
$head = 'Duration    ';
$dur_len = 2*strlen($head);
$pdf->Cell($dur_len,10,$head,1,0);
$head = 'Scale + Grade Pay/Total Pay    ';
$scale_len = 2*strlen($head);
$pdf->Cell($scale_len,10,$head,1,1);

for($i=0 ; $i<$num_rows1; $i++)
{

$pdf->Cell($sno_len,10,$sno[$i],1,0);
$pdf->Cell($name_len,10,$name[$i],1,0);
$pdf->Cell($desig_len,10,$designation[$i],1,0);
$pdf->Cell($doj_len,10,$doj[$i],1,0);
$pdf->Cell($dol_len,10,$dol[$i],1,0);
$pdf->Cell($dur_len,10,$duration[$i],1,0);
$pdf->Cell($scale_len,10,$scale[$i],1,1);

}



$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B');
$head = '17. Number of Student Projects Guided (mention only viva completed/graduated student details) : ';

$pdf->Cell(strlen($head),10,$head);
$pdf->Ln();
$pdf->SetFont('Arial');
$head = 'Undergraduate (B.Tech/B.E/B.Sc) : ';


$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->Cell(10,10,$undergrad);
$pdf->Ln();

$head = 'Reseach Degree (MS/M.Phil) : ';

$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->Cell(10,10,$research_deg);
$pdf->Ln();

$head = 'Postgraduate (M.Tech/M.E/M.Sc) : ';

$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->Cell(10,10,$postgrad);
$pdf->Ln();

$head = 'Doctoral(Ph.D) : ';

$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->Cell(10,10,$doctoral);
$pdf->Ln();
$pdf->Ln();


$retrieve = "SELECT * FROM spons_principal where userid = $usrid1";

	$result = mysqli_query($con,$retrieve);

	$num_rows2 = mysqli_num_rows($result);

	while($row = mysqli_fetch_array($result))
  	{
		$sno[] = $row['sno'];
		$title[] = $row['title'];
		$agency[] = $row['agency'];
		$value[] = $row['value'];
		$status[] = $row['status'];
  	}



$pdf->SetFont('Arial','B');
$head = '18. Sponsored Projects / Industrial Consultancy handled :';

$pdf->Cell(strlen($head),10,$head);
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial');

$head = '(a) As Principal Investigator  :';

$pdf->Cell(strlen($head),10,$head);
$pdf->Ln();

$head = 'Sr.No   ';
$sno_len = 2*strlen($head);
$pdf->Cell($sno_len,10,$head,1,0);
$head = 'Title    ';
$name_len = 2*strlen($head);
$pdf->Cell($name_len,10,$head,1,0);
$head = 'Sponsoring Agency    ';
$desig_len = 2*strlen($head);
$pdf->Cell($desig_len,10,$head,1,0);
$head = 'Value (in Lakhs)    ';
$doj_len = 2*strlen($head);
$pdf->Cell($doj_len,10,$head,1,0);
$head = 'Status    ';
$dol_len = 2*strlen($head);
$pdf->Cell($dol_len,10,$head,1,1);


for($i=0 ; $i<$num_rows2; $i++)
{

$pdf->Cell($sno_len,10,$sno[$i],1,0);
$pdf->Cell($name_len,10,$title[$i],1,0);
$pdf->Cell($desig_len,10,$agency[$i],1,0);
$pdf->Cell($doj_len,10,$value[$i],1,0);
$pdf->Cell($dol_len,10,$status[$i],1,1);

}


$retrieve = "SELECT * FROM spons_co_investigator where userid = $usrid1";

	$result = mysqli_query($con,$retrieve);

	$num_rows3 = mysqli_num_rows($result);

	while($row = mysqli_fetch_array($result))
  	{
		$sno[] = $row['sno'];
		$title[] = $row['title'];
		$agency[] = $row['agency'];
		$value[] = $row['value'];
		$status[] = $row['status'];
  	}


$pdf->Ln();
$pdf->Ln();


$head = '(b) As Co Investigator  :';

$pdf->Cell(strlen($head),10,$head);
$pdf->Ln();


$head = 'Sr.No   ';
$sno_len = 2*strlen($head);
$pdf->Cell($sno_len,10,$head,1,0);
$head = 'Title    ';
$name_len = 2*strlen($head);
$pdf->Cell($name_len,10,$head,1,0);
$head = 'Sponsoring Agency    ';
$desig_len = 2*strlen($head);
$pdf->Cell($desig_len,10,$head,1,0);
$head = 'Value (in Lakhs)    ';
$doj_len = 2*strlen($head);
$pdf->Cell($doj_len,10,$head,1,0);
$head = 'Status    ';
$dol_len = 2*strlen($head);
$pdf->Cell($dol_len,10,$head,1,1);


for($i=0 ; $i<$num_rows3; $i++)
{

$pdf->Cell($sno_len,10,$sno[$i],1,0);
$pdf->Cell($name_len,10,$title[$i],1,0);
$pdf->Cell($desig_len,10,$agency[$i],1,0);
$pdf->Cell($doj_len,10,$value[$i],1,0);
$pdf->Cell($dol_len,10,$status[$i],1,1);

}

$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = '19. Courses Handled :';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial');
$head = 'Undergraduate Level :';
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->MultiCell(0,10,$courses_undergrad);
$pdf->Ln();
$pdf->Ln();


$head = 'Postgraduate Level :';
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->MultiCell(0,10,$courses_postgrad);
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = '20. Short courses / Workshops /Seminars organized :';
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->MultiCell(0,10,$wrkshps);
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = '21. Details of Patents :';
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->MultiCell(0,10,$patents);
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = '22. Administrative Experience :';
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->MultiCell(0,10,$experience);
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = '23. Membership of Professional Bodies :';
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->MultiCell(0,10,$memberships);
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = '24. Honors and Awards :';
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->MultiCell(0,10,$awards);
$pdf->Ln();
$pdf->Ln();


$pdf->Output("test.pdf",F);

?>


