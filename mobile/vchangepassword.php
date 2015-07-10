<?php
@session_start();
if(isset($_GET['id'])) {
    require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_LoginClass.php");
    require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_FoodCartClass.php");
    require_once(dirname(__FILE__)."/LoginFiles/membersite_config.php");
    require_once(dirname(__FILE__)."/commonfunction.php");

//$emailsent = false;
    if(isset($_POST['submitted'])) {
        if($fgmembersite->EmailResetPasswordLink()) {
            $fgmembersite->RedirectToURL("login_register.php");
            exit;
        }
    }
//Redirect Function start
    function Redirect($url) {
        echo $url;
        header("Location: $url");
    }
//Redirect function end
    /*Serialization start*/
    if(isset($_SESSION['Login'])) {
        $Login=unserialize($_SESSION['Login']);
    }
    else $Login=new BL_LoginClass();

    if(isset($_SESSION['Cart'])) {
        $Cart=new BL_FoodCartClass();
        $Cart=unserialize($_SESSION['Cart']);
    }
    else $Cart=new BL_FoodCartClass();
    /*Serialization end*/
    if($Login->LoginCheck()) {
        Redirect("index.php");
    }
    else {
        ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Beat Beans :-) | E restaurant | Download Food | Online food ordering | Bangalore | Mangalore</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="style.css" />

        <script type="text/javascript" src="JavaScript/rsa.js">
        </script>
        <script type="text/javascript" src="JavaScript/location.js">
        </script>
        <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
        <link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
        <script type="text/javascript" src="JavaScript/pwdwidget.js"></script>
        <script type="text/javascript" src="JavaScript/jquery-latest.js"></script>
        <script type="text/javascript" src="JavaScript/jquery.tablesorter.js"></script>
        <script type='text/javascript' src='JavaScript/gen_validatorv31.js'></script>
    </head>
    <body>
        <a href="index.php"><img src="images/logo.jpg" width="237" height="123" class="float" alt="setalpm" /></a>
        <div class="topnav">
            <span><strong>Welcome</strong> &nbsp;
        <?php if(!($Login->LoginCheck())) { ?>
                <a href="loginmain.php">Log in</a>&nbsp; | &nbsp; <a href="registerform.php">Register</a>
            <?php } else echo $Login->GetLoginId(); ?>

            </span>
    <!--    <select>
            <option>Type of Product</option>
            <option>Clothing</option>
            <option>Accessories</option>
            <option>Clothing</option>
            <option>Accessories</option>
        </select>
        <span>Language:</span> <a href="#"><img src="images/flag1.jpg" alt="" width="21" height="13" /></a> <a href="#"><img src="images/flag2.jpg" alt="" width="21" height="13" /></a> <a href="#"><img src="images/flag3.jpg" alt="" width="21" height="13" /></a>-->
        </div>
        <!-------------------------------MENU------------------------------------>
        <?php menuifnologin(); ?>
        <!--------------------------------MENU END--------------------------------------->
        <div id="content">
            <div id="sidebar">
                <div id="navigation">
                    <ul>
                        <li><a href="index.php">Home page</a></li>
                        <li><a href="career.php">Career</a></li>
                        <!--                        <li><a href="schedulemeeting.php">Schedule A Meeting</a></li>
                                                <li><a href="schedulemeeting.php">Register Your Restaurant</a></li>
                        <!--      <li><a href="#">Reviews</a></li>-->
                        <li><a href="faq.php">F.A.Q.</a></li>
                        <li><a href="contact.php">Contacts</a></li>
                    </ul>
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
                </div>
                <div>
                    <!--<img src="images/title1.gif" alt="" width="233" height="41" /><br />
                    <ul class="categories">
                        <li><a href="category.php?cat_id=1">Pizza &amp; Fast Food</a></li>
                        <li><a href="category.php?cat_id=2">Cooked Food, Hotel &amp; Restaurant</a></li>

                    </ul>-->
                    <img src="images/title2.gif" alt="" width="233" height="41" /><br />
                    <div class="review">
                        <!------------------------------------------------------------REVIEW START---------------------------->
                        <b>
                            "Cool thing in Bengaluru-hassle free ordering from your nearest fovourite hotels & restaurants-Even small restaurant here is listed"</b><br/>
                        __Nithin Kumar, Software Engineer                    <!------------------------------------------------------------REVIEW END---------------------------->
                    </div>
                </div>
            </div>
            <div id="variablecontent">
                <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
                <div id="main">

                    <!-- Form Code Start -->
                    <div id='fg_membersite'>
                        <form id='newpass' action='BusinessLogicLayer/BL_ConfirmResetPassword.php' method='post' accept-charset='UTF-8'>
                            <fieldset >
                                <legend>Reset Password</legend>

                                <input type='hidden' name='submitted' id='submitted' value='1'/>
                                <input type='hidden' name='id' id='id' value='<?php echo $_GET['id']?>'/>

                                <div class='short_explanation'>* required fields</div>

                                <div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
                                <div class='container' style='height:80px;'>
                                    <label for='password' >New Password*:</label><br/>
                                    <div class='pwdwidgetdiv' id='thepwddiv' ></div>
                                    <noscript>
                                        <input type='password' name='password' id='password' maxlength="20" />
                                    </noscript>
                                    <div id='register_password_errorloc' class='error' style='clear:both'></div>
                                </div>
                                <div class='short_explanation'>New Password.</div>
                                <div class='container'>
                                    <input type='submit' name='Submit' value='Submit' />
                                </div>

                            </fieldset>
                        </form>
                        <!-- client-side Form Validations:
                        Uses the excellent form validation script from JavaScript-coder.com-->

                        <script type='text/javascript'>
                            // <![CDATA[
                            var pwdwidget = new PasswordWidget('thepwddiv','password');
                            pwdwidget.MakePWDWidget();

                            var frmvalidator  = new Validator("newpass");
                            frmvalidator.EnableOnPageErrorDisplay();
                            frmvalidator.EnableMsgsTogether();
                            frmvalidator.addValidation("password","req","This is not your graduate exam! You can pass this just with a password!");

        
                            // ]]>
                        </script>


                    </div>
                    <!--
                    Form Code End (see html-form-guide.com for more info.)
                    -->
                </div>
            </div>
        </div>
    </body>
</html>

        <?php
    }
}
?>
