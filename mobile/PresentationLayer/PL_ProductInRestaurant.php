<?php
@session_start();
?>
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
<div>
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
    <input type="text" id="Qty<?php echo $Food->product_id?>" name="Qty<?php echo $Food->product_id?>" size=2 maxlength=3 onkeypress="return isNumberKey(event)"/>
    <!-------------------------------------------------DIV--------------------------------->
    <div id="ProdDiv<?php echo $Food->product_id?>">
        <div id="info<?php echo $Food->product_id?>"> &nbsp;</div>
        <img style="cursor: pointer" src="images/buttons/addtotaste.png" onclick="AddCart(<?php echo $Food->product_id;?>,<?php echo $_GET['ShopId'];?>)" /></div>
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
    <?php echo $FoodCartObject->GetShopName($_GET['ShopId']); ?>
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