<?php include 'externalLinks.php';?><!-- this file contains all the external css and js files and plugins if any --> 
<?php include 'check.php'; ?>
<?php include 'form_h.php'; ?>

<?php

	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	
	$usrid1 = $_SESSION['userid'];
	if($_GET[a]==1)
	{
		echo "<br/><span style='color:green;'>Personal Details SAVED</span>";
	}


	if(mysqli_num_rows(mysqli_query($con, "select submitted from form2 where userid = $usrid1 and submitted = 1")) > 0)
	{
		echo "Your form is already submitted<br>";
		echo '<p><a href=".">Home</a></p><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
        include 'footer.php';
		exit;
	}


	$retrieve ="SELECT * FROM form2 where userid = $usrid1";

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

if(isset($_POST[submitted_val]) || isset($_POST[submitted_val1])) 
{
	echo "<br/><span style='color:green;'>Publication Details SAVED</span>";

	$intjournals3 = $_REQUEST['intjournals3'];
	$intjournalsoverall = $_REQUEST['intjournalsoverall'];
	$natjournals3 = $_REQUEST['natjournals3'];
	$natjournalsoverall = $_REQUEST['natjournalsoverall'];
	$intconf3 = $_REQUEST['intconf3'];
	$intconfoverall = $_REQUEST['intconfoverall'];
	$natconf3 = $_REQUEST['natconf3'];
	$natconfoverall = $_REQUEST['natconfoverall'];
	
	$p='publications';
	$temp='';
	$i=1;
	while(!($_REQUEST[$p.$i] == '' && $_REQUEST[$p.($i+1)] == '' && $_REQUEST[$p.($i+2)] == '' && $_REQUEST[$p.($i+3)] == '' && $_REQUEST[$p.($i+4)] == '' && $_REQUEST[$p.($i+5)] == '' ))
	{
		$temp=$temp.$_REQUEST[$p.$i].'^'.$_REQUEST[$p.($i+1)].'^'.$_REQUEST[$p.($i+2)].'^'.$_REQUEST[$p.($i+3)].'^'.$_REQUEST[$p.($i+4)].'^'.$_REQUEST[$p.($i+5)].'$';
		$i+=6;
	}
	$publications = $temp;//$_REQUEST['publications'] = $temp;

	if ($intjournalsoverall<$intjournals3) 
	{
		$intjournalsoverall=$intjournals3;
	}
	if ($natjournalsoverall<$natjournals3) 
	{
		$natjournalsoverall=$natjournals3;
	}
	if ($intconfoverall<$intconf3) 
	{
		$intconfoverall=$intconf3;
	}
	if ($natconfoverall<$natconf3) 
	{
		$natconfoverall=$natconf3;
	}
	//$publications = $temp_publications;

	//if($intjournals3=='' || $intjournalsoverall=='' || $natjournals3=='' || $natjournalsoverall=='' || $intconf3=='' || $intconfoverall=='' || $natconf3=='' || $natconfoverall=='' || $publications=='' || $_FILES["paper1"]["name"]=='' || $_FILES["paper2"]["name"]=='' || $_FILES["paper3"]["name"]=='')
	//	k=1;

	//$_REQUEST['publications']=$temp_publications;	
	//$publications = $_REQUEST['publications'];
	//var_dump($_REQUEST['publications']);
	
	/*if(strcmp($_FILES["paper1"]["name"],$_FILES["paper2"]["name"])==0 && strcmp($_FILES["paper1"]["name"],$_FILES["paper2"]["name"])==0 && 	$_FILES['paper1']['name']!='' && $_FILES['paper2']['name']!='' && $_FILES['paper3']['name']!='')
	{
		$message = "Check the files. you might uploading same files or change the name of the files 1,2,3.";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$_FILES['paper2']['name']='';
		$_FILES['paper3']['name']='';
	}
	elseif (strcmp($_FILES["paper1"]["name"],$_FILES["paper2"]["name"])==0 && $_FILES['paper1']['name']!='' && $_FILES['paper2']['name']!='') {
		$message = "Check the files. you might uploading same files or change the name of the files 1,2.";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$_FILES['paper2']['name']='';
	}
	elseif (strcmp($_FILES["paper2"]["name"],$_FILES["paper3"]["name"])==0 && $_FILES['paper2']['name']!='' && $_FILES['paper3']['name']!='') {
		$message = "Check the files. you might uploading same files or change the name of the files 2,3.";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$_FILES['paper3']['name']='';		
	}
	elseif (strcmp($_FILES["paper1"]["name"],$_FILES["paper3"]["name"])==0 && $_FILES['paper1']['name']!='' && $_FILES['paper3']['name']!='') {
		$message = "Check the files. you might uploading same files or change the name of the files 1,3.";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$_FILES['paper3']['name']='';		
	}*/

	mysqli_query($con,"delete from form2 where userid=$usrid1");

	/*$intjournals3 = $_REQUEST['intjournals3'];
	$intjournalsoverall = $_REQUEST['intjournalsoverall'];
	$natjournals3 = $_REQUEST['natjournals3'];
	$natjournalsoverall = $_REQUEST['natjournalsoverall'];
	$intconf3 = $_REQUEST['intconf3'];
	$intconfoverall = $_REQUEST['intconfoverall'];
	$natconf3 = $_REQUEST['natconf3'];
	$natconfoverall = $_REQUEST['natconfoverall'];

	$publications = $_REQUEST['publications'];*/


	//echo "paper1 = " . $_FILES["paper1"]["name"] . "<br>";
	//echo $_FILES["paper1"]["tmp_name"]."<br>";

	if(strlen($_FILES["paper1"]["name"]) != 0)
	{
		// Start upload script
		$allowedExts = array("pdf");
		$extension = explode(".", $_FILES["paper1"]["name"]);
		$extension = end($extension);
		if ((($_FILES["paper1"]["type"] == "application/pdf") && ($_FILES["paper1"]["size"] < 10000000)) && (in_array($extension, $allowedExts)))
		{
  			if ($_FILES["paper1"]["error"] > 0)
    			{
			    	echo "Error uploading paper1. Please try again";
    			}
  			else
    			{
    				//if(move_uploaded_file($_FILES["paper1"]["tmp_name"], $_FILES["paper1"]["name"], "temp_upload/" . $usrid1 ."_paper1." .$extension))
				$paper1 = "upload/" . $usrid1 ."_paper1." .$extension;
				if(move_uploaded_file($_FILES["paper1"]["tmp_name"], $paper1))
					echo "<br><span style='color:green;'>Paper1 saved</span><br>";
				else echo "<br>File not saved<br>";
				//echo "Paper 1 path = ".$paper1;
    			}
		}
		else
  		{
  			echo "Invalid file";
  		}
	
		// End upload script
	}

	// Upload paper-2

	if(strlen($_FILES["paper2"]["name"]) != 0)
	{
		// Start upload script
		$allowedExts = array("pdf");
		$extension = explode(".", $_FILES["paper2"]["name"]);
		$extension = end($extension);

		if ((($_FILES["paper2"]["type"] == "application/pdf") && ($_FILES["paper2"]["size"] < 10000000)) && (in_array($extension, $allowedExts)))
		{
  			if ($_FILES["paper2"]["error"] > 0)
    			{
			    	echo "Error uploading paper2. Please try again";
    			}
  			else
    			{
    				//if(move_uploaded_file($_FILES["paper1"]["tmp_name"], $_FILES["paper1"]["name"], "temp_upload/" . $usrid1 ."_paper1." .$extension))
				$paper2 = "upload/" . $usrid1 ."_paper2." .$extension;
				if(move_uploaded_file($_FILES["paper2"]["tmp_name"], $paper2))
					echo "<br><span style='color:green;'>Paper2 saved</span><br>";
				else echo "<br>File not saved<br>";
    			}
		}
		else
  		{
  			echo "Invalid file";
  		}
	
		// End upload script
	}

	// Upload paper 3

	if(strlen($_FILES["paper3"]["name"]) != 0)
	{
		// Start upload script
		$allowedExts = array("pdf");
		$extension = explode(".", $_FILES["paper3"]["name"]);
		$extension = end($extension);
			
		if ((($_FILES["paper3"]["type"] == "application/pdf") && ($_FILES["paper3"]["size"] < 10000000)) && (in_array($extension, $allowedExts)))
		{
  			if ($_FILES["paper3"]["error"] > 0)
    			{
			    	echo "Error uploading paper3. Please try again";
    			}
  			else
    			{
    				//if(move_uploaded_file($_FILES["paper1"]["tmp_name"], $_FILES["paper1"]["name"], "temp_upload/" . $usrid1 ."_paper1." .$extension))
				$paper3 = "upload/" . $usrid1 ."_paper3." .$extension;
				if(move_uploaded_file($_FILES["paper3"]["tmp_name"], $paper3))
					echo "<br><span style='color:green;'>Paper3 saved</span><br>";
				else echo "<br>File not saved<br>";
				//$paper1 = "temp_upload/" . $usrid1 . "_paper1." . $extension ;
				//echo "Paper 1 path = ".$paper1;
    			}
		}
		else
  		{
  			echo "Invalid file";
  		}
	
		// End upload script

	}

	//echo $_REQUEST['publications'];

// Upload end		
	//echo $intjournals3;


	/*$query = "INSERT INTO form2 (userid,intjournals3,intjournalsoverall,natjournals3,natjournalsoverall,intconf3,intconfoverall,natconf3,
natconfoverall,publications,submitted,paper1,paper2,paper3) VALUES ($usrid1,$intjournals3,$intjournalsoverall,$natjournals3,
$natjournalsoverall,$intconf3,$intconfoverall,$natconf3,$natconfoverall,'$publications',0, '$paper1', '$paper2', '$paper3')";

$query = "INSERT INTO `form2` (`userid`,`intjournals3`,`intjournalsoverall`,`natjournals3`,`natjournalsoverall`,`intconf3`,`intconfoverall`,`natconf3`,
 							   `natconfoverall`,`publications`,`submitted`,`paper1`,`paper2`,`paper3`) 
VALUES ('$usrid1','$intjournals3','$intjournalsoverall','$natjournals3','$natjournalsoverall','$intconf3','$intconfoverall','$natconf3','$natconfoverall',
		'$publications','0','$paper1','$paper2','$paper3')";*/

$query = "INSERT INTO form2 (userid,intjournals3,intjournalsoverall,natjournals3,natjournalsoverall,intconf3,intconfoverall,natconf3,
natconfoverall,publications,submitted,paper1,paper2,paper3) VALUES ('$usrid1','$intjournals3','$intjournalsoverall','$natjournals3',
'$natjournalsoverall','$intconf3','$intconfoverall','$natconf3','$natconfoverall','$publications',0, '$paper1', '$paper2', '$paper3')";

 	mysqli_query($con,$query) or die(mysqli_error($con));

	//echo '<meta http-equiv="REFRESH" content="0;url=saved.php">';
	//echo "Form saved successfully";

	/*	if(isset($_POST[submitted_val]))
			{
			echo '<script language="JavaScript" type="text/javascript">alert("Form SAVED")</script>';
			echo '<meta http-equiv="REFRESH" content="0;url=form2.php">';		
			}*/
        if(isset($_POST[submitted_val1]))
			{
			//echo '<script language="JavaScript" type="text/javascript">alert("Publication Details SAVED")</script>';
			echo '<meta http-equiv="REFRESH" content="0;url=form3.php?a=1">';		
			}	
}
?> 

