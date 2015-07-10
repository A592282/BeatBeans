<?php
@session_start();
require_once(dirname(__FILE__)."/Location/BL_LocationClass.php");
require_once(dirname(__FILE__)."/BL_LoginClass.php");
include_once(dirname(__FILE__)."/BL_FoodCartClass.php");
include_once(dirname(__FILE__)."/Location/BL_LocationClass.php");
$Location=new BL_LocationClass();
if(isset($_GET['newloc'])) {
    $Location->UnsetLocation();
    header( 'Location: index.php');
}
if(isset($_SESSION['Login'])) {
    $Login=unserialize($_SESSION['Login']);
}
else $Login=new BL_LoginClass();
if(isset($_SESSION['Cart'])) {
    $Cart=unserialize($_SESSION['Cart']);
}
else $Cart=new BL_FoodCartClass();

if($Cart->FoodCartCount()>0) {
    if($Login->LoginCheck()) {
        if($Cart->ConfirmOrder(serialize($Login))) {
            unset($Cart);
            $Cart=new BL_FoodCartClass();
            //<!--SUCCESS-->
            echo "success";
            //<!--SUCCESS END-->
            //<p style="color: red">Please note that your IP Address <b><?php echo $_SERVER['REMOTE_ADDR']  </b>is recorded for tracking purpose.<br/>Our privacy policy mandates that we state this.</p>
            unset($_SESSION['Cart']);
        }
        else {
            ?>
<!-----------ERROR START------------->
<img src="images/error.jpg" alt="success" height="200" width="200" />
<!------------ERROR END-------------->
            <?php
            //echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../checkoutconfirm.php?type=carterror">';
        }
    }
    else {
        echo "login";
    }
}
else
    {
    echo "cartempty";
}

$_SESSION['Login']=serialize($Login);
$_SESSION['Cart']=serialize($Cart);
?>
