
<?php
error_reporting(E_NOTICE ^ E_DEPRECATED ^ E_NOTICE ^ E_WARNING);
require("check.php");
require("fpdf/fpdf.php");
/*class PDF extends FPDF
{
function Header()
{
    // Select Arial bold 15
	$this->Image('Medium.png',5,5,30,30);
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(110);
	//$this->Ln(2);
    // Framed title
    $this->Cell(30,10,'Indian Institue of Information Technology Design & Manufacturing',0,0,'C');
    // Line break
    $this->Ln(10);

}
}*/
///var/www/fpdf/

//echo " Hello";

$pdf = new FPDF( );

$pdf->AddPage('L');

$pdf->SetFont('Arial');


$con=mysqli_connect("localhost","root","root","faculty_recruitment");

//echo " Hello";

//$usrid1= '16';

$usrid1=$_SESSION['userid'];

//$pdf->Cell(10,10,"kjnfjnfj".$_SESSION." njbhj");

//$usrid1 = $_GET['usrid'];

//**************FORM-1**********
	$retrieve = "SELECT * FROM form1 where userid = $usrid1";

	$result = mysqli_query($con,$retrieve);


	while($row = mysqli_fetch_array($result))
  	{
		$post = $row['post'];
		$area = $row['area'];
		$researcharea = $row['researcharea'];
		$adno = $row['adno'];
		$name = $row['name'];
		$dob = $row['dob'];
		$nationality = $row['nationality'];
		$gender = $row['gender'];
		$category = $row['category'];
		$categorycerti = $row['categorycerti'];

		if(strlen($categorycerti) == 0)
			$categorycerti = "No";
		else
			$categorycerti = "Yes";



		$address = $row['address'];
		$permaddress = $row['permaddress'];
		$fathername = $row['fathername'];
		$designation = $row['designation'];
		$photo = $row['photo'];
		$add_mobile = $row['addr_mobile'];
		$addr_email = $row['addr_email'];
		$perm_mobile = $row['perm_mobile'];
		$perm_email = $row['perm_email'];
  	}
$pdf->Ln(5);
//$pdf->Ln();
//$pdf->Ln();


$pdf->Image('Medium.png',10,15,27);



$head1 = "Indian Institute of Information Technology, Design & Manufacturing";
$head2 = "IIITD&M Kancheepuram, Chennai-127";
$head3 = "(An Autonomous Institute under MHRD,Govt. of India)";
$head4 = "Application for Faculty Position";

$pdf->SetFont('Arial','B',14);



$pdf->Cell(50);
$pdf->Cell(2*strlen($head1),8,$head1);
$pdf->Ln();


$pdf->Cell(90);
$pdf->Cell(2*strlen($head2),8,$head2);
$pdf->Ln();


$pdf->Cell(70);
$pdf->Cell(2*strlen($head3),8,$head3);
$pdf->Ln();

$pdf->Line(10,52,280,52);

$pdf->Cell(90);
$pdf->Cell(2*strlen($head4),15,$head4);
$pdf->Ln();

$pdf->SetFont('Arial','B',12);


/*$head = 'Application Number :                      ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->SetFont('Arial');
$pdf->Cell(10,10,$usrid1);
$pdf->Ln();
$pdf->Ln();*/




$pdf->SetFont('Arial','B');
$head = '1. Post Applied :                       ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->SetFont('Arial');
$pdf->Cell(10,10,$post);

$pdf->Image($photo,260,57,30);

//$pdf->Rect(230,15,35,45);

//$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = '2. Broad Area :                         ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->SetFont('Arial');
$pdf->Cell(10,10,$area);
//$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = '3. Current Areas of Research :          ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->SetFont('Arial');
$pdf->Cell(10,10,$researcharea);
$pdf->Ln();
//$pdf->Ln();



$retrieve = "SELECT * FROM advt_number";
$result = mysqli_query($con,$retrieve);


while($row = mysqli_fetch_array($result))
  	{
		$advt_no = $row['advt_no'];

  	}

$pdf->SetFont('Arial','B');
$head = '4. Advertisement No :                   ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->SetFont('Arial');

$pdf->Cell(2*strlen($advt_no),10,$advt_no,0,0); 
//$pdf->Cell(10,10,$adno);
$pdf->Ln();
//$pdf->Ln();


