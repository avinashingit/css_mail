<?php include 'check.php'; ?>
<?php include 'form1_h.php'; ?>
<?php
require_once("./include/membersite_config.php");

	if($isAdmin)
		{
 	$fgmembersite->RedirectToURL("admin_home.php");
 	  }
	$con=mysqli_connect("localhost","root","rootpw","faculty_recruitment");
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
//	$usrid1 = $_GET['usrid'];
	$usrid1 = $_SESSION['userid'];

	if(mysqli_num_rows(mysqli_query($con, "select submitted from form1 where userid = $usrid1 and submitted = 1")) > 0)
	{
		echo "<br/><br/><br/><br/>Your form is already submitted<br>";
		echo 'Click <a href="pdf_final.php">here</a></li> to generate the pdf of your application';
		//echo '<p><a href=".">Home</a></p>';
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

	if(isset($_POST[submitted_val])) 
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
		
		$query = "INSERT INTO educational_qualifications (userid,sno,degree,insti,yoe,yol,percent) VALUES ($usrid1,$i,'$degree','$insti','$yoe','$yol',$percent)";
		mysqli_query($con,$query);

	}




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
						echo "photo saved<br>";
					else echo "File not saved<br>";
    				}
			}
			else
  			{
  				echo "Invalid file";
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
						echo "Category certificate saved<br>";
					else echo "File not saved<br>";
    				}
			}
			else
  			{
  				echo "Invalid file";
  			}
	
		// End upload script
		}
		
		
		$sql1="INSERT INTO form1(userid,post,area,researcharea,name,dob,nationality,gender,category,address,addr_mobile,addr_email,
permaddress,perm_mobile,perm_email,fathername,designation,submitted,photo,categorycerti) VALUES  ('$usrid1','$post','$area','$research','$name','$dob','$nationality','$gender','$caste','$addr','$addr_mobile','$addr_email',
'$perm_addr','$perm_mobile','$perm_email','$fname','$posn',0,'$photo','$categorycerti')";
			mysqli_query($con,$sql1);
		echo '<meta http-equiv="REFRESH" content="0;url=saved1.php">';		
		}
	}

     /*if(!empty($errorMessage)) 
		    	{
			    echo("<p>There was an error with your form:</p>\n");
			    echo("<ul>" . $errorMessage . "</ul>\n");
            		}*/

?>


<html>
<body>

<form method="post" enctype="multipart/form-data">

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
cell2.innerHTML="<input type=\"text\" name=\"degree"+count1+"\"></td>";
cell3.innerHTML="<input type=\"text\" name=\"insti"+count1+"\"></td>";
cell4.innerHTML="<input type=\"text\" name=\"yoe"+count1+"\" size=\"8\"></td>";
cell5.innerHTML="<input type=\"text\" name=\"yol"+count1+"\" size=\"8\"></td>";
cell6.innerHTML="<input type=\"text\" name=\"percent"+count1+"\" size=\"5\"></td>";
cell7.innerHTML="<input type=\"hidden\" name=\"count1\" value=\""+count1+"\"></td>";
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

cell1.innerHTML=sno[i-1];
cell2.innerHTML="<input type=\"text\" name=\"degree"+i+"\" value = \""+degree[i-1]+"\" ></td>";
cell3.innerHTML="<input type=\"text\" name=\"insti"+i+"\" value = \""+insti[i-1]+"\"></td>";
cell4.innerHTML="<input type=\"text\" name=\"yoe"+i+"\"  value = \""+yoe[i-1]+"\"></td>";
cell5.innerHTML="<input type=\"text\" name=\"yol"+i+"\"  value = \""+yol[i-1]+"\"></td>";
cell6.innerHTML="<input type=\"text\" name=\"percent"+i+"\"  value = \""+percent[i-1]+"\"></td>";
cell7.innerHTML="<input type=\"hidden\" name=\"count1\" value=\""+i+"\"></td>";
}
}

}

</script>
<left>
<br/><br/><br/><br/>
<table id="myTable" border="1">
<tr><td>
1. Post Applied
</td><td>
<select name="post" >
  <option value="" <?php if($post=='') echo 'Selected="Selected"'?> >Select</option>
  <option value="Professor" <?php if($post=='Professor') echo 'Selected="Selected"'?>>Professor</option>
  <option value="Assistant Professor" <?php if($post=='Assistant Professor') echo 'Selected="Selected"'?> >Assistant Professor</option>
  <option value="Associate Professor" <?php if($post=='Associate Professor') echo 'Selected="Selected"'?> >Associate Professor</option>
</select>
</td></tr>
<tr><td>
2. Broad Area
</td><td>
<select name="area">
  <option value=""<?php if($area=='') echo 'Selected="Selected"'?>>Select</option>
  <option value="Computer Science" <?php if($area=='Computer Science') echo 'Selected="Selected"'?>>Computer Science</option>
  <option value="Electronics" <?php if($area=='Electronics') echo 'Selected="Selected"'?>>Electronics</option>
  <option value="Mechanical" <?php if($area=='Mechanical') echo 'Selected="Selected"'?>>Mechanical</option>
  <option value="Engineering Design" <?php if($area=='Engineering Design') echo 'Selected="Selected"'?>>Engineering Design</option>
