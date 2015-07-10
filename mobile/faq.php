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
        <link rel="stylesheet" type="text/css" href="style.css" />
        <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
        <link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
        <script type="text/javascript" src="JavaScript/pwdwidget.js"></script>
        <script type="text/javascript" src="JavaScript/location.js">
        </script>
        <script type="text/javascript" src="JavaScript/jquery-latest.js"></script>
        <script type="text/javascript" src="JavaScript/jquery.tablesorter.js"></script>
        <script type='text/javascript' src='JavaScript/gen_validatorv31.js'></script>
        <script type="text/javascript">
    function showHideMore(obj) {
        var contObj = obj.parentNode.getElementsByTagName('div')[0];
        var status = (contObj.style.display == 'block')? 'none' : 'block'
        contObj.style.display = status;
        //obj.innerHTML = (status == 'block')? 'Show less' : 'Show more';
        obj.curPic = (obj.curPic == 0)? 1 : 0;
        obj.style.backgroundImage = 'url("'+plusMinusPics[obj.curPic]+'")';
    }
    window.onload=function(){
        plusMinusPics = ['plus.png','minus.png'];
        oMoreLessSpans = document.getElementById('list1').getElementsByTagName('span');
        for(i=0; i < oMoreLessSpans.length; i++){
            oMoreLessSpans[i].curPic = 0;
            oMoreLessSpans[i].style.background = 'url("'+plusMinusPics[oMoreLessSpans[i].curPic]+'") no-repeat 0 50%';
            oMoreLessSpans[i].onclick=function(){showHideMore(this);}
        }
    }
</script>
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
            <div id="main">
                <div id="inside">
                    <div class="info">
        <?php
        if(isset($_SESSION['user_id'])&&isset($_SESSION['login_true'])) {
            ?>
        <p><b>Hello <?php echo $_SESSION['user_id']; ?></b></p>

            <?php

        }
        else {
            echo "<p><b>Hello Guest </b></p>";
        }

        ?>
        <br />
        <!--START-->

        <div>
            <ul id="list1">
                <li>
                    <div>
                        <br /><span>What is BeatBeans.com?</span>
                        <div class="more_content">BeatBeans is an Business 2 Consumer E-commerce site. This site as we call is the Second
                        World, Which is the aggregation of all the local shops in your locality. You can actually order products from your local
                        shops through this site.</div>
                    </div>
                </li>
                <li>
                    <div>
                        <br /><span>Edu Empower?</span>
                        <div class="more_content">Edu Empower is our Social Cause.
                            We contribute 2% of our revenue to rural India education.
                            Next time you visit this site and make every click, feel the pride,
                            You contribute to India tomorrow. </div>
                    </div>
                </li>
                <li>
                    <div>
                        <br /><span>Public Collaborative Business Model?</span>
                        <div class="more_content">THE MODEL IS SIMPLE, YOU CAN EARN LIFE TIME INCOME BY JUST FOLLOWING THESE TWO OR ANY ONE.
<br />1. IF THERE IS A HOME DELIVERY SHOP IN YOUR LOCALITY INTRODUCE BEATBEANS TO THEM AND IF THEY GET LISTED IN BEATBEANS, FOR ALL FUTURE TRANSACTIONS THROUGH THAT SHOP YOU WILL BE GETTING %PROFIT SHARE.

<br /><br />2.INTRODUCE YOUR FRIENDS TO BEATBEANS. AND FOR ALL FUTURE PURCHASES THEY MAKE YOU WILL BE GETTING CASH POINTS.
</div>
                    </div>
                </li>
            </ul>
        </div>

        <!--END-->

            </div>
        </div>
    <!--</div>-->

</div>

        </div>
    </body>
</html>