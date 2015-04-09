<?php include 'externalLinks.php';?>
<?php include 'form_h.php'; ?>
<?php include 'check.php'; ?>
<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	//echo "<script> add_row16(1); </script>";

		$usrid1=$_SESSION['userid'];
 
	if($_GET[a]==1)
	{
		echo "<br/><span style='color:green;'>Publication Details SAVED</span>";
	}

	if(mysqli_num_rows(mysqli_query($con, "select submitted from form3 where userid = $usrid1 and submitted = 1")) > 0)
	{
		echo "<br/><br/><br/><br/>Your form is already submitted<br>";
		echo 'Click <a href="pdf_final.php">here</a></li> to generate the pdf of your application<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
        include 'footer.php';
		//echo '<p><a href=".">Home</a></p>';
		exit;
	}


//	$usrid1 = $_GET['usrid'];

	$retrieve = "SELECT * FROM form3 where userid = $usrid1";

	$result = mysqli_query($con,$retrieve);


	while($row = mysqli_fetch_array($result))
  	{
		$undergrad = $row['undergrad'];
		$postgrad = $row['postgrad'];
		$doctoral = $row['doctoral'];
		$research_deg = $row['research_deg'];
		//$courses_undergrad = $row['courses_undergrad'];
		//$courses_postgrad = $row['courses_postgrad'];
		//$wrkshps = $row['wrkshps'];
		//$patents = $row['patents'];
		//$experience = $row['experience'];
		//$memberships = $row['memberships'];
		//$awards = $row['awards'];
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




	$retrieve = "SELECT * FROM spons_principal where userid = $usrid1";

	$result = mysqli_query($con,$retrieve);

	$num_rows2 = mysqli_num_rows($result);

	while($row = mysqli_fetch_array($result))
  	{
		$sno1[] = $row['sno'];
		$title[] = $row['title'];
		$agency[] = $row['agency'];
		$value[] = $row['value'];
		$status[] = $row['status'];
  	}



	$retrieve = "SELECT * FROM spons_co_investigator where userid = $usrid1";

	$result = mysqli_query($con,$retrieve);

	$num_rows3 = mysqli_num_rows($result);

	while($row = mysqli_fetch_array($result))
  	{
		$sno2[] = $row['sno'];
		$title1[] = $row['title'];
		$agency1[] = $row['agency'];
		$value1[] = $row['value'];
		$status1[] = $row['status'];
  	}



    $retrieve = "SELECT * FROM courses_handled_undergrad_level where userid = $usrid1";

    $result = mysqli_query($con,$retrieve);

    $num_rows4 = mysqli_num_rows($result);

    while($row = mysqli_fetch_array($result))
    {
        $sno3[] = $row['sno'];
        $undergrad_courses_details[] = $row['course'];
    }

    $retrieve = "SELECT * FROM courses_handled_postgrad_level where userid = $usrid1";

    $result = mysqli_query($con,$retrieve);

    $num_rows5 = mysqli_num_rows($result);

    while($row = mysqli_fetch_array($result))
    {
        $sno4[] = $row['sno'];
        $postgrad_courses_details[] = $row['course'];
    }

    $retrieve = "SELECT * FROM short_courses where userid = $usrid1";

    $result = mysqli_query($con,$retrieve);

    $num_rows6 = mysqli_num_rows($result);

    while($row = mysqli_fetch_array($result))
    {
        $sno5[] = $row['sno'];
        $short_courses_details[] = $row['course'];
    }

    $retrieve = "SELECT * FROM patents_details where userid = $usrid1";

    $result = mysqli_query($con,$retrieve);

    $num_rows7 = mysqli_num_rows($result);

    while($row = mysqli_fetch_array($result))
    {
        $sno6[] = $row['sno'];
        $patents_details[] = $row['patent'];
    }

    $retrieve = "SELECT * FROM administrative_experience where userid = $usrid1";

    $result = mysqli_query($con,$retrieve);

    $num_rows8 = mysqli_num_rows($result);

    while($row = mysqli_fetch_array($result))
    {
        $sno7[] = $row['sno'];
        $administrative_details[] = $row['admin_experience'];
    }

    $retrieve = "SELECT * FROM membership_professional where userid = $usrid1";

    $result = mysqli_query($con,$retrieve);

    $num_rows9 = mysqli_num_rows($result);

    while($row = mysqli_fetch_array($result))
    {
        $sno8[] = $row['sno'];
        $membership_details[] = $row['membership'];
    }

    $retrieve = "SELECT * FROM honors_and_awards where userid = $usrid1";

    $result = mysqli_query($con,$retrieve);

    $num_rows10 = mysqli_num_rows($result);

    while($row = mysqli_fetch_array($result))
    {
        $sno9[] = $row['sno'];
        $honors_awards[] = $row['honors'];
    }
if(isset($_POST[submitted_val]) || isset($_POST[submitted_val1])) 
{

	echo "<br/><span style='color:green;'>Professional Activities SAVED</span>";

	$undergrad = $_REQUEST['undergrad'];
	$research_deg = $_REQUEST['research_deg'];
	$postgrad = $_REQUEST['postgrad'];
	$doctoral = $_REQUEST['doctoral'];
	//$courses_undergrad = $_REQUEST['courses_undergrad'];
	//$courses_postgrad = $_REQUEST['courses_postgrad'];
	//$wrkshps = $_REQUEST['wrkshps'];
	//$patents = $_REQUEST['patents'];
	//$experience = $_REQUEST['experience'];
	//$memberships = $_REQUEST['memberships'];
	//$awards = $_REQUEST['awards'];


/*		if(strlen($_POST['undergrad']) == 0 || strlen($_POST['research_deg'])==0 || strlen($_POST['postgrad'])==0 || strlen($_POST['doctoral'])==0) 
        	{
			echo "Error : All entries of Field 17 need to be filled (fill 0 if NA)";
		}
		

	else*/ 


       	{

	mysqli_query($con,"delete from spons_principal where userid=$usrid1");
	mysqli_query($con,"delete from spons_co_investigator where userid=$usrid1");
    mysqli_query($con,"delete from courses_handled_undergrad_level where userid=$usrid1");
    mysqli_query($con,"delete from courses_handled_postgrad_level where userid=$usrid1");
    mysqli_query($con,"delete from short_courses where userid=$usrid1");
    mysqli_query($con,"delete from patents_details where userid=$usrid1");
    mysqli_query($con,"delete from administrative_experience where userid=$usrid1");
    mysqli_query($con,"delete from membership_professional where userid=$usrid1");
    mysqli_query($con,"delete from honors_and_awards where userid=$usrid1");
	mysqli_query($con,"delete from form3 where userid=$usrid1");

	$count1 = $_REQUEST['count1'];
	$num_rows1 = $count1;
    $error=0;
	for($i = 0,$j=1 ; $i<$count1 ; $i++)
	{
		$sno[$i] = $j;
		$name[$i] = $_REQUEST['emp_name'.$j];
		$designation[$i] = $_REQUEST['desig'.$j];
		$doj[$i] = $_REQUEST['doj'.$j];
		$dol[$i] = $_REQUEST['dol'.$j];
		$duration[$i] = $_REQUEST['duration'.$j];
		$scale[$i] = $_REQUEST['pay'.$j];	

 
        $j=$j+1;
		//echo gettype($doj[$i]);
		//var_dump(checkdate($doj[$i]));
		//if (!preg_match('/[^a-zA-Z.]/', $name[$i]) && !preg_match('/[^a-zA-Z]/', $designation[$i]) && )

	}
    $i=0;
    while(!($name[$i]=='' && $designation[$i]==''&& ($doj[$i]=='' or $doj[$i]=='0000-00-00' or $doj[$i]=='yyyy-mm-dd') && ($dol[$i]=='' or $dol[$i]=='0000-00-00' or $dol[$i]=='yyyy-mm-dd') && $duration[$i] =='' && ($scale[$i] =='' or $scale[$i])))
    {
                       if(strlen($doj[$i])!=0)
        {
            $dobSplitArray=explode("-", $doj[$i]);
            if(sizeof($dobSplitArray)!=3)
            {
                echo "<p class='text-center'>invalid format in row".($i+1)." of doj</p>";
                                $error=1;
            }
            else
            {
            if(!validateDate($dobSplitArray[1],$dobSplitArray[0],$dobSplitArray[2]) or $dobSplitArray[2]=='00' or strlen($dobSplitArray[1])!=2 or strlen($dobSplitArray[2])!=2 or strlen($dobSplitArray[0])!=4 )
            {
                $error=1;
                echo "<p class='text-center'>Check date of Joining in row ".($i+1)."</p>";
            }
            else
            {
                if(!validateDateOfBirth($dobSplitArray[1],$dobSplitArray[0],$dobSplitArray[2]) or $dobSplitArray[2]=='00' or strlen($dobSplitArray[1])!=2 or strlen($dobSplitArray[2])!=2 or strlen($dobSplitArray[0])!=4 )
                {
                    $error=1;
                    echo "<p class='text-center'>Date of joining is ahead of now in row".($i+1)."</p>";
                }
            }
            }
        }
                        if(strlen($dol[$i])!=0)
        {
            $dobSplitArray1=explode("-", $dol[$i]);
            if(sizeof($dobSplitArray1)!=3)
            {
                echo "<p class='text-center'>invalid format in row".($i+1)." of dol</p>";
                                $error=1;
            }
            else
            {
            if(!validateDate($dobSplitArray1[1],$dobSplitArray1[0],$dobSplitArray1[2]) or $dobSplitArray1[2]=='00' or strlen($dobSplitArray1[1])!=2 or strlen($dobSplitArray1[2])!=2 or strlen($dobSplitArray1[0])!=4 )
            {
                $error=1;
                echo "<p class='text-center'>Check date of leaving in row ".($i+1)."</p>";
            }
            else
            {
                if(!validateDateOfBirth($dobSplitArray1[1],$dobSplitArray1[0],$dobSplitArray1[2]) or $dobSplitArray1[2]=='00' or $dobSplitArray1[2]=='00' or strlen($dobSplitArray1[1])!=2 or strlen($dobSplitArray1[2])!=2 or strlen($dobSplitArray1[0])!=4 )
                {
                    $error=1;
                    echo "<p class='text-center'>Date of leaving is ahead of now in row".($i+1)."</p>";
                }
            }
            }
        }
        if($dobSplitArray[0]>$dobSplitArray1[0])
        {
                    $error=1;            
            echo "<p class='text-center'>date of leaving is behind date of joining </p>";
        }
        else if($dobSplitArray[0]==$dobSplitArray1[0])
        {
            if($dobSplitArray[1]>$dobSplitArray1[1])
            {
                    $error=1;                
                echo "<p class='text-center'>date of leaving is behind date of joining </p>";
            }
            else if($dobSplitArray[1]==$dobSplitArray1[1])
            {
                if($dobSplitArray[2]>$dobSplitArray1[2])
                {
                    $error=1;                    
                    echo "<p class='text-center'>date of leaving is behind date of joining </p>";
                }
            }
        }
        if(strlen($duration[$i])!=0)
        {
            $durationSplitArray=explode("-", $duration[$i]);
            if(sizeof($durationSplitArray)!=2 )
            {
                echo "<p class='text-center'>invalid format in row".($i+1)." of duration</p>";
                $error=1;
            }
            else if(($durationSplitArray[0]==0 and $durationSplitArray[1]==0)  or strlen($durationSplitArray[0])>2 or strlen($durationSplitArray[1])>2 )
            {
                echo "<p class='text-center'>invalid values in row".($i+1)." of duration</p>";
            }
            else if(!validateDate(($durationSplitArray[1]+1),'2000','10'))
            {
              echo "<p class='text-center'>months are greater than 12 in row".($i+1)." of duration</p>";  
            }
        }
        if($error==0)
        {
            $k=$i+1;
        mysqli_query($con,"delete from work_experience where userid=$usrid1");            
        $query = "INSERT INTO work_experience (userid,sno,name,designation,doj,dol,duration,scale) VALUES ($usrid1,$k,'$name[$i]','$designation[$i]','$doj[$i]','$dol[$i]','$duration[$i]','$scale[$i]')";
                mysqli_query($con,$query);
        }
            $i++;        
    }
    $num_rows1=$i;


	$count2 = $_REQUEST['count2'];
	$num_rows2 = $count2;


	for($i = 0,$j=1; $i<$count2 ; $i++)
	{
		$sno1[$i] = $j;
		$title[$i] = $_REQUEST['title2'.$j];
		$agency[$i] = $_REQUEST['spon2'.$j];
		$value[$i] = $_REQUEST['val2'.$j];
		$status[$i] = $_REQUEST['status2'.$j];

		$j=$j+1;

	}
    $i=0;
while(!($title[$i] == '' and $agency[$i] == '' and $value[$i] == '' and $status[$i] == ''))
{
    $k=$i+1;
        $query = "INSERT INTO spons_principal (userid,sno,title,agency,value,status) VALUES ($usrid1,$k,'$title[$i]','$agency[$i]','$value[$i]','$status[$i]')";
        mysqli_query($con,$query);    
    $i=$i+1;
}

    $num_rows2=$i;

	$count3 = $_REQUEST['count3'];
	$num_rows3 = $count3;

	for($i = 0,$j=1 ; $i<$count3 ; $i++)
	{
		$sno2[$i] = $j;
		$title1[$i] = $_REQUEST['title3'.$j];
		$agency1[$i] = $_REQUEST['spon3'.$j];
		$value1[$i] = $_REQUEST['val3'.$j];
		$status1[$i] = $_REQUEST['status3'.$j];

		$j=$j+1;
	}

    $i=0;
    while(!($title1[$i] == '' and $agency1[$i] == '' and $value1[$i] == '' and $status1[$i] == ''))
    {
        $k=$i+1;
        $query = "INSERT INTO spons_co_investigator (userid,sno,title,agency,value,status) VALUES ($usrid1,$k,'$title1[$i]','$agency1[$i]','$value[$i]','$status1[$i]')";
        mysqli_query($con,$query);    
        $i=$i+1;
    }

    $num_rows3=$i;
//this is part I added

    $count4 = $_REQUEST['count4'];
    $num_rows4 = $count4;

    for($i = 0,$j=1 ; $i<$count4 ; $i++)
    {
        $sno3[$i] = $j;
        $undergrad_courses_details[$i] = $_REQUEST['undergrad_courses'.$j];

        $j=$j+1;
    }

    $i=0;
    while($undergrad_courses_details[$i] !='') 
    {
        $k=$i+1;
        $query = "INSERT INTO courses_handled_undergrad_level (userid,sno,course) VALUES ($usrid1,$k,'$undergrad_courses_details[$i]')";
        mysqli_query($con,$query);    
        $i=$i+1;
    }

    $num_rows4=$i;

    $count5 = $_REQUEST['count5'];
    $num_rows5 = $count5;

    for($i = 0,$j=1 ; $i<$count5 ; $i++)
    {
        $sno4[$i] = $j;
        $postgrad_courses_details[$i] = $_REQUEST['postgrad_courses'.$j];

        $j=$j+1;
    }

     $i=0;
    while($postgrad_courses_details[$i] !='') 
    {
        $k=$i+1;
        $query = "INSERT INTO courses_handled_postgrad_level (userid,sno,course) VALUES ($usrid1,$k,'$postgrad_courses_details[$i]')";
        mysqli_query($con,$query);    
        $i=$i+1;
    }

    $num_rows5=$i;

    $count6 = $_REQUEST['count6'];
    $num_rows6 = $count6;

    for($i = 0,$j=1 ; $i<$count6 ; $i++)
    {
        $sno5[$i] = $j;
        $short_courses_details[$i] = $_REQUEST['short_courses'.$j];
        $j=$j+1;
    }

       $i=0;
    while($short_courses_details[$i] !='') 
    {
        $k=$i+1;
        $query = "INSERT INTO short_courses (userid,sno,course) VALUES ($usrid1,$k,'$short_courses_details[$i]')";
        mysqli_query($con,$query);    
        $i=$i+1;
    }

    $num_rows6=$i;  

    $count7 = $_REQUEST['count7'];
    $num_rows7 = $count7;

    for($i = 0,$j=1 ; $i<$count7 ; $i++)
    {
        $sno6[$i] = $j;
        $patents_details[$i] = $_REQUEST['patents'.$j];

        $j=$j+1;
    }

    $i=0;
    while($patents_details[$i] !='') 
    {
        $k=$i+1;
        $query = "INSERT INTO patents_details (userid,sno,patent) VALUES ($usrid1,$k,'$patents_details[$i]')";
        mysqli_query($con,$query);    
        $i=$i+1;
    }

    $num_rows7=$i; 

    $count8 = $_REQUEST['count8'];
    $num_rows8 = $count8;

    for($i = 0,$j=1 ; $i<$count8 ; $i++)
    {
        $sno7[$i] = $j;
        $administrative_details[$i] = $_REQUEST['administrative'.$j];

        $j=$j+1;
    }

    $i=0;
    while($administrative_details[$i] !='') 
    {
        $k=$i+1;
        $query = "INSERT INTO administrative_experience (userid,sno,admin_experience) VALUES ($usrid1,$k,'$administrative_details[$i]')";
        mysqli_query($con,$query);    
        $i=$i+1;
    }

    $num_rows8=$i; 


    $count9 = $_REQUEST['count9'];
    $num_rows9 = $count9;

    for($i = 0,$j=1 ; $i<$count9 ; $i++)
    {
        $sno8[$i] = $j;
        $membership_details[$i] = $_REQUEST['membership'.$j];

        $j=$j+1;
    }

     $i=0;
    while($membership_details[$i] !='') 
    {
        $k=$i+1;
        $query = "INSERT INTO membership_professional (userid,sno,membership) VALUES ($usrid1,$k,'$membership_details[$i]')";
        mysqli_query($con,$query);    
        $i=$i+1;
    }

    $num_rows9=$i; 

    $count10 = $_REQUEST['count10'];
    $num_rows10 = $count10;

    for($i = 0,$j=1 ; $i<$count10 ; $i++)
    {
        $sno9[$i] = $j;
        $honors_awards[$i] = $_REQUEST['honors'.$j];

        $j=$j+1;
    }

     $i=0;
    while($honors_awards[$i] !='') 
    {
        $k=$i+1;
        $query = "INSERT INTO honors_and_awards (userid,sno,honors) VALUES ($usrid1,$k,'$honors_awards[$i]')";
        mysqli_query($con,$query);    
        $i=$i+1;
    }

    $num_rows10=$i; 

//Part I added ended

	$query1 = "INSERT INTO form3 (userid,undergrad,postgrad,doctoral,research_deg,submitted) VALUES ($usrid1,'$undergrad','$postgrad','$doctoral','$research_deg',0)";


 	mysqli_query($con,$query1);
		if(isset($_POST[submitted_val1]))
			{
			echo '<meta http-equiv="REFRESH" content="0;url=form4.php?a=1">';		
			}
//echo '<meta http-equiv="REFRESH" content="0;url=saved3.php">';
}



}
?>

<html>
<!--<script src="include/js/form3include/validation.js" type="text/javascript"></script>
<script src="include/js/form3include/addrow.js" type="text/javascript"></script>
-->
<script type="text/javascript">
function myfunction1(countfunc)
{
	var inpObj= document.getElementById("id2"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
    		document.getElementById("idm2"+countfunc).innerHTML = "* a-z or A-Z or . are allowed.";
    	
    }
    else
    {
    	    document.getElementById("idm2"+countfunc).innerHTML = "";
    }
}

function myfunctionva1(countfunc)
{
	var inpObj= document.getElementById("idva2"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
    		document.getElementById("idmva2"+countfunc).innerHTML = "* a-z or A-Z or . are allowed.";
    	
    }
    else
    {
    	   document.getElementById("idmva2"+countfunc).innerHTML = "";
    }
}

function myfunction2(countfunc)
{
	var inpObj= document.getElementById("id3"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|\-+=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
    		document.getElementById("idm3"+countfunc).innerHTML = "* a-z or A-Z  or . are allowed.";
    }
    else
    {
    	   document.getElementById("idm3"+countfunc).innerHTML = "";
    }

}

function myfunctionva2(countfunc)
{
	var inpObj= document.getElementById("idva3"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|\-+=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
    		document.getElementById("idmva3"+countfunc).innerHTML = "* a-z or A-Z  or . are allowed.";
    }

    else
    {
    	   document.getElementById("idmva3"+countfunc).innerHTML = "";
    }
}

function myfunction3(countfunc)
{
	var inpObj= document.getElementById("id4"+countfunc);
	var matches = /(\d{4})[-\/](\d{2}|\d{1})[-\/](\d{2}|\d{1})/.exec(inpObj.value);
    if (matches == null)
    {
    	document.getElementById("idm4"+countfunc).innerHTML = "* Enter valid date in given format.";
    }
    var year = matches[1];
	var month = matches[2] - 1;
	var day = matches[3];
    var composedDate = new Date(year, month, day);
    if (!(composedDate.getDate() == day && composedDate.getMonth() == month && composedDate.getFullYear() == year))
    {
    	   document.getElementById("idm4"+countfunc).innerHTML = "* Enter day or month or year in limits.";
    }

    else
    {
    	   document.getElementById("idm4"+countfunc).innerHTML = "";
    }

}
function myfunctionva3(countfunc)
{
	var inpObj= document.getElementById("idva4"+countfunc);
	var matches = /(\d{4})[-\/](\d{2}|\d{1})[-\/](\d{2}|\d{1})/.exec(inpObj.value);
    if (matches == null)
    {
    	document.getElementById("idmva4"+countfunc).innerHTML = "* Enter valid date in given format.";
    }
    var year = matches[1];
	var month = matches[2] - 1;
	var day = matches[3];
    var composedDate = new Date(year, month, day);
    if (!(composedDate.getDate() == day && composedDate.getMonth() == month && composedDate.getFullYear() == year))
    {
    	   document.getElementById("idmva4"+countfunc).innerHTML = "* Enter day or month or year in limits.";
    }

    else
    {
    	   document.getElementById("idmva4"+countfunc).innerHTML = "";
    }

}

function myfunction4(countfunc)
{
	var inpObj= document.getElementById("id5"+countfunc);
	var matches = /(\d{4})[-\/](\d{2}|\d{1})[-\/](\d{2}|\d{1})/.exec(inpObj.value);
    if (matches == null)
    {
    	   document.getElementById("idm5"+countfunc).innerHTML = "* Enter valid date in given format.";
    }
    var year = matches[1];
	var month = matches[2] - 1;
	var day = matches[3];
    var composedDate = new Date(year, month, day);
    if (!(composedDate.getDate() == day && composedDate.getMonth() == month && composedDate.getFullYear() == year))
    {
    	   document.getElementById("idm5"+countfunc).innerHTML = "* Enter day or month or year in limits.";
    }

    else
    {
    	   document.getElementById("idm5"+countfunc).innerHTML = "";
    }

}
function myfunctionva4(countfunc)
{
	var inpObj= document.getElementById("idva5"+countfunc);
	var matches = /(\d{4})[-\/](\d{2}|\d{1})[-\/](\d{2}|\d{1})/.exec(inpObj.value);
    if (matches == null)
    {
    	   document.getElementById("idmva5"+countfunc).innerHTML = "* Enter valid date in given format.";
    }
    var year = matches[1];
	var month = matches[2] - 1;
	var day = matches[3];
    var composedDate = new Date(year, month, day);
    if (!(composedDate.getDate() == day && composedDate.getMonth() == month && composedDate.getFullYear() == year))
    {
    	   document.getElementById("idmva5"+countfunc).innerHTML = "* Enter day or month or year in limits.";
    }

    else
    {
    	   document.getElementById("idmva5"+countfunc).innerHTML = "";
    }

}
function myfunction5(countfunc)
{
	var inpObj= document.getElementById("id6"+countfunc);
	var errorinname = /(\d{2}|\d{1})[-](\d{2}|\d{1})/.exec(inpObj.value);
	var errorinname2 = /[`~!@#$%^&*()_|+=?;:'",<>\{\}\[\]\\\/]|[a-zA-Z]/.test(inpObj.value);

	if(errorinname2==true || errorinname==null)
    {
            document.getElementById("idm6"+countfunc).innerHTML = "only numbers and \"-\" are allowed.";
    }
    else
    {
    	if (inpObj.value[2]=="-")
    	{
    		if (inpObj.value.substr(3,5) > 12)
    		{
    			     document.getElementById("idm6"+countfunc).innerHTML = "* months can not be more than 12.";
    		}
            else
            {
                    document.getElementById("idm6"+countfunc).innerHTML = "";
            }
    	}
    	else if(inpObj.value[1]=="-")
    	{
    		if (inpObj.value.substr(2,4) > 12)
    		{
    			     document.getElementById("idm6"+countfunc).innerHTML = "* months can not be more than 12.";
    		}
            else
            {
                     document.getElementById("idm6"+countfunc).innerHTML = "";
            }
    	}

    }



}

function myfunctionva5(countfunc)
{
	var inpObj= document.getElementById("idva6"+countfunc);
	var errorinname = /(\d{2}|\d{1})[-](\d{2}|\d{1})/.exec(inpObj.value);
	var errorinname2 = /[`~!@#$%^&*()_|+=?;:'",<>\{\}\[\]\\\/]|[a-zA-Z]/.test(inpObj.value);

    if(errorinname2==true || errorinname==null)
    {
        document.getElementById("idmva6"+countfunc).innerHTML = "only numbers and \"-\" are allowed.";
    }
    else
    {
    	if (inpObj.value[2]=="-")
    	{
    		if (inpObj.value.substr(3,5) > 12)
    		{
    			    document.getElementById("idmva6"+countfunc).innerHTML = "* months can not be more than 12.";
    		}
            else
            {
                    document.getElementById("idmva6"+countfunc).innerHTML = "";
            }
    	}
    	else if(inpObj.value[1]=="-")
    	{
    		if (inpObj.value.substr(2,4) > 12)
    		{
    			    document.getElementById("idmva6"+countfunc).innerHTML = "* months can not be more than 12.";
    		}
            else
            {
                    document.getElementById("idmva6"+countfunc).innerHTML = "";
            }
    	}
    }

}
function myfunction6(countfunc)
{
	var inpObj= document.getElementById("id7"+countfunc);
	var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]|[a-z]|[A-Z]/.test(inpObj.value);
	if (errorinname == true)
    {
    		document.getElementById("idm7"+countfunc).innerHTML = "* only positive numbers are allowed.";
    }
    else
    {
    	    document.getElementById("idm7"+countfunc).innerHTML = "";
    }
}

function myfunctionva6(countfunc)
{
	var inpObj= document.getElementById("idva7"+countfunc);
	var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]|[a-z]|[A-Z]/.test(inpObj.value);
	if (errorinname == true)
    {
    		document.getElementById("idmva7"+countfunc).innerHTML = "* only positive numbers are allowed.";
    }
    else
    {
    	    document.getElementById("idmva7"+countfunc).innerHTML = "";
    }
}


