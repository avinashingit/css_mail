<?php include 'check.php'; ?>
<?php include 'form4_h.php'; ?>

<?php

	$con=mysqli_connect("localhost","root","rootpw","faculty_recruitment");
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//$usrid1 = $_GET['usrid'];
	$usrid1 = $_SESSION['userid'];

	if(mysqli_num_rows(mysqli_query($con, "select submitted from form4 where userid = $usrid1 and submitted = 1")) > 0)
	{
		echo "<br/><br/><br/><br/>Your form is already submitted<br>";
		echo 'Click <a href="pdf_final.php">here</a></li> to generate the pdf of your application';
		//echo '<p><a href=".">Home</a></p>';
		exit;
	}


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

	if(isset($_POST[submitted_val])) 
    		{			
		$errorMessage = "";
		
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
	
		echo '<meta http-equiv="REFRESH" content="0;url=saved4.php">';
		
		}
	}



    if(!empty($errorMessage)) 
		    	{
			    echo("<p>There was an error with your form:</p>\n");
			    echo("<ul>" . $errorMessage . "</ul>\n");
            		}

	
        ?>


<html>
<body background="bgimage.jpg";background-repeat:no-repeat;background-attachment:scroll;>
<br/><br/><br/><br/>
<form method="post" enctype="multipart/form-data">

25:SOP<br/>
a)Why would you like to join IIITDM Kancheepuram?<br/>
(Do not exceed a page length)<br/>
<textarea style="width: 500px; height: 150px; row="20" column="200" name="25a" ><?php echo $a25;?></textarea><br/><br/>
b)Your vision for the growth of the institute...<br/>
(Do not exceed a page length)<br/>
<textarea style="width: 500px; height: 150px; row="20" column="200" name="25b"><?php echo $b25;?></textarea><br/><br/>

26:<br/>
Enter the names and addresses including email,fax, telephone no. of 3 referees.<br/>
(at least one of them should be familiar with your recent work);<br/>Referees will be contacted by the institute directly, if required.<br/><br/>
Referee1:<br/>
Name: <input type="text" name="ref1_name" value="<?php echo $ref1_name ?>" /><br/>
Address: <input type="text" name="ref1_add" value="<?php echo $ref1_add ?>"/><br/>
Email: <input type="text" name="ref1_email" value="<?php echo $ref1_email?>" /><br/>
Phone: <input type="text" name="ref1_phone" value="<?php echo $ref1_phone ?>" /><br/>
<br/>
Referee2:<br/>
Name: <input type="text" name="ref2_name" value="<?php echo $ref2_name  ?>" /><br/>
Address: <input type="text" name="ref2_add" value="<?php echo $ref2_add ?>" /><br/>
Email: <input type="text" name="ref2_email" value="<?php echo $ref2_email ?>" /><br/>
Phone: <input type="text" name="ref2_phone" value="<?php echo $ref2_phone ?>" /><br/>
<br/><br/>
Referee3:<br/>
Name: <input type="text" name="ref3_name" value="<?php echo $ref3_name ?>" /><br/>
Address: <input type="text" name="ref3_add" value="<?php echo $ref3_add ?>" /><br/>
Email: <input type="text" name="ref3_email" value="<?php echo  $ref3_email?>" /><br/>
Phone: <input type="text" name="ref3_phone" value="<?php echo $ref3_phone ?>" /><br/>
<br/>
27:<br/>
Any other information you want to mention:<br/>
<textarea style="width: 500px; height: 150px; row="20" column="200" name="27"><?php echo $othr;?></textarea><br/>
<input type="submit" name="submitted_val" value="Save Form" />
</form>
</h3>
</body>
</html>
