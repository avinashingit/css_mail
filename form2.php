<?php include 'check.php'; ?>
<?php include 'form2_h.php'; ?>
<?php

	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	// Create connection
	$con=mysqli_connect("localhost","root","root","faculty_recruitment");
	// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

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

	$publications = $_REQUEST['publications'];

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
		$extension = end(explode(".", $_FILES["paper1"]["name"]));
	
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
		$extension = end(explode(".", $_FILES["paper2"]["name"]));
	
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
		$extension = end(explode(".", $_FILES["paper3"]["name"]));
	
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

// Upload end		
	
	$query = "INSERT INTO form2 		(userid,intjournals3,intjournalsoverall,natjournals3,natjournalsoverall,intconf3,intconfoverall,natconf3,
natconfoverall,publications,submitted,paper1,paper2,paper3) VALUES ($usrid1,$intjournals3,$intjournalsoverall,$natjournals3,
$natjournalsoverall,$intconf3,$intconfoverall,$natconf3,$natconfoverall,'$publications',0, '$paper1', '$paper2', '$paper3')";

 	mysqli_query($con,$query);

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

<html>
<body>
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
<br/><br/><span style="color:red;">* required fields</span>
<br/>	
<form method="post" action="form2.php" enctype="multipart/form-data">

<b>15.Number of Research Publications</b><span style="color:red;">*</span><br/><br/>

<table>

<tr>
<th>Publication Category</th>
<th>Last 3 Years</th>
<th>Overall</th>
</tr>

<tr>
<td>International Referred Journals(Published/Accepted only)</td>

<td><input type="text" name="intjournals3" value="<?php echo $intjournals3;?>" size="7"></td>
<td><input type="text" name="intjournalsoverall" value="<?php echo $intjournalsoverall;?>" size="7"></td>
</tr>

<tr>
<td>National Referred Journals(Published/Accepted only)</td>
<td><input type="text" name="natjournals3" value="<?php echo $natjournals3;?>" size="7"></td>
<td><input type="text" name="natjournalsoverall" value="<?php echo $natjournalsoverall;?>" size="7"></td>
</tr>

<tr>
<td>Presentation at International Conferences(Atleast one<br/>author should have presented personally)</td>
<td><input type="text" name="intconf3" value="<?php echo $intconf3;?>" size="7"></td>
<td><input type="text" name="intconfoverall" value="<?php echo $intconfoverall;?>" size="7"></td>
</tr>

<tr>
<td>Presentation at National Conferences(Atleast one author<br/>should have presented personally)</td>
<td><input type="text" name="natconf3" value="<?php echo $natconf3;?>" size="7"></td>
<td><input type="text" name="natconfoverall" value="<?php echo $natconfoverall;?>" size="7"></td>
</tr>

</table>


<br/>Give the complete list as appendix with name of authors (in sequence as appeared/accepted), title, journal/conference name, year, volume, page number format.<br/>

<textarea name="publications" rows="12" cols="70">
<?php echo $publications;?>
</textarea>


<br/>Upload copies of three best papers in PDF format<br/>
Paper 1:<input type="file" name="paper1" id="paper1"><?php if(strlen($paper1) > 0) echo "Paper-1 is already submitted; To overwrite, upload again"; ?><br/>
Paper 2:<input type="file" name="paper2" id="paper2"><?php if(strlen($paper2) > 0) echo "Paper-2 is already submitted; To overwrite, upload again"; ?><br/>
Paper 3:<input type="file" name="paper3" id="paper3"><?php if(strlen($paper3) > 0) echo "Paper-3 is already submitted; To overwrite, upload again"; ?><br/>


<br/><input type="submit" name = "submitted_val" value="Save">
<input type="submit" name = "submitted_val1" value="Save & Next">

<!--<input type="submit" value="Submit Form"> -->


</form>
</html>
<?php include 'footer.php'; ?>
