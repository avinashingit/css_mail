<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login_.php");
    exit;
}

if($_SESSION['uname']=='admin')
	$isAdmin = true;

else
	$isAdmin = false;


?>