function myfunction7()
{
    var inpObj= document.getElementById("id17a");
    var errorinname = /[.\-]|[a-z]|[A-Z]/.test(inpObj.value);
    if (errorinname==true)
    {
            document.getElementById("id17ma").innerHTML = "* only positive integers are valid.";
    }

    else
    {
            document.getElementById("id17ma").innerHTML = "";
    }
}

function myfunction8()
{
    var inpObj= document.getElementById("id17b");
    var errorinname = /[.\-]|[a-z]|[A-Z]/.test(inpObj.value);
    if (errorinname==true)
    {
            document.getElementById("id17mb").innerHTML = "* only positive integers are valid.";
    }
    else
    {
            document.getElementById("id17mb").innerHTML = "";
    }
}

function myfunction9()
{
    var inpObj= document.getElementById("id17c");
    var errorinname = /[.\-]|[a-z]|[A-Z]/.test(inpObj.value);
    if (errorinname==true)
    {
            document.getElementById("id17mc").innerHTML = "* only positive integers are valid.";
    }

    else
    {
            document.getElementById("id17mc").innerHTML = "";
    }
}
function myfunction10()
{
    var inpObj= document.getElementById("id17d");
    var errorinname = /[.\-]|[a-z]|[A-Z]/.test(inpObj.value);
    if (errorinname==true)
    {
        document.getElementById("id17md").innerHTML = "* only positive integers are valid.";
    }
    else
    {
        document.getElementById("id17md").innerHTML = "";
    }
}


