<?PHP
require_once("./include/membersite_config.php");
include 'header1.php';
include 'tab_style.php'; ?>
<div class="row">

  <div class="col-md-6 col-md-offset-3 text-center">
    <div class="text-center">
      <ul class="nav nav-tabs nav-justified">
        <li><a href="home.php">Home</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="change-pwd.php">Change password</a></li>
      </ul>
    </div>

  </div>

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
<h2 class="text-center">Password is Reset Successfully</h2>
<p class="text-center">Your new password is sent to your email address.</p>
<?php
}else{
?>
<h2 class="text-center">Error</h2>
<span class='text-center error'><?php echo $fgmembersite->GetErrorMessage(); ?></span>
<?php
}
?>
</div>
<br/><br/><br/><br/><br/>
</body>
</html>
<?php include 'footer.php'; ?>
