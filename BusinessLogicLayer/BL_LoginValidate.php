<?php
@session_start();
require_once(dirname(__FILE__)."/BL_LoginClass.php");
require_once(dirname(__FILE__)."/BL_FoodCartClass.php");
function Redirect($url) {
    echo $url;
    header("Location: $url");
}
function menuifnologin() {
    ?>
<ul id="menu">
    <li><a href="index.php"><img src="/../images/but1.gif" alt="" width="110" height="32" /></a></li>
    <li><a onclick="LoadLoginForm()"><img src="/../images/but2.gif" alt="" width="110" height="32" /></a></li>
    <li><a href="registerform.php"><img src="/../images/but3.gif" alt="" width="110" height="32" /></a></li>
    <li><a href="myaccount.php"><img src="/../images/but4.gif" alt="" width="110" height="32" /></a></li>
    <li><a href="shoppingcart.php"><img src="/../images/but5.gif" alt="" width="110" height="32" /></a></li>
    <li><a href="checkout.php"><img src="/../images/but6.gif" alt="" width="110" height="32" /></a></li>
</ul>

    <?php
}
function menuiflogin() {
    ?>
<ul id="menu">
    <li><a href="index.php"><img src="/../images/but1.gif" alt="" width="110" height="32" /></a></li>
    <li><a href="myaccount.php"><img src="/../images/but4.gif" alt="" width="110" height="32" /></a></li>
    <li><a href="shoppingcart.php"><img src="/../images/but5.gif" alt="" width="110" height="32" /></a></li>
    <li><a href="checkout.php"><img src="/../images/but6.gif" alt="" width="110" height="32" /></a></li>
    <li><a href="logout.php"><img src="/../images/but7.gif" alt="" width="110" height="32" /></a></li>
</ul>
    <?php
}

if(isset($_SESSION['Login'])) {
    $Login=unserialize($_SESSION['Login']);
}
else $Login=new BL_LoginClass();

if(isset($_SESSION['Cart'])) {
    $Cart=new BL_FoodCartClass();
    $Cart=unserialize($_SESSION['Cart']);
}
else $Cart=new BL_FoodCartClass();

if($Login->LoginCheck()) {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php">';
}
else {
    if($Login->LoginValidate($_POST['username'],$_POST['password'])) {
        $_SESSION['Login']=serialize($Login);
        if(($Cart->FoodCartCount())>0) {
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../checkout.php">';
        }
        else {
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php">';
        }
    }
    else {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../login.php?fail=passworderror">';    }
}
?>
