<?php
@session_start();
require_once(dirname(__FILE__)."/../BusinessLogicLayer/BL_LoginClass.php");
require_once(dirname(__FILE__)."/../BusinessLogicLayer/BL_FoodCartClass.php");
require_once(dirname(__FILE__)."/../BusinessLogicLayer/Location/BL_LocationClass.php");
require_once(dirname(__FILE__)."/PL_LoginFormDisplayFunction.php");
require_once(dirname(__FILE__)."/../LoginFiles/membersite_config.php"); 
if(isset($_SESSION['Login'])) {
    $Login=unserialize($_SESSION['Login']);
}
else $Login=new BL_LoginClass();
if(isset($_SESSION['Cart'])) {
    $Cart=unserialize($_SESSION['Cart']);
}
else $Cart=new BL_FoodCartClass();
?>
<link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
<div id="main">
<div id='fg_membersite'>
<form id='login' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Login</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div>

<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
<div class='container'>
    <label for='username' >UserName*:</label><br/>
    <input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
    <span id='login_username_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='password' >Password*:</label><br/>
    <input type='password' name='password' id='password' maxlength="50" /><br/>
    <span id='login_password_errorloc' class='error'></span>
</div>

<div class='container'>
    <input type='Button' name='Login' value='Login' onclick="encrypt('hello')" />
</div>
<div class='short_explanation'><a href='reset-pwd-req.php'>Forgot Password?</a></div>
<div class='short_explanation'><a href='registerform.php'>New User?</a></div>
</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("login");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("username","req","Please provide your username");

    frmvalidator.addValidation("password","req","Please provide the password");

// ]]>
</script>
</div>
</div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->