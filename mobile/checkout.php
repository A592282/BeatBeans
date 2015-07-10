<?php
@session_start();
require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_FoodCartClass.php");
require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_LoginClass.php");
require_once(dirname(__FILE__)."/commonfunction.php");
if(isset($_SESSION['Login'])) {
    $Login=unserialize($_SESSION['Login']);
}
else $Login=new BL_LoginClass();
if(isset($_SESSION['Cart'])) {
    $Cart=unserialize($_SESSION['Cart']);
}
else $Cart=new BL_FoodCartClass();
if(!$Login->LoginCheck()) {
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
}
else {
    if(($Cart->FoodCartCount())>0) {
        ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Beat Beans :-) | E restaurant | Download Food | Online food ordering | Bangalore | Mangalore</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <script type="text/javascript" src="JavaScript/location.js"></script>
        <script type="text/javascript" src="JavaScript/jquery-latest.js"></script>
                <style>
        .button {
   border-top: 1px solid #96d1f8;
   background: #65d67f;
   background: -webkit-gradient(linear, left top, left bottom, from(#28593b), to(#65d67f));
   background: -webkit-linear-gradient(top, #28593b, #65d67f);
   background: -moz-linear-gradient(top, #28593b, #65d67f);
   background: -ms-linear-gradient(top, #28593b, #65d67f);
   background: -o-linear-gradient(top, #28593b, #65d67f);
   padding: 7px 14px;
   -webkit-border-radius: 40px;
   -moz-border-radius: 40px;
   border-radius: 40px;
   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
   box-shadow: rgba(0,0,0,1) 0 1px 0;
   text-shadow: rgba(0,0,0,.4) 0 1px 0;
   color: white;
   font-size: 14px;
   font-family: Georgia, serif;
   text-decoration: none;
   vertical-align: middle;
   }
.button:hover {
   border-top-color: #28597a;
   background: #28597a;
   color: #ccc;
   }
.button:active {
   border-top-color: #1b435e;
   background: #1b435e;
   }
    </style>

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
    </head>
    <body>
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
                            $('tr').remove("#ProdDiv"+prodId);
                            var url="PresentationLayer/PL_ReturnCart.php";
                            document.getElementById("cart").innerHTML="<img src=\"images/spinloading.gif\" />Updating Plate";
                            $('#cart').load(url,function() {
                                $('#cart').fadeOut("slow");
                                $('#cart').fadeIn("slow");
                            });
                        }
                        else
                        {
                            document.getElementById("cart").innerHTML="<img src=\"images/spinloading.gif\" />Updating Plate";
                            var url="PresentationLayer/PL_ReturnCart.php";
                            document.getElementById("cart").innerHTML="<img src=\"images/spinloading.gif\" />Updating Plate";
                            $('#cart').load(url,function() {
                                $('#cart').fadeOut("slow");
                                $('#cart').fadeIn("slow");
                            });

                            document.getElementById("info"+prodId).innerHTML=xmlhttp.responseText;
                            $("#info"+prodId).fadeOut(5000);
                        }
                    }
                    else
                    {
                        document.getElementById("info"+prodId).innerHTML="Processing..Please Wait";
                        $("#info"+prodId).fadeIn(1000);
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
                var txt,x,i;
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
                        $('#cart').fadeOut("slow").load('cart.php').fadeIn("slow");
                        if(xmlhttp.responseText=="login")
                        {
                            //alert(xmlhttp.responseText);
                            window.location.href ="login.php";
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
        <div id="content">
            <div id="variablecontent">
                <div id="main">
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
                                    <td><input type="text" value="<?php echo $SelectedFoodItem->Quantity;?>" id="Qty<?php echo $SelectedFoodItem->SelectedProductId;?>" size="2" maxlength="2"/></td>
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
        </div>
        <hr/>
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
<hr/>
                        <!-------------------------------MENU------------------------------------>
<?php
            if($Login->LoginCheck()) {
                menuiflogin();
            }
            else {
                menuifnologin();
            }
            ?>
            <!--------------------------------MENU END--------------------------------------->

            <hr/>

        <div id="footer">
            <!---------------------THAWTE SEAL START-------------------->
            <div id="thawteseal" style="text-align:center;" title="Click to Verify - This site chose Thawte SSL for secure e-commerce and confidential communications.">
                <div><script type="text/javascript" src="https://seal.thawte.com/getthawteseal?host_name=beatbeans.com&amp;size=S&amp;lang=en"></script></div>
                <div></div>
            </div>
            <!---------------------THAWTE SEAL END----------------------->
        </div>
    </body>
</html>
        <?php
    }
    else {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
    }
}
?>
