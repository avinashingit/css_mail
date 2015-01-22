<?php include 'header1.php'; ?>
<?php include 'tab_style.php'; ?>
<div id="header">
  <ul>
    <li><a href="form1.php">Personal Details</a></li>
    <li><a href="form2.php">Publication Details</a></li>
    <li><a href="form3.php">Professional Activities</a></li>
    <li><a href="form4.php">SOP and LOR</a></li>
	<!--<li><a href="../pdf_final.php">Submit</a></li>-->
	<li id="current"><a href="submit.php">Submit</a></li>
	<li><a href="change-pwd.php">Change Password</a></li>
	<a align='right' href='logout.php'>Logout</a>
  </ul>
</div>
<br/><br/><br/><br/><br/>


<?php
	require_once("./include/membersite_config.php");
	include_once("check.php");
	function IsInjected($str)
	{
 		$injections = array('(\n+)',
             '(\r+)',
             '(\t+)',
             '(%0A+)',
             '(%0D+)',
             '(%08+)',
             '(%09+)'
             );
 		$inject = join('|', $injections);
 		$inject = "/$inject/i";
 		if(preg_match($inject,$str))
   			{
   				return true;
 			}
 		else
   			{
   				return false;
 			}
	}   



	// Create connection
	$con=mysqli_connect("localhost","root","rootpw","faculty_recruitment");
	// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to database";
	}

	// Retrieve user id
	$userid = $_SESSION["userid"];

	if(mysqli_num_rows(mysqli_query($con, "select submitted from users where id_user = $userid and submitted = 1")) == 1)
	{
		echo "Your forms are already submitted<br>";
		echo 'Click <a href="pdf_final.php">here</a></li> to generate the pdf of your application';
		echo "</br>Mail the printed form along with the Demand Draft to the following address:</br><br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Indian Institute of Information Technology,</br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Design & Manufacturing (IIITD&M) Kancheepuram</br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Melakottaiyur Village</br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Off Vandalur-Kelambakkam Road</br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Nellikuppam Road</br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Chennai - 600 127</br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Tamil Nadu</br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp India</br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp TEL +91-44-2747 6300</br>";
		echo '<p><a href=".">Home</a></p>';
        include "footer.php";
		exit;
	}

	$query1 = "SELECT submitted FROM form1 where userid = $userid and submitted = 1";
	$query2 = "SELECT submitted FROM form2 where userid = $userid and submitted = 1";
	$query3 = "SELECT submitted FROM form3 where userid = $userid and submitted = 1";
	$query4 = "SELECT submitted FROM form4 where userid = $userid and submitted = 1";
	$result1 = mysqli_query($con,$query1);
	$result2 = mysqli_query($con,$query2);
	$result3 = mysqli_query($con,$query3);
	$result4 = mysqli_query($con,$query4);

	$validate=true;

	if(mysqli_num_rows($result1) == 0)
	{
		$query = "SELECT * FROM form1 where userid = $userid";
		$result = mysqli_query($con,$query);
		$row1 = mysqli_fetch_assoc($result);


		$errorMessage = "";

		if(empty($row1['post'])) 
        	{
			$errorMessage .= "<li>You have forgotten to select the post for which yor are applying!</li>";
		}
		if(empty($row1['area'])) 
	        {
			$errorMessage .= "<li>You have forgotten to select an Area!</li>";
		}
		if(empty($row1['researcharea'])) 
	        {
			$errorMessage .= "<li>You have forgotten to enter your Areas of Research!</li>";
		}
		if(empty($row1['name'])) 
	        {
			$errorMessage .= "<li>You have forgotten to enter your Name!</li>";
		}
		if(empty($row1['dob'])) 
	        {
			$errorMessage .= "<li>You have forgotten to enter your Date Of Birth!</li>";
		}

		if(empty($row1['photo'])) 
	        {
			$errorMessage .= "<li>You have forgotten to upload your photograph!</li>";
		}

		if(empty($row1['nationality'])) 
	        {
			$errorMessage .= "<li>You have forgotten to enter your Nationality!</li>";
		}
		if(empty($row1['gender'])) 
	        {
			$errorMessage .= "<li>You have forgotten to select your gender!</li>";
		}
		if(empty($row1['category'])) 
	        {
			$errorMessage .= "<li>You have forgotten to select your caste!</li>";
		}
		/*if(empty($_REQUEST['cat_certi'])) 
	        {
			$errorMessage .= "<li>You have forgotten to upload your community certificate!</li>";
		}*/

		if(!empty($row1['category']) &&($row1['category']=='SC' || $row1['category']=='ST' || $row1['category']=='OBC'))
		{
			if(empty($row1['categorycerti'])) 
	        	{
					$errorMessage .= "<li>You have forgotten to upload your community certificate!</li>";
				}
			
		}
		if(empty($row1['address']) | empty($row1['addr_mobile']) | empty($row1['addr_email'])) 
	        {
			$errorMessage .= "<li>You have forgotten to enter your Contact Address!</li>";
		}
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$row1['addr_email']))
  			{
  			$errorMessage .= "<li>Invalid email format</li>";
  		}
		if(empty($row1['designation'])) 
	        {
			$errorMessage .= "<li>You have forgotten to enter your Designation!</li>";
		}

		if(mysqli_num_rows(mysqli_query($con, "select * from educational_qualifications where userid = $userid")) == 0)
	        {
			$errorMessage .= "<li>Educational Qualifications field is incomplete</li>";
		}
		if(mysqli_num_rows(mysqli_query($con, "select * from educational_qualifications where userid = $userid")) == 0)
	        {
			$errorMessage .= "<li>Educational Qualifications field is incomplete</li>";
		}
		if(mysqli_num_rows(mysqli_query($con, "select * from educational_qualifications where userid = $userid AND percent>100 ")) > 0)
	        {
			$errorMessage .= "<li>Percentage exceeds 100</li>";
		}


		if(!empty($errorMessage))
		{
			
			echo "<p>There are errors in <a href='form1.php'>Personal Details</a></p>";
			echo "<ul>".$errorMessage."</ul>";
			$validate=false;
		}

		else
		{
			mysqli_query($con, "update form1 set submitted = 1 where userid = $userid");
			echo "Personal Details submitted successfully<br>";
		}

	}

	if(mysqli_num_rows($result2) == 0)
	{
		$query = "SELECT * FROM form2 where userid = $userid";
		$result = mysqli_query($con,$query);
		$row2 = mysqli_fetch_assoc($result);
	if(strlen($row2['intjournals3']) == 0 || strlen($row2['intjournalsoverall'])==0 || strlen($row2['natjournals3'])==0 || strlen($row2['natjournalsoverall'])==0 || strlen($row2['intconf3'])==0 || strlen($row2['intconfoverall'])==0 || strlen($row2['natconf3'])==0 || strlen($row2['natconfoverall'])==0) 
        {
		echo "<p>There are errors in <a href='form2.php'>Publication Details</a></p>";
		
		echo "<ul><li> All entries of Field 15 needs to be filled (fill 0 if NA)</li></ul>";
		$validate=false;
	}

	else
	{
		mysqli_query($con, "update form2 set submitted = 1 where userid = $userid");
		echo "Publication Details submitted successfully<br>";
	}

	}

	if(mysqli_num_rows($result3) == 0)
	{
		$query = "SELECT * FROM form3 where userid = $userid";
		$result = mysqli_query($con,$query);
		$row3 = mysqli_fetch_assoc($result);
		if(strlen($row3['undergrad']) == 0 || strlen($row3['research_deg'])==0 || strlen($row3['postgrad'])==0 || strlen($row3['doctoral'])==0)
        	{
				echo "<p>There are errors in <a href='form3.php'>Professional Activities</a></p>";
			
				echo "<ul><li> All entries of Field 17 needs to be filled (fill 0 if NA)</li></ul>";
				$validate=false;
		}

		else
		{
			mysqli_query($con, "update form3 set submitted = 1 where userid = $userid");
			echo "Professional Activities submitted successfully<br>";
		}

	}

	if(mysqli_num_rows($result4) == 0)
	{
		$query = "SELECT * FROM form4 where userid = $userid";
		$result = mysqli_query($con,$query);
		$row4 = mysqli_fetch_assoc($result);

// Start
		$errorMessage = "";
		if(empty($row4['sop25a'] )) 
        	{
			$errorMessage .= "<li>You have forgotten to write your SOP(25-a)!</li>";
		}
		if(empty($row4['sop25b'])) 
        	{
			$errorMessage .= "<li>You have forgotten to write your SOP(25-b)!</li>";
		}
		if(empty($row4['ref1_name']) | empty($row4['ref1_addr']) | empty($row4['ref1_email']) | empty($row4['ref1_phone']) ) 
	        {
			$errorMessage .= "<li>You have forgotten to mention your Referee-1's Details !</li>";
		}
		if (!empty($row4['ref1_email']) & !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$row4['ref1_email']))
  			{
  			$errorMessage .= "<li>Invalid email format</li>";
  		}

		if(empty($row4['ref2_name']) | empty($row4['ref2_addr']) | empty($row4['ref2_email']) | empty($row4['ref2_phone']) ) 
	        {
			$errorMessage .= "<li>You have forgotten to mention your Referee-2's Details !</li>";
		}
		if (!empty($row4['ref2_email']) & !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$row4['ref2_email']))
  			{
  			$errorMessage .= "<li>Invalid email format for refree 1</li>";
  		}
		if(empty($row4['ref3_name']) | empty($row4['ref3_addr']) | empty($row4['ref3_email']) | empty($row4['ref3_phone']) ) 
	        {
			$errorMessage .= "<li>You have forgotten to mention your Referee-3's Details!</li>";
		}
		if (!empty($row4['ref3_email']) & !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$row4['ref3_email']))
  			{
  			$errorMessage .= "<li>Invalid email format for refree 3</li>";
  		}
// End

		if(!empty($errorMessage))
		{
			
			echo "<p>There are errors in <a href='form4.php'>SOP and LOR</a></p>";
			echo "<ul>".$errorMessage."</ul>";
			$validate=false;
		}

		else
		{
			mysqli_query($con, "update form4 set submitted = 1 where userid = $userid");
			echo "SOP and LOR submitted successfully<br>";
		}

		
	}


	if($validate)
	{
		echo "<p>Your form has been submitted successfully!</p>";
		mysqli_query($con, "update users set submitted = 1 where id_user = $userid");
		$fgmembersite->SendUserSubmittedEmail();
	}

	else
		echo "<p>Please make the necessary changes and click Submit Form</p>";

	echo '<p><a href=".">Home</a></p>';


?>

<?php include 'footer.php'; ?>


