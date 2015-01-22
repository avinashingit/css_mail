<?php include 'form3_h.php'; ?>
<?php include 'check.php'; ?>
<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	//echo "<script> add_row16(1); </script>";

	// Create connection
	$con=mysqli_connect("localhost","root","root","faculty_recruitment");

	// Check connection
	if (mysqli_connect_errno($con))
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
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

	function create_row1()
	{
		global $num_rows1;
		if($num_rows1 == 0)  //empty table
		{
			$num_rows1 = -1;
		}

		echo "<script> add_row16(".$num_rows1."); </script>";
	}




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

	function create_row2()
	{
		global $num_rows2;
		if($num_rows2 == 0)
		{
			$num_rows2= -1;
		}

		echo "<script> add_row18a(".$num_rows2."); </script>";
	}




	$retrieve = "SELECT * FROM spons_co_investigator where userid = $usrid1";

	$result = mysqli_query($con,$retrieve);

	$num_rows3 = mysqli_num_rows($result);

	while($row = mysqli_fetch_array($result))
  	{
		$sno1[] = $row['sno'];
		$title1[] = $row['title'];
		$agency1[] = $row['agency'];
		$value1[] = $row['value'];
		$status1[] = $row['status'];
  	}

	function create_row3()
	{
		global $num_rows3;
		if($num_rows3 == 0)
		{
			$num_rows3= -1;
		}

		echo "<script> add_row18b(".$num_rows3."); </script>";
	}


	$count1 = $_REQUEST['count1'];


