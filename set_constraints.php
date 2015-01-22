<?php
	include_once("check.php");
	include "header1.php";
	include "tab_style.php";

	if(!$isAdmin)
	{
		$fgmembersite->RedirectToURL("home.php");
		exit;
	}

?>

<div id="header">
  <ul>
    <li><a href="admin_home.php">Home</a></li>
    <li id="current"><a href="set_constraints.php">Generate</a></li>
    <li><a href="applicant-details.php">User_Details</a></li>
	<li><a href="change-pwd.php">Change Password</a></li>
	<a align='right' href='logout.php'>Logout</a>
  </ul>
</div>
<br/><br/><br/><br/><br/>

<?php
	// Create connection
	$con=mysqli_connect("localhost","root","rootpw","faculty_recruitment");
	// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to database";
	}

if(isset($_POST['submitted_val']))
{
	$query = "drop view if exists view1";
	mysqli_query($con,$query);

	if(empty($_POST['category']))
	{
		echo "Please select the required category <br/>";
	}

	else   // In progress
	{
		$ad_result = mysqli_query($con, "select advt_no from advt_number");
		$ad_row = mysqli_fetch_array($ad_result);

		$currentadno = $ad_row["advt_no"]; // Current advt. no in progress

		$category = $_POST['category'];
		$degreetype1 = $_POST['degreetype1'];
		$percent1 = $_POST['percent1'];
		$degreetype2 = $_POST['degreetype2'];
		$percent2 = $_POST['percent2'];
		$degreetype3 = $_POST['degreetype3'];
		$percent3 = $_POST['percent3'];
		$intjournalsoverall = $_POST['intjournalsoverall'];
		$natjournalsoverall = $_POST['natjournalsoverall'];
		$intconfoverall = $_POST['intconfoverall'];
		$natconfoverall = $_POST['natconfoverall'];

		$query1 = '';

		if(!empty($degreetype1) & !empty($percent1))
		{
			$query1 = "select userid from educational_qualifications where percent >= $percent1 and degreetype = $degreetype1";
		}

		$query2 = '';

		if(!empty($degreetype2) & !empty($percent2))
		{
			$query2 = "select userid from educational_qualifications where percent >= $percent2 and degreetype = $degreetype2";
			if(!empty($query1))
			{
				$query2 .= " and userid in ($query1)";
			}
		}

		$query3 = '';

		if(!empty($degreetype3) & !empty($percent3))
		{
			$query3 = "select userid from educational_qualifications where percent >= $percent3 and degreetype = $degreetype3";
			if(!empty($query2))
			{
				$query3 .= " and userid in ($query2)";
			}
			else if(!empty($query1))
			{
				$query3 .= " and userid in ($query1)";
			}
		}

		$query = "create view view1 as select distinct F1.userid from form1 as F1, form2 as F2 where F1.userid = F2.userid and F1.adno = '$currentadno' and category = '$category'";

		if(!empty($intjournalsoverall))
		{
			$query .= " and intjournalsoverall >= $intjournalsoverall";
		}

		if(!empty($natjournalsoverall))
		{
			$query .= " and natjournalsoverall >= $natjournalsoverall";
		}

		if(!empty($intconfoverall))
		{
			$query .= " and intconfoverall >= $intconfoverall";
		}

		if(!empty($natconfoverall))
		{
			$query .= " and natconfoverall >= $natconfoverall";
		}
		
		if(!empty($query3))
		{
			$query .= " and F1.userid in ($query3)";
		}

		else if(!empty($query2))
		{
			$query .= " and F1.userid in ($query2)";
		}

		else if(!empty($query1))
		{
			$query .= " and F1.userid in ($query1)";
		}

	}

	mysqli_query($con, $query);

	$query = "select * from view1,users where id_user = userid and submitted=1";
	$result = mysqli_query($con, $query);

	if(mysqli_num_rows($result) == 0)
		echo "<br/>No users found matching your query<br/>";

	else
		while($row = mysqli_fetch_array($result))
			echo "<a href='applicant-details.php?uid=".$row["userid"]."'>".$row["name"]."</a><br>";
}
?>

<html>
<body>
<br/><h1>Set Constraints page</h1><br/>
<form method="post">
Category:<select name="category">
  <option value="">Select</option>
  <option value="Others">Others</option>
  <option value="OBC">OBC</option>
  <option value="SC" >SC</option>
  <option value="ST" >ST</option>
</select> <br/>
Type of Degree:<select name="degreetype1">
  <option value="">Select</option>
  <option value="1">Undergraduate-level</option>
  <option value="2" >Graduate-level</option>
  <option value="3" >Doctoral-level</option>
</select>
 Percent:<input type="text" name="percent1" size="7"><br/>

Type of Degree:<select name="degreetype2">
  <option value="">Select</option>
  <option value="1">Undergraduate-level</option>
  <option value="2" >Graduate-level</option>
  <option value="3" >Doctoral-level</option>
</select>
 Percent:<input type="text" name="percent2" size="7"><br/>

Type of Degree:<select name="degreetype3">
  <option value="">Select</option>
  <option value="1">Undergraduate-level</option>
  <option value="2" >Graduate-level</option>
  <option value="3" >Doctoral-level</option>
</select>
 Percent:<input type="text" name="percent3" size="7"><br/>


International Referred Journals:<input type="text" name="intjournalsoverall" size="7"><br/>
National Referred Journals:<input type="text" name="natjournalsoverall" size="7"><br/>
International Conferences:<input type="text" name="intconfoverall" size="7"><br/>
National Conferences:<input type="text" name="natconfoverall" size="7"><br/>

<input type="submit" name = "submitted_val" id="1" value="Generate">

</form>