function myfunction11(countfunc)
{
    var inpObj= document.getElementById("id18a"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[a-z]|[A-Z]/.test(inpObj.value);
    if (errorinname == true)
    {
            document.getElementById("id18ma"+countfunc).innerHTML = "* only positive numbers are allowed.";
    }

    else
    {
            document.getElementById("id18ma"+countfunc).innerHTML = "";
    }
}

function myfunctionva11(countfunc)
{
    var inpObj= document.getElementById("id18vaa"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[a-z]|[A-Z]/.test(inpObj.value);
    if (errorinname == true)
    {
            document.getElementById("id18mvaa"+countfunc).innerHTML = "* only positive numbers are allowed.";
    }

    else
    {
            document.getElementById("id18mvaa"+countfunc).innerHTML = "";
    }
}

function myfunction12(countfunc)
{
    var inpObj= document.getElementById("id18b"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
            document.getElementById("id18mb"+countfunc).innerHTML = "you have to use only a-z or A-Z.";
    }
    else
    {
            document.getElementById("id18mb"+countfunc).innerHTML = "";
    }
}
function myfunctionva12(countfunc)
{
    var inpObj= document.getElementById("id18vab"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
            document.getElementById("id18mvab"+countfunc).innerHTML = "you have to use only a-z or A-Z.";
    }
    else
    {
            document.getElementById("id18mvab"+countfunc).innerHTML = "";
    }
}

function myfunction13(countfunc)
{
    var inpObj= document.getElementById("id18c"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[a-z]|[A-Z]/.test(inpObj.value);
    if (errorinname == true)
    {
            document.getElementById("id18mc"+countfunc).innerHTML = "* only positive numbers are allowed.";
    }

    else
    {
            document.getElementById("id18mc"+countfunc).innerHTML = "";
    }
}

function myfunctionva13(countfunc)
{
    var inpObj= document.getElementById("id18vac"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[a-z]|[A-Z]/.test(inpObj.value);
    if (errorinname == true)
    {
            document.getElementById("id18mvac"+countfunc).innerHTML = "* only positive numbers are allowed.";
    }

    else
    {
            document.getElementById("id18mvac"+countfunc).innerHTML = "";
    }
}

function myfunction14(countfunc)
{
    var inpObj= document.getElementById("id18d"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
            document.getElementById("id18md"+countfunc).innerHTML = "you have to use only a-z or A-Z.";
    }
    else
    {
            document.getElementById("id18md"+countfunc).innerHTML = "";
    }
}

function myfunctionva14(countfunc)
{
    var inpObj= document.getElementById("id18vad"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
            document.getElementById("id18mvad"+countfunc).innerHTML = "you have to use only a-z or A-Z.";
    }
    else
    {
            document.getElementById("id18mvad"+countfunc).innerHTML = "";
    }
}
    function checkDateValue(e)
    {
        var k = e.which || e.keyCode || e.charCode;
            var ok = (k>=48&&k<=57) || k==45 || k==8 || k==37 || k==39 || k==9;

            if (!ok){
                e.preventDefault();
            }
    }
</script>

<body>
		<div class="row">

			<div class="col-md-12">

				<form method="post" class="form" action="form3.php" enctype="multipart/form-data">

<!--changes I made I made 

this is changed to file in include/js folder
all functions are brought back from file for validation of php using js functions.
Not a good way of doing it but an easy one.

changes I made finish
myfunction6 is not checking for alphabets in salary.
-->
<script type="text/javascript">
var count1 = 0;

function add_row16(cnt)
{
//alert("hello");

if(cnt == 0  || cnt == -1)  //add row
{
count1 = count1+1;
if(cnt == -1)
{
count1 = 1;
}
var table=document.getElementById("Table16");
var row=table.insertRow(count1);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);
var cell4=row.insertCell(3);
var cell5=row.insertCell(4);
var cell6=row.insertCell(5);
var cell7=row.insertCell(6);
var cell8=row.insertCell(7);

cell1.innerHTML=count1+".";
cell2.innerHTML="<input id =\"id2"+count1+"\" class=\"form-control\" type=\"text\" name=\"emp_name"+count1+"\" onchange = \"myfunction1("+count1+")\"> <p style=\"color:red\" id=\"idm2"+count1+"\"></p></td>";
cell3.innerHTML="<input id =\"id3"+count1+"\" class=\"form-control\" type=\"text\" name=\"desig"+count1+"\" onchange = \"myfunction2("+count1+")\" ><p style=\"color:red\" id=\"idm3"+count1+"\"></p></td>";
cell4.innerHTML="<input id =\"id4"+count1+"\" type=\"text\" class=\"date-picker form-control\" data-date-format=\"YYYY-MM-DD\" onkeypress=\"checkDateValue(event);\" name=\"doj"+count1+"\" value = \"\" size=\"14\" onchange = \"myfunction3("+count1+")\"><p style=\"color:red\" id=\"idm4"+count1+"\"></p></td>";
cell5.innerHTML="<input id =\"id5"+count1+"\" type=\"text\" class=\"date-picker form-control\" data-date-format=\"YYYY-MM-DD\" onkeypress=\"checkDateValue(event);\" name=\"dol"+count1+"\" value = \"\" size=\"14\" onchange = \"myfunction4("+count1+")\"><p style=\"color:red\" id=\"idm5"+count1+"\"></p></td>";
cell6.innerHTML="<input id =\"id6"+count1+"\" class=\"form-control\" type=\"text\" name=\"duration"+count1+"\" onkeypress=\"checkDateValue(event);\" size=\"5\" onchange = \"myfunction5("+count1+")\"><p style=\"color:red\" id=\"idm6"+count1+"\"></p> </td>";
cell7.innerHTML="<input id =\"id7"+count1+"\" class=\"form-control\" type=\"number\" name=\"pay"+count1+"\" onchange = \"myfunction6("+count1+")\"><p style=\"color:red\" id=\"idm7"+count1+"\"></p></td>";

cell8.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count1\" value=\""+count1+"\"></td>";
}

else
{
count1 = cnt;

var sno= <?php echo json_encode($sno); ?>;
var name= <?php echo json_encode($name); ?>;		
var designation= <?php echo json_encode($designation); ?>;
var doj= <?php echo json_encode($doj); ?>;
var dol= <?php echo json_encode($dol); ?>;
var duration= <?php echo json_encode($duration); ?>;
var scale = <?php echo json_encode($scale); ?>;

for(var i=1;i<=count1;i++)
{
var table=document.getElementById("Table16");
var row=table.insertRow(i);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);
var cell4=row.insertCell(3);
var cell5=row.insertCell(4);
var cell6=row.insertCell(5);
var cell7=row.insertCell(6);
var cell8=row.insertCell(7);



cell1.innerHTML=sno[i-1];

cell2.innerHTML="<input id =\"idva2"+i+"\" class=\"form-control\" type=\"text\" name=\"emp_name"+i+"\" value =\""+name[i-1]+"\" onchange = \"myfunctionva1("+i+")\"> <p style=\"color:red\" id=\"idmva2"+i+"\"></p ></td>";
cell3.innerHTML="<input id =\"idva3"+i+"\" class=\"form-control\" type=\"text\" name=\"desig"+i+"\" value = \""+designation[i-1]+"\" onchange = \"myfunctionva2("+i+")\" ><p style=\"color:red\" id=\"idmva3"+i+"\"></p></td>";
cell4.innerHTML="<input id =\"idva4"+i+"\" class=\"date-picker form-control\" data-date-format=\"YYYY-MM-DD\" onkeypress=\"checkDateValue(event);\" type=\"text\" name=\"doj"+i+"\" size=\"14\" value = \""+doj[i-1]+"\" onchange = \"myfunctionva3("+i+")\"><p style=\"color:red\" id=\"idmva4"+i+"\"></p></td>";
cell5.innerHTML="<input id =\"idva5"+i+"\" class=\"date-picker form-contro\" data-date-format=\"YYYY-MM-DD\" onkeypress=\"checkDateValue(event);\" type=\"text\" name=\"dol"+i+"\" size=\"14\" value = \""+dol[i-1]+"\" onchange = \"myfunctionva4("+i+")\"><p style=\"color:red\" id=\"idmva5"+i+"\"></p></td>";
cell6.innerHTML="<input id =\"idva6"+i+"\" class=\"form-control\" type=\"text\" name=\"duration"+i+"\" onkeypress=\"checkDateValue(event);\" size=\"5\" value = \""+duration[i-1]+"\" onchange = \"myfunctionva5("+i+")\"><p style=\"color:red\" id=\"idmva6"+i+"\"></p></td>";
cell7.innerHTML="<input id =\"idva7"+i+"\" class=\"form-control\" type=\"number\" name=\"pay"+i+"\" min=\"0\" value = \""+scale[i-1]+"\" onchange = \"myfunctionva6("+i+")\"><p style=\"color:red\" id=\"idmva7"+i+"\"></p></td>";

cell8.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count1\" value=\""+i+"\"></td>";
}
}

}
</script>
<br/><span style="color:red;">* required fields</span><br/><br/>
<table class="table table-striped" id="myTable">
<tr>
<td>16. Work Experience (in reverse chronological order)</td>
</tr>
<tr>
<td>
<table id="Table16" border="1">

<tr>

<th>Sr.No &nbsp; &nbsp; &nbsp;</th>
<th>Name of the &nbsp; &nbsp; &nbsp;<br/>Employer &nbsp; &nbsp; &nbsp;</th>
<th>Designation &nbsp; &nbsp; &nbsp;</th>
<th>Date of &nbsp; &nbsp; &nbsp;<br/>Joining &nbsp; &nbsp; &nbsp;<br/>yyyy-mm-dd &nbsp; &nbsp; &nbsp;</th>
<th>Date of &nbsp; &nbsp; &nbsp;<br/>Leaving &nbsp; &nbsp; &nbsp;<br/>yyyy-mm-dd &nbsp; &nbsp; &nbsp;</th>
<th>Duration &nbsp; &nbsp; &nbsp;<br/>[YY-MM] &nbsp; &nbsp; &nbsp;</th>
<th>Scale + Grade &nbsp; &nbsp; &nbsp;<br/>Pay/Total Pay &nbsp; &nbsp; &nbsp;<br/>(per month) last &nbsp; &nbsp; &nbsp;<br/>drawn (in Rs) &nbsp; &nbsp; &nbsp;</th>
</tr>
</table> 



<?php 
if ($num_rows1 !=0)
  {
  			echo "<script> add_row16(".$num_rows1."); </script>";
  }
  	?>


<br/>
									<button type="button" class="btn btn-sm btn-primary" onclick="<?php echo "add_row16(0)";?>">Insert new row</button>
</td></tr>


<tr>
<td>17. Number of Student Projects Guided (mention only viva completed/graduated student details):
</td>
</tr>

<tr>
<td>
<table>

<tr>
<td>Undergraduate (B.Tech/B.E/B.Sc) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input  id = "id17a" class="form-control" type="number" name="undergrad" value="<?php echo $undergrad;?>" min="0" size="2" onchange = "myfunction7()"><p style ="color:red" id = "id17ma" ></p></td>


<td>Reseach Degree (MS/M.Phil) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input  id = "id17b" class="form-control" type="number" name="research_deg" value="<?php echo $research_deg;?>" min="0" size="2" onchange = "myfunction8()"><p style ="color:red" id = "id17mb" ></p> </td>

</tr>
<tr>
<td>Postgraduate (M.Tech/M.E/M.Sc) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input  id ="id17c" class="form-control" type="number" name="postgrad" value="<?php echo $postgrad;?>" min="0" size="2" onchange = "myfunction9()"><p style ="color:red" id = "id17mc" ></p></td>


<td>Doctoral(Ph.D) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input  id="id17d" class="form-control" type="number" name="doctoral" value="<?php echo $doctoral;?>" min="0" size="2" onchange = "myfunction10()"><p style ="color:red" id = "id17md" ></p></td>

</tr>
</table>
</td>
</tr>
</table>
<table class="table table-striped" id="myTable">

<tr><td>18. Sponsored Projects / Industrial Consultancy handled</td></tr>

<tr><td>(a) As Principal Investigator</td></tr>

<head>


<script type="text/javascript">
var count2 = 0;
function add_row18a(cnt)
{

if(cnt == 0 || cnt == -1)
{
count2 = count2+1;
if(cnt == -1)
{
count2 = 1;
}
var table=document.getElementById("Table18a");
var row=table.insertRow(count2);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);
var cell4=row.insertCell(3);
var cell5=row.insertCell(4);
var cell6=row.insertCell(5);

cell1.innerHTML=count2+".";
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"title2"+count2+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"text\" name=\"spon2"+count2+"\"></td>";
cell4.innerHTML="<input id = \"id18a"+count2+"\" class=\"form-control\" type=\"number\" min=\"0\" step = \"any\" name=\"val2"+count2+"\" onchange = \"myfunction11("+count2+")\"><p style=\"color:red\" id=\"id18ma"+count2+"\"></p></td>";
cell5.innerHTML="<input id = \"id18b"+count2+"\" class=\"form-control\" type=\"text\" name=\"status2"+count2+"\" onchange = \"myfunction12("+count2+")\"><p style=\"color:red\" id=\"id18mb"+count2+"\"></p></td>";
cell6.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count2\" value=\""+count2+"\"></td>";
}

else
{
count2 = cnt;

var sno= <?php echo json_encode($sno1); ?>;
var title= <?php echo json_encode($title); ?>;
var agency= <?php echo json_encode($agency); ?>;
var value= <?php echo json_encode($value); ?>;
var status= <?php echo json_encode($status); ?>;
for( var i=1;i<=count2;i++)
{

var table=document.getElementById("Table18a");
var row=table.insertRow(i);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);
var cell4=row.insertCell(3);
var cell5=row.insertCell(4);
var cell6=row.insertCell(5);

cell1.innerHTML=sno[i-1];
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"title2"+i+"\" value = \""+title[i-1]+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"text\" name=\"spon2"+i+"\" value = \""+agency[i-1]+"\"></td>";
cell4.innerHTML="<input id = \"id18vaa"+i+"\" class=\"form-control\" type=\"number\" min=\"0\" step = \"any\" name=\"val2"+i+"\" value = \""+value[i-1]+"\" onchange = \"myfunctionva11("+i+")\"><p style=\"color:red\" id=\"id18mvaa"+i+"\"></p></td>";
cell5.innerHTML="<input id = \"id18vab"+i+"\" class=\"form-control\" type=\"text\" name=\"status2"+i+"\" value = \""+status[i-1]+"\" onchange = \"myfunctionva12("+i+")\"><p style=\"color:red\" id=\"id18mvab"+i+"\"></p></td>";
cell6.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count2\" value=\""+i+"\"></td>";

}
}

}
</script>

