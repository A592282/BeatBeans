<?php
@session_start();
require_once(dirname(__FILE__)."/BL_LoginClass.php");
require_once(dirname(__FILE__)."/BL_FoodCartClass.php");
                    /*UnSerialization Of Objects Start*/
if(isset($_SESSION['Login']))
{
    $Login=unserialize($_SESSION['Login']);
}
else
    $Login=new BL_LoginClass();
if(isset($_SESSION['Cart']))
{
    $Cart=unserialize($_SESSION['Cart']);
}
else $Cart=new BL_FoodCartClass();
                    /*UnSerialization Of Objects End*/
if($Cart->AddFoodCart($_GET['ProductId'],$_GET['Quantity'],$_GET['ShopId']))
        echo "Added";
                    /*Serialization Of Objects Start*/
$_SESSION['Login']=serialize($Login);
$_SESSION['Cart']=serialize($Cart);
                    /*Serialization Of Objects End*/
?>