<script type="text/javascript">
	function check_file(a){
                str=document.getElementById(a).value.toUpperCase();
        suffix=".PDF";
        if(str.indexOf(suffix, str.length - suffix.length) == -1)
        {
        alert('File type not allowed,\nAllowed file: *.PDF');
            document.getElementById(a).value='';
        }
        else if(document.getElementById(a).files[0].size >= 2097152)
        {
        alert("Size of the file should be less than 2MB");
            document.getElementById(a).value='';        		        		
        }	
    }
</script>

<script type="text/javascript">
	var count_cell=1;
	function add_row(cnt0,cnt1,cnt2,cnt3,cnt4,cnt5) {
		var table=document.getElementById("table_pub");
		var row=table.insertRow();
		var cell1=row.insertCell(0);
		var cell2=row.insertCell(1);
		var cell3=row.insertCell(2);
		var cell4=row.insertCell(3);
		var cell5=row.insertCell(4);
		var cell6=row.insertCell(5);
		var cell7=row.insertCell(6);		
		cell2.innerHTML="<input class=\"form-control\" type=\"text\" name=\"publications"+count_cell+"\" pattern=\'[a-zA-Z0-9]{0,100}\' title=\"Only alphanumeric input is valid upto 100 characters\" value=\""+cnt0+"\"></td>";count_cell++;
		cell3.innerHTML="<input class=\"form-control\" type=\"text\" name=\"publications"+count_cell+"\" pattern=\'[a-zA-Z0-9]{0,100}\' title=\"Only alphanumeric input is valid upto 100 characters\" value=\""+cnt1+"\"></td>";count_cell++;
		cell4.innerHTML="<input class=\"form-control\" type=\"text\" name=\"publications"+count_cell+"\" pattern=\'[a-zA-Z0-9]{0,100}\' title=\"Only alphanumeric input is valid upto 100 characters\" value=\""+cnt2+"\"></td>";count_cell++;
		cell5.innerHTML="<input class=\"form-control\" type=\"number\" name=\"publications"+count_cell+"\" value=\""+cnt3+"\" min=\"1950\" max=\"2015\"></td>";count_cell++;
		cell6.innerHTML="<input class=\"form-control\" type=\"number\" name=\"publications"+count_cell+"\" min=\"0\" value=\""+cnt4+"\"></td>";count_cell++;
		cell7.innerHTML="<input class=\"form-control\" type=\"number\" name=\"publications"+count_cell+"\"  min=\"0\" value=\""+cnt5+"\"></td>";
		cell1.innerHTML=(count_cell/6)+". ";	
		count_cell++;

		}

