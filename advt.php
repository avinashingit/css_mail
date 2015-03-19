<?php include 'header1.php'; ?>
<?php include 'tab_style.php'; ?>

<html>
<body>
<?php


	$userid = $_SESSION["userid"];

?>


<form method="post" enctype="multipart/form-data">

<table id="myTable" border="1">
<tr><td>
1. Previous Advertisement Number
</td><td>
<?php
	$retrieve = "SELECT * FROM advt_number";
	$result = mysqli_query($con,$retrieve);
	while($row = mysqli_fetch_array($result))
  	{

		$advt_no=$row['advt_no'];
		
  	}
	echo $advt_no;
        ?>
</td>
<tr><td>
2. New Advertisement Number
</td><td>
<input type="text" name="advt_no" >

</td>
</table>
</br>
<input type="submit" name="submitted_val" value="Save Form" />
<?php
if(isset($_POST[submitted_val])) 
    		{			
		$errorMessage = "";
		
		if(empty($_POST['advt_no'] )) 
        	{
			$errorMessage .= "<li>No Advertise number updated, Update it !!</li>";
		}
		if(empty($errorMessage)) 
        	{ 
		mysqli_query($con,"delete from advt_number");
		$advt_no=$_REQUEST['advt_no'];
	//	echo $advt_no;
		$sql = "INSERT INTO advt_number(advt_no) VALUES ('$advt_no')";
		mysqli_query($con,$sql);
		}
 		if(!empty($errorMessage)) 
		    	{
			    echo("<p>There was an error with your form:</p>\n");
			    echo("<ul>" . $errorMessage . "</ul>\n");
            		}
       echo '<meta http-equiv="REFRESH" content="0;url=admin_home.php">';		


		}

?>
</html>
</body>
