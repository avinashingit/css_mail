<?php include 'header1.php'; ?>
<?php include 'tab_style.php'; ?>
	<div id="header">
  <ul>
    <li><a href="admin_home.php">Home</a></li>
    <li><a href="set_constraints.php">Generate</a></li>
    <li id="current"><a href="applicant-details.php">User_Details</a></li>

	<a align='right' href='logout.php'>Logout</a>
  </ul>
</div>
<br/>
<br/><br/><br/>	
<?php
	include_once("check.php");
	

/*	$userid = $_SESSION["userid"];

	$query = "select username from users where id_user = $userid";
	$result = mysqli_query($con,$query);
        $row = mysqli_fetch_assoc($result);

	$uname = $row["username"];

	if(strcmp($uname,"admin") != 0)
		echo "Access Forbidden for this page";
*/
	//else
	{
		//echo "Welcome to user details page<br>";

		if(!isset($_GET['uid']))
		{
			$fgmembersite->RedirectToURL("admin_home.php");
			exit;
		}

		$uid = $_GET['uid'];

		$query1 = "select * from form1 where userid = $uid";
		$query2 = "select * from form2 where userid = $uid";
		$query3 = "select * from form3 where userid = $uid";
		$query4 = "select * from form4 where userid = $uid";
		$query5 = "select * from work_experience where userid = $uid";
		$query6 = "select * from spons_principal where userid = $uid";
		$query7 = "select * from spons_co_investigator where userid = $uid";
		$query8 = "select * from educational_qualifications where userid = $uid";

		$result1 = mysqli_query($con,$query1);
		$result2 = mysqli_query($con,$query2);
		$result3 = mysqli_query($con,$query3);
		$result4 = mysqli_query($con,$query4);
		$wrkexp = mysqli_query($con, $query5);
		$result6 = mysqli_query($con, $query6);
		$result7 = mysqli_query($con, $query7);
		$result8 = mysqli_query($con, $query8);

		$row1 = mysqli_fetch_assoc($result1);
		$row2 = mysqli_fetch_assoc($result2);
		$row3 = mysqli_fetch_assoc($result3);
		$row4 = mysqli_fetch_assoc($result4);

	}
?>
<!-- Form 1-->
<table id="myTable" border="1">
<tr><td>
1. Post Applied
</td><td>
<?php echo $row1['post']; ?>
</td></tr>
<tr><td>
2. Broad Area
</td><td>
<?php echo $row1['area']; ?></td></tr>
<tr><td>
3. Current Areas Of Research
</td><td>
<?php echo $row1['researcharea']; ?>
</td></tr>
</tr><td>
4. Advertisement No</td><td><?php echo $row1['adno']; ?>
</td></tr>
<tr><td>
5. Name in Full</br>
</td><td>
<?php echo $row1['name']; ?>
</td></tr>
<tr><td>
6. Date Of Birth</br>(Enclose a copy of SSLC Certificate)
</td><td>
<?php echo $row1['dob']; ?>
</td></tr>
<tr><td>	
7. Photograph
</td><td>
<!--<input type="file" name="photo" id="photo" value="<?php echo $_REQUEST['photo']; ?>" ><br>-->
</td></tr>
<tr><td>
8. Nationality
</td><td>
<?php echo $row1['nationality']; ?>
</td></tr>
<tr><td>
9. Gender
</td><td>
<?php echo $row1['gender']; ?></td></tr>
<tr><td>
10. Category </br>
</td><td>
<?php echo $row1['category']; ?><br/>
Certificate Attached: <?php if(strlen($row1['categorycerti'])==0) echo "No"; else echo "Yes"; ?>

