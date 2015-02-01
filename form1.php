<!--

/***************************************

Author: Ramesh krishnan, Sowmya jain, Anand, Avinash Kadimisetty
File: Form-1.php
Edited dates : 22/01/2015, 01/02/2015
Chages made:

1. Indented the code 
2. Input validations


*****************************************/
-->
<?php include 'externalLinks.php';?><!-- this file contains all the external css and js files and plugins if any --> 
<?php include 'check.php'; ?>
<?php include 'form1_h.php'; ?>
<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED ^ E_STRICT);
	require_once("./include/membersite_config.php");
	if($isAdmin)
		{
			$fgmembersite->RedirectToURL("admin_home.php");
		}
	$con=mysqli_connect("localhost","root","root","faculty_recruitment");
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$usrid1 = $_SESSION['userid'];
	if(mysqli_num_rows(mysqli_query($con, "select submitted from form1 where userid = $usrid1 and submitted = 1")) > 0)
	{
		echo "<br/><br/><br/><br/>Your form is already submitted<br>";
		echo 'Click <a href="pdf_final.php">here</a></li> to generate the pdf of your application<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
		include 'footer.php';
		exit;
	}
	$retrieve = "SELECT * FROM form1 where userid = $usrid1";
	$result = mysqli_query($con,$retrieve);
	while($row = mysqli_fetch_array($result))
	{
		$post=$row['post'];
		$area=$row['area'];
		$research=$row['researcharea'];
		$name=$row['name'];
		$dob=$row['dob'];
		$nationality=$row['nationality'];
		$gender=$row['gender'];
		$caste=$row['category'];
		$fname=$row['fathername'];
		$posn=$row['designation'];
		$addr=$row['address'];
		$perm_addr=$row['permaddress'];
		$addr_mobile=$row['addr_mobile'];
		$addr_email=$row['addr_email'];
		$perm_mobile=$row['perm_mobile'];
		$perm_email=$row['perm_email'];
		$photo = $row['photo'];
		$categorycerti = $row['categorycerti'];
	}
	$retrieve = "SELECT * FROM educational_qualifications where userid = $usrid1";
	$result = mysqli_query($con,$retrieve);
	$num_rows1 = mysqli_num_rows($result);
	while($row = mysqli_fetch_array($result))
	{
		$sno[] = $row['sno'];
		$degree[] = $row['degree'];
		$insti[] = $row['insti'];
		$yoe[] = $row['yoe'];
		$yol[] = $row['yol'];
		$percent[] = $row['percent'];
		$degreetype[] = $row['degreetype']; // Added april 9 2014
	}
	
	function create_row1()
	{
		global $num_rows1;
		if($num_rows1 == 0)  //empty table
		{
			$num_rows1 = -1;
		}
		echo "<script> add_row16(".$num_rows1."); </script>";
	}
	if(isset($_POST[submitted_val]) || isset($_POST[submitted_val1]))
	{
		//if(empty($errorMessage))
		{
			$count1 = $_REQUEST['count1'];
			mysqli_query($con,"delete from form1 where userid=$usrid1");
			mysqli_query($con,"delete from educational_qualifications where userid=$usrid1");
			for($i = 1 ; $i<=$count1 ; $i++)
			{
				$degree = $_REQUEST['degree'.$i];
				$insti = $_REQUEST['insti'.$i];
				$yoe = $_REQUEST['yoe'.$i];
				$yol = $_REQUEST['yol'.$i];
				$percent = $_REQUEST['percent'.$i];
				$degreetype = $_REQUEST['degreetype'.$i]; // Added april 9 2014

				$query = "INSERT INTO educational_qualifications (userid,sno,degree,insti,yoe,yol,percent,degreetype) VALUES ($usrid1,$i,'$degree','$insti','$yoe','$yol',$percent,$degreetype)"; // Added april 9 2014
				mysqli_query($con,$query);
			}
			$error=0;
			$post=$_REQUEST['post'];
			$area=$_REQUEST['area'];
			$research=$_REQUEST['research'];
			$name=$_REQUEST['name'];
			$dob=$_REQUEST['dob'];
			$nationality=$_REQUEST['nationality'];
			$gender=$_REQUEST['gender'];
			$caste=$_REQUEST['caste'];
			$fname=$_REQUEST['fname'];
			$posn=$_REQUEST['posn'];
			$addr=$_REQUEST['addr'];
			$perm_addr=$_REQUEST['addr_p'];
			$addr_mobile=$_REQUEST['addr_mob'];
			$addr_email=$_REQUEST['addr_email'];
			$perm_mobile=$_REQUEST['mob_p'];
			$perm_email=$_REQUEST['email_p'];
			$adno = $_REQUEST['adno'];

			if(strlen($dob)!=0)
			{
				$dobSplitArray=explode("-", $dob);

				if(!validateDate($dobSplitArray[1],$dobSplitArray[0],$dobSplitArray[2]))
				{
					$error=1;
					echo "<p class='text-center'>Check your date of birth</p>";
				}
				if(!validateDateOfBirth($dobSplitArray[1],$dobSplitArray[0],$dobSplitArray[2]))
				{
					$error=1;
					echo "<p class='text-center'>Date of birth is ahead of now</p>";
				}
			}
				
			
			if(strlen($addr_mobile)!=0)
				{
					if(!is_int((int)$addr_mobile))
					{
						$error=1;
						echo "<p class=\"text-center\">Please enter a valid mobile number</p>";
					}
				}
			if(strlen($perm_mobile)!=0)
			{
				if(!is_int((int)$perm_mobile))
				{
					$error=1;
					echo "<p class=\"text-center\">Please enter a valid mobile number</p>";
				}
			}
			
			if(strlen($addr_email)!=0)
			{
				if(!filter_var($addr_email, FILTER_VALIDATE_EMAIL)) {
			        $error=1;
			        echo "<p class='text-center'>Please enter a valid email</p>";
			    }
			}
			if(strlen($perm_email)!=0)
			{
				if(!filter_var($perm_email, FILTER_VALIDATE_EMAIL)) {
			        $error=1;
			        echo "<p class=\"text-center\">Please enter a valid email</p>";
			    }
			}


			// Upload photo
			if(strlen($_FILES["photo"]["name"]) != 0)
			{
				// Start upload script
				$allowedExts = array("gif", "jpeg", "jpg", "png");
				$extension = end(explode(".", $_FILES["photo"]["name"]));

				if (((($_FILES["photo"]["type"] == "image/png") || ($_FILES["photo"]["type"] == "image/jpg") || ($_FILES["photo"]["type"] == "image/jpeg") || ($_FILES["photo"]["type"] == "image/gif")) && ($_FILES["photo"]["size"] < 10000000)) && (in_array($extension, $allowedExts)))
				{
					if ($_FILES["photo"]["error"] > 0)
					{
						echo "Error uploading photo. Please try again";
					}
					else
					{
						$photo = "upload/" . $usrid1 ."_photo." .$extension;
						if(move_uploaded_file($_FILES["photo"]["tmp_name"], $photo))
							echo "<br><span style='color:green;'>Photo Saved</span><br>";
						else 
							echo "<br>File not saved<br>";
					}
				}
				else
				{
					$error=1;
					echo "<p class=\"text-center\">Invalid photo</p>";
				}

			// End upload script
			}
			// Upload category certi
			if(strlen($_FILES["cat_certi"]["name"]) != 0)
			{
				// Start upload script
				$allowedExts = array("pdf");
				$extension = end(explode(".", $_FILES["cat_certi"]["name"]));

				if ((($_FILES["cat_certi"]["type"] == "application/pdf") && ($_FILES["cat_certi"]["size"] < 10000000)) && (in_array($extension, 				$allowedExts)))
				{
					if ($_FILES["cat_certi"]["error"] > 0)
					{
						echo "Error uploading category certificate. Please try again";
					}
					else
					{
						$categorycerti = "upload/" . $usrid1 ."_categorycerti." .$extension;
						if(move_uploaded_file($_FILES["cat_certi"]["tmp_name"], $categorycerti))
							echo "<br><span style='color:green;'>Category certificate saved</span><br>";
						else 
							echo "<br>File not saved<br>";
					}
				}
				else
				{
					$error=1;
					echo "<p class=\"text-center\">Invalid certificate file extension</p>";
				}

			// End upload script
			}

			if($error==0)
			{
				$sql1="INSERT INTO form1(userid,post,area,researcharea,name,dob,nationality,gender,category,address,addr_mobile,addr_email,
					permaddress,perm_mobile,perm_email,fathername,designation,submitted,photo,categorycerti,adno) VALUES  ('$usrid1','$post','$area','$research','$name','$dob','$nationality','$gender','$caste','$addr','$addr_mobile','$addr_email',
					'$perm_addr','$perm_mobile','$perm_email','$fname','$posn',0,'$photo','$categorycerti','$adno')";
					mysqli_query($con,$sql1);
					echo "<br/><span style='color:green;'>Personal Details SAVED</span>";
					if(isset($_POST[submitted_val1]))
					{
						//echo '<script language="JavaScript" type="text/javascript">alert("Personal Detail SAVED")</script>';
						echo '<meta http-equiv="REFRESH" content="0;url=form2.php?a=1">';
					}
			}
			
		}
	}
