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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Beat Beans :-) | E restaurant | Download Food | Online food ordering | Bangalore | Mangalore</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
                <?php
                if($_GET['message']=="passwordchanged") {
                    echo 'Password Changed Succesfully';
                }
                if($_GET['message']=="error") {
                    echo 'There Was An error';
                }
                if($_GET['message']=="regformsub")
                {
                    echo 'Please check your mail at '.$_GET['email'].' for further processing.<br/> If you didnt recieve any mail
                    please check your spam as well.';
                }
                if($_GET['message']=="resetmailsent")
                {
                    echo 'Please check your mail at '.$_GET['email'].' for further processing.<br/> If you didnt recieve any mail
                    please check your spam as well.';
                }

                ?>
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

    </body>
</html>