</head>
<tr>
<td>
<table id="Table18a" border ="1">

<tr>

<th>Sr.No &nbsp; &nbsp; &nbsp;</th>
<th>Title &nbsp; &nbsp; &nbsp;</th>
<th>Sponsoring Agency &nbsp; &nbsp; &nbsp;</th>
<th>Value (in<br/>Lakhs) &nbsp; &nbsp; &nbsp;</th>
<th>Status &nbsp; &nbsp; &nbsp;</th>

</tr>

<!--<tr>
<td>1.</td>
<td><input type="text" name="title21"></td>
<td><input type="text" name="spon21"></td>
<td><input type="number" name="val21"></td>
<td><input type="text" name="status21"></td>
</tr>-->

</table>
<?php 
if ($num_rows2 !=0)
  {
  			echo "<script> add_row18a(".$num_rows2."); </script>";
  }

  	?>
<br/>
									<button type="button" class="btn btn-sm btn-primary" onclick="<?php echo "add_row18a(0)";?>">Insert new row</button></td></tr>
<tr>
<td>(b) As Co Investigator</td>
</tr>


<head>


<script type="text/javascript">
var count3 = 0;

function add_row18b(cnt)
{

if(cnt == -1 || cnt == 0)
{
	count3 = count3+1;
	if(cnt == -1)
	{
		count3 = 1;
	}
var table=document.getElementById("Table18b");
var row=table.insertRow(count3);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);
var cell4=row.insertCell(3);
var cell5=row.insertCell(4);
var cell6=row.insertCell(5);

cell1.innerHTML=count3+".";
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"title3"+count3+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"text\" name=\"spon3"+count3+"\"></td>";
cell4.innerHTML="<input id = \"id18c"+count3+"\" class=\"form-control\" type=\"number\" min=\"0\" step = \"any\" name=\"val3"+count3+"\" onchange = \"myfunction13("+count3+")\"><p style=\"color:red\" id=\"id18mc"+count3+"\"></p></td>";
cell5.innerHTML="<input id = \"id18d"+count3+"\" class=\"form-control\" type=\"text\" name=\"status3"+count3+"\" onchange = \"myfunction14("+count3+")\"><p style=\"color:red\" id=\"id18md"+count3+"\"></p></td>";
cell6.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count3\" value=\""+count3+"\"></td>";
}


