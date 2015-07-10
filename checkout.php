<?php
@session_start();
require_once(dirname(__FILE__)."/BusinessLogicLayer/Location/BL_LocationClass.php");
require_once(dirname(__FILE__)."/commonfunction.php");
require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_LoginClass.php");
include_once(dirname(__FILE__)."/BusinessLogicLayer/BL_FoodCartClass.php");
include_once(dirname(__FILE__)."/BusinessLogicLayer/Location/BL_LocationClass.php");
$Location=new BL_LocationClass();
if(isset($_SESSION['Login'])) {
    $Login=unserialize($_SESSION['Login']);
}
else $Login=new BL_LoginClass();
if(isset($_SESSION['Cart'])) {
    $Cart=unserialize($_SESSION['Cart']);
}
else $Cart=new BL_FoodCartClass();
//$Location object wil be created upon the inclusion of the class file BL_LocationClass()
if(!$Login->LoginCheck()) {
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
}
else {
    if(($Cart->FoodCartCount())>0) {
        ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
    <head runat="server" >
        <title>Beat Beans :-) | Checkout</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/reset/reset-min.css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all" charset="utf-8" />
        <link rel="stylesheet" href="css/MenuMatic.css" type="text/css" media="screen" charset="utf-8" />
        <script type="text/javascript" src="JavaScript/location.js"></script>
        <script type="text/javascript" src="JavaScript/jquery-latest.js"></script>
        <link rel="STYLESHEET" type="text/css" href="loginregisterstyle.css" />

        <!--[if lt IE 7]>
			<link rel="stylesheet" href="css/MenuMatic-ie6.css" type="text/css" media="screen" charset="utf-8" />
		<![endif]-->
        <!--Dialog Start-->
        <link href="css/sunny/jquery-ui-1.9.1.custom.css" rel="stylesheet" />
        <script src="js/jquery-1.8.2.js"></script>
        <script src="js/jquery-ui-1.9.1.custom.js"></script>
        
        <style>
            .demoHeaders {
                margin-top: 2em;
            }
            #dialog-link span.ui-icon {
                margin: 0 5px 0 0;
                position: absolute;
                left: .2em;
                top: 50%;
                margin-top: -8px;
            }
            #icons {
                margin: 0;
                padding: 0;
            }
            #icons li {
                margin: 2px;
                position: relative;
                padding: 4px 0;
                cursor: pointer;
                float: left;
                list-style: none;
            }
            #icons span.ui-icon {
                float: left;
                margin: 0 4px;
            }
        </style>
        <!--Dialog Head End-->
        <style>
            /* ------------------
         styling for the tables
           ------------------   */
            body
            {
                line-height: 1.6em;
            }

            #background-image
            {
                font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
                font-size: 12px;
                /*margin: 45px;*/
                width: 480px;
                text-align: left;
                border-collapse: collapse;
                /*background: url('images/pic3.jpg') 450px 150px no-repeat;*/
            }
            #background-image th
            {
                padding: 12px;
                font-weight: normal;
                font-size: 14px;
                color: #339;
            }
            #background-image td
            {
                padding: 9px 12px;
                color: #669;
                border-top: 1px solid #fff;
            }
            #background-image tfoot td
            {
                font-size: 11px;
            }
            #background-image tbody td
            {
                background: url('table-images/back.png');
            }
            #background-image tbody td
            {
                background: url('table-images/back.png');
            }
            * html #background-image tbody td
            {
                /*
	   ----------------------------
		PUT THIS ON IE6 ONLY STYLE
		AS THE RULE INVALIDATES
		YOUR STYLESHEET
	   ----------------------------
	*/
                /*        filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='table-images/back.png',sizingMethod='crop');*/
                background: none;
            }
            #background-image tbody tr:hover td
            {
                color: #339;
                background: none;
            }
        </style>
        <script type="text/javascript">
            function Update(prodId,shopid,Qty)
            {
                var xmlhttp;
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function()
                {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        if(xmlhttp.responseText=="Deleted")
                        {
                            jQuery('tr').remove("#ProdDiv"+prodId);
                            var url="PresentationLayer/PL_ReturnCart.php";
                            document.getElementById("cart").innerHTML="<img src=\"images/spinloading.gif\" />Updating Plate";
                            jQuery('#cart').load(url,function() {
                                jQuery('#cart').fadeOut("slow");
                                jQuery('#cart').fadeIn("slow");
                            });
                        }
                        else if(xmlhttp.responseText=="cartempty")
                            window.location.href ="index.php?redirect=cartempty";
                        else
                        {
                            document.getElementById("cart").innerHTML="<img src=\"images/spinloading.gif\" />Updating Plate";
                            var url="PresentationLayer/PL_ReturnCart.php";
                            document.getElementById("cart").innerHTML="<img src=\"images/spinloading.gif\" />Updating Plate";
                            jQuery('#cart').load(url,function() {
                                jQuery('#cart').fadeOut("slow");
                                jQuery('#cart').fadeIn("slow");
                            });

                            document.getElementById("info"+prodId).innerHTML=xmlhttp.responseText;
                            jQuery("#info"+prodId).fadeOut(5000);
                        }
                    }
                    else
                    {
                        document.getElementById("info"+prodId).innerHTML="Processing..Please Wait";
                        jQuery("#info"+prodId).fadeIn(1000);
                    }
                }
                var QtyValue;
                if(Qty==0)
                {
                    QtyValue=0;
                }
                else
                {
                    QtyValue=document.getElementById("Qty"+prodId).value;
                }
                if(QtyValue<0)
                {
                    alert("Check Quantity :-)");

                }
                else
                {
                    xmlhttp.open("GET","BusinessLogicLayer/UpdateCart.php?pid="+prodId+"&Qty="+QtyValue+"&ShopId="+shopid,true);
                    xmlhttp.send();
                }
            }
            function Checkout()
            {
                var xmlhttp;
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function()
                {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        // alert(xmlhttp.responseText);
                        jQuery('#cart').fadeOut("slow").load('cart.php').fadeIn("slow");
                        if(xmlhttp.responseText=="login")
                        {
                            //alert(xmlhttp.responseText);
                            window.location.href ="login.php";
                        }
                        else if(xmlhttp.responseText=="success")
                        {
                            //alert(xmlhttp.responseText);
                            window.location.href ="index.php?redirect=checkoutsuccess";
                        }
                        else
                        {
                            document.getElementById("variablecontent").innerHTML=xmlhttp.responseText;
                        }
                    }
                }
                xmlhttp.open("GET","BusinessLogicLayer/BL_Checkout.php",true);
                xmlhttp.send();

            }
        </script>

    </head>
    <body>
        <a id="logo" href="index.php"></a>
        <div id="container" >
            <!-- BEGIN Menu -->
            <ul id="nav">

                        <?php
                        if($Login->LoginCheck()) {
                            menuiflogin();
                        }
                        else {
                            menuifnologin();
                        }
                        ?>
            </ul>

            <!-- END Menu -->

            <div id="content">
                <br/><br/><br/><br/>
                

                <img style="cursor: pointer" src="images/buttons/checkout.png" onclick="Checkout();"/>
                <form>
                    <table id="background-image">
                        <thead><tr><th>Food Name:</th><th>Quantity:</th><th>Update:</th></tr></thead>
                        <tbody>
                                    <?php
                                    $SelectedFoodArray=json_decode($Cart->GetCartFood());
                                    foreach($SelectedFoodArray as $SelectedFoodItem) {
                                        ?>
                            <tr id="ProdDiv<?php echo $SelectedFoodItem->SelectedProductId?>">
                                <td><?php echo $Cart->GetFoodName($SelectedFoodItem->SelectedProductId) ?><br />From: <?php echo $Cart->GetShopName($SelectedFoodItem->ShopId)?></td>
                                <td><input class="input-mini" type="text" value="<?php echo $SelectedFoodItem->Quantity;?>" id="Qty<?php echo $SelectedFoodItem->SelectedProductId;?>" size="2" maxlength="2"/></td>
                                <td><div id="info<?php echo $SelectedFoodItem->SelectedProductId; ?>"></div><img src="images/buttons/updateplate.png" style="cursor:pointer" onclick="Update(<?php echo $SelectedFoodItem->SelectedProductId?>,<?php echo $SelectedFoodItem->ShopId ?>)"/></td>
                                <td><img style="cursor: pointer" src="images/buttons/del.gif" onclick="Update(<?php echo $SelectedFoodItem->SelectedProductId?>,<?php echo $SelectedFoodItem->ShopId ?>,0)" /></td>
                            </tr>
                                        <?php
                                    }
                                    ?>
                        </tbody>
                    </table>
                </form>
                <img style="cursor: pointer" src="images/buttons/checkout.png" onclick="Checkout();"/>
            </div>
        </div>
        <div id="cart">
            <strong>Your Plate:</strong> <br />
                    <?php
                    echo $Cart->FoodCartCount();
                    ?> items |
                    <?php
                    echo $Cart->FoodCartPrice();
                    ?>

            INR
        </div>

        <div id="footer">
                    <?php footer() ?>
        </div>

        <!-- Load the Mootools Framework -->
        <script src="http://www.google.com/jsapi"></script><script>google.load("mootools", "1.2.1");</script>

        <!-- Load the MenuMatic Class -->
        <script src="js/MenuMatic_0.68.3.js" type="text/javascript" charset="utf-8"></script>

        <!-- Create a MenuMatic Instance -->
        <script type="text/javascript" >
            window.addEvent('domready', function() {
                var myMenu = new MenuMatic();
            });
        </script>

    </body>
</html>

        <?php
    }
    else {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?redirect=cartempty">';
    }
}
?>
