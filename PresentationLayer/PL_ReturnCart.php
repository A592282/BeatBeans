<?php
@session_start();
require_once(dirname(__FILE__)."/../BusinessLogicLayer/BL_FoodCartClass.php");
                    /*UnSerialization Of Objects Start*/
if(isset($_SESSION['Cart']))
{
    $Cart=unserialize($_SESSION['Cart']);
}
else $Cart=new BL_FoodCartClass();
                    /*UnSerialization Of Objects End*/
?>
<strong>Your Plate:</strong> <br />
<?php
    echo $Cart->FoodCartCount();
?> items |
<?php
    echo $Cart->FoodCartPrice();
                        /*Serialization Of Objects Start*/
$_SESSION['Cart']=serialize($Cart);
                    /*Serialization Of Objects End*/
?>