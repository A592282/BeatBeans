<?php
@session_start();
require_once(dirname(__FILE__)."/../DataAccessLayer/DA_QueryClass.php");
/**
 * Description of CouponClass
 *
 * @author nithin
 */
class BL_CouponClass {
    //put your code here
    //private $CouponCode;

    public function GetCouponMessage($CouponCode_="")
    {
        $QueryObject=new DA_QueryClass();
        $QueryObject->SetTable("coupon");
        $QueryObject->AddField("CouponMessage");
        if($CouponCode_=="")
        {
            if(isset($_SESSION['CouponCode']))
            {
                $QueryObject->AddCondition("CouponCode", $_SESSION['CouponCode']);
            }
            else
            {
                return "Error";
            }
        }
        else
        {
            $QueryObject->AddCondition("CouponCode", $CouponCode_);
        }
        $Message=json_decode($QueryObject->Select());
        return $Message[0]->CouponMessage;

    }
    public function ApplyCoupon($CouponCode_)
    {
        $QueryObject=new DA_QueryClass();
        $QueryObject->SetTable("coupon");
        $QueryObject->AddField("CouponCode");
        $QueryObject->AddCondition("CouponCode", $CouponCode_);
        $Message=json_decode($QueryObject->Select());
        if($Message==null)
            return false;
        else
        {
            $_SESSION['CouponCode']=$CouponCode_;
            return true;
        }
    }
    public function ValidateCoupon()
    {
        
    }
    public function DeleteCoupon()
    {
        unset ($_SESSION['CouponCode']);
        return true;
    }
    public function IsCouponSet()
    {
        if(isset($_SESSION['CouponCode']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>
