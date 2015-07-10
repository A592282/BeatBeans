<?php
/* 
/**
 * Description of BL_ProductInRestaurant
 *
 * @author Nithin Devang
 */
class BL_ProductInRestaurantClass
{
    public function GetAllCategories($ShopId_)
    {
        // AND  =  AND p.shop_id = s.shop_id";
        require_once(dirname(__FILE__)."/../DataAccessLayer/DA_QueryClass.php");
        $QueryObject=new DA_QueryClass();
        $QueryObject->SetTable("products_in_shops p");
        $QueryObject->SetTable("product p1");
        $QueryObject->SetTable("shops s");
        $QueryObject->AddField("distinct p1.product_category");
        $QueryObject->AddCondition("p.shop_id",$ShopId_);
        $QueryObject->AddFieldLink("p.product_id", "p1.product_id");
        $QueryObject->AddFieldLink("p.shop_id","s.shop_id");
        return $QueryObject->Select();
    }
    public function GetProducts($ShopId_,$CategoryName_)
    {
       // SELECT , , , 
       // FROM , ,  WHERE  =$getshop_id AND  AND  AND ='".$db_field['product_category']."'";
       require_once(dirname(__FILE__)."/../DataAccessLayer/DA_QueryClass.php");
       $QueryObject=new DA_QueryClass();
       $QueryObject->SetTable("products_in_shops p");
       $QueryObject->SetTable("product p1");
       $QueryObject->SetTable("shops s");
       $QueryObject->AddField("p.product_id");
       $QueryObject->AddField("product_name");
       $QueryObject->AddField("product_price");
       $QueryObject->AddField("product_comments");
       $QueryObject->AddField("shop_name");
       $QueryObject->AddField("p1.product_description");
       $QueryObject->AddCondition("p.shop_id", $ShopId_);
       $QueryObject->AddCondition("product_category",$CategoryName_);
       $QueryObject->AddFieldLink("p.product_id","p1.product_id");
       $QueryObject->AddFieldLink("p.shop_id","s.shop_id");
       return $QueryObject->Select();
    }
}
?>
