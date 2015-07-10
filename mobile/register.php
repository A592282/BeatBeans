<?php
@session_start();
require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_LoginClass.php");
require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_FoodCartClass.php");
require_once(dirname(__FILE__)."/commonfunction.php");
require_once(dirname(__FILE__)."/LoginFiles/membersite_config.php");
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
    header("Location: index.php");
}
else
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Beat Beans :-) | E restaurant | Download Food | Online food ordering | Bangalore | Mangalore</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
        <link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
        <script type="text/javascript" src="JavaScript/pwdwidget.js"></script>
        <script type="text/javascript" src="JavaScript/location.js">
        </script>
        <script type="text/javascript" src="JavaScript/jquery-latest.js"></script>
        <script type='text/javascript' src='JavaScript/gen_validatorv31.js'></script>
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

    </head>
    <body>
        <div id="content">
            <div id="variablecontent">
                <div id="main">
<!-- Form Code Start -->
<div id='fg_membersite'>
<form id='register' action='BusinessLogicLayer/BL_RegisterValidate.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Register</legend>

<!--<input type='hidden' name='submitted' id='submitted' value='1'/>-->

<div class='short_explanation'>* required fields</div>
<input type='text'  class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' />-

<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
<div class='container'>
    <label for='name' >Your Full Name*: </label><br/>
    <input type='text' name='name' id='name' value='<?php echo $fgmembersite->SafeDisplay('name') ?>' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='email' >Email Address*:</label><br/>
    <input type='text' name='email' id='email' value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
    <span id='register_email_errorloc' class='error'></span>
</div>

<!--<div class='container'>
    <label for='username' >UserName*:</label><br/>
    <input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
    <span id='register_username_errorloc' class='error'></span>
</div>-->
<div class='container' style='height:80px;'>
    <label for='password' >Password*:</label><br/>
    <div class='pwdwidgetdiv' id='thepwddiv' ></div>
    <noscript>
    <input type='password' name='password' id='password' maxlength="20" />
    </noscript>
    <div id='register_password_errorloc' class='error' style='clear:both'></div>
</div>
<div class='container'>
    <label for='phone' >Phone*:</label><br/>
    <input type='text' name='phone' id='phone' value='<?php echo $fgmembersite->SafeDisplay('phone') ?>' maxlength="12" /><br/>
    <span id='register_phone_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='address' >Address*:</label><br/>
    <textarea name='address' id='address' value='' maxlength="500"></textarea><br/>
    <span id='register_address_errorloc' class='error'></span>
</div>

<?php
if(isset ($_GET['error']))
{
    if($_GET['error']=="captchafail")
    {
        echo "<p>That was a wrong captcha :-/";
    }
}
require_once('BusinessLogicLayer/recaptchalib.php');
  $publickey = "6Lcj9M4SAAAAAN1NxAzfRSH4HmGSB5mLe9B8Ms6V"; // you got this from the signup page
  echo recaptcha_get_html($publickey);
  ?>


<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</fieldset>
</form>
</div>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[
    var pwdwidget = new PasswordWidget('thepwddiv','password');
    pwdwidget.MakePWDWidget();

    var frmvalidator  = new Validator("register");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("name","req","You seriosly dont have a name? :-O But Unfortunately we need it :P");

    frmvalidator.addValidation("email","req","Using Internet & No mail ID? strange!");

    frmvalidator.addValidation("email","email","That dont seem valid! Dont worry, We dont spam your Inbox :P");

   // frmvalidator.addValidation("username","req","Please provide a username");
    frmvalidator.addValidation("phone","req","Dont worry we wont call you every one hour! We are not your Love :P");
    frmvalidator.addValidation("phone","numeric","Please provide a number");
    frmvalidator.addValidation("phone","maxlen=12","We still donot believe phone number can be less than 9 :-D");
    frmvalidator.addValidation("phone","minlen=9","We still donot believe phone number can be less than 9 :-D");

    frmvalidator.addValidation("address","req","Please provide your primary shipping address");
    frmvalidator.addValidation("address","maxlen=50");
    frmvalidator.addValidation("password","req","This is not your graduate exam! You can pass this just with a password!");


// ]]>
</script>

<!--
Form Code End (see html-form-guide.com for more info.)
-->
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
?>