else
{
count3 = cnt;
var sno= <?php echo json_encode($sno2); ?>;
var title= <?php echo json_encode($title1); ?>;
var agency= <?php echo json_encode($agency1); ?>;
var value= <?php echo json_encode($value1); ?>;
var status= <?php echo json_encode($status1); ?>;

for( var i=1;i<=count3;i++)
{
var table=document.getElementById("Table18b");
var row=table.insertRow(i);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);
var cell4=row.insertCell(3);
var cell5=row.insertCell(4);
var cell6=row.insertCell(5);




cell1.innerHTML=sno[i-1];
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"title3"+i+"\" value = \""+title[i-1]+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"text\" name=\"spon3"+i+"\" value = \""+agency[i-1]+"\"></td>";
cell4.innerHTML="<input id = \"id18vac"+i+"\" class=\"form-control\" type=\"number\" min=\"0\" step = \"any\" name=\"val3"+i+"\" value = \""+value[i-1]+"\" onchange = \"myfunctionva13("+i+")\"><p style=\"color:red\" id=\"id18mvac"+i+"\"></p></td>";
cell5.innerHTML="<input id = \"id18vad"+i+"\" class=\"form-control\" type=\"text\" name=\"status3"+i+"\" value = \""+status[i-1]+"\" onchange = \"myfunctionva14("+i+")\"><p style=\"color:red\" id=\"id18mvad"+i+"\"></p></td>";
cell6.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count3\" value=\""+i+"\"></td>";

}
}

}
</script>
</head>

