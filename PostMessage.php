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
        <title>Beat Beans :-)</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/reset/reset-min.css" />
            <link rel="stylesheet" href="css/style.css" type="text/css" media="all" charset="utf-8" />
            <link rel="stylesheet" href="css/MenuMatic.css" type="text/css" media="screen" charset="utf-8" />
            <script type="text/javascript" src="JavaScript/jquery-latest.js"></script>
            <link rel="STYLESHEET" type="text/css" href="loginregisterstyle.css" />
            <script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#registerHere input').hover(function () {
                    $(this).popover('hide')
                });
                $("#registerHere").validate({
                    rules: {
                        username: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true,
                            minlength: 6
                        }
                    },
                    messages: {
                        username: {
                            required: "Enter your email address",
                            email: "Enter valid email address"
                        },
                        password: {
                            required: "Enter your password",
                            minlength: "Password must be minimum 6 characters"
                        }
                    },
                    errorClass: "help-inline",
                    errorElement: "span",
                    highlight: function (element, errorClass, validClass) {
                        $(element).parents('.control-group').addClass('error');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).parents('.control-group').removeClass('error');
                        $(element).parents('.control-group').addClass('success');
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
                <?php
                if($_GET['message']=="passwordchanged") {
                    ?>
                <div class="alert alert-success">
                        <?php
                        echo 'Password Changed Succesfully';
                    }
                    ?>
                </div>
                <?php
                if($_GET['message']=="error") {
                    ?>
                <div class="alert alert-danger">
                        <?php
                        echo 'There Was An error';
                        ?>
                </div>
                    <?php
                }
                if($_GET['message']=="regformsub") {
                    ?>
                <div class="alert alert-success">
                        <?php
                        echo 'Please check your mail at '.$_GET['email'].' for further processing.<br/> If you didnt recieve any mail
                    please check your spam as well.';
                        ?>
                </div>
                    <?php
                }
                if($_GET['message']=="resetmailsent") {
                    ?>
                <div class="alert alert-success">
                        <?php
                        echo 'Please check your mail at '.$_GET['email'].' for further processing.<br/> If you didnt recieve any mail
                    please check your spam as well.';
                        ?>
                </div>
                    <?php
                }
                if($_GET['message']=="userexist") {
                    ?>
                <div class="alert alert-danger">
                        <?php
                        echo $_GET['email'].' already exist.';
                        ?>
                </div>
                    <?php
                }
                ?>

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
