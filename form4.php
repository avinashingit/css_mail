<?php include 'externalLinks.php';?><!-- this file contains all the external css and js files and plugins if any --> 
<?php include 'check.php'; ?>
<?php include 'form_h.php'; ?>

<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	
	$usrid1 = $_SESSION['userid'];

	// to check whether the form is submitted or not
	if(mysqli_num_rows(mysqli_query($con, "select submitted from form4 where userid = $usrid1 and submitted = 1")) > 0)
	{
		echo "<br/><br/><br/><br/>Your form is already submitted<br><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
		//echo 'Click <a href="pdf_final.php">here</a></li> to generate the pdf of your application<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
        include 'footer.php';

		//echo '<p><a href=".">Home</a></p>';
		exit;
	}
	//end of checking

	if($_GET[a]==1)
	{
		echo "<br/><span style='color:green;'>Professional Activities SAVED</span>";
	}

	// retrieving data from form4 table 
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
  	//end of retrieval

if(isset($_POST[submitted_val]) || isset($_POST[submitted_val1])) 
{

		//copying submitted form variables		
		$ref1_name=$_REQUEST['ref1_name'];
		$ref1_add=$_REQUEST['ref1_add'];
		$ref1_email=$_REQUEST['ref1_email'];
		$ref1_phone=$_REQUEST['ref1_phone'];
		$ref2_name=$_REQUEST['ref2_name'];
		$ref2_add=$_REQUEST['ref2_add'];
		$ref2_email=$_REQUEST['ref2_email'];
		$ref2_phone=$_REQUEST['ref2_phone'];
		$ref3_name=$_REQUEST['ref3_name'];
		$ref3_add=$_REQUEST['ref3_add'];
		$ref3_email=$_REQUEST['ref3_email'];
		$ref3_phone=$_REQUEST['ref3_phone'];
		$othr=$_REQUEST['27'];
		//end of copying

		//validation of referee emails with user email
		$errorMessage = "";
		$retrieve = "SELECT email FROM users where id_user = $usrid1";
		$result = mysqli_query($con,$retrieve);
		while($row = mysqli_fetch_array($result))
	  	{
			$usermail=$row['email'];
	  	}
	  	if($usermail==$ref1_email)
	  	{
	  		$errorMessage .= "<li>check the referee1 email. It is similar to your email</li>";
	  	}
	  	if($usermail==$ref2_email)
	  	{
			$errorMessage .= "<li>check the referee2 email. It is similar to your email</li>";	  		
	  	}
	  	if($usermail==$ref3_email)
	  	{
	  		$errorMessage .= "<li>check the referee3 email. It is similar to your email</li>";
	  	}
	  	//end of validation

		/*	$errorMessage = "";
		
		if(empty($_POST['25a'] )) 
        	{
			$errorMessage .= "<li>You have forgotten to write your SOP(25-a)!</li>";
		}
		if(empty($_POST['25b'])) 
        	{
			$errorMessage .= "<li>You have forgotten to write your SOP(25-b)!</li>";
		}
		if(empty($_POST['ref1_name']) | empty($_POST['ref1_add']) | empty($_POST['ref1_email']) | empty($_POST['ref1_phone']) ) 
	        {
			$errorMessage .= "<li>You have forgotten to mention your Referee-1's Details !</li>";
		}
		if(empty($_POST['ref2_name']) | empty($_POST['ref2_add']) | empty($_POST['ref2_email']) | empty($_POST['ref2_phone']) ) 
	        {
			$errorMessage .= "<li>You have forgotten to mention your Referee-2's Details !</li>";
		}
		if(empty($_POST['ref3_name']) | empty($_POST['ref3_add']) | empty($_POST['ref3_email']) | empty($_POST['ref3_phone']) ) 
	        {
			$errorMessage .= "<li>You have forgotten to mention your Referee-3's Details !</li>";
		}		
		
			
		if(empty($errorMessage)) 
        	{ 

		mysqli_query($con,"delete from form4 where userid=$usrid1");
		$a25=$_REQUEST['25a'];
		$b25=$_REQUEST['25b'];
		$ref1_name=$_REQUEST['ref1_name'];
		$ref1_add=$_REQUEST['ref1_add'];
		$ref1_email=$_REQUEST['ref1_email'];
		$ref1_phone=$_REQUEST['ref1_phone'];
		$ref2_name=$_REQUEST['ref2_name'];
		$ref2_add=$_REQUEST['ref2_add'];
		$ref2_email=$_REQUEST['ref2_email'];
		$ref2_phone=$_REQUEST['ref2_phone'];
		$ref3_name=$_REQUEST['ref3_name'];
		$ref3_add=$_REQUEST['ref3_add'];
		$ref3_email=$_REQUEST['ref3_email'];
		$ref3_phone=$_REQUEST['ref3_phone'];
		$othr=$_REQUEST['27'];

		$sql="INSERT INTO form4(userid,sop25a,sop25b,ref1_name,ref1_addr,ref1_email,ref1_phone,ref2_name,ref2_addr,ref2_email,ref2_phone,ref3_name,ref3_addr,ref3_email,ref3_phone,otherinfo27,submitted) VALUES ('$usrid1','$a25','$b25','$ref1_name','$ref1_add','$ref1_email','$ref1_phone','$ref2_name','$ref2_add','$ref2_email','$ref2_phone','$ref3_name','$ref3_add','$ref3_email','$ref3_phone','$othr',0)";
     	mysqli_query($con,$sql);
	}
*/		if(strlen($_FILES["25a"]["name"]) != 0)
	{
		// Start upload script
		$allowedExts = array("pdf");
		$extension = explode(".", $_FILES["25a"]["name"]);
		$extension = end($extension);
		if ((($_FILES["25a"]["type"] == "application/pdf") && ($_FILES["25a"]["size"] < 10000000)) && (in_array($extension, $allowedExts)))
		{
  			if ($_FILES["25a"]["error"] > 0)
    			{
			    	echo "Error uploading 25a file. Please try again";
    			}
  			else
    			{
				$a25 = "upload/" . $usrid1 ."_25a." .$extension;
				if(move_uploaded_file($_FILES["25a"]["tmp_name"], $a25))
					echo "<span style='color:green;'>25a file is saved</span><br>";
				else echo "<br>File not saved<br>";
    			}
		}
		else
  		{
  			echo "Invalid file";
  		}
	
		// End upload script
	}

	// Upload paper-2

	if(strlen($_FILES["25b"]["name"]) != 0)
	{
		// Start upload script
		$allowedExts = array("pdf");
		$extension = explode(".", $_FILES["25b"]["name"]);
		$extension = end($extension);

		if ((($_FILES["25b"]["type"] == "application/pdf") && ($_FILES["25b"]["size"] < 10000000)) && (in_array($extension, $allowedExts)))
		{
  			if ($_FILES["25b"]["error"] > 0)
    			{
			    	echo "Error uploading 25b file. Please try again";
    			}
  			else
    			{
				$b25 = "upload/" . $usrid1 ."_25b." .$extension;
				if(move_uploaded_file($_FILES["25b"]["tmp_name"], $b25))
					echo "<span style='color:green;'>25b file is saved</span><br>";
				else echo "<br>File not saved<br>";
    			}
		}
		else
  		{
  			echo "Invalid file";
  		}
	
		// End upload script
	}

		if($errorMessage == "")
		{

		//writing the validated data in to the form4 table			
		echo "<br/><span style='color:green;'>SOP and LOR SAVED</span><br/>";			
		mysqli_query($con,"delete from form4 where userid=$usrid1");
		$sql="INSERT INTO form4(userid,sop25a,sop25b,ref1_name,ref1_addr,ref1_email,ref1_phone,ref2_name,ref2_addr,ref2_email,ref2_phone,ref3_name,ref3_addr,ref3_email,ref3_phone,otherinfo27,submitted) VALUES ('$usrid1','$a25','$b25','$ref1_name','$ref1_add','$ref1_email','$ref1_phone','$ref2_name','$ref2_add','$ref2_email','$ref2_phone','$ref3_name','$ref3_add','$ref3_email','$ref3_phone','$othr',0)";
     	mysqli_query($con,$sql);
     	//end of writing

		if(isset($_POST[submitted_val1]))
			{	
			echo '<meta http-equiv="REFRESH" content="0;url=submit.php?a=1">';
			}
		}
		else
		{
			echo "<ul>".$errorMessage."</ul>";
		}

   /* if(!empty($errorMessage)) 
		    	{
			    echo("<p>There was an error with your form:</p>\n");
			    echo("<ul>" . $errorMessage . "</ul>\n");
            		}

	*/
     }


   ?>
   <script type="text/javascript">
   
   // function to check the file size and extension
	function check_25(a){
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
    //end of file checking

    </script>

<html>
	<body background="bgimage.jpg";background-repeat:no-repeat;background-attachment:scroll;>
		<div class="row">
			<div class="col-md-12">
				<form method="post" class="form" action="form4.php" enctype="multipart/form-data">
					<br/>
					<span style="color:red;">* required fields</span>
					<br/><br/>

					<!-- file fields for uploading SOPs -->
					<table class="table table-striped" id="myTable">

						25:SOP<span style="color:red;">*</span><br/><br/>
						<tr>
							<td>a) Why would you like to join IIITDM Kancheepuram? (file size < 2MB is accepted.)<br/></td>
							<td>b) Your vision for the growth of the institute...  (file size < 2MB is accepted.)<br/></td>
							<!--<td><textarea class="form-control" style= "width: 500px; height: 150px;" row="20" column="200" name="25a" maxlength="4000"><?php echo $a25;?></textarea></td> -->
						</tr>
						<tr>
							<!-- <td><textarea class="form-control" style="width: 500px; height: 150px;" row="20" column="200" name="25b" maxlength="4000"><?php echo $b25;?></textarea></td> -->
							<td><input type="file" name="25a" id="25a" onchange="check_25('25a')"><?php if(strlen($a25) > 0) echo "It is already submitted; To overwrite, upload again"; ?><br/></td>
							<td><input type="file" name="25b" id="25b" onchange="check_25('25b')"><?php if(strlen($b25) > 0) echo "It is already submitted; To overwrite, upload again"; ?><br/></td>
						</tr>
					</table>
					<!-- end of SOPs -->

					<!-- Referee details -->
					<table class="table table-striped" id="myTable">

						26:Referee Details<span style="color:red;">*</span><br/>
						Enter the names and addresses including email,fax, telephone no. of 3 referees.<br/>
						(at least one of them should be familiar with your recent work);<br/>Referees will be contacted by the institute directly, if required.<br/><br/>
						<tr>
							<td><h4>Referee1:<br/></h4></td>
							<tr><td>Name:</td><td><input class="form-control" type="text" name="ref1_name" value="<?php echo $ref1_name ?>" pattern='[a-zA-Z0-9]{0,100}' title="Only alphanumeric input is valid upto 100 characters" style="width:50%;"/></td></tr>
							<tr><td>Address:</td> <td><input class="form-control" type="text" name="ref1_add" value="<?php echo $ref1_add ?>" style="width:50%;"/></td></tr>
							<tr><td>Email:</td> <td><input class="form-control" type="email" name="ref1_email" value="<?php echo $ref1_email?>" style="width:50%;"/></td></tr>
							<tr><td>Phone:</td> <td><input class="form-control" type="number" name="ref1_phone" value="<?php echo $ref1_phone ?>" min="0" style="width:50%;"/></td></tr>
						</tr>
						<tr>
							<td><h4>Referee2:</h4></td>
							<tr><td>Name:</td><td><input class="form-control" type="text" name="ref2_name" value="<?php echo $ref2_name ?>" pattern='[a-zA-Z0-9]{0,100}' title="Only alphanumeric input is valid upto 100 characters" style="width:50%;"/></td></tr>
							<tr><td>Address:</td> <td><input class="form-control" type="text" name="ref2_add" value="<?php echo $ref2_add ?>" style="width:50%;"/></td></tr>
							<tr><td>Email:</td> <td><input class="form-control" type="email" name="ref2_email" value="<?php echo $ref2_email?>" style="width:50%;"/></td></tr>
							<tr><td>Phone:</td> <td><input class="form-control" type="number" name="ref2_phone" value="<?php echo $ref2_phone ?>" min="0" style="width:50%;"/></td></tr>
						</tr>
						<tr>
							<td><h4>Referee3:</h4>
							<tr><td>Name:</td><td><input class="form-control" type="text" name="ref3_name" value="<?php echo $ref3_name ?>" pattern='[a-zA-Z0-9]{0,100}' title="Only alphanumeric input is valid upto 100 characters" style="width:50%;"/></td></tr>
							<tr><td>Address:</td> <td><input class="form-control" type="text" name="ref3_add" value="<?php echo $ref3_add ?>" style="width:50%;"/></td></tr>
							<tr><td>Email:</td> <td><input class="form-control" type="email" name="ref3_email" value="<?php echo $ref3_email?>" style="width:50%;"/></td></tr>
							<tr><td>Phone:</td> <td><input class="form-control" type="number" name="ref3_phone" value="<?php echo $ref3_phone ?>" min="0" style="width:50%;"/></td></tr>
						</tr>
					</table>
					<!-- end of Referee details -->

					<!--
					<br/>
					Referee2:<br/>
					Name: <input type="text" name="ref2_name" value="<?php echo $ref2_name  ?>" pattern='[a-zA-Z0-9]{0,100}' title="Only alphanumeric input is valid upto 100 characters"/><br/>
					Address: <input type="text" name="ref2_add" value="<?php echo $ref2_add ?>" /><br/>
					Email: <input type="email" name="ref2_email" value="<?php echo $ref2_email ?>" /><br/>
					Phone: <input type="number" name="ref2_phone" value="<?php echo $ref2_phone ?>" min="0"/><br/>
					<br/><br/>
					Referee3:<br/>
					Name: <input type="text" name="ref3_name" value="<?php echo $ref3_name ?>" pattern='[a-zA-Z0-9]{0,100}' title="Only alphanumeric input is valid upto 100 characters"/><br/>
					Address: <input type="text" name="ref3_add" value="<?php echo $ref3_add ?>" /><br/>
					Email: <input type="email" name="ref3_email" value="<?php echo  $ref3_email?>" /><br/>
					Phone: <input type="number" name="ref3_phone" value="<?php echo $ref3_phone ?>" min="0"/><br/>
					</table>
					<br/>
					-->

					<!-- textarea tag for entering any other information -->
					<table class="table table-striped" id="myTable">
						<tr>
							<td>27:Any other information you want to mention:</td>
							<td><textarea class="form-control" style="width: 900px; height: 150px; " row="20" column="200" name="27"><?php echo $othr;?></textarea></td>
						</tr>
					</table>
					<!-- end of any other information field -->

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

