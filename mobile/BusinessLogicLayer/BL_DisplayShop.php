<?php
function BL_DisplayShop() {
    require_once(dirname(__FILE__)."/../DataAccessLayer/DA_QueryClass.php");
    require_once(dirname(__FILE__)."/Location/BL_LocationClass.php");

    $Location=new BL_LocationClass();
    $ShopQuery=new DA_QueryClass();
    return $ShopQuery->SelectQueryRun("SELECT shop_id,shop_name,shop_address,rating,time,min_price,price_range from shops WHERE shop_id IN(SELECT ShopId from locationofshop where LocationId=".$Location->GetCurrentLocation().")");
}
?>