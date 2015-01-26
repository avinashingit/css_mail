<?PHP
include 'header1.php';
require_once("./include/membersite_config.php");

include 'tab_style.php'; ?>
<div class="row">

  <div class="col-md-6 col-md-offset-3 text-center">
    <div class="text-center">
      <ul class="nav nav-tabs nav-justified">
        <li><a href="home.php">Home</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="change-pwd.php">Change Password</a></li>
      </ul>
    </div>

  </div>

</div>




<br/><br/><br/><br/>
<?php
$emailsent = false;
if(isset($_POST['submitted']))
{
   if($fgmembersite->EmailResetPasswordLink())
   {
        $fgmembersite->RedirectToURL("reset-pwd-link-sent.php");
        exit;
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Reset Password Request</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
</head>
<body>
<!-- Form Code Start -->

<div class="row">

  <div class="col-md-6 col-md-offset-3 text-center">

      <div>
        <form class="form" id='resetreq' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
        <fieldset >
          <div class="col-md-12">
          <legend>Reset Password</legend>

            <input type='hidden' name='submitted' id='submitted' value='1'/>

            <div class='short_explanation' style="color:red;">* required fields</div><br/>

            <div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
            <div class='form-group'>
                <label for='username' >Your Email*:</label><br/>
                <input class="form-control" type='text' name='email' id='email' value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
                <span id='resetreq_email_errorloc' class='error'></span>
            </div>
            <div class='text-center short_explanation'>A link to reset your password will be sent to the email address</div><br/>
            <div class='form-group'>
                <input class="btn btn-danger btn-sm" type='submit' name='Submit' value='Submit' />
            </div>

          </div>

        

        </fieldset>
        </form>
        <!-- client-side Form Validations:
        Uses the excellent form validation script from JavaScript-coder.com-->

        <script type='text/javascript'>
        // <![CDATA[

            var frmvalidator  = new Validator("resetreq");
            frmvalidator.EnableOnPageErrorDisplay();
            frmvalidator.EnableMsgsTogether();

            frmvalidator.addValidation("email","req","Please provide the email address used to sign-up");
            frmvalidator.addValidation("email","email","Please provide the email address used to sign-up");

        // ]]>
        </script>

        </div>


  </div>


</div>




<!--
Form Code End (see html-form-guide.com for more info.)
-->

</body>
</html>
<?php include 'footer.php'; ?>
