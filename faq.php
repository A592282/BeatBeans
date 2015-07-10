<?php
@session_start();
require_once(dirname(__FILE__)."/commonfunction.php");
require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_LoginClass.php");
include_once(dirname(__FILE__)."/BusinessLogicLayer/BL_FoodCartClass.php");
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
        <title>Beat Beans :-) | FAQ</title>
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
	<script>
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
            })
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
                <!--Dialog Head End-->

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
                <ul id="list1">
                                <li>
                                    <div>
                                        <br /><span><b>What is BeatBeans.com?</b></span>
                                        <div class="more_content">BeatBeans.com is a Food Download E-restaurant to satisfy your food needs. It allows you to view detailed menus and place orders online from single or multiple restaurants,avail various offers from numerous restaurants. A free service for everyone.</div>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <br /><span><b>Edu Empower?</b></span>
                                        <div class="more_content">Edu Empower is our Social Cause.
                                            We contribute 2% of our revenue to rural India education.
                                            Next time you visit this site and make every click, feel the pride,
                                            You contribute to India tomorrow. </div>
                                    </div>
                                </li>
                                <!--<li>
                                    <div>
                                        <br /><span><b></b>Public Collaborative Business Model?</span>
                                        <div class="more_content">THE MODEL IS SIMPLE, YOU CAN EARN LIFE TIME INCOME BY JUST FOLLOWING THESE TWO OR ANY ONE.
                                            <br />1. IF THERE IS A HOME DELIVERY SHOP IN YOUR LOCALITY INTRODUCE BEATBEANS TO THEM AND IF THEY GET LISTED IN BEATBEANS, FOR ALL FUTURE TRANSACTIONS THROUGH THAT SHOP YOU WILL BE GETTING %PROFIT SHARE.

                                            <br /><br />2.INTRODUCE YOUR FRIENDS TO BEATBEANS. AND FOR ALL FUTURE PURCHASES THEY MAKE YOU WILL BE GETTING CASH POINTS.
                                        </div>
                                    </div>
                                </li>-->
                                <li>
                                    <div>
                                        <br /><span><b>Do I have to pay anything extra, if use BeatBeans.com?</b></span>
                                        <div class="more_content">No. All our services are completely free for you. If we charge you a fee it will be clearly mentioned.</div>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <br /><span><b>What can I do if I have any complaints??</b></span>
                                        <div class="more_content">mail contact@beatbeans.com or call 888-41-BEANS (888-41-23267) between 07.00 a.m. and 11.00 p.m.</div>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <br /><span><b>How is my personal information used?</b></span>
                                        <div class="more_content">We will NEVER share your personal information with third parties without your prior consent. Information you provide to us may be shared with restaurants for order execution.</div>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <br /><span><b>What can I do to help get my favorite restaurant on BeatBeans.Com??</b></span>
                                        <div class="more_content">mail us at contact@beatbeans.Com. We'll do whatever we can to get them on our site.</div>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <br /><span><b>Why are some restaurants not listed?</b></span>
                                        <div class="more_content">We are still in the process of getting more restaurants on our list. As and when they have tied up with us, we keep adding them on to our list. If there are some restaurants you would particularly like to be included on our list, please see suggest.</div>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <br /><span><b>Could there be a difference in my BeatBeans amount and the actual restaurant bill amount?</b></span>
                                        <div class="more_content">We try our best to keep our menus updated with the latest prices and food items. However, restaurants may change prices without any prior notice. In these situations the bill value shown online and the actual bill value may not match. Besides, the restaurant may also add any other charges to the bill, which again would lead to a difference between the actual and the online bill.</div>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <br /><span><b>Is there a guaranteed delivery time?</b></span>
                                        <div class="more_content">The restaurant provides us an estimated delivery time for the order. However, it would also depend on the weather, traffic, location the kind of item ordered etc. beatBeans.com does not take any responsibility for the time of delivery. We request you to call the restaurant directly or mail us at contact@beatbeans.com or contact us at 88841-BEANS in case the order is delayed by more than 45 minutes so that we may follow up on the order. Please note that it's the restaurants that do delivery. </div>
                                    </div>
                                </li><li>
                                    <div>
                                        <br /><span><b>Who can write reviews?</b></span>
                                        <div class="more_content">Anybody can write reviews on the website. BeatBeans does not take any responsibility of any review written on the website as it's the personal opinion of the reviewer. However, BeatBeans reserves the right to remove the review in case of any objection. </div>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <br /><span><b>I am stuck and can't figure out how to order? </b></span>
                                        <div class="more_content">Call 888-41-Beans. We will help you.</div>
                                    </div>
                                </li>
                            </ul>
                <br/><br/><br/>
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