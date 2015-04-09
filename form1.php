<!--

/***************************************

Author: Ramesh krishnan, Sowmya jain, Anand, Avinash Kadimisetty
File: Form-1.php
Edited dates : 22/01/2015, 01/02/2015, 02/02/2015
Chages made:

1. Indented the code 
2. Input validations
3. 

*****************************************/
-->
<?php include 'externalLinks.php';?><!-- this file contains all the external css and js files and plugins if any --> 
<?php include 'check.php'; ?>
<?php include 'form_h.php'; ?>
<?php require_once('connect.php');require_once('functions.php'); ?>
<script type="text/javascript">function add_row16(ct){}</script>
<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED ^ E_STRICT);
	require_once("./include/membersite_config.php");
	if($isAdmin)
		{
			$fgmembersite->RedirectToURL("admin_home.php");
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
		$permSameAsCurr=$row['permAddSame'];
		$directPhD=$row['directPHD'];
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
		$degreetype[] = $row['degreetype'];
		$scoreType[]=$row['scoreType'];	
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
		$count1 = $_REQUEST['count1'];
			
			#------check---------
			$retrieve = "SELECT userid FROM form1 where userid = $usrid1";
			$result = mysqli_query($con,$retrieve);
			while($row = mysqli_fetch_array($result))
			{
				$id=$row['userid'];
			}
			#---------------------------------

		//mysqli_query($con,"delete from form1 where userid=$usrid1");
		//mysqli_query($con,"delete from educational_qualifications where userid=$usrid1");
		$degree=array();
		$insti=array();
		$yoe=array();
		$yol=array();
		$percent=array();
		$degreetype=array();
		$scoreType=array();
		$cou=1;
		for($i = 1 ; $i<=$count1 ; $i++)
		{
			$sno[$i-1]=$i;
			$degree[$i-1] = $_REQUEST['degree'.$i];
			$insti[$i-1] = $_REQUEST['insti'.$i];
			$yoe[$i-1] = $_REQUEST['yoe'.$i];
			$yol[$i-1] = $_REQUEST['yol'.$i];
			$percent[$i-1] = $_REQUEST['percent'.$i];
			$degreetype[$i-1] = $_REQUEST['degreetype'.$i];
			$scoreType[$i-1] = $_REQUEST['scoreType'.$i];
			/*if($degree[$i-1]=='' && $insti[$i-1]=='' && $yoe[$i-1]=='' && $yol[$i-1]=='' && ($percent[$i-1]==0 || $percent[$i-1]=='') && $degreetype[$i-1]=='' && $scoreType[$i-1]=='')
				{
				$cou=$i;
				break;
				}*/
		}

		/*$eduError=0;
		for($i=1;$i<=$count1;$i++)
		{
			if($yoe[$i-1]>$yol[$i-1])
			{
				$eduError=1;
			}
			else if($percent[$i-1]<0 || $percent[$i-1]>100)
			{
				$eduError=1;
			}
		}*/

		//if($eduError==0)
		//{
			/*for($i=1;$i<=$count;$i++) //$count1 is replaced by $cou;
			{
				$x=$i-1;
				$query = "INSERT INTO educational_qualifications (userid,sno,degree,insti,yoe,yol,percent,degreetype,scoreType) VALUES ('$usrid1','$i','$degree[$x]','$insti[$x]','$yoe[$x]','$yol[$x]','$percent[$x]','$degreetype[$x]','$scoreType[$x]')"; // Added april 9 2014
				mysqli_query($con,$query); //or die(mysqli_error($con));
			}*/
			$j=0;
			$year_error='';
			while(!($degree[$j]=='' && $insti[$j]=='' && $yoe[$j]=='' && $yol[$j]=='' && ($percent[$j]==0 || $percent[$j]=='') && $degreetype[$j]=='' && $scoreType[$j]==''))
			{

				$k=$j+1;

				if($yoe[$j]>$yol[$j] && $yoe[$j]!='' && $yol[$j]!='')
				{
					$year_error .="<li class='text-center'> invalid yoe and yol data in row " .$k. " of edu qualifications </li>";
					//$yol[$j]='';
				}

				$j++;
			}
		//}
		//if($eduError)
		//{
		//	echo '<p class="text-center">Invalid data in educational qualifications</p>';
		//}
			if($year_error!='')
			{
				echo $year_error;				
			}
			else
			{
					mysqli_query($con,"delete from educational_qualifications where userid=$usrid1");				
					$l=0;
					while(!($degree[$l]=='' && $insti[$l]=='' && $yoe[$l]=='' && $yol[$l]=='' && ($percent[$l]==0 || $percent[$l]=='') && $degreetype[$l]=='' && $scoreType[$l]==''))
					{
					$k=$l+1;
					$query = "INSERT INTO educational_qualifications (userid,sno,degree,insti,yoe,yol,percent,degreetype,scoreType) VALUES ('$usrid1','$k','$degree[$l]','$insti[$l]','$yoe[$l]','$yol[$l]','$percent[$l]','$degreetype[$l]','$scoreType[$l]')"; // Added april 9 2014
					mysqli_query($con,$query);			
					$l++;
					}

			$retrieve = "SELECT * FROM educational_qualifications where userid = $usrid1";
			$result = mysqli_query($con,$retrieve);
			//$num_rows1 = mysqli_num_rows($result);
			//$num_rows1=$j;
			while($row = mysqli_fetch_array($result))
			{
				$sno[] = $row['sno'];
				$degree[] = $row['degree'];
				$insti[] = $row['insti'];
				$yoe[] = $row['yoe'];
				$yol[] = $row['yol'];
				$percent[] = $row['percent'];
				$degreetype[] = $row['degreetype'];
				$scoreType[]=$row['scoreType'];
			}
			//echo '<script>add_row16('.$num_rows1.');</script>';					
			}
		
		$num_rows1=$j;
		echo "<script> add_row16(".$num_rows1."); </script>";		
		//echo '<script type="text/javascript">', 'add_row16('.$num_rows1.');', '</script>';

		$error=0;
		$post=$_REQUEST['post'];
		$area=$_REQUEST['area'];
		$research=$_REQUEST['research'];
		$name=strtoupper($_REQUEST['name']);
		$dob=$_REQUEST['dob'];
		$nationality=$_REQUEST['nationality'];
		$gender=$_REQUEST['gender'];
		$caste=$_REQUEST['caste'];
		$fname=$_REQUEST['fname'];
		$posn=$_REQUEST['posn'];
		$addr=$_REQUEST['temp_addr1'].'$'.$_REQUEST['temp_addr2'];
		$perm_addr=$_REQUEST['perm_addr1'].'$'.$_REQUEST['perm_addr2'];
		$addr_mobile=$_REQUEST['addr_mob'];
		$addr_email=$_REQUEST['addr_email'];
		$perm_mobile=$_REQUEST['mob_p'];
		$perm_email=$_REQUEST['email_p'];
		$adno = $_REQUEST['adno'];
		$permSameAsCurr = $pSAC = $_REQUEST['sameAsCurrentAddress'];
		$directPhD = $dPHD = $_REQUEST['directPhdValue'];
		//$photo = $_REQUEST['photo'];
		//$categorycerti = $_REQUEST['cat_certi'];				
		//if(isset($_REQUEST['sameAsCurrentAddress']))
		//{
		//	$pSAC=1;	
		//}
		//else
		//{
		//	$pSAC=0;
		//}
		if($pSAC==1)
		{
			$perm_addr=$addr;
			$perm_mobile=$addr_mobile;
			$perm_email=$addr_email;
		}
		//if(isset($_REQUEST['directPhdValue']))
		//{
		//	$dPHD=1;
		//}
		//else
		//{
		//	$dPHD=0;
		//}

		// $dPHD=$_REQUEST['directPhdValue'];

		//echo $dPHD;

		if(strlen($addr_email)!=0)
		{
			if(!validateEmail($addr_email))
			{
				$error=1;
				echo "Enter proper email address";
			}
		}

		if(strlen($perm_email)!=0)
		{
			if(!validateEmail($addr_email))
			{
				$error=1;
				echo "<p class='text-center'>Enter proper email address</p>";
			}
		}

		if(strlen($dob)!=0)
		{
			$dobSplitArray=explode("-", $dob);

			if(!validateDate($dobSplitArray[1],$dobSplitArray[0],$dobSplitArray[2]) or $dobSplitArray[2]=='00' or strlen($dobSplitArray[1])!=2 or strlen($dobSplitArray[2])!=2 or strlen($dobSplitArray[0])!=4 )
			{
				$error=1;
				echo "<p class='text-center'>Check your date of birth</p>";
			}
			else
			{
				if(!validateDateOfBirth($dobSplitArray[1],$dobSplitArray[0],$dobSplitArray[2]) or $dobSplitArray[2]=='00' or strlen($dobSplitArray[1])!=2 or strlen($dobSplitArray[2])!=2 or strlen($dobSplitArray[0])!=4 )
				{
					$error=1;
					echo "<p class='text-center'>Date of birth is ahead of now</p>";
				}
			}
			
		}
			
		if(strlen($addr_mobile)!=0)
		{
			if(!is_int(intval($addr_mobile)))
			{
				$error=1;
				echo "<p class=\"text-center\">Please enter a valid mobile number</p>";
				echo gettype($addr_mobile);
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
					{
						if($id=='')
						{
							$sql1=" INSERT INTO form1 (userid,photo) VALUES  ('$usrid1','$photo')";
							mysqli_query($con,$sql1);						
						}
						else
						{
							$sql1="	UPDATE form1 SET photo='$photo' WHERE userid = '$usrid1' ";
							mysqli_query($con,$sql1);							
						}
						echo "<br><span style='color:green;'>Photo Saved</span><br>";
					}
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
					{
						if($id=='')
						{
							$sql1=" INSERT INTO form1 (userid,categorycerti) VALUES  ('$usrid1','$categorycerti')";
							mysqli_query($con,$sql1);						
						}
						else
						{
							$sql1="	UPDATE form1 SET categorycerti='$categorycerti' WHERE userid = '$usrid1' ";
							mysqli_query($con,$sql1);							
						}	
						echo "<br><span style='color:green;'>Category certificate saved</span><br>";
					}
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

		if($error==0 )
		{
			mysqli_query($con,"delete from form1 where userid=$usrid1");
			$sql1=" INSERT INTO form1 (userid,post,area,researcharea,name,dob,nationality,gender,category,address,addr_mobile,addr_email,
				permaddress,perm_mobile,perm_email,fathername,designation,submitted,photo,categorycerti,adno,permAddSame,directPHD) VALUES  ('$usrid1','$post','$area','$research','$name','$dob','$nationality','$gender','$caste','$addr','$addr_mobile','$addr_email',
				'$perm_addr','$perm_mobile','$perm_email','$fname','$posn',0,'$photo','$categorycerti','$adno','$pSAC','$dPHD')";
				mysqli_query($con,$sql1);// or die(mysqli_error($con));
				//echo "<br/><span class='text-center' style='color:green;'>Personal Details SAVED</span>";
		}
		if($error==0 && $year_error=='')
		{
				echo "<script>alert('Personal Details SAVED'); </script>";			
				if(isset($_POST[submitted_val1]))
				{
					echo '<meta http-equiv="REFRESH" content="0;url=form2.php?a=1">';					
				}
					echo '<meta http-equiv="REFRESH" content="0;url=form1.php?a=1">';								
		}
			
	}
?>

<script>

	function checkPersonName(e)
	{
		var k = e.which || e.keyCode || e.charCode;
	        var ok = k >= 65 && k <= 90 || // A-Z
	            k >= 97 && k <= 122 || k==8 || k==37 || k==39 || k==9 || k==32 || k==46;

	        if (!ok){
	            e.preventDefault();
	        }
	}

	function checkDateValue(e)
	{
		var k = e.which || e.keyCode || e.charCode;
	        var ok = (k>=48&&k<=57) || k==45 || k==8 || k==37 || k==39 || k==9 || k==32 || k==46;

	        if (!ok){
	            e.preventDefault();
	        }
	}

	function checkMobileValue(e)
	{
		var k = e.which || e.keyCode || e.charCode;
	    var ok = (k>=48 && k<=57) || k==8 || k==37 || k==39 || k==9 ||  k==46;

	    if (!ok){
	        e.preventDefault();
	    }
	}

</script>
<html>
	<body>
		<div class="row">

			<div class="col-md-12">

				<form method="post" class="form" action="form1.php" enctype="multipart/form-data">
					<script type="text/javascript">
						var count1 = 1;
						function add_row16(cnt)
						{
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
								var cell8=row.insertCell(7);
								var parameter='percent'+count1;
								cell1.innerHTML=count1+".";
								cell2.innerHTML="<td><select class='form-control'  name=\"degreetype"+count1+"\"><option value=\"\">Select</option><option value=\"1\">Undergraduate-level</option><option value=\"2\" >Graduate-level</option><option value=\"3\" >Doctoral-level</option></select></td>";
								cell3.innerHTML="<td><input class='form-control' type=\"text\" name=\"degree"+count1+"\" size=\"8\"></td>";
								cell4.innerHTML="<td><input class='form-control' type=\"text\" name=\"insti"+count1+"\" size=\"8\"></td>";
								cell5.innerHTML="<td><input class='form-control' type=\"number\" min=\"1980\" max='2015' name=\"yoe"+count1+"\" size=\"4\"></td>";
								cell6.innerHTML="<td><input class='form-control' type=\"number\" min='1980' max='2015' name=\"yol"+count1+"\" size=\"4\"></td>";
								cell7.innerHTML="<td><select class='form-control'  onchange=\"scoring('"+count1+"')\" id=\"scoreType"+count1+"\" name=\"scoreType"+count1+"\"><option value=\"\">Select</option><option value=\"1\">Percentage</option><option value=\"2\" >CGPA out of 4</option><option value=\"3\" >CGPA out of 8</option><option value=\"4\" >CGPA out of 10</option></select></td>";
								cell8.innerHTML="<td><input class='form-control' type=\"number\" min=\"0\" step=\"0.01\" id=\"percent"+count1+"\" name=\"percent"+count1+"\" size=\"10\"><input type=\"hidden\" name=\"count1\" value=\""+count1+"\"></td>";
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
									var cell8=row.insertCell(7);
									var sno= <?php echo json_encode($sno); ?>;
									var degree= <?php echo json_encode($degree); ?>;
									var insti= <?php echo json_encode($insti); ?>;
									var yoe= <?php echo json_encode($yoe); ?>;
									var yol= <?php echo json_encode($yol); ?>;
									var scoreType=<?php echo json_encode($scoreType); ?>;
									var percent= <?php echo json_encode($percent); ?>;
									var degreetype = <?php echo json_encode($degreetype); ?>;
									if(degreetype[i-1] == 1)  
									{
										cell2.innerHTML="<td><select name=\"degreetype"+i+"\" class=\"form-control\" ><option value=\"\">Select</option> <option value=\"1\" Selected=\"Selected\">Undergraduate-level</option> <option value=\"2\">Graduate-level</option><option value=\"3\">Doctoral-level</option></select></td>";
									}
									else if(degreetype[i-1] == 2)
									{
										cell2.innerHTML="<td><select name=\"degreetype"+i+"\" class=\"form-control\" ><option value=\"\">Select</option> <option value=\"1\">Undergraduate-level</option> <option value=\"2\" Selected=\"Selected\">Graduate-level</option><option value=\"3\">Doctoral-level</option></select></td>";
									}
					
									else if(degreetype[i-1] == 3)  
									{
										cell2.innerHTML="<td><select name=\"degreetype"+i+"\" class=\"form-control\" ><option value=\"\">Select</option> <option value=\"1\">Undergraduate-level</option> <option value=\"2\">Graduate-level</option><option value=\"3\" Selected=\"Selected\">Doctoral-level</option></select></td>";
									}
									else  
									{
										cell2.innerHTML="<td><select name=\"degreetype"+i+"\" class=\"form-control\" ><option value=\"\" Selected=\"Selected\">Select</option> <option value=\"1\">Undergraduate-level</option> <option value=\"2\">Graduate-level</option><option value=\"3\">Doctoral-level</option></select></td>";
									}
									//alert(sno[i-1]);
									cell1.innerHTML=sno[i-1]+".";
									cell3.innerHTML="<td><input class=\"form-control\" type=\"text\" name=\"degree"+i+"\" value = \""+degree[i-1]+"\"  size=\"8\"></td>";
									cell4.innerHTML="<td><input class=\"form-control\" type=\"text\" name=\"insti"+i+"\" value = \""+insti[i-1]+"\" size=\"8\"></td>";
									cell5.innerHTML="<td><input class=\"form-control\" type=\"number\" name=\"yoe"+i+"\"  value = \""+yoe[i-1]+"\" min=\"1980\" max=\"2015\"size=\"4\"></td>";
									cell6.innerHTML="<td><input class=\"form-control\" min=\"1980\" max=\"2015\" type=\"number\" name=\"yol"+i+"\"  value = \""+yol[i-1]+"\" size=\"4\"></td>";
									if(scoreType[i-1]==1)
									{
										cell7.innerHTML="<td><select class=\"form-control\"  onchange=\"scoring('"+i+"')\" id=\"scoreType"+i+"\" name=\"scoreType"+i+"\"><option value=\"\">Select</option><option value=\"1\" Selected=\"Selected\">Percentage</option><option value=\"2\" >CGPA out of 4</option><option value=\"3\" >CGPA out of 8</option><option value=\"4\" >CGPA out of 10</option></select></td>";
									}

									else if(scoreType[i-1]==2)
									{							
										cell7.innerHTML="<td><select class=\"form-control\"  onchange=\"scoring('"+i+"')\" id=\"scoreType"+i+"\" name=\"scoreType"+i+"\"><option value=\"\">Select</option><option value=\"1\">Percentage</option><option value=\"2\"  Selected=\"Selected\">CGPA out of 4</option><option value=\"3\" >CGPA out of 8</option><option value=\"4\" >CGPA out of 10</option></select></td>";
									}

									else if(scoreType[i-1]==3)
									{									
										cell7.innerHTML="<td><select class=\"form-control\"  onchange=\"scoring('"+i+"')\" id=\"scoreType"+i+"\" name=\"scoreType"+i+"\"><option value=\"\">Select</option><option value=\"1\">Percentage</option><option value=\"2\"  >CGPA out of 4</option><option value=\"3\" Selected=\"Selected\">CGPA out of 8</option><option value=\"4\" >CGPA out of 10</option></select></td>";
									}

									else if(scoreType[i-1]==4)
									{									
										cell7.innerHTML="<td><select class=\"form-control\"  onchange=\"scoring('"+i+"')\" id=\"scoreType"+i+"\" name=\"scoreType"+i+"\"><option value=\"\">Select</option><option value=\"1\">Percentage</option><option value=\"2\"  >CGPA out of 4</option><option value=\"3\" >CGPA out of 8</option><option value=\"4\" Selected=\"Selected\">CGPA out of 10</option></select></td>";
									}
									else
									{
										cell7.innerHTML="<td><select class=\"form-control\"  onchange=\"scoring('"+i+"')\" id=\"scoreType"+i+"\" name=\"scoreType"+i+"\"><option value=\"\"  Selected=\"Selected\" >Select</option><option value=\"1\">Percentage</option><option value=\"2\"  >CGPA out of 4</option><option value=\"3\" >CGPA out of 8</option><option value=\"4\">CGPA out of 10</option></select></td>";
									}
									cell8.innerHTML="<td><input  class=\"form-control\" min=\"0\" step=\"0.01\" max=\"100\" type=\"number\" id=\"percent"+i+"\" name=\"percent"+i+"\"  value = \""+percent[i-1]+"\"  size=\"10\"><input type=\"hidden\" name=\"count1\" value=\""+i+"\"></td>";
									scoring(i);
								}
							}
						}
						function scoring(counter)
						{
							para1="scoreType"+counter;							
							para="percent"+counter;

							if(document.getElementById(para1).value=="1")
							{
								document.getElementById(para).max=100;																							
							}
							else if(document.getElementById(para1).value=="2")
							{
								document.getElementById(para).max=4;
							}
							else if(document.getElementById(para1).value=="3")
							{
								document.getElementById(para).max=8;
							}
							else if(document.getElementById(para1).value=="4")
							{
								document.getElementById(para).max=10;
							}
							else if(document.getElementById(para1).value=="")
							{						
								document.getElementById(para).max=100;
							}
						}
						
						/*function retrieval_scoring(counter,index)
						{
							para="percent"+index;
							//alert(counter.value);
							if(counter.value=="1")
							{
								document.getElementById(para).max=100;																							
							}
							else if(counter.value=="2")
							{
								document.getElementById(para).max=4;
							}
							else if(counter.value=="3")
							{
								document.getElementById(para).max=8;
							}
							else if(counter.value=="4")
							{
								document.getElementById(para).max=10;
							}
							else if(counter.value=="")
							{
								document.getElementById(para).max=100;
							}
						}*/				
						//alert(document.getElementById(para).max);
					</script>

					<script type="text/javascript">
						function check_file(a){
					        if(document.getElementById(a).files[0].size >= 2097152)
					        {
					        alert("Size of the file should be less than 2MB");
					            document.getElementById(a).value='';        		        		
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
									<b>1. Post Applied</b> <span style="color:red;">*</span>
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
									<b>2. Broad Area</b> <span style="color:red;">*</span>
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
									<b>3. Current Areas Of Research</b> <span style="color:red;">*</span>
								</td>
								<td>
									<div class="col-md-6">
										<input class="form-control" type="text" name="research" value="<?php echo $research; ?>"  >
									</div>
								</td>
							</tr>
							<tr>	
								<td>
									<b>4. Advertisement No</b></td><td><div class="col-md-6">
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
									<b>5. Name in Full</b> (Capital Letters) <span style="color:red;">*</span></br>(as in SSLC Certificate)
								</td>
								<td>
									<div class="col-md-6">
										<input class="form-control" type="text" name="name" value="<?php echo $name; ?>" onkeypress="checkPersonName(event);" >
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<b>6. Date Of Birth</b> <span style="color:red;">*</span></br>
								</td>
								<td>
									<div class="col-md-6">
										YYYY-MM-DD</br>
										<input class="date-picker form-control" data-date-format="YYYY-MM-DD" type="text" name="dob" value="<?php echo $dob; ?>" onkeypress="checkDateValue(event);"></br>
										<!--Age:<input type="text" size="1" name="yrs" value="<?php echo $_REQUEST['yrs']; ?>" >Y<input type="text" size="1" name="months" value="<?php echo $_REQUEST['months']; ?>" >M -->
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<b>7. Photograph</b> <span style="color:red;">*</span>
								</td>
								<td>
									<div class="col-md-6">
										Photo in GIF/JPEG/PNG format only<br/>
										<input type="file"  onchange="check_file_image('photo'); check_file('photo');" name="photo" id="photo"><?php if(strlen($photo) > 0) echo "You have already uploaded the photo." ?> <br>
									</div>
								</tr>
							<tr>
								</td>
								<td>
									<b>8. Nationality</b> <span style="color:red;">*</span>
								</td>
								<td>
									<div class="col-md-6">
										<input class="form-control" type="text" name="nationality" value="<?php echo $nationality; ?>" onkeypress="checkPersonName(event);">
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<b>9. Gender</b> <span style="color:red;">*</span>
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
									<b>10. Category</b> <span style="color:red;">*</span></br>(Attach Certificate(s))
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
	
												<?php 				
												$temp_addr_dollar=explode('$',$addr);
												$temp_addr1= $temp_addr_dollar[0];
												$temp_addr2= $temp_addr_dollar[1];
												$perm_addr_dollar=explode('$',$perm_addr);
												$perm_addr1= $perm_addr_dollar[0];
												$perm_addr2= $perm_addr_dollar[1];
												$psacurr=$permSameAsCurr[0];
												$dirphd=$directPhD[0];
												?>
												<script type="text/javascript"> 
													var temp=0;
													var ta1= "<?php echo $temp_addr1; ?>";
													var ta2= "<?php echo $temp_addr2; ?>";
													var pa1= "<?php echo $perm_addr1; ?>";
													var pa2= "<?php echo $perm_addr2; ?>";
													var mt= "<?php echo $addr_mobile; ?>";
													var mp= "<?php echo $perm_mobile; ?>";
													var et= "<?php echo $addr_email; ?>";
													var ep= "<?php echo $perm_email; ?>";													
													if(ta1==pa1 && ta2== pa2 && mt==mp)
													{
														ep=mp=pa2=pa1="";
													}
												function alerting(a)
												{
													//alert(a + " "+ temp);																										
													if(a=='1')
													{
														temp++;
													}
													if(temp%2==0)
													{
														document.getElementById('perm_add1').value= ta1;
														document.getElementById('perm_add2').value= ta2;
														document.getElementById('mob_p').value=mt;
														document.getElementById('email_p').value=et;														
														document.getElementById('perm_add1').disabled = true;
														document.getElementById('perm_add2').disabled = true;
														document.getElementById('mob_p').disabled = true;
														document.getElementById('email_p').disabled = true;
													}
													else
													{
														document.getElementById('perm_add1').value= pa1;
														document.getElementById('perm_add2').value= pa2;														
														document.getElementById('mob_p').value=mp;
														document.getElementById('email_p').value=ep;														
														document.getElementById('perm_add1').disabled = false;
														document.getElementById('perm_add2').disabled = false;														
														document.getElementById('mob_p').disabled = false;
														document.getElementById('email_p').disabled = false;														
													}
													if(a=='0')
													{
														temp++;
													}
												}
												function disable()
												{
													return "hello";
												}
												</script>

								</table>
									</div>
									<div class="col-md-4 col-md-offset-1">
										<br/><br/><br/>
										Upload the certificate in PDF format only<br/>
										<input type="file" onchange="check_file_pdf('cat_certi'); check_file('cat_certi');" name="cat_certi" id="cat_certi"><?php if(strlen($categorycerti) > 0) echo "You have already uploaded the category certificate." ?>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<b>11. Address for Communication</b> <span style="color:red;">*</span>
								</td>
								<td>
									<div class="col-md-6">
										<!--<textarea class="form-control" rows="5" cols="100" name="addr" type="text"><?php echo $addr; ?></textarea></br> -->
											<input class="form-control" name="temp_addr1" type="text" value="<?php echo $temp_addr1; ?>"> <br/>
											<input class="form-control" name="temp_addr2" type="text" value="<?php echo $temp_addr2; ?>"> <br/>											
										<table class="table">
											<tr>
												<td><b>Mobile</b></td><td>
												<div class="col-md-12"><input class="form-control" placeholder="Should be of the form 9898989898. 6 to 10 characters." type="text" pattern=".{6,10}" name="addr_mob" value="<?php echo $addr_mobile; ?>" maxlength="10" size="10" onkeypress="checkMobileValue(event);check_mobile_number(this,event);"></div>
												</td>
											</tr>
											<tr>
												<td><b>Email</b></td><td><div class="col-md-12"><input class="form-control" type="email" name="addr_email" value="<?php echo $addr_email; ?>"></div>
												</td>
											</tr>
										</table>
									</div>
							</td></tr>
							<tr>
								<td>
									<b>12. Permanent Home Address</b> <span style="color:red;">*</span>
								</td>
								<td>
									<div class="col-md-6">
									<!-- <textarea class="form-control" rows="5" cols="100" name="addr_p" type="text"><?php echo $perm_addr; ?></textarea></br> -->
										<input class="form-control" type="text" id="perm_add1" name="perm_addr1" value="<?php if($psacurr==1) echo $temp_addr1; else echo $perm_addr1; ?>" <?php if($psacurr==1) echo 'disabled';?> > <br/>
										<input class="form-control" type="text" id="perm_add2" name="perm_addr2" value="<?php if($psacurr==1) echo $temp_addr2; else echo $perm_addr2; ?>" <?php if($psacurr==1) echo 'disabled';?> > <br/>
									<table class="table">
										<tr>
											<td><b>Mobile</b></td><td><div class="col-md-12"><input placeholder="Should be of the form 9898989898" class="form-control" id="mob_p" minLength="6" type="text" maxlength="10" size="10" pattern=".{6,10}" name="mob_p" value="<?php if($psacurr==1) echo $addr_mobile; else echo $perm_mobile; ?>" onkeypress="checkMobileValue(event);check_mobile_number(this,event);"  <?php if($psacurr==1) echo 'disabled';?> ></div>
											</td>
										</tr>
											<tr>
												<td><b>Email</b></td><td><div class="col-md-12"><input class="form-control" type="email" name="email_p" id="email_p" value="<?php if($psacurr==1) echo $addr_email; else echo $perm_email; ?>"  <?php if($psacurr==1) echo 'disabled';?> ></div>
												</td>
											</tr>										
									</table>
									</div>
									<div class="col-md-6">

										<label>

											<input type="checkbox" value="1" onchange="alerting('<?php echo $psacurr; ?>')" name="sameAsCurrentAddress"  <?php if($psacurr==1) echo 'checked="checked"';?> >&nbsp;&nbsp; Check this if permanent address is same as current address
										</label>

									</div>
								</td>
							</tr>
							<tr>
								<td>
									<b>13. Name of Father/Husband</b> <span style="color:red;">*</span>
								</td>
								<td>
									<div class="col-md-6">
										<input class="form-control" type="text" size="50" name="fname" value="<?php echo $fname; ?>"  onkeypress="checkPersonName(event);">
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<b>14. Present Position/Designation & Pay Drawn</b>  <span style="color:red;">*</span>
								</td>
								<td>
									<div class="col-md-6">
										<input class="form-control" type="text" size="50" name="posn" value="<?php echo $posn; ?>">
									</div>
								</td>
							</tr>
							<tr >
								<td>
									<b>15. Educational Qualifications</b><br/> (Starting from Bachelor's Degree) <span style="color:red;">*</span>
								</td>

								<td>
									
									<label><input type="checkbox" value="1" name="directPhdValue" <?php if($dirphd==1) echo"checked='checked'"; ?> >&nbsp&nbsp;Direct Ph.D &nbsp;&nbsp; </label><small> Check this if Ph.D is taken after undergraduate degree.</small>

								</td>

							</tr>

							<tr class="col-md-12">
									<table class="table " id="myTable1" >	
										<tr>
											<th>Sl.No</th>
											<th class="col-md-2">Degree Type</th>
											<th class="col-md-2">Degree</th>
											<th class="col-md-3">Institution/University</th>
											<th class="col-md-1">Year Of Entry</th>
											<th class="col-md-1">Year Of Leaving</th>
											<th class="col-md-2">Score type</th>
											<th class="col-md-2">Score</th>
										</tr>
									</table>
									<?php 	create_row1(); ?>
									<br/>
									<button type="button" class="btn btn-sm btn-primary" onclick="<?php echo "add_row16(0)";?>">Insert new row</button>
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