?>
<html>
	<body>
		<div class="row">

			<div class="col-md-12">

				<form method="post" class="form" action="form1.php" enctype="multipart/form-data">
					<script type="text/javascript">
						var count1 = 1;
						function add_row16(cnt)
						{
							//alert("hello");
							if(cnt == 0  || cnt == -1)  //add row
							{
								count1 = count1+1;
								if(cnt == -1)
								{
									count1 = 1;
								}
								var table=document.getElementById("myTable1");
								var row=table.insertRow(count1);
								var cell1=row.insertCell(0);
								var cell2=row.insertCell(1);
								var cell3=row.insertCell(2);
								var cell4=row.insertCell(3);
								var cell5=row.insertCell(4);
								var cell6=row.insertCell(5);
								var cell7=row.insertCell(6);
								cell1.innerHTML=count1+".";
								cell2.innerHTML="<td><select  name=\"degreetype"+count1+"\"><option value=\"\">Select</option><option value=\"1\">Undergraduate-level</option><option value=\"2\" >Graduate-level</option><option value=\"3\" >Doctoral-level</option></select></td>";
								cell3.innerHTML="<td><input type=\"text\" name=\"degree"+count1+"\" size=\"8\"></td>";
								cell4.innerHTML="<td><input type=\"text\" name=\"insti"+count1+"\" size=\"8\"></td>";
								cell5.innerHTML="<td><input type=\"number\" min=\"0\" name=\"yoe"+count1+"\" size=\"8\"></td>";
								cell6.innerHTML="<td><input type=\"number\" min='0' name=\"yol"+count1+"\" size=\"8\"></td>";
								cell7.innerHTML="<td><input type=\"number\" min='0' max='100' name=\"percent"+count1+"\" size=\"5\"><input type=\"hidden\" name=\"count1\" value=\""+count1+"\"></td>";
							}
							else
							{
								count1 = cnt;
								for(var i=1;i<=count1;i++)
								{
									var table=document.getElementById("myTable1");
									var row=table.insertRow(i);
									var cell1=row.insertCell(0);
									var cell2=row.insertCell(1);
									var cell3=row.insertCell(2);
									var cell4=row.insertCell(3);
									var cell5=row.insertCell(4);
									var cell6=row.insertCell(5);
									var cell7=row.insertCell(6);
									var sno= <?php echo json_encode($sno); ?>;
									var degree= <?php echo json_encode($degree); ?>;
									var insti= <?php echo json_encode($insti); ?>;
									var yoe= <?php echo json_encode($yoe); ?>;
									var yol= <?php echo json_encode($yol); ?>;
									var percent= <?php echo json_encode($percent); ?>;
									var degreetype = <?php echo json_encode($degreetype); ?>;
									if(degreetype[i-1] == 1)  
									{
										cell2.innerHTML="<td><select name=\"degreetype"+i+"\"><option value=\"\">Select</option> <option value=\"1\" Selected=\"Selected\">Undergraduate-level</option> <option value=\"2\">Graduate-level</option><option value=\"3\">Doctoral-level</option></select></td>";
									}
									else if(degreetype[i-1] == 2)
									{
										cell2.innerHTML="<td><select name=\"degreetype"+i+"\"><option value=\"\">Select</option> <option value=\"1\">Undergraduate-level</option> <option value=\"2\" Selected=\"Selected\">Graduate-level</option><option value=\"3\">Doctoral-level</option></select></td>";
									}
					
									else if(degreetype[i-1] == 3)  
									{
										cell2.innerHTML="<td><select name=\"degreetype"+i+"\"><option value=\"\">Select</option> <option value=\"1\">Undergraduate-level</option> <option value=\"2\">Graduate-level</option><option value=\"3\" Selected=\"Selected\">Doctoral-level</option></select></td>";
									}
									else  
									{
										cell2.innerHTML="<td><select name=\"degreetype"+i+"\"><option value=\"\" Selected=\"Selected\">Select</option> <option value=\"1\">Undergraduate-level</option> <option value=\"2\">Graduate-level</option><option value=\"3\">Doctoral-level</option></select></td>";
									}
									cell1.innerHTML=sno[i-1];
									cell3.innerHTML="<td><input type=\"text\" name=\"degree"+i+"\" value = \""+degree[i-1]+"\"  size=\"8\"></td>";
									cell4.innerHTML="<td><input type=\"text\" name=\"insti"+i+"\" value = \""+insti[i-1]+"\" size=\"8\"></td>";
									cell5.innerHTML="<td><input type=\"text\" name=\"yoe"+i+"\"  value = \""+yoe[i-1]+"\" size=\"8\"></td>";
									cell6.innerHTML="<td><input type=\"text\" name=\"yol"+i+"\"  value = \""+yol[i-1]+"\" size=\"8\"></td>";
									cell7.innerHTML="<td><input type=\"text\" name=\"percent"+i+"\"  value = \""+percent[i-1]+"\"  size=\"8\"><input type=\"hidden\" name=\"count1\" value=\""+i+"\"></td>";
								}
							}
						}
					</script>
					<left>
						<br/>
						<span style="color:red;" class="text-center">* required fields</span>
						<br/><br/>
						<table class="table table-striped" id="myTable">
							<tr>
								<td>
									1. Post Applied <span style="color:red;">*</span>
								</td>
								<td>
									<div class="col-md-6">
										<select class="form-control" name="post" >
											<option value="" <?php if($post=='') echo 'Selected="Selected"'?> >Select</option>
											<option value="Professor" <?php if($post=='Professor') echo 'Selected="Selected"'?>>Professor</option>
											<option value="Assistant Professor" <?php if($post=='Assistant Professor') echo 'Selected="Selected"'?> >Assistant Professor</option>
											<option value="Associate Professor" <?php if($post=='Associate Professor') echo 'Selected="Selected"'?> >Associate Professor</option>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									2. Broad Area <span style="color:red;">*</span>
								</td>
								<td>
									<div class="col-md-6">
										<select class="form-control" name="area">
											<option value=""<?php if($area=='') echo 'Selected="Selected"'?>>Select</option>
											<option value="Computer Science" <?php if($area=='Computer Science') echo 'Selected="Selected"'?>>Computer Science</option>
											<option value="Electronics" <?php if($area=='Electronics') echo 'Selected="Selected"'?>>Electronics</option>
											<option value="Mechanical" <?php if($area=='Mechanical') echo 'Selected="Selected"'?>>Mechanical</option>
											<option value="Engineering Design" <?php if($area=='Engineering Design') echo 'Selected="Selected"'?>>Engineering Design</option>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									3. Current Areas Of Research <span style="color:red;">*</span>
								</td>
								<td>
									<div class="col-md-6">
										<input class="form-control" type="text" name="research" value="<?php echo $research; ?>"  >
									</div>
								</td>
							</tr>
							<tr>	
								<td>
									4. Advertisement No</td><td><div class="col-md-6">
									<?php
										$retrieve = "SELECT * FROM advt_number";
											$result = mysqli_query($con,$retrieve);
											while($row = mysqli_fetch_array($result))
											{
												$advt_no=$row['advt_no'];
												
											}
											echo $advt_no;
									?>
									<input type="hidden" name="adno" value="<?php echo $advt_no; ?>"></div>
								</td>
							</tr>
							<tr>
								<td>
									5. Name in Full (Capital Letters) <span style="color:red;">*</span></br>(as in SSLC Certificate)
								</td>
								<td>
									<div class="col-md-6">
										<input class="form-control" type="text" name="name" value="<?php echo $name; ?>" >
									</div>
								</td>
							</tr>
							<tr>
								<td>
									6. Date Of Birth <span style="color:red;">*</span></br>
								</td>
								<td>
									<div class="col-md-6">
										YYYY-MM-DD</br>
										<input class="date-picker form-control" data-date-format="YYYY-MM-DD" type="text" name="dob" value="<?php echo $dob; ?>" ></br>
										<!--Age:<input type="text" size="1" name="yrs" value="<?php echo $_REQUEST['yrs']; ?>" >Y<input type="text" size="1" name="months" value="<?php echo $_REQUEST['months']; ?>" >M -->
									</div>
								</td>
							</tr>
							<tr>
								<td>
									7. Photograph <span style="color:red;">*</span>
								</td>
								<td>
									<div class="col-md-6">
										Photo in GIF/JPEG/PNG format only<br/>
										<input type="file" name="photo" id="photo"><?php if(strlen($photo) > 0) echo "You have already uploaded the photo." ?> <br>
									</div>
								</tr>
							<tr>
								</td>
								<td>
									8. Nationality <span style="color:red;">*</span>
								</td>
								<td>
									<div class="col-md-6">
										<input class="form-control" type="text" name="nationality" value="<?php echo $nationality; ?>" >
									</div>
								</td>
							</tr>
							<tr>
								<td>
									9. Gender <span style="color:red;">*</span>
								</td>
								<td>
									<div class="col-md-6">
										<table class="table">
											<tr>
												<td>Male&nbsp;&nbsp;<input type="radio" name="gender" value="Male" <?php if($gender=='Male') echo 'checked="checked"'?>/></td>&nbsp;&nbsp;&nbsp;&nbsp;
												<td>Female&nbsp;&nbsp;<input type="radio" name="gender" value="Female" <?php if($gender=='Female') echo 'checked="checked"'?> />
												</td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									10. Category <span style="color:red;">*</span></br>(Attach Certificate(s))
								</td>
								<td>
									<div class="col-md-6">
										<table class="table">
											<tr>
												<td>SC</td>
												<td><input type="radio" name="caste" value="SC" <?php if($caste == 'SC') echo 'checked' ?>/></td>
											</tr>
											<tr>
												<td>ST</td>
												<td><input type="radio" name="caste" value="ST" <?php if($caste == 'ST') echo 'checked' ?> /></td>
											</tr>
											<tr>
												<td>OBC</td>
												<td><input type="radio" name="caste" value="OBC" <?php if($caste == 'OBC') echo 'checked' ?> /></td>
											</tr>
											<tr>
												<td>Others</td>
												<td><input type="radio" name="caste" value="Others" <?php if($caste == 'Others') echo 'checked' ?>/></td>
											</tr>
					

										</table>
									</div>
									<div class="col-md-4 col-md-offset-1">
										<br/><br/><br/>
										Upload the certificate in PDF format only<br/>
										<input type="file" name="cat_certi" id="cat_certi"><?php if(strlen($categorycerti) > 0) echo "You have already uploaded the category certificate." ?>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									11. Address for Communication <span style="color:red;">*</span>
								</td>
								<td>
									<div class="col-md-12">
										<textarea class="form-control" rows="5" cols="100" name="addr" type="text"><?php echo $addr; ?></textarea></br>
										<table class="table" border="1">
											<tr>
												<td>Mobile</td><td>
												<div class="col-md-6"><input class="form-control" type="number" min="0" name="addr_mob" value="<?php echo $addr_mobile; ?>"></div>
												</td>
											</tr>
											<tr>
												<td>Email</td><td><div class="col-md-6"><input class="form-control" type="email" name="addr_email" value="<?php echo $addr_email; ?>"></div>
												</td>
											</tr>
										</table>
									</div>
							</td></tr>
							<tr>
								<td>
									12. Permanent Home Address <span style="color:red;">*</span>
								</td>
								<td>
									<div class="col-md-12">
									<textarea class="form-control" rows="5" cols="100" name="addr_p" type="text"><?php echo $perm_addr; ?></textarea></br>
									<table class="table" border="1">
										<tr>
											<td>Mobile</td><td><div class="col-md-6"><input class="form-control" type="number" name="mob_p" value="<?php echo $perm_mobile; ?>"></div>
											</td>
										</tr>
									</table>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									13. Name of Father/Husband <span style="color:red;">*</span>
								</td>
								<td>
									<div class="col-md-6">
										<input class="form-control" type="text" size="50" name="fname" value="<?php echo $fname; ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>
									14. Present Position/Designation & Pay Drawn  <span style="color:red;">*</span>
								</td>
								<td>
									<div class="col-md-6">
										<input class="form-control" type="text" size="50" name="posn" value="<?php echo $posn; ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>
									15. Educational Qualifications (Starting from Bachelor's Degree) <span style="color:red;">*</span>
								</td>
								<td>
									<table class="table" id="myTable1" border="1" style="width: 5px">	
										<tr>
											<th>Sl.No</th>
											<th>Degree Type</th>
											<th>Degree</th>
											<th>Institution/University</th>
											<th>Year Of Entry</th>
											<th>Year Of Leaving</th>
											<th>Percentage</br>(out of 100)</th>
										</tr>
									</table>
									<?php 	create_row1(); ?>
									<br/>
									<button type="button" class="btn btn-sm btn-primary" onclick="<?php echo "add_row16(0)";?>">Insert new row</button>
								</td>
							</tr>
						</table>
						</br>
						<div class="text-center">
							<input type="submit" class="btn btn-sm btn-info" name = "submitted_val" value="Save">
							<input type="submit" class="btn btn-sm btn-success" name = "submitted_val1" value="Save & Next">
						</div>
				</form>
				</left>

			</div>

		</div><!-- end class row -->


<script>

// $('.date-picker').datepicker();

</script>

<style>

	.table,tr,td
	{
		border-radius:5px;
	}

</style>

	</body>
	</br>
</html>

<?php include 'footer.php'; ?>