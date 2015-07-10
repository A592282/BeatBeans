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
        <title>An-orderoid solution.Beat Beans :-)</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/reset/reset-min.css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all" charset="utf-8" />
        <link rel="stylesheet" href="css/MenuMatic.css" type="text/css" media="screen" charset="utf-8" />
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
                    document.getElementById("changetext").innerHTML="<p><h6>Edu Empower</h6><img src=\"images/book.jpg\" />We contribute 2% of our revenue to educate poor kids in Rural India.</p>";
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
                    document.getElementById("changetext").innerHTML="<p><h6>BeatBeans.Com</h6>BeatBeans.com is a premium online food ordering platform.It's a one stop site that not just allows you to search and locate restaurants of your choice but also takes orders on your behalf.</p>";
                    num=1;
                }
                jQuery('#changetext').fadeIn("fast");
            }
            jQuery(function() {
                jQuery( "#button" ).button();
                jQuery( "#radioset" ).buttonset();
                jQuery( "#dialog" ).dialog({
                    autoOpen: false,
                    width: 400,
                    buttons: [
                        {
                            text: "Ok",
                            click: function() {
                                jQuery( this ).dialog( "close" );
                            }
                        },

                    ]
                });


                // Link to open the dialog
                jQuery( "#dialog-link" ).click(function( event ) {
                    document.getElementById("dialog").innerHTML="Loading";
                    jQuery("#dialog").load("PresentationLayer/PL_ShoppingCart.php",function() {
                    });

                    jQuery( "#dialog" ).dialog( "open" );
                    event.preventDefault();
                });

                // Hover states on the static widgets
                jQuery( "#dialog-link, #icons li" ).hover(
                function() {
                    jQuery( this ).addClass( "ui-state-hover" );
                },
                function() {
                    jQuery( this ).removeClass( "ui-state-hover" );
                }
            );
            });
        </script>
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
                <h1>Android App !</h1><h6>_Droid orderoid solution.</h6>

                <p>
                    <b>BeatBeans.Com</b> is always commited to bridge the gap between Food & Technology.
                   <br/>
                   BeatBeans Android is an Android app which can be instaled in the Android OS devices.
                   You can easily search your restaurant in any location and place order using this.
                   <div class="control-group">
                                        <label class="control-label" for="input01"></label>
                                        <div class="controls">
                                            <a href="https://play.google.com/store/apps/details?id=com.beatbeans&feature=search_result#?t=W251bGwsMSwxLDEsImNvbS5iZWF0YmVhbnMiXQ.." class="btn btn-success" rel="Download" title="Download For Android" style="text-decoration: none">Download Android App</a>
                                        </div>
                                    </div>
                </p>
                <div id="changetext">
                        <p><h6>BeatBeans.Com</h6><img src="images/bsmall.jpg" />BeatBeans.com is a premium online food ordering platform.
                            It's a one stop site that not just allows you to search and locate restaurants of your choice but also takes orders on your behalf.</p>
                    </div>
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
            Ojasvi Corporation
            <br/>
            <a href="career.php" style="text-decoration: none">Career | </a>
            <a href="faq.php" style="text-decoration: none">F.A.Q. | </a>
            <a href="contact.php" style="text-decoration: none">Contacts | </a>
            <a href="/App" style="text-decoration: none">Android</a>
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