</script>

<script type="text/javascript">
	function greaterthan1(a,b)
	{
		if (document.getElementById(a).value>document.getElementById(b).value && document.getElementById(a).value!='' && document.getElementById(b).value!='')
		{
			alert("Journals published in last 3 years are more than total");
			document.getElementById(a).value='';
		}

	}
	function greaterthan2(a,b)
	{
		if (document.getElementById(a).value>document.getElementById(b).value && document.getElementById(a).value!='' && document.getElementById(b).value!='')
		{
			alert("Journals published in last 3 years are more than total");
			document.getElementById(b).value='';
		}

	}
</script>

<html>
<body>
		<div class="row">

			<div class="col-md-12">

				<form method="post" class="form" action="form2.php" enctype="multipart/form-data">			


<!--
<?php
/*function cal_publications()
{
			echo "hi";
		$count=$_REQUEST['count_cell'];
		for($i =1 ; $i<$count ; $i++)
			{
		 		$temp_pub=$temp_pub.$_REQUEST['publications'.$i].',';
			}
			$temp_pub=$temp_pub.$_REQUEST['publications6'];
		$_REQUEST['publications']=$temp_pub;
}*/
?> -->


<!--<div id="demo"></div>
<script language="JavaScript" type="text/javascript">

//document.write("jbdf");
//document.getElementById('demo').innerHTML +	= "Form has been save";	
/*function GetUrlValue(VarSearch){
    var SearchString = window.location.search.substring(1);
    var VariableArray = SearchString.split('&');
    for(var i = 0; i < VariableArray.length; i++){
        var KeyValuePair = VariableArray[i].split('=');
        if(KeyValuePair[0] == VarSearch){
            return KeyValuePair[1];
        }
    }
}
var count;

/*if(GetUrlValue('a')==0)
{
alert("Form SAVED");
}
/*
if(GetUrlValue('a')==1)
{
	alert("your has been saved");
}
*/
/*if(getUrlVars()["a"]!=0)
{
	document.getElementById('demo').innerHTML +	= "Form1 has been saved heress";
}	*/
  

