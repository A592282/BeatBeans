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
                        <table cellspacing="20">
                            <tr>
                                <th><h3>Customer Care</h3></th>
                                <td>Phone:(+91)888-41-BEANS (888-41-23267)
                                    <br />
                                    e:mail: contact@beatbeans.com
                                </td>
                            </tr>
                            <tr>
                                <th><h3>Relationship Manager</h3></th>
                                <td>
                                    e:mail: valence@beatbeans.com
                                </td>
                            </tr>
                            <tr>
                                <th><h3>Marketing Manager</h3></th>
                                <td>
                                    e:mail: veigas@beatbeans.com
                                </td>
                            </tr>
                            <tr>
                                <th><h3>Snail Mail</h3></th>
                                <td>
                                    OrbiDes Labs<br/>
                                    E003<br/>
                                    Gaana Regent, Uttarahalli-Kengeri Road<br/>
                                    RR-Nagar, Bagalore-60<br/>
                                </td>
                            </tr>
                            <tr>
                                <th><h3>Regional Office</h3></th>
                                <td>
                                    BeatBeans E-Restaurant<br/>
                                    Pragathi Complex<br/>
                                    Next To Smart City,
                                    Universities Road<br/>
                                    Thokkottu, Permannur<br/>
                                    Mangalore-575017<br/>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>