<?php
@session_start();
?>
<link rel="stylesheet" type="text/css" href="css/CarouSlide.css" />
<style type="text/css">
	/*customisation styles*/
	body {font-family:Arial,sans-serif; font-size:0.8em;}
	#a1, #b1, .b1, #c1 {background-color:#ffc;}
	#a2, #b2, .b2, #c2 {background-color:#ccc;}
	#a3, #b3, .b3, #c3 {background-color:#017163; color:#fff;}
	#a4, #b4, .b4, #c4 {background-color:#f0c;}
	#a5, #b5, .b5, #c5 {background-color:#aaf;}
	#a6, #b6, .b6, #c6 {background-color:#000; color:#fff;}
	#a7, #b7, .b7, #c7 {background-color:#037eb0; color:#fff;}
	#a8, #b8, .b8, #c8 {background-color:#B6D862;}
	.slider-nav .active {font-weight:bold;}

	.s1 {position:relative;}
	.s1 .slider-wrapper {border: 1px solid #ccc; position:relative;}
	.s1 .slider-wrapper {width:600px; height:295px;}
	.s1 .slider-holder {width:600px; display:block; height:295px;}
	.s1 .slider-holder li.slide {width:380px; height:275px; padding-right:210px;}
	.s1 .slider-nav {position:absolute; right:-1px; top:0; z-index:1000; width:200px; padding:0; margin:0; border:1px solid #ccc; border-width:1px 0 0 1px; background-color:#fff;}
	.s1 .slider-nav li {list-style:none; height:36px; margin:0; padding:0;border:1px solid #ccc; border-width:0 0 1px;}
	.s1 .slider-nav li a {display:block; width:180px; padding:10px 10px; }
	.s1 .slider-nav li a:hover,
	.s1 .slider-nav li.active a {background-color:#ddd;}


</style>
<?php
require_once(dirname(__FILE__)."/../BusinessLogicLayer/BL_ProductInRestaurantClass.php");
$ProductInRestaurantObject=new BL_ProductInRestaurantClass();

require_once(dirname(__FILE__)."/../BusinessLogicLayer/BL_FoodCartClass.php");
$FoodCartObject=new BL_FoodCartClass();

$CategoryArray=json_decode($ProductInRestaurantObject->GetAllCategories($_GET['ShopId']));
function product($ShopId_,$CategoryId_) {
    $ProductInRestaurantObject=new BL_ProductInRestaurantClass();
    $CategoryArray=json_decode($ProductInRestaurantObject->GetAllCategories($_GET['ShopId']));
    $FoodArray=json_decode($ProductInRestaurantObject->GetProducts($ShopId_, $CategoryId_));
    foreach($FoodArray as $Food) {
        ?>
<div style="border: 02px solid orange;border-right:double orange; width: 50%;text-align: center;  border-top: 0; overflow: visible; margin: 2; border-radius:99px;">
            <?php
            if(file_exists ("../images/product/$Food->product_id.jpg")) {
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
                <button type="button" class="btn btn-small" rel="Add" title="Add"  onclick="AddCart(<?php echo $Food->product_id;?>,<?php echo $_GET['ShopId'];?>)">Add</button>
            </div>
        </div>

    </div>
    <!------------------------------------------------------------------------------------------------->
</div>
<br/>
        <?php
    }
}
if(isset($_GET['CategoryName'])) {
    product($_GET['ShopId'],$_GET['CategoryName']);
}
else {
    ?>

<div id="main">

                <?php
                if(file_exists ("../images/shop/logo/".$_GET['ShopId'].".jpg")) {
                    echo "<img src=\"images/shop/logo/".$_GET['ShopId'].".jpg \" width=\"213\" height=\"192\" />";
                }
                else
                    echo $FoodCartObject->GetShopName($_GET['ShopId']); ?>
            <div id="locationmenu"></div>
            <div class="control-group">
                <label class="control-label" for="input01"></label>
                <div class="controls">
                    <a href="checkout.php"><button type="button" class="btn btn-success" rel="Checkout" title="Hungry checkout :)">Continue</button></a>
                    <button type="button" class="btn btn-success" rel="More" title="Other Eat Point" onclick="LoadShops();">Other Restaurant</button>
                </div>
            </div>

            <div style="cursor:wait" id="info"></div>
            <!--<div class="datagrid">-->
            
                        <p id="currentcategory" nowrap="nowrap">Current Category: <?php echo $FoodCartObject->GetCategoryName($CategoryArray[0]->product_category) ?></p>
                            <!--<div class="datagrid">-->
                            <div class="CarouSlide s1">
                                <div id="catrefresh">
                                    <?php product($_GET['ShopId'],$CategoryArray[0]->product_category); ?>
                            </div>
                            <ul class="slider-nav">
                            <?php
                            foreach($CategoryArray as $CategoryObject) {
                                if($CategoryObject->product_category!="") {
                                    ?>
                                <li><a style="cursor: pointer" onclick="LoadProducts(<?php echo $_GET['ShopId']?>,'<?php echo rawurlencode($CategoryObject->product_category); ?>')"><?php echo $FoodCartObject->GetCategoryName($CategoryObject->product_category); ?></a></li>
                                    <?php
                                }
                                else {
                                    echo "<li>No Category</li>";
                                }
                            }
                            ?>
                            </ul>
                            </div>
                  
            
	
	


    <!--</div>-->

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
</div>
    <?php
}
?>