$pdf->SetFont('Arial','B');
$head = '5. Full Name :                          ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->SetFont('Arial');
$pdf->Cell(10,10,$name);
$pdf->Ln();
//$pdf->Ln();


$pdf->SetFont('Arial','B');
$head = '6. Date of Birth :                      ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->SetFont('Arial');
$pdf->Cell(10,10,$dob);
//$pdf->Ln();
$pdf->Ln();


$pdf->SetFont('Arial','B');
$head = '7. Nationality :                        ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->SetFont('Arial');
$pdf->Cell(10,10,$nationality);
$pdf->Ln();
//$pdf->Ln();


$pdf->SetFont('Arial','B');
$head = '8. Sex:                                 ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->SetFont('Arial');
$pdf->Cell(10,10,$gender);
$pdf->Ln();
//$pdf->Ln();


$pdf->SetFont('Arial','B');
$head = '9. Category :                           ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->SetFont('Arial');
$pdf->Cell(10,10,$category);
$pdf->Ln();
$pdf->SetFont('Arial','B');
$head = 'Certificate Attached :                  ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->SetFont('Arial');
$pdf->Cell(10,10,$categorycerti);
$pdf->Ln();
//$pdf->Ln();


$pdf->SetFont('Arial','B');
$head = '10. Address of Communication :';
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->Cell(10,10,$address);
$pdf->Ln();
$head = 'Phone :  ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->Cell(10,10,$add_mobile);
$pdf->Ln();
$head = 'Email :   ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->Cell(10,10,$addr_email);
$pdf->Ln();
//$pdf->Ln();


$pdf->SetFont('Arial','B');
$head = '11. Permanent Home Address :';
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->Cell(10,10,$address);
$pdf->Ln();
$head = 'Phone :  ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->Cell(10,10,$perm_mobile);
$pdf->Ln();
$head = 'Email :   ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->Cell(10,10,$perm_email);
$pdf->Ln();
//$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = '12. Name of Father/Husband :                        ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->SetFont('Arial');
$pdf->Cell(10,10,$fathername);
$pdf->Ln();
//$pdf->Ln();


$pdf->SetFont('Arial','B');
$head = '13. Present Position/Designation & Pay Drawn :      ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->SetFont('Arial');
$pdf->Cell(10,10,$designation);
$pdf->Ln();
//$pdf->Ln();


$retrieve = "SELECT * FROM educational_qualifications where userid = $usrid1";

	$result = mysqli_query($con,$retrieve);

	$num_rows2 = mysqli_num_rows($result);

	while($row = mysqli_fetch_array($result))
  	{
		$sno1[] = $row['sno'];
		$degree[] = $row['degree'];
		$insti[] = $row['insti'];
		$yoe[] = $row['yoe'];
		$yol[] = $row['yol'];
		$percent[] = $row['percent'];
  	}

$pdf->SetFont('Arial','B');
$head = '14. Educational Qualification :';
$pdf->Cell(2*strlen($head),10,$head);
$pdf->Ln();
$pdf->SetFont('Arial');

$head = 'Sr.No   ';
$sno_len = 2*strlen($head);
$pdf->Cell($sno_len,10,$head,1,0);
$head = '    Degree      ';
$name_len = 2*strlen($head);
$pdf->Cell($name_len,10,$head,1,0);
$head = '     Institution / University    ';
$desig_len = 2*strlen($head);
$pdf->Cell($desig_len,10,$head,1,0);
$head = 'Year of Entry    ';
$doj_len = 2*strlen($head);
$pdf->Cell($doj_len,10,$head,1,0);
$head = 'Year of Leaving    ';
$dol_len = 2*strlen($head);
$pdf->Cell($dol_len,10,$head,1,0);
$head = 'Percentage & Class    ';
$per_len = 2*strlen($head);
$pdf->Cell($per_len,10,$head,1,1);



for($i=0 ; $i<$num_rows2; $i++)
{

$pdf->Cell($sno_len,10,$sno1[$i],1,0);





if(strlen($degree[$i]) > ($name_len/2-4))
{
$degree[$i] = substr($degree[$i],0,$name_len/2-4).'...';
}

$pdf->Cell($name_len,10,$degree[$i],1,0);







if(strlen($insti[$i]) > ($desig_len/2-8))
{
$insti[$i] = substr($insti[$i],0,$desig_len/2-8).'...';
}
$pdf->Cell($desig_len,10,$insti[$i],1,0);





$pdf->Cell($doj_len,10,$yoe[$i],1,0);
$pdf->Cell($dol_len,10,$yol[$i],1,0);
$pdf->Cell($per_len,10,$percent[$i],1,1);

}
//***********END OF FORM1***********