</td></tr>
<tr><td>
11. Address for Communication
</td><td>
<?php echo $row1['address']; ?><br/>
<?php echo $row1['addr_mobile']; ?><br/>
<?php echo $row1['addr_email']; ?><br/>
</td></tr>
<tr><td>
12. Permanent Home Address
</td><td>
<?php echo $row1['permaddress']; ?><br/>
<?php echo $row1['perm_mobile']; ?><br/>
<?php echo $row1['perm_email']; ?><br/>
</td></tr>
<tr><td>
13. Name of Father/Husband
</td><td>
<?php echo $row1['fathername']; ?>
</td></tr>
<tr><td>
14. Present Position/Designation & Pay Drawn  
</td><td>
<?php echo $row1['designation']; ?>
</td></tr>
<tr><td>
15. Educational Qualifications (Starting from Bachelor's Degree)
</td><td>
<table id="myTable1" border="1">
<tr><th size="10">Sl.No</th><th>Degree</th><th>Institution/University</th><th>Year Of Entry</th><th>Year Of Leaving</th><th>Percentage & Class</th></tr>
<?php
	while($row_eq = mysqli_fetch_array($result8))
	{
?>
<tr>
<td><?php echo $row_eq['sno']; ?></td>
<td><?php echo $row_eq['degree']; ?></td>
<td><?php echo $row_eq['insti']; ?></td>
<td><?php echo $row_eq['yoe']; ?></td>
<td><?php echo $row_eq['yol']; ?></td>
<td><?php echo $row_eq['percent']; ?></td>
</tr>
<?php } ?>
</table>
</table>

<!-- Form 2-->
<br/><br/>
<b>16.Number of Research Publications</b><br/><br/>
<table border ="1">
<tr align="center">
<th>Publication Category</th>
<th>Last 3 Years</th>
<th>Overall</th>
</tr>
<tr>
<td>International Referred Journals</td>
<td align="center"> <?php echo $row2['intjournals3']; ?></td>
<td align="center"> <?php echo $row2['intjournalsoverall']; ?></td>
</tr>

<tr>
<td>National Referred Journals</td>
<td align="center"> <?php echo $row2['natjournals3']; ?></td>
<td align="center"> <?php echo $row2['natjournalsoverall']; ?></td>
</tr>

<tr>
<td>Presentation at International Conferences</td>
<td align="center"> <?php echo $row2['intconf3']; ?></td>
<td align="center"> <?php echo $row2['intconfoverall']; ?></td>
</tr>
<tr>
<td>Presentation at National Conferences</td>
<td align="center"> <?php echo $row2['natconf3']; ?></td>
<td align="center"> <?php echo $row2['natconfoverall']; ?></td>
</tr>
</table>
<br/><strong>Complete list of publications</strong><br/>
<?php echo nl2br($row2['publications']); ?>

<br/>
<br/>

<strong>17. Work Experience (in reverse chronological order)</strong>
<table id="Table16" border="1">

<tr>

<th>Sr.No</th>
<th>Name of the<br/>Employer</th>
<th>Designation</th>
<th>Date of<br/>Joining<br/>yyyy-mm-dd</th>
<th>Date of<br/>Leaving<br/>yyyy-mm-dd</th>
<th>Duration<br/>[YY-MM]</th>
<th>Scale + Grade<br/>Pay/Total Pay<br/>(per month) last<br/>drawn (in Rs)</th>
</tr>
<?php
	while($row_we = mysqli_fetch_array($wrkexp))
	{
?>
<tr>
<td><?php echo $row_we['sno']; ?></td>
<td><?php echo $row_we['name']; ?></td>
<td><?php echo $row_we['designation']; ?></td>
<td><?php echo $row_we['doj']; ?></td>
<td><?php echo $row_we['dol']; ?></td>
<td><?php echo $row_we['duration']; ?></td>
<td><?php echo $row_we['scale']; ?></td>
</tr>
<?php } ?>
</table>
<br/><br/>
<strong>18.Number of Student Projects Guided</strong><br>
<br>Undergraduate (B.Tech/B.E/B.Sc) : <?php echo $row3['undergrad']; ?>
<br>Reseach Degree (MS/M.Phil) : <?php echo $row3['research_deg']; ?>
<br>Postgraduate (M.Tech/M.E/M.Sc) : <?php echo $row3['postgrad']; ?>
<br>Doctoral(Ph.D) : <?php echo $row3['doctoral']; ?>

<br/>
<br/>
<strong>19. Sponsored Projects / Industrial Consultancy handled</strong>

<br/>
(a) As Principal Investigator
<table id="Table18a" border="1">
<tr>

<th>Sr.No</th>
<th>Title</th>
<th>Sponsoring Agency</th>
<th>Value (in<br/>Lakhs)</th>
<th>Status</th>

</tr>
<?php
	while($row_sp = mysqli_fetch_array($result6))
	{
?>
<tr>
<td><?php echo $row_sp['sno']; ?></td>
<td><?php echo $row_sp['title']; ?></td>
<td><?php echo $row_sp['agency']; ?></td>
<td><?php echo $row_sp['value']; ?></td>
<td><?php echo $row_sp['status']; ?></td>
</tr>
<?php } ?>

</table>

<br/>
(a) As Co Investigator
<table id="Table18b" border="1">
<tr>

<th>Sr.No</th>
<th>Title</th>
<th>Sponsoring Agency</th>
<th>Value (in<br/>Lakhs)</th>
<th>Status</th>

</tr>
<?php
	while($row_sp = mysqli_fetch_array($result7))
	{
?>
<tr>
<td><?php echo $row_sp['sno']; ?></td>
<td><?php echo $row_sp['title']; ?></td>
<td><?php echo $row_sp['agency']; ?></td>
<td><?php echo $row_sp['value']; ?></td>
<td><?php echo $row_sp['status']; ?></td>
</tr>
<?php } ?>

</table>

<br/>
<br/>

<strong>20. Courses Handled</strong>
<br/>
<br/>
<strong>Undergraduate Level</strong>
<br/>
<br/>
<?php echo nl2br($row3['courses_undergrad']) ;?>

<br/>
<br/>
<strong>Postgraduate Level</strong>
<br/>
<br/>
<?php echo nl2br($row3['courses_postgrad']);?>


<br/>
<br/>
<strong>21. Short courses / Workshops /Seminars organized</strong>
<br/>
<br/>


<?php echo nl2br($row3['wrkshps']);?>



<br/>
<br/>
<strong>22. Details of Patents</strong>
<br/>
<br/>


<?php echo nl2br($row3['patents']);?>



<br/>
<br/>
<strong>23. Administrative Experience</strong>
<br/>
<br/>


<?php echo nl2br($row3['experience']);?>



<br/>
<br/>
<strong>24. Membership of Professional Bodies</strong>
<br/>
<br/>


<?php echo nl2br($row3['memberships']);?>


<br/>
<br/>
<strong>25. Honors and Awards</strong>
<br/>
<br/>
<?php echo nl2br($row3['awards']);?>

<!-- Form 4 start-->
<br/><br/>
<strong>26. SOP</strong><br/><br/>
a)Why would you like to join IIITDM Kancheepuram?<br/>
<?php echo nl2br($row4['sop25a']);?><br/>

<br/>b)Your vision for the growth of the institute...<br/>
<?php echo nl2br($row4['sop25b']);?><br/><br/>

<strong>27. References</strong><br/><br/>
Referee 1:<br/>
<?php echo $row4['ref1_name']; ?><br/>
<?php echo $row4['ref1_addr']; ?><br/>
<?php echo $row4['ref1_email']; ?><br/>
<?php echo $row4['ref1_phone']; ?><br/>
<br/>
Referee 2:<br/>
<?php echo $row4['ref2_name']; ?><br/>
<?php echo $row4['ref2_addr']; ?><br/>
<?php echo $row4['ref2_email']; ?><br/>
<?php echo $row4['ref2_phone']; ?><br/>
<br/>
Referee 3:<br/>
<?php echo $row4['ref3_name']; ?><br/>
<?php echo $row4['ref3_addr']; ?><br/>
<?php echo $row4['ref3_email']; ?><br/>
<?php echo $row4['ref3_phone']; ?><br/>
<br/><br/>
<strong>28. Other Information</strong><br/>
<?php echo $row4['otherinfo27'];?>