<tr>
<td>
<table id="Table18b" border = "1">

<tr>

<th>Sr.No &nbsp; &nbsp; &nbsp;</th>
<th>Title &nbsp; &nbsp; &nbsp;</th>
<th>Sponsoring Agency &nbsp; &nbsp; &nbsp;</th>
<th>Value (in<br/>Lakhs) &nbsp; &nbsp; &nbsp;</th>
<th>Status &nbsp; &nbsp; &nbsp;</th>

</tr>

<!--
<tr>
<td>1.</td>
<td><input type="text" name="title31"></td>
<td><input type="text" name="spon31"></td>
<td><input type="number" name="val31"></td>
<td><input type="text" name="status31"></td>
</tr>-->


</table>
<?php 
if ($num_rows3 !=0)
  {
  			echo "<script> add_row18b(".$num_rows3."); </script>";
  }
  	?>


<br/>
									<button type="button" class="btn btn-sm btn-primary" onclick="<?php echo "add_row18b(0)";?>">Insert new row</button>
</td></tr>
</table>

<script type="text/javascript">
var count4 = 0;

function add_row19a(cnt)
{

if(cnt == -1 || cnt == 0)
{
    count4 = count4+1;
    if(cnt == -1)
    {
        count4 = 1;
    }
var table=document.getElementById("Table19a");
var row=table.insertRow(count4);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);

cell1.innerHTML=count4+".";
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"undergrad_courses"+count4+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count4\" value=\""+count4+"\"></td>";
}

