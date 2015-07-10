<?php
@session_start();
require_once(dirname(__FILE__)."/BusinessLogicLayer/Location/BL_LocationClass.php");
require_once(dirname(__FILE__)."/commonfunction.php");
require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_LoginClass.php");
include_once(dirname(__FILE__)."/BusinessLogicLayer/BL_FoodCartClass.php");
include_once(dirname(__FILE__)."/BusinessLogicLayer/Location/BL_LocationClass.php");
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
    <head runat="server" >
        <title>Beat Beans :-) | E restaurant | Download Food | Online food ordering | Bangalore | Mangalore</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/reset/reset-min.css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all" charset="utf-8" />
        <link rel="stylesheet" href="css/MenuMatic.css" type="text/css" media="screen" charset="utf-8" />
        <script type="text/javascript" src="JavaScript/jquery-latest.js"></script>
        <script type="text/javascript" src="JavaScript/location.js"></script>
        <link rel="STYLESHEET" type="text/css" href="loginregisterstyle.css" />

        <!--[if lt IE 7]>
			<link rel="stylesheet" href="css/MenuMatic-ie6.css" type="text/css" media="screen" charset="utf-8" />
		<![endif]-->
        <link href="css/sunny/jquery-ui-1.9.1.custom.css" rel="stylesheet" />
	<script src="js/jquery-ui-1.9.1.custom.js"></script>
	<script>
                        var num=1;
            window.setInterval(function(){changetext();}, 6000);
            function changetext()
            {
                //alert("Out"+num)
                jQuery('#changetext').fadeOut("slow");
                if(num==1)
                {
                    document.getElementById("changetext").innerHTML="<p><h6>Edu Empower</h6><img src=\"images/book.jpg\" />We contribute part of our revenue for rural poor students education</p>";
                    num=num+1;
                    //      alert("In"+num)
                }
                else if(num==2)
                {
                    document.getElementById("changetext").innerHTML="<p><h6>Still Using Phone?</h6><img src=\"images/phone.jpg\" />Order Online! Its Simple > Fast > Reliable.</p>";
                    num=num+1;
                }
                else if(num==3)
                {
                    document.getElementById("changetext").innerHTML="<p><h6>Like Us ;)</h6><img src=\"images/facebookhand.jpg\" />We dont flood your mails with unwanted updates. For all BeatBeans updates like our fan page <a href=\"http://www.facebook.com/pages/BeatBeansCom/221198307993747?fref=ts\" target=\"_blank\">here</a></p>";
                    num=num+1;
                }
                else if(num==4)
                {
                    document.getElementById("changetext").innerHTML="<p><h6>BeatBeans.Com</h6><img src=\"images/bsmall.jpg\" />BeatBeans.com is a premium online food ordering platform.It's a one stop site that not just allows you to search and locate restaurants of your choice but also takes orders on your behalf.</p>";
                    num=1;
                }
                jQuery('#changetext').fadeIn("fast");
            }
	</script>
	
    </head>
    <body>
        <a id="logo" href="index.php"></a>
        <?php
        if(isset($_GET['redirect'])) {
            if($_GET['redirect']=="cartempty") {
                ?>
        <div class="alert alert-danger" style=" position: absolute;width: 200px; left: 300px; top: 5px">
            No food in your plate.
        </div>
                <?php
            }
            if($_GET['redirect']=="logout") {
                ?>
        <div class="alert alert-success" style=" position: absolute;width: 200px; left: 300px; top: 5px">
            You have been successfully logged out.
        </div>
                <?php
            }
            if($_GET['redirect']=="checkoutsuccess") {
                ?>
        <div class="alert alert-success" style=" position: absolute;width: 200px; left: 300px; top: 5px">
            Your order is cooking. You will get a confirmation call shortly.
        </div>
                <?php
            }

        }
        ?>

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

                <div id="variablecontent">
                    <div style="background-color: #f2f2f2">
                    <img src="images/cartoon/manu1.gif" style="position: fixed; left: 80%; top: 50%;"/>
                    <h1>Select Your Location!</h1>

                    <!-------------------------LOCATION START------------------------------------->
                    <br />
                    <div id="locationmenu">
                        <?php
                        if($Location->CheckSet()) {
                            ?>
                        <div id="main">
                            <center>
                                <table  bgcolor="#f5f5f5" border="0" width="400" style=" background-image:url(images/cartoon/cartoon2.gif); background-repeat: no-repeat; background-position: left;">
                                    <tr>
                                        <td align="center" valign="middle" class="input_field">
                                            <font size="5">CITY : </font>
                                                <?php
                                                echo $Location->GetCurrentCity("id");
                                                echo "<br />";
                                                ?>
                                            <font size="5">LOCATION : </font>
                                                <?php
                                                echo $Location->GetCurrentLocation("name");
                                                ?>
                                            <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <table>
                                                <tr>
                                                    <td>
                                                        <form action="index.php" method="GET">
                                                            <div class="control-group">
                                                                <label class="control-label" for="input01"></label>
                                                                <div class="controls">
                                                                    <button type="submit" class="btn btn-success" rel="tooltip" title="Change your set location">Change Location :-)</button>
                                                                </div>
                                                            </div>                                                                    <input type="hidden" name="newloc" value="2626" />
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form action="shops_in_location.php" method="GET">

                                                            <div class="control-group">
                                                                <label class="control-label" for="input01"></label>
                                                                <div class="controls">
                                                                    <button type="button" class="btn btn-success" rel="tooltip" title="This will load restaurants in your location" onclick="LoadShops();">Search Food :)</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </center>
                        </div>

                            <?php }
                        else {
                            ?>
                        <div id="main" style="background-color: #f2f2f2">
                            <center>
                                <table  bgcolor="#f5f5f5" border="0" width="400" align="center" style=" background-image:url(images/cartoon/cartoon4.gif); background-repeat: no-repeat; background-position: left; height: 150px;">
                                    <center>
                                        <form action="shops_in_location.php"  id="myform" target="_top">
                                            <tr>
                                                <td  class="input_field">
                                                    <center><font size="5">&nbsp; CITY : </font>
                                                            <select name="CITY"id=city onchange="cityChange()">
                                                                <option value=0 selected>Select City</option>
                                                                <option value=1>Bangalore</option>
                                                                <option value=2>Mangalore</option>
                                                            </select></center>
                                                    <center>
                                                        <div id="locationajax">
                                                        </div>
                                                    </center>
                                                    <div id="setlocationbutton"></div>
                                                </td>
                                            </tr>
                                        </form>
                                    </center>
                                </table>
                            </center>
                        </div>
                            <?php

                        } ?>
                    </div>
                </div>
                    <!-------------------------LOCATION END------------------------------------->
                    <div id="changetext">
                        <p><h6>BeatBeans.Com</h6><img src="images/bsmall.jpg" />BeatBeans.com is a premium online food ordering platform.
                            It's a one stop site that not just allows you to search and locate restaurants of your choice but also takes orders on your behalf.</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="cart" style="cursor: pointer">
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