</script>-->
<br/>
<span style="color:red;"class="text-center">* required fields</span>

<!--<div style="position:right"><span style="color:red;" class="text-center"> Incomplete upload fields will not save the form.</span></div>-->
<br/><br/>


<b>15.Number of Research Publications</b><span style="color:red;">*</span><br/><br/>

<table class="table table-striped" id="myTable">

<tr>
<th>Publication Category</th>
<th class="text-center">Last 3 Years</th>
<th class="text-center">Overall</th>
</tr>

<tr>
<td>International Referred Journals(Published/Accepted only)</td>

<td><input class="form-control" type="number" id="intjournals3" onchange="greaterthan1('intjournals3', 'intjournalsoverall')" name="intjournals3" value="<?php echo $intjournals3;?>" size="7" min="0"></td>
<td><input class="form-control" type="number" id="intjournalsoverall" onchange="greaterthan2('intjournals3', 'intjournalsoverall')" name="intjournalsoverall" value="<?php echo $intjournalsoverall;?>" size="7" min="0"></td>
</tr>

<tr>
<td>National Referred Journals(Published/Accepted only)</td>
<td><input class="form-control" type="number" id="natjournals3" onchange="greaterthan1('natjournals3', 'natjournalsoverall')"  name="natjournals3" value="<?php echo $natjournals3;?>" size="7" min="0"></td>
<td><input class="form-control" type="number" id="natjournalsoverall" onchange="greaterthan2('natjournals3', 'natjournalsoverall')" name="natjournalsoverall" value="<?php echo $natjournalsoverall;?>" size="7" min="0"></td>
</tr>

<tr>
<td>Presentation at International Conferences(Atleast one<br/>author should have presented personally)</td>
<td><input class="form-control" type="number" id="intconf3" onchange="greaterthan1('intconf3', 'intconfoverall')"  name="intconf3" value="<?php echo $intconf3;?>" size="7" min="0"></td>
<td><input class="form-control" type="number" id="intconfoverall" onchange="greaterthan2('intconf3', 'intconfoverall')" name="intconfoverall" value="<?php echo $intconfoverall;?>" size="7" min="0"></td>
</tr>