else
{
count4 = cnt;
var sno= <?php echo json_encode($sno3); ?>;
var title= <?php echo json_encode($undergrad_courses_details); ?>;
for( var i=1;i<=count4;i++)
{
var table=document.getElementById("Table19a");
var row=table.insertRow(i);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);


cell1.innerHTML=sno[i-1];
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"undergrad_courses"+i+"\" value = \""+title[i-1]+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count4\" value=\""+i+"\"></td>";
}
}

}
</script>

<script type="text/javascript">
var count5 = 0;

function add_row19b(cnt)
{

if(cnt == -1 || cnt == 0)
{
    count5 = count5+1;
    if(cnt == -1)
    {
        count5 = 1;
    }
var table=document.getElementById("Table19b");
var row=table.insertRow(count5);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);

cell1.innerHTML=count5+".";
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"postgrad_courses"+count5+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count5\" value=\""+count5+"\"></td>";
}

else
{
count5 = cnt;
var sno= <?php echo json_encode($sno4); ?>;
var title= <?php echo json_encode($postgrad_courses_details); ?>;
for( var i=1;i<=count5;i++)
{
var table=document.getElementById("Table19b");
var row=table.insertRow(i);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);


cell1.innerHTML=sno[i-1];
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"postgrad_courses"+i+"\" value = \""+title[i-1]+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count5\" value=\""+i+"\"></td>";
}
}

}
</script>

<script type="text/javascript">
var count6 = 0;

function add_row20(cnt)
{

if(cnt == -1 || cnt == 0)
{
    count6 = count6+1;
    if(cnt == -1)
    {
        count6 = 1;
    }
var table=document.getElementById("Table20");
var row=table.insertRow(count6);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);

cell1.innerHTML=count6+".";
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"short_courses"+count6+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count6\" value=\""+count6+"\"></td>";
}

else
{
count6 = cnt;
var sno= <?php echo json_encode($sno5); ?>;
var title= <?php echo json_encode($short_courses_details); ?>;
for( var i=1;i<=count6;i++)
{
var table=document.getElementById("Table20");
var row=table.insertRow(i);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);


cell1.innerHTML=sno[i-1];
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"short_courses"+i+"\" value = \""+title[i-1]+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count6\" value=\""+i+"\"></td>";
}
}

}
</script>

<script type="text/javascript">
var count7=0;

function add_row21(cnt)
{

if(cnt == -1 || cnt == 0)
{
    count7 = count7+1;
    if(cnt == -1)
    {
        count7 = 1;
    }
var table=document.getElementById("Table21");
var row=table.insertRow(count7);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);

cell1.innerHTML=count7+".";
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"patents"+count7+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count7\" value=\""+count7+"\"></td>";
}

else
{
count7 = cnt;
var sno= <?php echo json_encode($sno6); ?>;
var title= <?php echo json_encode($patents_details); ?>;
for( var i=1;i<=count7;i++)
{
var table=document.getElementById("Table21");
var row=table.insertRow(i);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);


cell1.innerHTML=sno[i-1];
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"patents"+i+"\" value = \""+title[i-1]+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count7\" value=\""+i+"\"></td>";
}
}

}
</script>

<script type="text/javascript">
var count8=0;

function add_row22(cnt)
{

if(cnt == -1 || cnt == 0)
{
    count8 = count8+1;
    if(cnt == -1)
    {
        count8 = 1;
    }
var table=document.getElementById("Table22");
var row=table.insertRow(count8);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);

cell1.innerHTML=count8+".";
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"administrative"+count8+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count8\" value=\""+count8+"\"></td>";
}

