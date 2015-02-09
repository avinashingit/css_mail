<?php include 'externalLinks.php';?>
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

	$count1 = $_REQUEST['count1'];
	$num_rows1 = $count1;

	for($i = 0,$j=1 ; $i<$count1 ; $i++)
	{
		$sno[$i] = $j;
		$name[$i] = $_REQUEST['emp_name'.$j];
		$designation[$i] = $_REQUEST['desig'.$j];
		$doj[$i] = $_REQUEST['doj'.$j];
		$dol[$i] = $_REQUEST['dol'.$j];
		$duration[$i] = $_REQUEST['duration'.$j];
		$scale[$i] = $_REQUEST['pay'.$j];	

		$query = "INSERT INTO work_experience (userid,sno,name,designation,doj,dol,duration,scale) VALUES ($usrid1,$j,'$name[$i]','$designation[$i]','$doj[$i]','$dol[$i]','$duration[$i]','$scale[$i]')";
		$j=$j+1;
		//echo gettype($doj[$i]);
		//var_dump(checkdate($doj[$i]));
		//if (!preg_match('/[^a-zA-Z.]/', $name[$i]) && !preg_match('/[^a-zA-Z]/', $designation[$i]) && )
		mysqli_query($con,$query);

	}

	$count2 = $_REQUEST['count2'];
	$num_rows2 = $count2;


	for($i = 0,$j=1; $i<$count2 ; $i++)
	{
		$sno1[$i] = $j;
		$title[$i] = $_REQUEST['title2'.$j];
		$agency[$i] = $_REQUEST['spon2'.$j];
		$value[$i] = $_REQUEST['val2'.$j];
		$status[$i] = $_REQUEST['status2'.$j];

		$query = "INSERT INTO spons_principal (userid,sno,title,agency,value,status) VALUES ($usrid1,$j,'$title[$i]','$agency[$i]','$value[$i]','$status[$i]')";


		mysqli_query($con,$query);
		$j=$j+1;

	}



	$count3 = $_REQUEST['count3'];
	$num_rows3 = $count3;

	for($i = 0,$j=1 ; $i<$count3 ; $i++)
	{
		$sno2[$i] = $j;
		$title1[$i] = $_REQUEST['title3'.$j];
		$agency1[$i] = $_REQUEST['spon3'.$j];
		$value1[$i] = $_REQUEST['val3'.$j];
		$status1[$i] = $_REQUEST['status3'.$j];

		$query = "INSERT INTO spons_co_investigator (userid,sno,title,agency,value,status) VALUES ($usrid1,$j,'$title1[$i]','$agency1[$i]','$value[$i]','$status1[$i]')";


		mysqli_query($con,$query);
		$j=$j+1;
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
		<div class="row">

			<div class="col-md-12">

				<form method="post" class="form" action="form3.php" enctype="multipart/form-data">

<!--changes I made I made -->

<script >
function myfunction1(countfunc)
{
	var inpObj= document.getElementById("id2"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
    		document.getElementById("idm2"+countfunc).innerHTML = "* a-z or A-Z or . are allowed.";
    	
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
}

function myfunction2(countfunc)
{
	var inpObj= document.getElementById("id3"+countfunc);
    var errorinname = /[`~!@#$%^&*()_|\-+=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
    if (errorinname == true)
    {
    		document.getElementById("idm3"+countfunc).innerHTML = "* a-z or A-Z  or . are allowed.";
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

}
function myfunction5(countfunc)
{
	var inpObj= document.getElementById("id6"+countfunc);
	var errorinname = /(\d{2}|\d{1})[-](\d{2}|\d{1})/.exec(inpObj.value);
	var errorinname2 = /[`~!@#$%^&*()_|+=?;:'",<>\{\}\[\]\\\/]|[a-zA-Z]/.test(inpObj.value);

	if (errorinname == null || errorinname2==true)
    {
    		document.getElementById("idm6"+countfunc).innerHTML = "* years and months should be seperated by \"-\".";
    }
    else
    {
    	if (inpObj.value[2]=="-")
    	{
    		if (inpObj.value.substr(3,5) > 12)
    		{
    			document.getElementById("idm6"+countfunc).innerHTML = "* months can not be more than 12.";
    		}
    	}
    	else
    	{
    		if (inpObj.value.substr(2,4) > 12)
    		{
    			document.getElementById("idm6"+countfunc).innerHTML = "* months can not be more than 12.";
    		}
    	}
    }

}

function myfunctionva5(countfunc)
{
	var inpObj= document.getElementById("idva6"+countfunc);
	var errorinname = /(\d{2}|\d{1})[-](\d{2}|\d{1})/.exec(inpObj.value);
	var errorinname2 = /[`~!@#$%^&*()_|+=?;:'",<>\{\}\[\]\\\/]|[a-zA-Z]/.test(inpObj.value);

	if (errorinname == null || errorinname2==true)
    {
    		document.getElementById("idmva6"+countfunc).innerHTML = "* years and months should be seperated by \"-\".";
    }
    else
    {
    	if (inpObj.value[2]=="-")
    	{
    		if (inpObj.value.substr(3,5) > 12)
    		{
    			document.getElementById("idmva6"+countfunc).innerHTML = "* months can not be more than 12.";
    		}
    	}
    	else
    	{
    		if (inpObj.value.substr(2,4) > 12)
    		{
    			document.getElementById("idmva6"+countfunc).innerHTML = "* months can not be more than 12.";
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
}

function myfunctionva6(countfunc)
{
	var inpObj= document.getElementById("idva7"+countfunc);
	var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]|[a-z]|[A-Z]/.test(inpObj.value);
	if (errorinname == true)
    {
    		document.getElementById("idmva7"+countfunc).innerHTML = "* only positive numbers are allowed.";
    }
}
</script>

<!--changes I made finish
myfunction6 is not checking for lphabets in salary.
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
cell4.innerHTML="<input id =\"id4"+count1+"\" type=\"text\" name=\"doj"+count1+"\" value = \"yyyy-mm-dd\" size=\"14\" onchange = \"myfunction3("+count1+")\"><p style=\"color:red\" id=\"idm4"+count1+"\"></p></td>";
cell5.innerHTML="<input id =\"id5"+count1+"\" type=\"text\" name=\"dol"+count1+"\" value = \"yyyy-mm-dd\" size=\"14\" onchange = \"myfunction4("+count1+")\"><p style=\"color:red\" id=\"idm5"+count1+"\"></p></td>";
cell6.innerHTML="<input id =\"id6"+count1+"\" class=\"form-control\" type=\"text\" name=\"duration"+count1+"\" size=\"5\" onchange = \"myfunction5("+count1+")\"><p style=\"color:red\" id=\"idm6"+count1+"\"></p> </td>";
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
cell4.innerHTML="<input id =\"idva4"+i+"\" type=\"text\" name=\"doj"+i+"\" size=\"14\" value = \""+doj[i-1]+"\" onchange = \"myfunctionva3("+i+")\"><p style=\"color:red\" id=\"idmva4"+i+"\"></p></td>";
cell5.innerHTML="<input id =\"idva5"+i+"\" type=\"text\" name=\"dol"+i+"\" size=\"14\" value = \""+dol[i-1]+"\" onchange = \"myfunctionva4("+i+")\"><p style=\"color:red\" id=\"idmva5"+i+"\"></p></td>";
cell6.innerHTML="<input id =\"idva6"+i+"\" class=\"form-control\" type=\"text\" name=\"duration"+i+"\" size=\"5\" value = \""+duration[i-1]+"\" onchange = \"myfunctionva5("+i+")\"><p style=\"color:red\" id=\"idmva6"+i+"\"></p></td>";
cell7.innerHTML="<input id =\"idva7"+i+"\" class=\"form-control\" type=\"number\" name=\"pay"+i+"\" value = \""+scale[i-1]+"\" onchange = \"myfunctionva6("+i+")\"><p style=\"color:red\" id=\"idmva7"+i+"\"></p></td>";

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

<th>Sr.No &nbsp &nbsp &nbsp</th>
<th>Name of the &nbsp &nbsp &nbsp<br/>Employer &nbsp &nbsp &nbsp</th>
<th>Designation &nbsp &nbsp &nbsp</th>
<th>Date of &nbsp &nbsp &nbsp<br/>Joining &nbsp &nbsp &nbsp<br/>yyyy-mm-dd &nbsp &nbsp &nbsp</th>
<th>Date of &nbsp &nbsp &nbsp<br/>Leaving &nbsp &nbsp &nbsp<br/>yyyy-mm-dd &nbsp &nbsp &nbsp</th>
<th>Duration &nbsp &nbsp &nbsp<br/>[YY-MM] &nbsp &nbsp &nbsp</th>
<th>Scale + Grade &nbsp &nbsp &nbsp<br/>Pay/Total Pay &nbsp &nbsp &nbsp<br/>(per month) last &nbsp &nbsp &nbsp<br/>drawn (in Rs) &nbsp &nbsp &nbsp</th>
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

<script >
function myfunction7()
{
	var inpObj= document.getElementById("id17a");
	var errorinname = /[.\-]|[a-z]|[A-Z]/.test(inpObj.value);
	if (errorinname==true)
	{
		document.getElementById("id17ma").innerHTML = "* only positive integers are valid.";
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
}

function myfunction9()
{
	var inpObj= document.getElementById("id17c");
	var errorinname = /[.\-]|[a-z]|[A-Z]/.test(inpObj.value);
	if (errorinname==true)
	{
		document.getElementById("id17mc").innerHTML = "* only positive integers are valid.";
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
}
</script>


<tr>
<td>17. Number of Student Projects Guided (mention only viva completed/graduated student details):<span style="color:red;">*</span>
</td>
</tr>

<tr>
<td>
<table>

<tr>
<td>Undergraduate (B.Tech/B.E/B.Sc)
<input  id = "id17a" class="form-control" type="number" name="undergrad" value="<?php echo $undergrad;?>" size="2" onchange = "myfunction7()"><p style ="color:red" id = "id17ma" ></p></td>


<td>Reseach Degree (MS/M.Phil)
<input  id = "id17b" class="form-control" type="number" name="research_deg" value="<?php echo $research_deg;?>" size="2" onchange = "myfunction8()"><p style ="color:red" id = "id17mb" ></p> </td>

</tr>
<tr>
<td>Postgraduate (M.Tech/M.E/M.Sc)
<input  id ="id17c" class="form-control" type="number" name="postgrad" value="<?php echo $postgrad;?>" size="2" onchange = "myfunction9()"><p style ="color:red" id = "id17mc" ></p></td>


<td>Doctoral(Ph.D)
<input  id="id17d" class="form-control" type="number" name="doctoral" value="<?php echo $doctoral;?>" size="2" onchange = "myfunction10()"><p style ="color:red" id = "id17md" ></p></td>

</tr>
</table>
</td>
</tr>
</table>
<table class="table table-striped" id="myTable">

<tr><td>18. Sponsored Projects / Industrial Consultancy handled</td></tr>

<tr><td>(a) As Principal Investigator</td></tr>

<head>

<script>
function myfunction11(countfunc)
{
	var inpObj= document.getElementById("id18a"+countfunc);
	var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[a-z]|[A-Z]/.test(inpObj.value);
	if (errorinname == true)
    {
    		document.getElementById("id18ma"+countfunc).innerHTML = "* only positive numbers are allowed.";
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
}

function myfunction12(countfunc)
{
	var inpObj= document.getElementById("id18b"+countfunc);
	var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
	if (errorinname == true)
    {
    		document.getElementById("id18mb"+countfunc).innerHTML = "you have to use only a-z or A-Z.";
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
}
</script>

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
cell4.innerHTML="<input id = \"id18a"+count2+"\" class=\"form-control\" type=\"number\" step = \"any\" name=\"val2"+count2+"\" onchange = \"myfunction11("+count2+")\"><p style=\"color:red\" id=\"id18ma"+count2+"\"></p></td>";
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
cell4.innerHTML="<input id = \"id18vaa"+i+"\" class=\"form-control\" type=\"number\" step = \"any\" name=\"val2"+i+"\" value = \""+value[i-1]+"\" onchange = \"myfunctionva11("+i+")\"><p style=\"color:red\" id=\"id18mvaa"+i+"\"></p></td>";
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

<th>Sr.No &nbsp &nbsp &nbsp</th>
<th>Title &nbsp &nbsp &nbsp</th>
<th>Sponsoring Agency &nbsp &nbsp &nbsp</th>
<th>Value (in<br/>Lakhs) &nbsp &nbsp &nbsp</th>
<th>Status &nbsp &nbsp &nbsp</th>

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

<script>
function myfunction13(countfunc)
{
	var inpObj= document.getElementById("id18c"+countfunc);
	var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[a-z]|[A-Z]/.test(inpObj.value);
	if (errorinname == true)
    {
    		document.getElementById("id18mc"+countfunc).innerHTML = "* only positive numbers are allowed.";
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
}

function myfunction14(countfunc)
{
	var inpObj= document.getElementById("id18d"+countfunc);
	var errorinname = /[`~!@#$%^&*()_|+\-=?;:'",<>\{\}\[\]\\\/]|[0-9]/.test(inpObj.value);
	if (errorinname == true)
    {
    		document.getElementById("id18md"+countfunc).innerHTML = "you have to use only a-z or A-Z.";
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
}
</script>>
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
cell4.innerHTML="<input id = \"id18c"+count3+"\" class=\"form-control\" type=\"number\" step = \"any\" name=\"val3"+count3+"\" onchange = \"myfunction13("+count3+")\"><p style=\"color:red\" id=\"id18mc"+count3+"\"></p></td>";
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
cell4.innerHTML="<input id = \"id18vac"+i+"\" class=\"form-control\" type=\"number\" step = \"any\" name=\"val3"+i+"\" value = \""+value[i-1]+"\" onchange = \"myfunctionva13("+i+")\"><p style=\"color:red\" id=\"id18mvac"+i+"\"></p></td>";
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

<th>Sr.No &nbsp &nbsp &nbsp</th>
<th>Title &nbsp &nbsp &nbsp</th>
<th>Sponsoring Agency &nbsp &nbsp &nbsp</th>
<th>Value (in<br/>Lakhs) &nbsp &nbsp &nbsp</th>
<th>Status &nbsp &nbsp &nbsp</th>

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
<table class="table table-striped" id="myTable">
<tr><td>19. Courses Handled</td></tr>


<tr><td>Undergraduate Level</td>
<td><textarea class="form-control" rows="15" cols="100" name="courses_undergrad">
<?php echo $courses_undergrad ;?>
</textarea></td>
</tr>

<tr><td>Postgraduate Level</td>
<td>
<textarea class="form-control" rows="15" cols="100" name="courses_postgrad">
<?php echo $courses_postgrad;?>
</textarea></td>
</tr>


<tr><td>20. Short courses / Workshops /Seminars organized</td>

<td>
<textarea class="form-control" rows="5" cols="50" name="wrkshps">
<?php echo $wrkshps;?>
</textarea></td>
</tr>

<tr><td>21. Details of Patents (if any)</td>

<td>
<textarea class="form-control" rows="5" cols="50" name="patents">
<?php echo $patents;?>
</textarea></td>
</tr>

<tr>
<td>22. Administrative Experience (if any)</td>
<td>
<textarea class="form-control" rows="5" cols="50" name="experience">
<?php echo $experience;?>
</textarea></td>
</tr>

<tr><td>23. Membership of Professional Bodies (Give only Life Memberships, if any) </td>

<td>
<textarea class="form-control" rows="5" cols="50" name="memberships">
<?php echo $memberships;?>
</textarea></td>
</tr>

<tr>
<td>24. Honors and Awards</td>

<td>
<textarea class="form-control" rows="5" cols="50" name="awards">
<?php echo $awards;?>
</textarea>
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


