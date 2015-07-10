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
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
    <head runat="server" >
        <title>New User | Beat Beans :-)</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/reset/reset-min.css" />
            <link rel="stylesheet" href="css/style.css" type="text/css" media="all" charset="utf-8" />
            <link rel="stylesheet" href="css/MenuMatic.css" type="text/css" media="screen" charset="utf-8" />
            <script type="text/javascript" src="JavaScript/location.js"></script>
            <script type="text/javascript" src="JavaScript/jquery-latest.js"></script>
            <link rel="STYLESHEET" type="text/css" href="loginregisterstyle.css" />
            <script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
            <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery('#registerHere input').hover(function () {
                    $(this).popover('hide')
                });
                jQuery("#registerHere").validate({
                    rules: {
                        name: "required",
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true,
                            minlength: 6
                        },
                        phone: {
                            required: true,
                            digits:true
                        },
                        address: {
                            required: true,
                            minlength: 110
                        }
                    },
                    messages: {
                        name: "Enter your first and last name",
                        email: {
                            required: "Enter your email address",
                            email: "Enter valid email address"
                        },
                        password: {
                            required: "Enter your password",
                            minlength: "Password better if minimum 6 characters"
                        },
                        phone: {
                            required: "Enter your phone number",
                            digits: "Enter correct phone number"
                        },
                        address: {
                            required: "Enter your delivery address",
                            minlength: "Enter proper address"
                        }/*,
                        cpwd: {
                            required: "Enter confirm password",
                            equalTo: "Password and Confirm Password must match"
                        },*/
                    },
                    errorClass: "help-inline",
                    errorElement: "span",
                    highlight: function (element, errorClass, validClass) {
                        jQuery(element).parents('.control-group').addClass('error');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        jQuery(element).parents('.control-group').removeClass('error');
                        jQuery(element).parents('.control-group').addClass('success');
                    }
                });
            });
        </script>


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
                <div class="row">
                            <div class="span8">
                                <!--<div class="alert alert-success">
                                  Well done! You successfully read this important alert message.
                                </div>-->
                                <form class="form-horizontal" id="registerHere" method='post' action='BusinessLogicLayer/BL_RegisterValidate.php' style=" background-image:url(images/cartoon/cartoon.jpg); background-repeat: no-repeat; background-position: left;">
                                    <fieldset>
                                        <legend>Registration</legend>
                                        <div class="control-group">
                                            <label class="control-label" for="input01">Full Name</label>
                                            <div class="controls">
                                                <input type="text" class="input-xlarge" id="name" name="name" rel="popover" data-content="Enter your first and last name." data-original-title="Full Name" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="input01">Email</label>
                                            <div class="controls">
                                                <input type="text" class="input-xlarge" id="email" name="email" rel="popover" data-content="What's your email address?" data-original-title="Email"/>
                                                <h6>We dont send any promotional or marketing spams. Promise!<br/>e-Mail address is used just for verification purpose only.</h6>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="input01">Pa-shhhh...word</label>
                                            <div class="controls">
                                                <input type="password" class="input-xlarge" id="password" name="password" rel="popover" data-content="Better if more than 6 char! Be tricky" data-original-title="Password" />
                                                <h6>Your password is stored using md5 hashing.<br/>Practically no one can view it, inside or outside BeatBeans.</h6>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="input01">Phone</label>
                                            <div class="controls">
                                                <input type="text" class="input-xlarge" id="phone" name="phone" rel="popover" data-content="Enter your contact number. We will call you for verification." data-original-title="Phone" />
                                            <h6>Only verification calls. No marketing calls even if you<br/> dont have DND set. :-)</h6>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="input01">Address</label>
                                            <div class="controls">
                                                <textarea name='address' id='address' class="input-xlarge" value='' rel="popover" data-content="Default Delivery Adress." data-original-title="Delivery Adress" >House/Apartment No:
Apartment Name:
Landmark:
Address Line:
Location:
City:
Pin Code:</textarea>
                                                <h6>Address will be shared with Restaurant(s) for delivery.</h6>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                                <?php
                                                if(isset ($_GET['error'])) {
                                                    if($_GET['error']=="captchafail") {
                                                        ?>
                                            <div class="alert alert-danger">
                                                That was a wrong captha :-(.
                                            </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            <div class="controls">
                                                    <?php
                                                    require_once('BusinessLogicLayer/recaptchalib.php');
                                                    $publickey = "6Lcj9M4SAAAAAN1NxAzfRSH4HmGSB5mLe9B8Ms6V"; // you got this from the signup page
                                                    echo recaptcha_get_html($publickey);
                                                    ?>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="input01"></label>
                                            <div class="controls">
                                                <button type="submit" class="btn btn-success" rel="tooltip" title="first tooltip">Join BeatBeans Family</button>
                                                <h6>BeatBeans use high grade SSL encryption by Thawte to transmit information.</h6>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
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
