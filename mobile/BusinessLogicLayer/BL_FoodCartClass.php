<?php
/**
 * Description of BL_FoodCartClass
 *
 * @author Nithin Devang
 */
//require_once 'BL_food.php';
class BL_FoodCartClass {
    //private $BL_Food;
    private $SelectedProductId=array();
    private $Quantity=array();
    private $ShopId=array();
    public function BL_FoodCartClass() {
        //  $BL_Food=new BL_Food();
    }
    public function AddFoodCart($SelectedProductId_,$Quantity_,$ShopId_) {
        if(in_array($SelectedProductId_, $this->SelectedProductId)) {
            $TempSearchId=array_search($SelectedProductId_, $this->SelectedProductId);
            if(($this->ShopId[$TempSearchId])==$ShopId_)
                $this->Quantity[$TempSearchId]=$this->Quantity[$TempSearchId]+$Quantity_;
            else {
                array_push($this->SelectedProductId,$SelectedProductId_);
                array_push($this->Quantity,$Quantity_);
                array_push($this->ShopId,$ShopId_);
            }
        }
        else {
            array_push($this->SelectedProductId,$SelectedProductId_);
            array_push($this->Quantity,$Quantity_);
            array_push($this->ShopId,$ShopId_);
        }
        return true;
    }
    public function UpdateFoodCart($SelectedProductId_,$Quantity_,$ShopId_) {
        if((in_array($SelectedProductId_, $this->SelectedProductId))&&(in_array($ShopId_, $this->ShopId))) {
            $ProductIdLocation=array_search($SelectedProductId_, $this->SelectedProductId);
            if($ShopId_==$this->ShopId[$ProductIdLocation]) {
                $this->Quantity[$ProductIdLocation]=$Quantity_;
            }
            else {
                $this->AddFoodCart($SelectedProductId_,$Quantity_,$ShopId_);
            }
        }
        else {
            $this->AddFoodCart($SelectedProductId_,$Quantity_,$ShopId_);
        }
    }
    public function DeleteFoodCart($SelectedProductId_,$ShopId_) {
        if((in_array($SelectedProductId_, $this->SelectedProductId))&&(in_array($ShopId_, $this->ShopId))) {
            $ProductIdLocation=array_search($SelectedProductId_, $this->SelectedProductId);
            if($ShopId_==$this->ShopId[$ProductIdLocation]) {
                unset($this->SelectedProductId[$ProductIdLocation]);
                $this->SelectedProductId = array_values($this->SelectedProductId);
                unset($this->Quantity[$ProductIdLocation]);
                $this->Quantity = array_values($this->Quantity);
                unset($this->ShopId[$ProductIdLocation]);
                $this->ShopId = array_values($this->ShopId);
            }
        }
    }
    public function FoodCartCount() {
        return count($this->SelectedProductId);
    }
    public function FoodCartPrice() {
        require_once(dirname(__FILE__)."/../DataAccessLayer/DA_QueryClass.php");
        $TotalPrice=0;
        foreach($this->SelectedProductId as $Index=>$TempProductId) {
            $QueryObject=new DA_QueryClass();
            $QueryObject->SetTable("products_in_shops");
            $QueryObject->AddField("product_price");
            $QueryObject->AddCondition("product_id", $TempProductId);
            $QueryObject->AddCondition("shop_id", $this->ShopId[$Index]);
            $QueryResult=json_decode($QueryObject->Select());
            foreach($QueryResult as $Value) {
                $TotalPrice=$TotalPrice+($Value->product_price*$this->Quantity[$Index]);
            }
        }
        return $TotalPrice;
    }
    public function GetCartFood() {
        for($i=0;$i<$this->FoodCartCount();$i++) {
            $temp[$i]['SelectedProductId']=$this->SelectedProductId[$i];
            $temp[$i]['Quantity']=$this->Quantity[$i];
            $temp[$i]['ShopId']=$this->ShopId[$i];
        }
        return json_encode($temp);

    }
    public function GetFoodName($ProductId_) {
        require_once(dirname(__FILE__)."/../DataAccessLayer/DA_QueryClass.php");
        $QueryObject=new DA_QueryClass();
        $QueryObject->SetTable("product");
        $QueryObject->AddField("product_name");
        $QueryObject->AddCondition("product_id", $ProductId_);
        $QueryResult=json_decode($QueryObject->Select());
        return $QueryResult[0]->product_name ;
    }
    public function GetShopName($ShopId_) {
        require_once(dirname(__FILE__)."/../DataAccessLayer/DA_QueryClass.php");
        $QueryObject=new DA_QueryClass();
        $QueryObject->SetTable("shops");
        $QueryObject->AddField("shop_name");
        $QueryObject->AddCondition("shop_id", $ShopId_);
        $QueryResult=json_decode($QueryObject->Select());
        return $QueryResult[0]->shop_name ;
    }
        public function GetCategoryName($CategoryId_) {
        require_once(dirname(__FILE__)."/../DataAccessLayer/DA_QueryClass.php");
        $QueryObject=new DA_QueryClass();
        $QueryObject->SetTable("category");
        $QueryObject->AddField("category_name");
        $QueryObject->AddCondition("category_id", $CategoryId_);
        $QueryResult=json_decode($QueryObject->Select());
        return $QueryResult[0]->category_name ;
    }
    public function ConfirmOrder($LoginSerialized_) {
        //if loged in continue or return false
        $Flag=false;
        require_once(dirname(__FILE__)."/BL_LoginClass.php");
        $Login=new BL_LoginClass();
        $Login=unserialize($LoginSerialized_);

        if($Login->LoginCheck()) {
            $Cart=new BL_FoodCartClass();
            $Cart=$this->GetCartFood();
            require_once(dirname(__FILE__)."/../DataAccessLayer/DA_QueryClass.php");
            $QueryObjectMax=new DA_QueryClass();
            $QueryObjectMax->SetTable("transaction");
            $QueryObjectMax->AddField("max(TransactionId) as MaxTransactionId");
            $QueryResult=json_decode($QueryObjectMax->Select());
            if(($QueryResult[0]->MaxTransactionId)==null) {
                $TransactionIdLocal=1;
            }
            else {
                $TransactionIdLocal=($QueryResult[0]->MaxTransactionId)+1;
            }
            $QueryObjectTransaction=new DA_QueryClass();
            $QueryObjectTransaction->SetTable("transaction");
            $QueryObjectTransaction->AddField($TransactionIdLocal);
            $QueryObjectTransaction->AddField($Login->GetLoginId());
            $QueryObjectTransaction->AddField("Pending");
            if($QueryObjectTransaction->Insert())
            {
                $Flag=true;
                $SelectedFoodArray=json_decode($this->GetCartFood());
                $Sql="INSERT INTO transactionproducts VALUES ";
                foreach($SelectedFoodArray as $SelectedFoodItem) {
                    $Sql=$Sql."('".$TransactionIdLocal."','".$SelectedFoodItem->SelectedProductId."','".$SelectedFoodItem->Quantity."','".$SelectedFoodItem->ShopId."','NA'),";
                }
                $Sql = substr($Sql, 0, strlen($Sql)-1);
                if(mysql_query($Sql))
                {
                     require_once(dirname(__FILE__)."/BL_Mail.php");
                     $To="dvng4u@gmail.com";
                    $Subject="New Order";
                    $Message='<p>You have a new order</p>
                        ';
                    $Message=$Message.'There was a new order';
                    return(SendMail($To, $Subject, $Message));
                }
            }
        }
        return $Flag;
    }
}
?>