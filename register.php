<?php include 'register_h.php'; ?>
<?PHP
require_once("./include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->RegisterUser())
   {
        $fgmembersite->RedirectToURL("thank-you.php");
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>Register</title>
    <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
    <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
    <link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
    <script src="scripts/pwdwidget.js" type="text/javascript"></script>      
</head>
<body>

<!-- Form Code Start -->

<div class="row">

    <div class="col-md-4 col-md-offset-4">

        <div>
        <form id='register' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
        <fieldset >

        <input type='hidden' name='submitted' id='submitted' value='1'/>

        <div class="row">

            <div class="col-md-12">

                <div class='short_explanation' style="color:red;">* required fields</div><br/>
                <input class="hidden" type='text'  class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' />

                <div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
                <div class='form-group'>
                    <label for='name' >Your Full Name <span style="color:red;">*</span>: </label><br/>
                    <input class="form-control" type='text' name='name' id='name' value='<?php echo $fgmembersite->SafeDisplay('name') ?>' maxlength="50" /><br/>
                    <span id='register_name_errorloc' class='error'></span>
                </div>
                <div class='form-group'>
                    <label for='email' >Email Address <span style="color:red;">*</span>:</label><br/>
                    <input class="form-control" type='text' name='email' id='email' value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
                    <span id='register_email_errorloc' class='error'></span>
                </div>
                <div class='form-group'>
                    <label for='username' >UserName <span style="color:red;">*</span>:</label><br/>
                    <input class="form-control" type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
                    <span id='register_username_errorloc' class='error'></span>
                </div>
                <div class='form-group' style='height:80px;'>
                    <label for='password' >Password <span style="color:red;">*</span>:</label><br/>
                    <div class='pwdwidgetdiv' id='thepwddiv' ></div>
                    <noscript>
                    <input class="form-control"  type='password' name='password' id='password' maxlength="50" />
                    </noscript>    
                    <div id='register_password_errorloc' class='error' style='clear:both'></div>
                </div>

                <div class='form-group'>
                    <input class="btn btn-md btn-primary" type='submit' name='Submit' value='Submit' />
                </div>

            </div>

        </div>

        

        </fieldset>
        </form>

        </div>

    </div>

</div>




<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[
    var pwdwidget = new PasswordWidget('thepwddiv','password');
    pwdwidget.MakePWDWidget();
    
    var frmvalidator  = new Validator("register");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("name","req","Please provide your name");

    frmvalidator.addValidation("email","req","Please provide your email address");

    frmvalidator.addValidation("email","email","Please provide a valid email address");

    frmvalidator.addValidation("username","req","Please provide a username");
    
    frmvalidator.addValidation("password","req","Please provide a password");

// ]]>
</script>
<script type="text/javascript">
document.getElementById('name').focus();
</script>

<!--
Form Code End (see html-form-guide.com for more info.)
-->

</body>
</br>
</html>
<?php include 'footer.php'; ?>