if(isset($_POST[submitted_val]) || isset($_POST[submitted_val1])) 
{

	echo "<br/><span style='color:green;'>Professional Activities SAVED</span>";

	$undergrad = $_REQUEST['undergrad'];
	$research_deg = $_REQUEST['research_deg'];
	$postgrad = $_REQUEST['postgrad'];
	$doctoral = $_REQUEST['doctoral'];
	$courses_undergrad = $_REQUEST['courses_undergrad'];
	$courses_postgrad = $_REQUEST['courses_postgrad'];
	$wrkshps = $_REQUEST['wrkshps'];
	$patents = $_REQUEST['patents'];
	$experience = $_REQUEST['experience'];
	$memberships = $_REQUEST['memberships'];
	$awards = $_REQUEST['awards'];


/*		if(strlen($_POST['undergrad']) == 0 || strlen($_POST['research_deg'])==0 || strlen($_POST['postgrad'])==0 || strlen($_POST['doctoral'])==0) 
        	{
			echo "Error : All entries of Field 17 need to be filled (fill 0 if NA)";
		}
		

	else*/ 
       	{

	mysqli_query($con,"delete from work_experience where userid=$usrid1");
	mysqli_query($con,"delete from spons_principal where userid=$usrid1");
	mysqli_query($con,"delete from spons_co_investigator where userid=$usrid1");
	mysqli_query($con,"delete from form3 where userid=$usrid1");


	for($i = 1 ; $i<=$count1 ; $i++)
	{
		$name = $_REQUEST['emp_name'.$i];
		$designation = $_REQUEST['desig'.$i];
		$doj = $_REQUEST['doj'.$i];
		$dol = $_REQUEST['dol'.$i];
		$duration = $_REQUEST['duration'.$i];
		$scale = $_REQUEST['pay'.$i];	

		$query = "INSERT INTO work_experience (userid,sno,name,designation,doj,dol,duration,scale) VALUES ($usrid1,$i,'$name','$designation','$doj','$dol','$duration','$scale')";


		mysqli_query($con,$query);

	}


	$count2 = $_REQUEST['count2'];


	for($i = 1 ; $i<=$count2 ; $i++)
	{
		$title = $_REQUEST['title2'.$i];
		$agency = $_REQUEST['spon2'.$i];
		$value = $_REQUEST['val2'.$i];
		$status = $_REQUEST['status2'.$i];

		$query = "INSERT INTO spons_principal (userid,sno,title,agency,value,status) VALUES ($usrid1,$i,'$title','$agency','$value','$status')";


		mysqli_query($con,$query);

	}



	$count3 = $_REQUEST['count3'];


	for($i = 1 ; $i<=$count3 ; $i++)
	{
		$title = $_REQUEST['title3'.$i];
		$agency = $_REQUEST['spon3'.$i];
		$value = $_REQUEST['val3'.$i];
		$status = $_REQUEST['status3'.$i];

		$query = "INSERT INTO spons_co_investigator (userid,sno,title,agency,value,status) VALUES ($usrid1,$i,'$title','$agency','$value','$status')";


		mysqli_query($con,$query);

	}


	$query1 = "INSERT INTO form3 (userid,undergrad,postgrad,doctoral,research_deg,courses_undergrad,courses_postgrad,wrkshps,patents,experience,memberships,awards,submitted) VALUES ($usrid1,'$undergrad','$postgrad','$doctoral','$research_deg','$courses_undergrad','$courses_postgrad','$wrkshps','$patents','$experience','$memberships','$awards',0)";


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
<body>

<form method="post" action="form3.php" enctype="multipart/form-data">

<script type="text/javascript">
var count1 = 1;

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
cell2.innerHTML="<input type=\"text\" name=\"emp_name"+count1+"\"></td>";
cell3.innerHTML="<input type=\"text\" name=\"desig"+count1+"\"></td>";
cell4.innerHTML="<input type=\"date\" name=\"doj"+count1+"\" size=\"8\"></td>";
cell5.innerHTML="<input type=\"date\" name=\"dol"+count1+"\" size=\"8\"></td>";
cell6.innerHTML="<input type=\"text\" name=\"duration"+count1+"\" size=\"5\"></td>";
cell7.innerHTML="<input type=\"number\" name=\"pay"+count1+"\"></td>";

cell8.innerHTML="<input type=\"hidden\" name=\"count1\" value=\""+count1+"\"></td>";
}


else
{
count1 = cnt;
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


var sno= <?php echo json_encode($sno); ?>;
var name= <?php echo json_encode($name); ?>;
var designation= <?php echo json_encode($designation); ?>;
var doj= <?php echo json_encode($doj); ?>;
var dol= <?php echo json_encode($dol); ?>;
var duration= <?php echo json_encode($duration); ?>;
var scale = <?php echo json_encode($scale); ?>;

cell1.innerHTML=sno[i-1];

cell2.innerHTML="<input type=\"text\" name=\"emp_name"+i+"\" value = \""+name[i-1]+"\" ></td>";
cell3.innerHTML="<input type=\"text\" name=\"desig"+i+"\" value = \""+designation[i-1]+"\"></td>";
cell4.innerHTML="<input type=\"date\" name=\"doj"+i+"\" size=\"8\" value = \""+doj[i-1]+"\"></td>";
cell5.innerHTML="<input type=\"date\" name=\"dol"+i+"\" size=\"8\" value = \""+dol[i-1]+"\"></td>";
cell6.innerHTML="<input type=\"text\" name=\"duration"+i+"\" size=\"5\" value = \""+duration[i-1]+"\"></td>";
cell7.innerHTML="<input type=\"number\" name=\"pay"+i+"\" value = \""+scale[i-1]+"\"></td>";

cell8.innerHTML="<input type=\"hidden\" name=\"count1\" value=\""+i+"\"></td>";
}
}

}
</script>
<span style="color:red;">* required fields</span><br/><br/><br/>
16. Work Experience (in reverse chronological order)
<br/>
<br/>

<table id="Table16" border="1">

<tr>

<th>Sr.No</th>
<th>Name of the<br/>Employer</th>
<th>Designation</th>
<th>Date of<br/>Joining<br/>yyyy-mm-dd</th>
<th>Date of<br/>Leaving<br/>yyyy-mm-dd</th>
<th>Duration<br/>[YY-MM]</th>
<th>Scale + Grade<br/>Pay/Total Pay<br/>(per month) last<br/>drawn (in Rs)</th>
</tr>

