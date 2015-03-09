<?php include 'header1.php'; ?>
<?php include 'tab_style.php'; ?>
 <?php
     function curPageURL()
     {
         $pageURL = 'http';
         if (isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" ) {$pageURL .= "s";}
         $pageURL .= "://";
         if ($_SERVER["SERVER_PORT"] != "80") {
             $pageURL .=
             $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
         }
         else {
             $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
         }
         return $pageURL;
     }

     $pageurl =curPageURL();

     $arr = explode("/",$pageurl);
 ?>


<div class="row">
	<div class="col-md-12 text-center">
  <ul class="nav nav-tabs nav-justified">

  <?php 
  if($arr[sizeof($arr)-1]=="form1.php" or $arr[sizeof($arr)-1]=='form1.php?a=1')
    {?>

    <li class="active"><a href="form1.php">Personal Details</a></li>
    <?php
    }
  else
    {?>
    <li><a href="form1.php">Personal Details</a></li>
    <?php
    }?>


    <?php 
  if($arr[sizeof($arr)-1]=="form2.php" or $arr[sizeof($arr)-1]=='form2.php?a=1')
    {?>

    <li class="active"><a href="form2.php">Publication Details</a></li>
    <?php
    }
  else
    {?>
    <li><a href="form2.php">Publication Details</a></li>
    <?php
    }?>



    <?php
    if($arr[sizeof($arr)-1]=="form3.php" or $arr[sizeof($arr)-1]=='form3.php?a=1')
    {?>
    <li class="active"><a href="form3.php">Professional Activities</a></li>
    <?php
    }
  else
    {?>
    <li><a href="form3.php">Professional Activities</a></li>
    <?php
    }?>



    <?php
    if($arr[sizeof($arr)-1]=="form4.php" or $arr[sizeof($arr)-1]=='form4.php?a=1')
    {?>

    <li class="active"><a href="form4.php">SOP and LOR</a></li>
    <?php
    }
    else
    {?>
    <li><a href="form4.php">SOP and LOR</a></li>
    <?php
    }?>

    <?php
    if($arr[sizeof($arr)-1]=="submit.php" or $arr[sizeof($arr)-1]=='submit.php?a=1')
    {?>

    <li class="active"><a href="submit.php">Submit</a></li>
    <?php
    }
    else
    {?>
    <li><a href="submit.php">Submit</a></li>
    <?php
    }?>


    
    <?php
    if($arr[sizeof($arr)-1]=="change-pwd.php")
    {?>

    <li class="active"><a href="change-pwd.php">Change Password</a></li>
    <?php
    }
    else
    {?>
    <li><a href="change-pwd.php">Change Password</a></li>
    <?php
    }?>


    <?php
    if($arr[sizeof($arr)-1]=="logout.php")
    {?>

    <li class="active"><a href="logout.php">Logout</a></li>
    <?php
    }
    else
    {?>
    <li><a href="logout.php">Logout</a></li>
    <?php
    }?>
	<!--<li><a href="../pdf_final.php">Submit</a></li>-->
  </ul>
</div>
</div>
<br/>
