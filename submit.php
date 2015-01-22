<?php include_once("check.php");
include 'header1.php';
include 'tab_style.php';
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); ?>

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

<?php
	if($_GET[a]==1)
	{
		echo "<br/><br/><span style='color:green;'>SOP and LOR SAVED</span>";
	}
	$a=0;
?>

<br/><br/>

<h2>Undertaking</h2>
<p>I hereby declare that I have carefully read and understood the instructions and all information furnished in this form as well as the attached sheets are true and correct to the best of my knowledge and belief. I fully understand that if it is found at a later date that any information given in the application is incorrect/false or if I do not satisfy the eligibility criteria, my candidature/appointment is liable to be cancelled/terminated.</p>

<p>Click on submit to complete submission of application. Please note that once submitted, the form cannot be changed. Hence check all the saved details before submitting.</p>
<form action='submit_conf.php'>
<input type="submit" value="Submit"></input>
</form>
<!--<p><a href='submit_conf.php'>Submit Forms</a></p>-->
</br></br></br></br></br>	
<?php include 'footer.php'; ?>