<!--
<tr>
<td>1.</td>
<td><input type="text" name="emp_name1"></td>
<td><input type="text" name="desig1"></td>
<td><input type="date" name="doj1"size="8"></td>
<td><input type="date" name="dol1"size="8"></td>
<td><input type="text" name="duration1"size="5"></td>
<td><input type="number" name="pay1"></td>
</tr>-->

</table> 

<?php 	create_row1(); ?>


<br/>
<button type="button" onclick="<?php echo "add_row16(0)";?>">Insert new row</button>


<br/>
<br/>
17. Number of Student Projects Guided (mention only viva completed/graduated student details):<span style="color:red;">*</span>
<br/>
<br/>

<table>

<tr>
<td>Undergraduate (B.Tech/B.E/B.Sc)
<input type="number" name="undergrad" value="<?php echo $undergrad;?>" size="2"></td>


<td>Reseach Degree (MS/M.Phil)
<input type="number" name="research_deg" value="<?php echo $research_deg;?>" size="2"></td>

</tr>


<tr>
<td>Postgraduate (M.Tech/M.E/M.Sc)
<input type="number" name="postgrad" value="<?php echo $postgrad;?>" size="2"></td>


<td>Doctoral(Ph.D)
<input type="number" name="doctoral" value="<?php echo $doctoral;?>" size="2"></td>

</tr>
</table>

<br/>
<br/>
18. Sponsored Projects / Industrial Consultancy handled
<br/>
<br/>


<br/>
(a) As Principal Investigator
<br/>
<br/>

<head>
<script type="text/javascript">
var count2 = 1;
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
cell2.innerHTML="<input type=\"text\" name=\"title2"+count2+"\"></td>";
cell3.innerHTML="<input type=\"text\" name=\"spon2"+count2+"\"></td>";
cell4.innerHTML="<input type=\"number\" name=\"val2"+count2+"\"></td>";
cell5.innerHTML="<input type=\"text\" name=\"status2"+count2+"\"></td>";
cell6.innerHTML="<input type=\"hidden\" name=\"count2\" value=\""+count2+"\"></td>";
}

else
{
count2 = cnt;
for( var i=1;i<=cnt;i++)
{

var table=document.getElementById("Table18a");
var row=table.insertRow(i);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);
var cell4=row.insertCell(3);
var cell5=row.insertCell(4);
var cell6=row.insertCell(5);


var sno= <?php echo json_encode($sno); ?>;
var title= <?php echo json_encode($title); ?>;
var agency= <?php echo json_encode($agency); ?>;
var value= <?php echo json_encode($value); ?>;
var status= <?php echo json_encode($status); ?>;


cell1.innerHTML=sno[i-1];
cell2.innerHTML="<input type=\"text\" name=\"title2"+i+"\" value = \""+title[i-1]+"\"></td>";
cell3.innerHTML="<input type=\"text\" name=\"spon2"+i+"\" value = \""+agency[i-1]+"\"></td>";
cell4.innerHTML="<input type=\"number\" name=\"val2"+i+"\" value = \""+value[i-1]+"\"></td>";
cell5.innerHTML="<input type=\"text\" name=\"status2"+i+"\" value = \""+status[i-1]+"\"></td>";
cell6.innerHTML="<input type=\"hidden\" name=\"count2\" value=\""+i+"\"></td>";

}
}

}
</script>
</head>

<table id="Table18a">

<tr>

<th>Sr.No</th>
<th>Title</th>
<th>Sponsoring Agency</th>
<th>Value (in<br/>Lakhs)</th>
<th>Status</th>

</tr>

<!--<tr>
<td>1.</td>
<td><input type="text" name="title21"></td>
<td><input type="text" name="spon21"></td>
<td><input type="number" name="val21"></td>
<td><input type="text" name="status21"></td>
</tr>-->

</table>

<?php create_row2(); ?>