//******FORM2********

	$retrieve = "SELECT * FROM form2 where userid = $usrid1";

	$result = mysqli_query($con,$retrieve);


	while($row = mysqli_fetch_array($result))
  	{
		$intjournals3 = $row['intjournals3'];
		$intjournalsoverall = $row['intjournalsoverall'];
		$natjournals3 = $row['natjournals3'];
		$natjournalsoverall = $row['natjournalsoverall'];
		$intconf3 = $row['intconf3'];
		$intconfoverall = $row['intconfoverall'];
		$natconf3 = $row['natconf3'];
		$natconfoverall = $row['natconfoverall'];
		$publications = $row['publications'];
		$paper1 = $row['paper1'];
		$paper2 = $row['paper2'];
		$paper3 = $row['paper3'];		
  	}


$pdf->SetFont('Arial','B');
$head = '15. Number of Research Publications: ';
$pdf->Cell(strlen($head),10,$head);
$pdf->Ln();
$pdf->SetFont('Arial');


$head = '     Publication Category     ';
$sz1 = 2*strlen($head);
$pdf->Cell(2*strlen($head),10,$head,1,0);

$head = ' Last 3 years  ';
$sz2 = 2*strlen($head);
$pdf->Cell(2*strlen($head),10,$head,1,0);

$head = '  Overall  ';
$sz3 = 2*strlen($head);
$pdf->Cell(2*strlen($head),10,$head,1,0);
$pdf->Ln();

$head = 'International Journal ';
$pdf->Cell($sz1,10,$head,1,0);

$pdf->Cell($sz2,10,$intjournals3,1);

$pdf->Cell($sz3,10,$intjournalsoverall,1);
$pdf->Ln();

$head = 'National Journal';
$pdf->Cell($sz1,10,$head,1,0);

$pdf->Cell($sz2,10,$natjournals3,1);

$pdf->Cell($sz3,10,$natjournalsoverall,1);
$pdf->Ln();

$head = 'International Conference';
$pdf->Cell($sz1,10,$head,1,0);

$pdf->Cell($sz2,10,$intconf3,1);

$pdf->Cell($sz3,10,$intconfoverall,1);
$pdf->Ln();

$head = 'National Conference   ';
$pdf->Cell($sz1,10,$head,1,0);

$pdf->Cell($sz2,10,$natconf3,1);

$pdf->Cell($sz3,10,$natconfoverall,1);
$pdf->Ln();
//$pdf->Ln();

/*$pdf->SetFont('Arial','B');
$head = 'Appendix :'; 
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->MultiCell(0,10,$publications);
$pdf->Ln();*/
$pdf->Ln();
$pdf->SetFont('Arial','B');
$head = 'Journal details (Appendix)';
$pdf->Cell(2*strlen($head),10,$head);
$pdf->Ln();
$pdf->SetFont('Arial');

$head = 'Sr.No   ';
$sno_len = 2*strlen($head);
$pdf->Cell($sno_len,10,$head,1,0);
$head = '    Name of Author      ';
$authorname_len = 2*strlen($head);
$pdf->Cell($authorname_len,10,$head,1,0);
$head = '     Title    ';
$title_len = 2*strlen($head);
$pdf->Cell($title_len,10,$head,1,0);
$head = '	Journal/conference name    ';
$journalname_len = 2*strlen($head);
$pdf->Cell($journalname_len,10,$head,1,0);
$head = '	Year    ';
$year_len = 2*strlen($head);
$pdf->Cell($year_len,10,$head,1,0);
$head = '	volume    ';
$vol_len = 2*strlen($head);
$pdf->Cell($vol_len,10,$head,1,0);
$head = '	Page number    ';
$pageno_len = 2*strlen($head);
$pdf->Cell($pageno_len,10,$head,1,0);
$pdf->Ln();

