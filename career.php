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
        <title>Career | Beat Beans :-)</title>
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
                <h1><!--We're -->Career!</h1><br/>

                    If you're comfortable working independently, solving the most complex
                    problems as well as the most mundane, and want to join a very tiny company with
                    plans to be a very valuable company, we'd like to see your work and get to know you better.<br/><br/>

The specific positions here are what we know we need soon. But we are sorry we dont have
any specific positions now. But It's entirely possible we need you,
even if we don't know it yet. If so, submit a cover letter and Resume for the "Other" position at <b>"vibrantcolors@beatbeans.com"</b>.<br/><br/>
<h2>Common factors for all positions</h2>
<ul>
    <li>When people ask us where we're based, we typically respond "on the Internet." That is, although our current office is in Bangalore-India, we're looking for talented people wherever they might be based.</li>

    <li>You're excited to help create not only the architecture of our products, but the culture of the company. You lead by example.</li>

    <li>You don't need much direction, but when you do, you're comfortable asking for it.</li>

    <li>You're willing to dive into just about any problem, even if it's outside your area of expertise. You cheerfully accept responsibility for whatever needs to get done, but relinquish it when that makes more sense.</li>

    <li>When you attack a task, you stay on it until it's done. And although you can crank out tons of work, you know when you've done enough (not everything has to be perfect -- but some things do).</li>

    <li>You can deal with uncertainty and change. During severe course corrections you stay on an even keel. You're a pleasure to be around when things get tough.</li>

    <li>You keep up to date with the latest developments, but you're immune to fads and technology/business religion. You just choose the right tools for the job at hand.</li>
</ul>
<h3>NOTE:</h3>
We donot consider your Religion, Caste, Skin Colour, Ethnicity, Nationality (If legally approved), Gender, Fathers Occupation,
Family Income, Physical Disabilities (If it dont effect the work done), Language spoken at home etc while hiring. We
 are least bothered about it. So please dont mention anything like that in the Resume. If you are good at technology you are in. AS SIMPLE AS THAT :)
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

                        