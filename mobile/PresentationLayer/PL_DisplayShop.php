<?php
@session_start();
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
    #background-image tbody tr:hover td
    {
        color: #339;
        background: none;
    }
</style>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="JavaScript/jquery.tablesorter.js"></script>
<script type="text/javascript">

    $(document).ready(function()
    {
        $("#background-image").tablesorter();
    }
);
</script>
<div id="main">
    <center><font size="3">EAT POINT AT YOUR LOCATION! ;-)</font></center>
    <?php
    require_once(dirname(__FILE__)."/../BusinessLogicLayer/Location/BL_LocationClass.php");
    include_once(dirname(__FILE__)."/../BusinessLogicLayer/BL_FoodCartClass.php");
    $Location=new BL_LocationClass();
    if(isset($_SESSION['Cart'])) {
        $Cart=unserialize($_SESSION['Cart']);
    }
    else $Cart=new BL_FoodCartClass();

    if($Location->CheckSet()) {
        ?>
    <div id="loadingmenu"></div>

    <table id="background-image" summary="Shops In Location">
        <thead>
            <tr>
                <th scope="col" style="cursor:pointer">Restaurant</th>
                <th scope="col" style="cursor:pointer">Ratings</th>
                <th scope="col" style="cursor:pointer">Price Range</th>
                <th scope="col" style="cursor:pointer">Delivery Time</th>
                <th scope="col" style="cursor:pointer">Minimum Order</th>
                <th scope="col" style="cursor:pointer">Delivery Charge</th>
                <th scope="col" style="cursor:pointer">Offers</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="4">Click the header to sort accordingly.</td>
            </tr>
        </tfoot>
        <tbody>
                <?php
                require_once(dirname(__FILE__)."/../BusinessLogicLayer/BL_DisplayShop.php");
                $ShopArray=json_decode(BL_DisplayShop());
                foreach($ShopArray as $ShopValue) {
                    ?>
            <tr>
                <td><b>
                        <a style="cursor: pointer;TEXT-DECORATION: NONE;" onclick="LoadProducts(<?php echo $ShopValue->shop_id ?>)">
                                    <?php echo $ShopValue->shop_name; ?>
                        </a>
                    </b>
                </td>
                <td><?php print $ShopValue->rating; ?></td>
                <td><?php print $ShopValue->price_range; ?></td>
                <td><?php print $ShopValue->time; ?></td>
                <td><?php print $ShopValue->min_price; ?></td>
                <td>0</td>
                <td></td>
            </tr>
                    <?php
                }
                ?>
        </tbody>
    </table>



</div>
    <?php
}

?>