$publication_dollar= explode('$',$publications);
$n=sizeof($publication_dollar);
for($i=1;$i<$n;$i++)
{
	$publication_split=explode('^', $publication_dollar[$i-1]);
	$pdf->Cell($sno_len,10,$i,1,0);
	$pdf->Cell($authorname_len,10,$publication_split[0],1,0);
	$pdf->Cell($title_len,10,$publication_split[1],1,0);
	$pdf->Cell($journalname_len,10,$publication_split[2],1,0);
	$pdf->Cell($year_len,10,$publication_split[3],1,0);
	$pdf->Cell($vol_len,10,$publication_split[4],1,0);
	$pdf->Cell($pageno_len,10,$publication_split[5],1,0);
	$pdf->Ln();
}

//*****END Of FORM2*****/

//****FORM3****//

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

	$num_rows1 = mysqli_num_rows($result);/*
if($result==0)
$pdf->Cell(10,10,"jnjnddjjdsnfc",0,0);
else
$pdf->Cell(10,10,'abc'.$num_rows1,0,0);*/

unset($sno);//[] = $row['sno'];
		unset($name);//[] = $row['name'];
		unset($designation);//[] = $row['designation'];
		unset($doj);//[] = $row['doj'];
		unset($dol);//[] = $row['dol'];
		unset($duration);//[] = $row['duration'];
		unset($scale);

	while($row = mysqli_fetch_array($result))
  	{
		$sno[] = $row['sno'];
		$name[] = $row['name'];
		$designation[] = $row['designation'];
		$doj[] = $row['doj'];
		$duration[] = $row['duration'];
		$scale[] = $row['scale'];

  	}
		$dol[] = $row['dol'];



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


if(strlen($name[$i]) > ($name_len/2-4))
{
$name[$i] = substr($name[$i],0,$name_len/2-4).'...';
}

$pdf->Cell($name_len,10,$name[$i],1,0);




if(strlen($designation[$i]) > ($desig_len/2-8))
{
$designation[$i] = substr($designation[$i],0,$desig_len/2-8).'...';
}
$pdf->Cell($desig_len,10,$designation[$i],1,0);





$pdf->Cell($doj_len,10,$doj[$i],1,0);
$pdf->Cell($dol_len,10,$dol[$i],1,0);
$pdf->Cell($dur_len,10,$duration[$i],1,0);
$pdf->Cell($scale_len,10,$scale[$i],1,1);

}



$pdf->Ln();
//$pdf->Ln();
//$pdf->Ln();
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
//$pdf->Ln();


$retrieve = "SELECT * FROM spons_principal where userid = $usrid1";

	$result = mysqli_query($con,$retrieve);

	$num_rows2 = mysqli_num_rows($result);

	while($row = mysqli_fetch_array($result))
  	{
		$sno3[] = $row['sno'];
		$title1[] = $row['title'];
		$agency[] = $row['agency'];
		$value[] = $row['value'];
		$status[] = $row['status'];
  	}



$pdf->SetFont('Arial','B');
$head = '18. Sponsored Projects / Industrial Consultancy handled :';

$pdf->Cell(strlen($head),10,$head);
$pdf->Ln();
//$pdf->Ln();

$pdf->SetFont('Arial');

$head = '(a) As Principal Investigator  :';

$pdf->Cell(strlen($head),10,$head);
$pdf->Ln();

$head = 'Sr.No   ';
$sno_len = 2*strlen($head);
$pdf->Cell($sno_len,10,$head,1,0);
$head = '           Title           ';
$name_len = 2*strlen($head);
$pdf->Cell($name_len,10,$head,1,0);
$head = '          Sponsoring Agency         ';
$desig_len = 2*strlen($head);
$pdf->Cell($desig_len,10,$head,1,0);
$head = '   Value (in Lakhs)    ';
$doj_len = 2*strlen($head);
$pdf->Cell($doj_len,10,$head,1,0);
$head = '     Status     ';
$dol_len = 2*strlen($head);
$pdf->Cell($dol_len,10,$head,1,1);

$i=0;

for($i=0 ; $i<$num_rows2; $i++)
{

$pdf->Cell($sno_len,10,$sno3[$i],1,0);




if(strlen($title1[$i]) > ($name_len/2-4))
{
$title1[$i] = substr($title1[$i],0,$name_len/2-4).'...';
}

$pdf->Cell($name_len,10,$title1[$i],1,0);




if(strlen($agency[$i]) > ($desig_len/2-8))
{
$agency[$i] = substr($agency[$i],0,$desig_len/2-8).'...';
}
$pdf->Cell($desig_len,10,$agency[$i],1,0);


$pdf->Cell($doj_len,10,$value[$i],1,0);






if(strlen($status[$i]) > ($dol_len/2-8))
{
$status[$i] = substr($status[$i],0,$dol_len/2-8).'...';
}
$pdf->Cell($dol_len,10,$status[$i],1,1);

}

		unset($sno3);
		unset($title);
		unset($agency);
		unset($value);//[] = $row['value'];
		unset($status);//[] = $row['status'];



