<?php
@session_start();
require_once(dirname(__FILE__)."/BusinessLogicLayer/Location/BL_LocationClass.php");
require_once(dirname(__FILE__)."/commonfunction.php");
require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_LoginClass.php");
include_once(dirname(__FILE__)."/BusinessLogicLayer/BL_FoodCartClass.php");
include_once(dirname(__FILE__)."/BusinessLogicLayer/Location/BL_LocationClass.php");
require_once(dirname(__FILE__)."/commonfunction.php");
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
//$Location object wil be created upon the inclusion of the class file BL_LocationClass()
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Beat Beans :-) | E restaurant | Download Food | Online food ordering | Bangalore | Mangalore</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <meta name="format-detection" content="address=no" />
        <script type="text/javascript" src="JavaScript/location.js"></script>
        <script type="text/javascript" src="JavaScript/jquery-latest.js"></script>
        <style type='text/css'>
            label.custom-select {
                position: relative;
                display: inline-block;

            }

            .custom-select select {
                display: inline-block;
                padding: 4px 3px 3px 5px;
                margin: 0;
                font: inherit;
                outline:none; /* remove focus ring from Webkit */
                line-height: 1.2;
                background: #000;
                color:white;
                border:0;
                outline:none;
            }




            /* Select arrow styling */
            .custom-select:after {
                content: "<";
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                font-size: 60%;
                line-height: 30px;
                padding: 0 10px;
                background: green;
                color: white;
            }

            .no-pointer-events .custom-select:after {
                content: none;
            }


        </style>
        <!--Google Analytics Start-->
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-32720545-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>
        <!--Google Analytics End-->
    </head>
    <body>
        <?php if(($Login->LoginCheck())) echo "<p>".$Login->GetLoginId()."</p>"; ?>
        <div id="variablecontent">
            <div class="info">

<!--<a href="#" class="more"><img src="images/more.gif" alt="" width="106" height="28" /></a>-->
                <!-------------------------LOCATION START------------------------------------->
                <br />
                <div id="locationmenu">
                    <?php
                    if($Location->CheckSet()) {
                        ?>
                    <div id="main">
                        <table  bgcolor="#f5f5f5" border="0">
                            <tr>
                                <td valign="middle" class="input_field">
                                    <font size="5">CITY : </font>
                                        <?php
                                        echo $Location->GetCurrentCity("id");
                                        echo "<br />";
                                        ?>
                                    <font size="5">LOCATION : </font>
                                        <?php
                                        echo $Location->GetCurrentLocation("name");
                                        ?>
                                    <table>
                                        <tr>
                                            <td>
                                                <form action="index.php" method="GET" name="locationchangeandset">
                                                    <img style="cursor: pointer" src="images/buttons/changelocation.png" onclick="document['locationchangeandset'].submit()" />
                                                    <input type="hidden" name="newloc" value="2626">
                                                </form>
                                            </td>
                                            <td>
                                                <form action="shops_in_location.php" method="GET">
                                                    <img style="cursor: pointer" src="images/buttons/searchfood.png" onclick="LoadShops();"/>
                                                </form>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>

                        <?php }
                    else {
                        ?>
                    <div id="main">
                        <table>
                            <form action="shops_in_location.php"  id="myform" target="_top">
                                <tr>
                                    <td  class="input_field">
                                        <p><font size="5">&nbsp; CITY : </font>
                                            <label class="custom-select">
                                                <select name="CITY"id=city onchange="cityChange()">
                                                    <option value=0 selected>Select City</option>
                                                    <option value=1>Bangalore &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                                    <option value=2>Mangalore</option>
                                                </select>
                                            </label>
                                        <div id="locationajax">
                                        </div>
                                        <div id="setlocationbutton"></div>
                                    </td>
                                </tr>
                            </form>
                        </table>
                    </div>
                        <?php

                    } ?>
                </div>
            </div>
            <!-------------------------LOCATION END------------------------------------->

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
$_SESSION['Login']=serialize($Login);
$_SESSION['Cart']=serialize($Cart);
?>
