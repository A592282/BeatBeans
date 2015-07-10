<?php
@session_start();
if(isset($_GET['id']))
{
    require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_LoginClass.php");
    if(isset($_SESSION['Login'])) {
        $Login=unserialize($_SESSION['Login']);
    }
    else $Login=new BL_LoginClass();

    if($Login->TokenValidate($_GET['id']))
    {
        require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_FoodCartClass.php");
        $_SESSION['Login']=serialize($Login);
        if(isset($_SESSION['Cart'])) {
            $Cart=unserialize($_SESSION['Cart']);
        }
        else $Cart=new BL_FoodCartClass();
        if(($Cart->FoodCartCount())>0)//if cart has data move to checkout
        {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=checkout.php">';
        }
        else
         {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
        }
    }
    else
        echo 'Error Geting The Token';
}

?>