$retrieve = "SELECT * FROM spons_co_investigator where userid = $usrid1";

	$result = mysqli_query($con,$retrieve);

	$num_rows3 = mysqli_num_rows($result);

	while($row = mysqli_fetch_array($result))
  	{
		$sno2[] = $row['sno'];
		$title4[] = $row['title'];
		$agency4[] = $row['agency'];
		$value4[] = $row['value'];
		$status4[] = $row['status'];
  	}


$pdf->Ln();
//$pdf->Ln();


$head = '(b) As Co Investigator  :';

$pdf->Cell(strlen($head),10,$head);
$pdf->Ln();


$head = 'Sr.No   ';
$sno_len = 2*strlen($head);
$pdf->Cell($sno_len,10,$head,1,0);
$head = '           Title           ';
$name_len = 2*strlen($head);
$pdf->Cell($name_len,10,$head,1,0);
$head = '          Sponsoring Agency         ';
$desig_len = 2*strlen($head);
$pdf->Cell($desig_len,10,$head,1,0);
$head = '   Value (in Lakhs)    ';
$doj_len = 2*strlen($head);
$pdf->Cell($doj_len,10,$head,1,0);
$head = '     Status     ';
$dol_len = 2*strlen($head);
$pdf->Cell($dol_len,10,$head,1,1);

$i=0;

for($i=0 ; $i<$num_rows2; $i++)
{

$pdf->Cell($sno_len,10,$sno2[$i],1,0);




if(strlen($title4[$i]) > ($name_len/2-8))
{
$title4[$i] = substr($title4[$i],0,$name_len/2-8).'...';
}

$pdf->Cell($name_len,10,$title4[$i],1,0);




if(strlen($agency4[$i]) > ($desig_len/2-8))
{
$agency4[$i] = substr($agency4[$i],0,$desig_len/2-8).'...';
}
$pdf->Cell($desig_len,10,$agency4[$i],1,0);


$pdf->Cell($doj_len,10,$value4[$i],1,0);






if(strlen($status4[$i]) > ($dol_len/2-8))
{
$status4[$i] = substr($status4[$i],0,$dol_len/2-8).'...';
}
$pdf->Cell($dol_len,10,$status4[$i],1,1);

}



$pdf->Ln();
//$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = '19. Courses Handled :';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->Ln();
//$pdf->Ln();


$head = 'Undergraduate Level :';
$pdf->SetFont('Arial','B');
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->MultiCell(0,10,$courses_undergrad);
$pdf->Ln();
//$pdf->Ln();


$head = 'Postgraduate Level :';
$pdf->SetFont('Arial','B');
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->MultiCell(0,10,$courses_postgrad);
$pdf->Ln();
//$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = '20. Short courses / Workshops /Seminars organized :';
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->MultiCell(0,10,$wrkshps);
$pdf->Ln();
//$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = '21. Details of Patents :';
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->MultiCell(0,10,$patents);
$pdf->Ln();
//$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = '22. Administrative Experience :';
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->MultiCell(0,10,$experience);
$pdf->Ln();
//$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = '23. Membership of Professional Bodies :';
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->MultiCell(0,10,$memberships);
$pdf->Ln();
//$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = '24. Honors and Awards :';
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->MultiCell(0,10,$awards);
$pdf->Ln();
//$pdf->Ln();

//****END OF FORM3*****//
//*****FORM4*****//
	$retrieve = "SELECT * FROM form4 where userid = $usrid1";
	$result = mysqli_query($con,$retrieve);
	while($row = mysqli_fetch_array($result))
  	{

		$a25=$row['sop25a'];
		$b25=$row['sop25b'];
		$ref1_name=$row['ref1_name'];
		$ref1_add=$row['ref1_addr'];
		$ref1_email=$row['ref1_email'];
		$ref1_phone=$row['ref1_phone'];
		$ref2_name=$row['ref2_name'];
		$ref2_add=$row['ref2_addr'];
		$ref2_email=$row['ref2_email'];
		$ref2_phone=$row['ref2_phone'];
		$ref3_name=$row['ref3_name'];
		$ref3_add=$row['ref3_addr'];
		$ref3_email=$row['ref3_email'];
		$ref3_phone=$row['ref3_phone'];
		$othr=$row['otherinfo27'];
	
  	}

