<?PHP
require_once("./include/membersite_config.php");?>
<?php include 'form_h.php'; ?>

<!--
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <ul class="nav nav-tabs nav-justified"> 
      <li><a href=".">Home</a></li>
      <li class="active"><a href="change-pwd.php">Change Password</a></li>
      <li><a href='logout.php'>Logout</a></li>
    </ul>
  </div>
</div>
!-->

<br/>
<?php
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}

if(isset($_POST['submitted']))
{
   if($fgmembersite->ChangePassword())
   {
        $fgmembersite->RedirectToURL("changed-pwd.php");
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Change password</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
      <link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
      <script src="scripts/pwdwidget.js" type="text/javascript"></script>       
</head>
<body>

<!-- Form Code Start -->
<div class="row">

  <div class="col-md-6 col-md-offset-3 text-center">

    <form class="form"  id='changepwd' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
    <fieldset >

    <input type='hidden' name='submitted' id='submitted' value='1'/>

    <div class='short_explanation' style="color:red;">* required fields</div>

    <br/>

    <div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
    <div class='form-group'>
        <label for='oldpwd' >Old Password <span style="color:red;">*</span>:</label><br/>
        <div class='pwdwidgetdiv col-md-6 col-md-offset-5' id='oldpwddiv' ></div>
        <noscript>
        <input class="form-control text-center" type='password' name='oldpwd' id='oldpwd' maxlength="50" />
        </noscript>    
        <span id='changepwd_oldpwd_errorloc' class='error'></span>
    </div>
    <br/>
    <div class='form-group'>
        <label for='newpwd' >New Password <span style="color:red;">*</span>:</label><br/>
        <div class='pwdwidgetdiv col-md-6 col-md-offset-5' id='newpwddiv' ></div>
        <noscript>
        <input class="form-control"  type='password' name='newpwd' id='newpwd' maxlength="50" /><br/>
        </noscript>
        <span id='changepwd_newpwd_errorloc' class='error'></span>
    </div>

    <br/><br/><br/>
    <div class='form-group'>
        <input class="btn btn-md btn-warning" type='submit' name='Submit' value='Submit' />
    </div>

    </fieldset>
    </form>
    <!-- client-side Form Validations:
    Uses the excellent form validation script from JavaScript-coder.com-->

    <script type='text/javascript'>
    // <![CDATA[
        var pwdwidget = new PasswordWidget('oldpwddiv','oldpwd');
        pwdwidget.enableGenerate = false;
        pwdwidget.enableShowStrength=false;
        pwdwidget.enableShowStrengthStr =false;
        pwdwidget.MakePWDWidget();
        
        var pwdwidget = new PasswordWidget('newpwddiv','newpwd');
        pwdwidget.MakePWDWidget();
        
        
        var frmvalidator  = new Validator("changepwd");
        frmvalidator.EnableOnPageErrorDisplay();
        frmvalidator.EnableMsgsTogether();

        frmvalidator.addValidation("oldpwd","req","Please provide your old password");
        
        frmvalidator.addValidation("newpwd","req","Please provide your new password");

    // ]]>
    </script>

  </div>

</div>

<!--
Form Code End (see html-form-guide.com for more info.)
-->

</body>
</html>
<?php include 'footer.php'; ?>
