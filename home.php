<?php require_once("./include/membersite_config.php");
if($fgmembersite->CheckLogin())
   {
        $fgmembersite->RedirectToURL("form1.php");
   }
?>

<?php include 'header1.php'; ?>
<?php include 'tab_style.php'; ?>
<html>
<div id="header">
  <ul>
    <li id="current"><a href="home.php">Home</a></li>
    <li><a href="register.php">Register</a></li>
    <li><a href="login.php">Login</a></li>
  </ul>
</div>
<br/><br/>
<body>
<br/><br/>

Welcome to IIITD&M online Faculty Recruitment portal.Kindly go through the <a href="instructions.php">instructions</a> before filling in the forms.</br>


</body>

<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

</html>

<?php include 'footer.php'; ?>