/*$pdf->SetFont('Arial','B');
$head = '25:  SOP';
$pdf->Cell(2*strlen($head),10,$head);
$pdf->Ln();
$pdf->SetFont('Arial');
$head='a)Why would you like to join IIITDM Kancheepuram?';

$pdf->SetFont('Arial','B');
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->Ln();


$pdf->MultiCell(0,10,$a25);
$pdf->Ln();

$head = 'b)Your vision for the growth of the institute...';

$pdf->SetFont('Arial','B');
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->Ln();
$pdf->MultiCell(0,10,$b25);
$pdf->Ln();
$pdf->SetFont('Arial','B');*/

$head = '26. Enter the names and addresses including email,fax, telephone no. of 3 referees.
(at least one of them should be familiar with your recent work);
Referees will be contacted by the institute directly, if required.';

//$pdf->MultiCell(0,10,$head,0,0);
$pdf->MultiCell(0,10,$head);

$pdf->Ln();
$head = 'Referee1';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->Ln();
$pdf->SetFont('Arial');
$head = 'Name:       ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->Cell(10,10,$ref1_name);
$pdf->Ln();

$head = 'Address:    ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->Cell(10,10,$ref1_add);
$pdf->Ln();

$head = 'Email:      ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
//$pdf->Ln();
$pdf->Cell(10,10,$ref1_email);
$pdf->Ln();

$head = 'Phone:     ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
//$pdf->Ln();
$pdf->Cell(10,10,$ref1_phone);
$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = 'Referee2';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->Ln();
$pdf->SetFont('Arial');
$head = 'Name:     ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
//$pdf->Ln();
$pdf->Cell(10,10,$ref2_name);
$pdf->Ln();

$head = 'Address:  ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
//$pdf->Ln();
$pdf->Cell(10,10,$ref2_add);
$pdf->Ln();

$head = 'Email:    ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
//$pdf->Ln();
$pdf->Cell(10,10,$ref2_email);
$pdf->Ln();

$head = 'Phone:    ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
//$pdf->Ln();
$pdf->Cell(10,10,$ref2_phone);
$pdf->Ln();


$pdf->SetFont('Arial','B');
$head = 'Referee3';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->Ln();
$pdf->SetFont('Arial');
$head = 'Name:    ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
//$pdf->Ln();
$pdf->Cell(10,10,$ref3_name);
$pdf->Ln();

$head = 'Address: ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
//$pdf->Ln();
$pdf->Cell(10,10,$ref3_add);
$pdf->Ln();

$head = 'Email:   ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
//$pdf->Ln();
$pdf->Cell(10,10,$ref3_email);
$pdf->Ln();

$head = 'Phone:   ';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->Ln();
$pdf->Cell(10,10,$ref3_phone);
$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = '27:
Any other information you want to mention:';
$pdf->Cell(2*strlen($head),10,$head,0,0);
$pdf->Ln();
$pdf->SetFont('Arial');

$pdf->MultiCell(0,10,$othr);
$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = ' Files Attached ';
$pdf->Cell(2*strlen($head),10,$head);
$pdf->Ln();

$pdf->SetFont('Arial','B');
$head=' Uploaded Papers ';
$pdf->Cell(50,10,$head,100,0);
$pdf->SetFont('Arial');
$pdf->Cell(50,10,$paper1,100,0);
$pdf->Cell(50,10,$paper2,100,0);
$pdf->Cell(0,10,$paper3,100,0);
$pdf->Ln();

$pdf->SetFont('Arial','B');
$head = '25:  SOP';
$pdf->Cell(2*strlen($head),10,$head);
$pdf->Ln();
$pdf->SetFont('Arial');
$head='a)Why would you like to join IIITDM Kancheepuram?            b)Your vision for the growth of the institute...';
$pdf->SetFont('Arial','B');
$pdf->Cell(2*strlen($head),10,$head,0,1);
$pdf->SetFont('Arial');
$pdf->Cell(120,10,$a25,100,0);
$pdf->Cell(0,10,$b25,100,0);

//****END OF FORM4***//
$pdf->Output();
//$pdf->Output("Final.pdf",F);

?>



