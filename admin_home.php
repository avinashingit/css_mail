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
	 echo '</br></br><a href="advt.php">Change the advertisement number</a>';

?>


<?php
	$query = "select u.id_user id_user,u.name name,f.post post,f.area area from users as u,form1 as f where u.id_user = f.userid and f.adno = '$advt_no' and u.submitted = 1";
	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) == 0)
		echo "No user submissions so far!";

	else
	{
?>
<h3>Submitted users</h3><p>
<table id="usertable" border="1" style="width: 5px">
<tr><th>S.No</th><th>Application No.</th><th>Name</th><th>Post Applied</th><th>Broad Area</th></tr>


<?php
		$sno = 1;
		while($row = mysqli_fetch_assoc($result))
		{
			$userid = $row["id_user"];
			$name = $row["name"];
			$post = $row["post"];
			$area = $row["area"];

			echo "<tr><td>$sno</td><td>$userid</td><td><a href='applicant-details.php?uid=".$userid."'>$name</a></td><td>$post</td><td>$area</td></tr>";

			$sno = $sno + 1;
		
			//echo "<a href='applicant-details.php?uid=".$row["id_user"]."'>".$row["name"]."</a><br>";

		}

		echo "<p>";
			
	}
?>

</table>
