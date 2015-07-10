<?php
@session_start();
require_once(dirname(__FILE__)."/BL_LoginClass.php");
$Email=$_POST['email'];
if(isset($_SESSION['Login'])) {
    $Login=unserialize($_SESSION['Login']);
}
else $Login=new BL_LoginClass();
if($Login->PasswordResetRequest($Email))
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../PostMessage.php?message=resetmailsent&email='.$Email.'">';
}
?>