<br/>
<button type="button" onclick="<?php echo "add_row18a(0)";?>">Insert new row</button>

<br/>
<br/>
(b) As Co Investigator
<br/>
<br/>


<head>
<script type="text/javascript">
var count3 = 1;

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
cell2.innerHTML="<input type=\"text\" name=\"title3"+count3+"\"></td>";
cell3.innerHTML="<input type=\"text\" name=\"spon3"+count3+"\"></td>";
cell4.innerHTML="<input type=\"number\" name=\"val3"+count3+"\"></td>";
cell5.innerHTML="<input type=\"text\" name=\"status3"+count3+"\"></td>";
cell6.innerHTML="<input type=\"hidden\" name=\"count3\" value=\""+count3+"\"></td>";
}


else
{
count3 = cnt;
for( var i=1;i<=cnt;i++)
{

var table=document.getElementById("Table18b");
var row=table.insertRow(i);
var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);
var cell4=row.insertCell(3);
var cell5=row.insertCell(4);
var cell6=row.insertCell(5);


var sno= <?php echo json_encode($sno1); ?>;
var title= <?php echo json_encode($title1); ?>;
var agency= <?php echo json_encode($agency1); ?>;
var value= <?php echo json_encode($value1); ?>;
var status= <?php echo json_encode($status1); ?>;


cell1.innerHTML=sno[i-1];
cell2.innerHTML="<input type=\"text\" name=\"title3"+i+"\" value = \""+title[i-1]+"\"></td>";
cell3.innerHTML="<input type=\"text\" name=\"spon3"+i+"\" value = \""+agency[i-1]+"\"></td>";
cell4.innerHTML="<input type=\"number\" name=\"val3"+i+"\" value = \""+value[i-1]+"\"></td>";
cell5.innerHTML="<input type=\"text\" name=\"status3"+i+"\" value = \""+status[i-1]+"\"></td>";
cell6.innerHTML="<input type=\"hidden\" name=\"count3\" value=\""+i+"\"></td>";

}
}

}
</script>
</head>


<table id="Table18b">

<tr>

<th>Sr.No</th>
<th>Title</th>
<th>Sponsoring Agency</th>
<th>Value (in<br/>Lakhs)</th>
<th>Status</th>

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


<?php create_row3(); ?>

<br/>
<button type="button" onclick="<?php echo "add_row18b(0)";?>">Insert new row</button>

<br/>
<br/>
19. Courses Handled
<br/>
<br/>

Undergraduate Level
<br/>
<textarea rows="15" cols="100" name="courses_undergrad">
<?php echo $courses_undergrad ;?>
</textarea>

<br/>
<br/>
Postgraduate Level
<br/>
<textarea rows="15" cols="100" name="courses_postgrad">
<?php echo $courses_postgrad;?>
</textarea>


<br/>
<br/>
20. Short courses / Workshops /Seminars organized
<br/>
<br/>

<textarea rows="5" cols="50" name="wrkshps">
<?php echo $wrkshps;?>
</textarea>


<br/>
<br/>
21. Details of Patents (if any)
<br/>
<br/>

<textarea rows="5" cols="50" name="patents">
<?php echo $patents;?>
</textarea>


<br/>
<br/>
22. Administrative Experience (if any)
<br/>
<br/>

<textarea rows="5" cols="50" name="experience">
<?php echo $experience;?>
</textarea>


<br/>
<br/>
23. Membership of Professional Bodies (Give only Life Memberships, if any) 
<br/>
<br/>

<textarea rows="5" cols="50" name="memberships">
<?php echo $memberships;?>
</textarea>

<br/>
<br/>
24. Honors and Awards
<br/>
<br/>

<textarea rows="5" cols="50" name="awards">
<?php echo $awards;?>
</textarea>

<br/><input type="submit" name = "submitted_val" value="Save">
<input type="submit" name = "submitted_val1" value="Save & Next">


</form>
</br>
</html>
<?php include 'footer.php'; ?>


