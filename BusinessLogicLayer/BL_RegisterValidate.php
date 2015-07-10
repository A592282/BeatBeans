<?php
@session_start();
require_once(dirname(__FILE__)."/../BusinessLogicLayer/BL_LoginClass.php");
require_once('recaptchalib.php');
if(isset($_SESSION['Login'])) {
    $Login=unserialize($_SESSION['Login']);
}
else $Login=new BL_LoginClass();

$privatekey = "6Lcj9M4SAAAAAKGtnbzCtHIADC47-36xW-m9U-K-";
$resp = recaptcha_check_answer ($privatekey,
        $_SERVER["REMOTE_ADDR"],
        $_POST["recaptcha_challenge_field"],
        $_POST["recaptcha_response_field"]);

if (!$resp->is_valid) {//if captcha fails
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../register.php?error=captchafail">';
}
else
{

    $NewUserVariable=array();
   // $NewUserVariable['UserName']=$_POST['username'];
    $NewUserVariable['PassWord']=$_POST['password'];
    $NewUserVariable['FullName']=$_POST['name'];
    $NewUserVariable['Address']=$_POST['address'];
    $NewUserVariable['Phone']=$_POST['phone'];
    $NewUserVariable['Email']=$_POST['email'];
    if($Login->Register($NewUserVariable))
    {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../PostMessage.php?message=regformsub&email='.$NewUserVariable['Email'].'">';
    }
    else
        {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../PostMessage.php?message=userexist&email='.$NewUserVariable['Email'].'">';
        }
}
?>
