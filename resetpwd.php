<?PHP
require_once("./include/membersite_config.php");
include 'header1.php';
include 'tab_style.php'; ?>
<div id="header">
  <ul>
    <li><a href="home.php">Home</a></li>
    <li><a href="register.php">Register</a></li>	
	<li><a href="change-pwd.php">Change Password</a></li>
    <li><a href="login.php">Login</a></li>
  </ul>
</div>
<br/><br/><br/><br/>
<?php
$success = false;
if($fgmembersite->ResetPassword())
{
    $success=true;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Reset Password</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
</head>
<body>
<div id='fg_membersite_content'>
<?php
if($success){
?>
<h2>Password is Reset Successfully</h2>
Your new password is sent to your email address.
<?php
}else{
?>
<h2>Error</h2>
<span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span>
<?php
}
?>
</div>

</body>
</html>
<?php include 'footer.php'; ?>
