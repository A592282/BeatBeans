<?php
@session_start();
require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_LoginClass.php");
require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_FoodCartClass.php");
require_once(dirname(__FILE__)."/PresentationLayer/PL_LoginFormDisplayFunction.php");
require_once(dirname(__FILE__)."/LoginFiles/membersite_config.php");
require_once(dirname(__FILE__)."/commonfunction.php");

//$emailsent = false;
if(isset($_POST['submitted']))
{
   if($fgmembersite->EmailResetPasswordLink())
   {
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

    </head>
    <body>
        <div id="content">
            <div id="variablecontent">
                    <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
                    <div id="main">

<!-- Form Code Start -->
<div id='fg_membersite'>
<form id='resetreq' action='BusinessLogicLayer/BL_ResetPassword.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Reset Password</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div>

<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
<div class='container'>
    <label for='email' name='email' >Your Email*:</label><br/>
    <input type='text' name='email' id='email' value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
    <span id='resetreq_email_errorloc' class='error'></span>
</div>
<div class='short_explanation'>Password Reset Link Will Be Sent To Your Mail ID If Found.</div>
<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("resetreq");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("email","req","Please provide the email address used to sign-up");
    frmvalidator.addValidation("email","email","Please provide the email address used to sign-up");

// ]]>
</script>

</div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->
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
?>
