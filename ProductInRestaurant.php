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
        <title>Beat Beans :-) | E restaurant | Download Food | Online food ordering | Bangalore | Mangalore</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <link rel="STYLESHEET" type="text/css" href="loginregisterstyle.css" />
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
                        <?php } else echo $Login->GetUserInfo("FullName"); ?>
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
                        0 items |
                        0
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
                <?php
                @session_start();
                ?>
                <?php
                require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_ProductInRestaurantClass.php");
                $ProductInRestaurantObject=new BL_ProductInRestaurantClass();

                require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_FoodCartClass.php");
                $FoodCartObject=new BL_FoodCartClass();

                $CategoryArray=json_decode($ProductInRestaurantObject->GetAllCategories($_GET['ShopId']));
                function product($ShopId_,$CategoryId_) {
                    $ProductInRestaurantObject=new BL_ProductInRestaurantClass();
                    $CategoryArray=json_decode($ProductInRestaurantObject->GetAllCategories($_GET['ShopId']));
                    $FoodArray=json_decode($ProductInRestaurantObject->GetProducts($ShopId_, $CategoryId_));
                    foreach($FoodArray as $Food) {
                        ?>
                <div class="food">
                            <?php
                            if(file_exists ("images/product/$Food->product_id.jpg")) {
                                print "<img src=\"images/product/$Food->product_id[$i].jpg\" height=100 width=100></img>";
                            }
                            /*else {
                print "<img src=\"images/product/noimage.jpg\" height=100 width=100></img>";
            }*/
                            ?>
                            <?php
                            print "<h3>".$Food->product_name."</h3>";
                            print "<p style=\"font-size: 9pt\">".$Food->product_description."</p>";
                            print $Food->product_price." ".$Food->product_comments." * ";
                            ?>
                    <input class="input-mini" type="text" id="Qty<?php echo $Food->product_id?>" name="Qty<?php echo $Food->product_id?>" size=2 maxlength=3 onkeypress="return isNumberKey(event)"/>
                    <!-------------------------------------------------DIV--------------------------------->
                    <div id="ProdDiv<?php echo $Food->product_id?>">
                        <div id="info<?php echo $Food->product_id?>"> &nbsp;</div>
                        <div class="control-group">
                            <label class="control-label" for="input01"></label>
                            <div class="controls">
                                <button type="button" class="btn btn-small" rel="Add" title="Add"  onclick="AddCart(<?php echo $Food->product_id;?>,<?php echo $_GET['ShopId'];?>)">Add To Taste :)</button>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------->
                </div>
                        <?php
                    }
                }
                if(isset($_GET['CategoryName'])) {
                    product($_GET['ShopId'],$_GET['CategoryName']);
                }
                else {
                    ?>
                <style>
                    /* ------------------
                 styling for the tables
                   ------------------   */


                    body
                    {
                        line-height: 1.6em;
                    }

                    #background-image
                    {
                        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
                        font-size: 12px;
                        /*margin: 45px;*/
                        width: 480px;
                        text-align: left;
                        border-collapse: collapse;
                        background: url('images/pic3.jpg') 450px 150px no-repeat;
                    }
                    #background-image th
                    {
                        padding: 12px;
                        font-weight: normal;
                        font-size: 14px;
                        color: #339;
                    }
                    #background-image td
                    {
                        padding: 9px 12px;
                        color: #669;
                        border-top: 1px solid #fff;
                    }
                    #background-image tfoot td
                    {
                        font-size: 11px;
                    }
                    #background-image tbody td
                    {
                        background: url('table-images/back.png');
                    }
                    * html #background-image tbody td
                    {
                        /*
	   ----------------------------
		PUT THIS ON IE6 ONLY STYLE
		AS THE RULE INVALIDATES
		YOUR STYLESHEET
	   ----------------------------
	*/
                        filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='table-images/back.png',sizingMethod='crop');
                        background: none;
                    }
                </style>
                <script src="JavaScript/jquery-latest.js"></script>

                <div id="main">
                        <?php
                        if(file_exists ("images/shop/logo/".$_GET['ShopId'].".jpg")) {
                            echo "<img src=\"images/shop/logo/".$_GET['ShopId'].".jpg \" width=\"213\" height=\"192\" />";
                        }
                        else
                            echo $FoodCartObject->GetShopName($_GET['ShopId']); ?>
                    <div id="locationmenu"></div>
                    <br/>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                    <a href="checkout.php"><img src="images/buttons/continue.png" /></a>
                    <img style="cursor: pointer" src="images/buttons/otherrestaurant.png" onclick="LoadShops();"/>
                    <div style="cursor:wait" id="info"></div>
                    <!--<div class="datagrid">-->
                    <table id="background-image" summary="Products">
                        <thead>
                            <tr>
                                <th id="currentcategory" nowrap="nowrap">Current Category: <?php echo $FoodCartObject->GetCategoryName($CategoryArray[0]->product_category) ?></th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody>
                            <tr valign="top">
                                <td nowrap="nowrap">
                                    <!--<div class="datagrid">-->
                                    <div id="catrefresh">
                                            <?php product($_GET['ShopId'],$CategoryArray[0]->product_category); ?>
                                    </div>
                                    <!--</div>-->
                                </td>
                                <td valign="top"  nowrap="nowrap"><!--Category to Right-->
                                    <br/><br/>
                                        <?php
                                        foreach($CategoryArray as $CategoryObject) {
                                            if($CategoryObject->product_category!="") {
                                                ?>
                                    <a style="cursor: pointer" onclick="LoadProducts(<?php echo $_GET['ShopId']?>,'<?php echo rawurlencode($CategoryObject->product_category); ?>')"><?php echo $FoodCartObject->GetCategoryName($CategoryObject->product_category); ?></a>
                                                <?php
                                            }
                                            else {
                                                echo "No Category";
                                            }
                                            echo "<br /><br />";
                                        }
                                        ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--</div>-->
                </div>
                <div id="disqus_thread"></div>
                <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'beatbeans'; // required: replace example with your forum shortname
            var disqus_identifier = '<?php echo "ShopId :".$_GET['ShopId'] ?>';
            var disqus_url = 'https://beatbeans.com/ProductInRestaurant.php?ShopId=<?php echo $_GET['ShopId']?>';
            var disqus_title='comments for <?php echo $FoodCartObject->GetShopName($_GET['ShopId']) ?>';
            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">Comments</a></noscript>
                <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>

                    <?php
                }
                ?>
            </div>
            <div id="footer">
                <div id="footer">
                    <img src="images/cards.jpg" alt="" width="919" height="76" />
                    <!---------------------THAWTE SEAL START-------------------->
                    <div id="thawteseal" style="text-align:center;" title="Click to Verify - This site chose Thawte SSL for secure e-commerce and confidential communications.">
                        <div><script type="text/javascript" src="https://seal.thawte.com/getthawteseal?host_name=beatbeans.com&amp;size=S&amp;lang=en"></script></div>
                        <div></div>
                    </div>
                    <!---------------------THAWTE SEAL END----------------------->

                    <ul>
                        <li><a href="index.php">Home page</a> |</li>
                        <!--<li><a href="#">New Products</a> |</li>-->
                        <!--  <li><a href="#">All Products</a> |</li>-->
                        <!--  <li><a href="#">Reviews</a> |</li>-->
                        <li><a href="faq.php">F.A.Q.</a> |</li>
                        <li><a href="contact.php">Contacts</a></li>
                    </ul>
                    <p>Copyright (C), Ownership & All Rights Reserved To OrbiDes.
                    <p> BeatBeans.com is a part of our EES (Enterprise Enhancement Solutions)</div>
                <div class="fb-like" data-href="http://beatbeans.com" data-send="true" data-width="450" data-show-faces="true" data-action="recommend"></div>

            </div>
        </div>

    </body>
</html>
