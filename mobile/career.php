<?php
@session_start();
require_once(dirname(__FILE__)."/BusinessLogicLayer/Location/BL_LocationClass.php");
require_once(dirname(__FILE__)."/commonfunction.php");
require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_LoginClass.php");
include_once(dirname(__FILE__)."/BusinessLogicLayer/BL_FoodCartClass.php");
include_once(dirname(__FILE__)."/BusinessLogicLayer/Location/BL_LocationClass.php");
$Location=new BL_LocationClass();
if(isset($_GET['newloc'])) {
    $Location->UnsetLocation();
    header( 'Location: index.php');
}
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Beat Beans :-) | Career</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <script type="text/javascript" src="JavaScript/location.js"></script>
        <script type="text/javascript" src="JavaScript/jquery-latest.js"></script>
        <script type="text/javascript" src="JavaScript/jquery.tablesorter.js"></script>
        <script type='text/javascript' src='JavaScript/gen_validatorv31.js'></script>
        <!--Google Analytics Start-->
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-32720545-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>
        <!--Google Analytics End-->
    </head>
    <body>
        <div id="fb-root"></div>
        <script type="text/javascript">(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <div>
            <a href="index.php"><img src="images/logo.jpg" width="237" height="123" class="float" alt="BeatBeans" /></a>
            <div class="topnav">
                <span><strong>Welcome</strong> &nbsp;
                    <?php if(!($Login->LoginCheck())) { ?>
                    <a href="loginmain.php">Log in</a>&nbsp; | &nbsp; <a href="registerform.php">Register</a>
                        <?php } else echo $Login->GetLoginId(); ?>

                </span>
            </div>
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
        </div>

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
                <div id="main">
                    <br />
                    <br />
                    <div id="inside">

                        <h1><!--We're -->Hiring!</h1><br/>

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
                    </div>
                </div>
            </div>
        </div>
                <img src="images/cards.jpg" alt="" width="919" height="76" />

    </body>
</html>
