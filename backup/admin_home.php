
<?php
	include_once("check.php");
	include 'admin_h.php';
	if(!$isAdmin)
	{
		$fgmembersite->RedirectToURL("home.php");
		exit;
	}

	// Create connection
	$con=mysqli_connect("localhost","root","rootpw","faculty_recruitment");
	// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to database";
	}

	$userid = $_SESSION["userid"];

	$query = "select username from users where id_user = $userid";
	$result = mysqli_query($con,$query);
        $row = mysqli_fetch_assoc($result);

	$uname = $row["username"];

	if(strcmp($uname,"admin") != 0)
		echo "Access Forbidden for this page";

	else
	{
?>
<br/><br/><br/><br/>
<h1>Welcome Administrator</h1>
<b>Advertisement No: </b> 
<?php
	
$retrieve = "SELECT * FROM advt_number";
	$result = mysqli_query($con,$retrieve);
	while($row = mysqli_fetch_array($result))
  	{

		$advt_no=$row['advt_no'];
		
  	}
	echo $advt_no;
        



    //     echo "<button type="button" onclick="advt.php"> Change </button>";
	 echo '</br></br><a href="advt.php">Change the advertisement number</a>';

?>


<?php
	$query = "select id_user,name from users where submitted = 1";
	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) == 0)
		echo "No user submissions so far!";

	else
	{
		echo "<h3>Submitted users</h3>";

		echo "<p>";

		while($row = mysqli_fetch_assoc($result))
			echo "<a href='applicant-details.php?uid=".$row["id_user"]."'>".$row["name"]."</a><br>";

		echo "<p>";
			
	}
?>

<?php
}
?>