<tr>
<td>Presentation at National Conferences(Atleast one author<br/>should have presented personally)</td>
<td><input class="form-control" type="number" id="natconf3" onchange="greaterthan1('natconf3', 'natconfoverall')"  name="natconf3" value="<?php echo $natconf3;?>" size="7" min="0"></td>
<td><input class="form-control" type="number" id="natconfoverall" onchange="greaterthan2('natconf3', 'natconfoverall')" name="natconfoverall" value="<?php echo $natconfoverall;?>" size="7" min="0"></td>
</tr>

<!--every input type above is changed to number and attribute min is assigned with 1 -->

</table>

<table class="table table-striped" id="myTable">
<tr>
<td><br/>Give the complete list as appendix with name of authors, title, journal/conference name, year, volume, page number format <span style="color:red;">*</span></td>
</tr>
<tr>
<td>
<!--
<textarea class="form-control" name="publications" rows="12" cols="160">	
<?php echo $publications;?>
</textarea>
-->
<table id="table_pub" class="text-center">
<tr class="text-center">
<td>S No:</td>
<td>Name of Author:</td>
<td>Title:</td>
<td>Journal/conference name:</td>
<td>Year:</td>
<td>volume:</td>
<td>Page number:</td>
</tr>

<!--
<tr>
<td>
<input class="form-control" type="text" name="publications1" value="<?php echo $publication_split[0];?>">
</td>
<td>
<input class="form-control" type="text" name="publications2" value="<?php echo $publication_split[1];?>">
</td>
<td>
<input class="form-control" type="text" name="publications3" value="<?php echo $publication_split[2];?>">
</td>
<td>
<input class="form-control" type="text" name="publications4" value="<?php echo $publication_split[3];?>">
</td>
<td>
<input class="form-control" type="text" name="publications5" value="<?php echo $publication_split[4];?>">
</td>
<td>
<input class="form-control" type="text" name="publications6" value="<?php echo $publication_split[5];?>">
</td>
<?php $_POST['publications'] = $row['publications1'] + ',' + $row['publications2'] + ',' + $row['publications3'] + ',' + $row['publications4'] + ',' + $row['publications5'] + ',' + $row['publications6'];?>
</tr>-->
</table>
<!-- <?php //echo "<script> add_row(); </script>";?> -->

<?php 
$publication_dollar= explode('$',$publications);


if(sizeof($publication_dollar)>1)
{
$n=sizeof($publication_dollar);

for($i=1;$i<$n;$i++)
{
	$publication_split=explode('^', $publication_dollar[$i-1]);
	$j0=$publication_split[0];
	$j1=$publication_split[1];
	$j2=$publication_split[2];
	$j3=$publication_split[3];
	$j4=$publication_split[4];
	$j5=$publication_split[5];		

	echo "<script> add_row('".$j0."','".$j1."','".$j2."','".$j3."','".$j4."','".$j5."'); </script>";
}
}
else
{
	echo "<script> add_row('','','','','',''); </script>";
}
?>	
<br/>
<button type="button" class="btn btn-sm btn-primary" onclick="<?php echo "add_row('','','','','','')";?>">Insert new row</button>
</td>
	<!--12X70-->
</tr>
</table>

<table class="table table-striped" id="myTable">
<tr>
<td><br/>Upload copies of three best papers in PDF format (file size < 2MB is accepted.)<br/></td>
<td>Paper 1:<input type="file" name="paper1" id="paper1" onchange="check_file('paper1')"><?php if(strlen($paper1) > 0) echo "Paper-1 is already submitted; To overwrite, upload again"; ?><br/></td>
<td>Paper 2:<input type="file" name="paper2" id="paper2" onchange="check_file('paper2')"><?php if(strlen($paper2) > 0) echo "Paper-2 is already submitted; To overwrite, upload again"; ?><br/></td>
<td>Paper 3:<input type="file" name="paper3" id="paper3" onchange="check_file('paper3')"><?php if(strlen($paper3) > 0) echo "Paper-3 is already submitted; To overwrite, upload again"; ?><br/></td>
</tr>
</table>
<!-- -->
<!-- -->
<br/>
						<div class="text-center">
							<input type="submit" class="btn btn-sm btn-info" name = "submitted_val" value="Save">
							<input type="submit" class="btn btn-sm btn-success" name = "submitted_val1" value="Save & Next">
						</div>

<!--<input type="submit" value="Submit Form"> -->

</form>
</div>
</div>
</body>
</html>
<?php include 'footer.php'; ?>