</select>
</td></tr>
<tr><td>
3. Current Areas Of Research
</td><td>
<input type="text" name="research" value="<?php echo $research; ?>"  >
</td></tr>
</tr><td>
4. Advertisement No</td><td>
<?php
	
$retrieve = "SELECT * FROM advt_number";
	$result = mysqli_query($con,$retrieve);
	while($row = mysqli_fetch_array($result))
  	{

		$advt_no=$row['advt_no'];
		
  	}
	echo $advt_no;
        
?>
</td></tr>
<tr><td>
5. Name in Full (Capital Letters)</br>(as in SSLC Certificate)
</td><td>
<input type="text" name="name" value="<?php echo $name; ?>" >
</td></tr>
<tr><td>
6. Date Of Birth</br>(Enclose a copy of SSLC Certificate)
</td><td>
YYYY-MM-DD </br>
<input type="date" name="dob" value="<?php echo $dob; ?>" ></br>
<!--Age:<input type="text" size="1" name="yrs" value="<?php echo $_REQUEST['yrs']; ?>" >Y<input type="text" size="1" name="months" value="<?php echo $_REQUEST['months']; ?>" >M -->
</td></tr>
<tr><td>	
7. Photograph
</td><td>
Photo in GIF/JPEG/PNG format only<br/>
<input type="file" name="photo" id="photo"><?php if(strlen($photo) > 0) echo "You have already uploaded the photo." ?> <br>
</tr><tr>
</td><td>
8. Nationality
</td><td>
<input type="text" name="nationality" value="<?php echo $nationality; ?>" >
</td></tr>
<tr><td>
9. Gender
</td><td>
<table>
<tr><td>Male</td><td><input type="radio" name="gender" value="Male" <?php if($gender=='Male') echo 'checked="checked"'?>/></td></tr>
<tr><td>Female</td><td><input type="radio" name="gender" value="Female" <?php if($gender=='Female') echo 'checked="checked"'?> /></td></tr>
</table>
</td></tr>
<tr><td>
10. Category </br>(Attach Certificate(s))
</td><td>
SC<input type="radio" name="caste" value="SC" <?php if($caste == 'SC') echo 'checked' ?>/><br />
ST<input type="radio" name="caste" value="ST" <?php if($caste == 'ST') echo 'checked' ?> /><br />
OBC<input type="radio" name="caste" value="OBC" <?php if($caste == 'OBC') echo 'checked' ?> /><br />
Others<input type="radio" name="caste" value="Others" <?php if($caste == 'Others') echo 'checked' ?>/><br />
Upload the certificate in PDF format only<br/>
<input type="file" name="cat_certi" id="cat_certi"><?php if(strlen($categorycerti) > 0) echo "You have already uploaded the category certificate." ?><br>
</td></tr>
<tr><td>
11. Address for Communication
</td><td>
<textarea rows="5" cols="100" name="addr" type="text"><?php echo $addr; ?></textarea></br>
<table border="1">
<tr><td>Mobile</td><td><input type="text" name="addr_mob" value="<?php echo $addr_mobile; ?>"></td></tr>
<tr><td>Email</td><td><input  type="text" name="addr_email" value="<?php echo $addr_email; ?>"></td></tr>
</table>
</td></tr>
<tr><td>
12. Permanent Home Address
</td><td>
<textarea rows="5" cols="100" name="addr_p" type="text"><?php echo $perm_addr; ?></textarea></br>
<table border="1">
<tr><td>Mobile</td><td><input type="text" name="mob_p" value="<?php echo $perm_mobile; ?>"></td></tr>

</table>
</td></tr>
<tr><td>
13. Name of Father/Husband
</td><td>
<input type="text" size="50" name="fname" value="<?php echo $fname; ?>">
</td></tr>
<tr><td>
14. Present Position/Designation & Pay Drawn  
</td><td>
<input type="text" size="50" name="posn" value="<?php echo $posn; ?>">
</td></tr>
<tr><td>
15. Educational Qualifications (Starting from Bachelor's Degree)
</td><td>

<table id="myTable1" border="1">
<tr><th size="10">Sl.No</th><th>Degree</th><th>Institution/University</th><th>Year Of Entry</th><th>Year Of Leaving</th><th>Percentage</br>(out of 100)</th></tr>
<!--<tr><td>1</td><td><input type="text" size="10" name="degree" value="<?php echo $degree; ?>"></td><td><input type="text" size="10" name="insti" value="<?php echo $insti; ?>"></td><td><input type="text" size="10" name="yoe" value="<?php echo $yoe; ?>"></td><td><input type="text" size="10" name="yol" value="<?php echo $yol; ?>"></td><td><input type="text" size="10" name="percent" value="<?php echo $percent; ?>"></td></tr> -->
</table>

<?php 	create_row1(); ?>

<br/>
<button type="button" onclick="<?php echo "add_row16(0)";?>">Insert new row</button>

</td></tr>
</table>
</br>
<input type="submit" name = "submitted_val" value="Save Form">

</form> 
</left>

</body>
</html> 



