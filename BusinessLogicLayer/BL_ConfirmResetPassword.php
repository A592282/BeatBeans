<?php
@session_start();
require_once(dirname(__FILE__)."/BL_LoginClass.php");
if(isset($_SESSION['Login'])) {
    $Login=unserialize($_SESSION['Login']);
}
else $Login=new BL_LoginClass();
if($Login->PasswordReset($_POST['id'],$_POST['password']))//Success
{
    $_SESSION['Login']=serialize($Login);
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../PostMessage.php?message=passwordchanged">';
}
else
    {
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../PostMessage.php?message=error">';
    
}
?>
