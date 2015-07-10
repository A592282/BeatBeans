<?php
@session_start();
require_once(dirname(__FILE__)."/BL_FoodCartClass.php");
require_once(dirname(__FILE__)."/BL_LoginClass.php");
if(isset($_SESSION['Cart'])) {
    $Cart=unserialize($_SESSION['Cart']);
}
else $Cart=new BL_FoodCartClass();
if($_GET['Qty']==0)
{
    $Cart->DeleteFoodCart($_GET['pid'],$_GET['ShopId']);
    echo "Deleted";
}
else
{
    $Cart->UpdateFoodCart($_GET['pid'],$_GET['Qty'],$_GET['ShopId']);
    echo "Updated";
}
$_SESSION['Cart']=serialize($Cart);
?>