else
{
count8 = cnt;
var sno= <?php echo json_encode($sno7); ?>;
var title= <?php echo json_encode($administrative_details); ?>;
for( var i=1;i<=count8;i++)
{
var table=document.getElementById("Table22");
var row=table.insertRow(i);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);


cell1.innerHTML=sno[i-1];
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"administrative"+i+"\" value = \""+title[i-1]+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count8\" value=\""+i+"\"></td>";
}
}

}
</script>

<script type="text/javascript">
var count9=0;

function add_row23(cnt)
{

if(cnt == -1 || cnt == 0)
{
    count9 = count9+1;
    if(cnt == -1)
    {
        count9 = 1;
    }
var table=document.getElementById("Table23");
var row=table.insertRow(count9);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);

cell1.innerHTML=count9+".";
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"membership"+count9+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count9\" value=\""+count9+"\"></td>";
}

else
{
count9 = cnt;
var sno= <?php echo json_encode($sno8); ?>;
var title= <?php echo json_encode($membership_details); ?>;
for( var i=1;i<=count9;i++)
{
var table=document.getElementById("Table23");
var row=table.insertRow(i);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);


cell1.innerHTML=sno[i-1];
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"membership"+i+"\" value = \""+title[i-1]+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count9\" value=\""+i+"\"></td>";
}
}

}
</script>

<script type="text/javascript">
var count10=0;

function add_row24(cnt)
{

if(cnt == -1 || cnt == 0)
{
    count10 = count10+1;
    if(cnt == -1)
    {
        count10 = 1;
    }
var table=document.getElementById("Table24");
var row=table.insertRow(count10);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);

cell1.innerHTML=count10+".";
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"honors"+count10+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count10\" value=\""+count10+"\"></td>";
}

else
{
count10 = cnt;
var sno= <?php echo json_encode($sno9); ?>;
var title= <?php echo json_encode($honors_awards); ?>;
for( var i=1;i<=count10;i++)
{
var table=document.getElementById("Table24");
var row=table.insertRow(i);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);


cell1.innerHTML=sno[i-1];
cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"honors"+i+"\" value = \""+title[i-1]+"\"></td>";
cell3.innerHTML="<input class=\"form-control\" type=\"hidden\" name=\"count10\" value=\""+i+"\"></td>";
}
}

}
</script>
<table class="table table-striped" id="myTable">
<tr><td>19. Courses Handled</td></tr>


<tr><td>a)Undergraduate Level</td></tr>
<!--<td><textarea class="form-control" rows="15" cols="100" name="courses_undergrad">
<?php echo $courses_undergrad ;?>
</textarea></td>
!-->
<tr>
<td>
<table id="Table19a" border = "1">
<col width="100">
<col width="1000">
<tr>

<th>Sr.No &nbsp; &nbsp; &nbsp;</th>
<th>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Courses <br/>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; details</th>
</tr>

</table>
</td>
</tr>

<?php 
if ($num_rows4 !=0)
  {
            echo "<script> add_row19a(".$num_rows4."); </script>";
  }
    ?>

<tr>
<td>
<button type="button" class="btn btn-sm btn-primary" onclick="<?php echo "add_row19a(0)";?>">Insert new row</button>
</td>
</tr>



<tr><td>b)Postgraduate Level</td></tr>

<tr>
<td>
<table id="Table19b" border = "1">
<col width="100">
<col width="1000">
<tr>

<th>Sr.No &nbsp; &nbsp; &nbsp;</th>
<th>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Courses <br/>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; details</th>
</tr>

</table>
</td>
</tr>

<?php 
if ($num_rows5 !=0)
  {
            echo "<script> add_row19b(".$num_rows5."); </script>";
  }
?>

<tr>
<td>
<button type="button" class="btn btn-sm btn-primary" onclick="<?php echo "add_row19b(0)";?>">Insert new row</button>
</td>
</tr>


<tr><td>20. Short courses / Workshops /Seminars organized</td></tr>


<tr>
<td>
<table id="Table20" border = "1">
<col width="100">
<col width="1000">
<tr>

<th>Sr.No &nbsp; &nbsp; &nbsp;</th>
<th>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Courses <br/>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; details</th>
</tr>

</table>
</td>
</tr>

<?php 
if ($num_rows6 !=0)
  {
            echo "<script> add_row20(".$num_rows6."); </script>";
  }
?>

<tr>
<td>
<button type="button" class="btn btn-sm btn-primary" onclick="<?php echo "add_row20(0)";?>">Insert new row</button>
</td>
</tr>

<tr><td>21. Details of Patents (if any)</td></tr>


<tr>
<td>
<table id="Table21" border = "1">
<col width="100">
<col width="1000">
<tr>

<th>Sr.No &nbsp; &nbsp; &nbsp;</th>
<th>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Patents <br/>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; details</th>
</tr>

</table>
</td>
</tr>

<?php 
if ($num_rows7 !=0)
  {
            echo "<script> add_row21(".$num_rows7."); </script>";
  }
?>

<tr>
<td>
<button type="button" class="btn btn-sm btn-primary" onclick="<?php echo "add_row21(0)";?>">Insert new row</button>
</td>
</tr>

<tr><td>22. Administrative Experience (if any)</td></tr>

<tr>
<td>
<table id="Table22" border = "1">
<col width="100">
<col width="1000">
<tr>

<th>Sr.No &nbsp; &nbsp; &nbsp;</th>
<th>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Patents <br/>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; details</th>
</tr>

</table>
</td>
</tr>

<?php 
if ($num_rows8 !=0)
  {
            echo "<script> add_row22(".$num_rows8."); </script>";
  }
?>

<tr>
<td>
<button type="button" class="btn btn-sm btn-primary" onclick="<?php echo "add_row22(0)";?>">Insert new row</button>
</td>
</tr>



<tr><td>23. Membership of Professional Bodies (Give only Life Memberships, if any) </td></tr>

<tr>
<td>
<table id="Table23" border = "1">
<col width="100">
<col width="1000">
<tr>

<th>Sr.No &nbsp; &nbsp; &nbsp;</th>
<th>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Life Membership <br/>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; details</th>
</tr>

</table>
</td>
</tr>

<?php 
if ($num_rows9 !=0)
  {
            echo "<script> add_row23(".$num_rows9."); </script>";
  }
?>

<tr>
<td>
<button type="button" class="btn btn-sm btn-primary" onclick="<?php echo "add_row23(0)";?>">Insert new row</button>
</td>
</tr>


<tr><td>24. Honors and Awards</td></tr>

<tr>
<td>
<table id="Table24" border = "1">
<col width="100">
<col width="1000">
<tr>

<th>Sr.No &nbsp; &nbsp; &nbsp;</th>
<th>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Honors<br/>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; and awards</th>
</tr>

</table>
</td>
</tr>

<?php 
if ($num_rows10 !=0)
  {
            echo "<script> add_row24(".$num_rows10."); </script>";
  }
?>

<tr>
<td>
<button type="button" class="btn btn-sm btn-primary" onclick="<?php echo "add_row24(0)";?>">Insert new row</button>
</td>
</tr>

</table>
						<div class="text-center">
							<input type="submit" class="btn btn-sm btn-info" name = "submitted_val" value="Save">
							<input type="submit" class="btn btn-sm btn-success" name = "submitted_val1" value="Save & Next">
						</div>

</form>
</div>
</div>
</body>
</html>
<?php include 'footer.php'; ?>


