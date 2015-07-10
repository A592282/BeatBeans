<?php
@session_start();
class BL_LocationClass
{
    private $LocationId;
    private $CityId;
    public function SetLocation($CityId_,$LocationId_)//Not used. Set current is used
    {
        $this->CityId=$CityId_;
        $this->LocationId=$LocationId_;
    }
    public function GetCity()
    {
        require_once(dirname(__FILE__)."/../../DataAccessLayer/DA_QueryClass.php");
        $QueryObject=new DA_QueryClass();
        $QueryObject->SetTable("city");
        $QueryObject->AddField("city_id");
        $QueryObject->AddField("city_name");
        return $QueryObject->Select();
    }
    public function GetLocation($CityId_)
    {
        require_once(dirname(__FILE__)."/../../DataAccessLayer/DA_QueryClass.php");
        $QueryObject= new DA_QueryClass();
        $QueryObject->SetTable("location");
        $QueryObject->AddField("location_id");
        $QueryObject->AddField("location_name");
        $QueryObject->AddCondition("city_id", $CityId_);
        return $QueryObject->Select();
    }
    public function SetCurrent($CityId_,$LocationId_)
    {
        $_SESSION['CityId']=$CityId_;
        $_SESSION['LocationId']=$LocationId_;
    }
    public function GetCurrentLocation($Type_="Id")
    {
        if($Type_=="Id")
        {
            return $_SESSION['LocationId'];
        }
        else
        {
            require_once(dirname(__FILE__)."/../../DataAccessLayer/DA_QueryClass.php");
            $QueryObject=new DA_QueryClass();
            $QueryObject->SetTable("location");
            $QueryObject->AddField("location_name");
            $QueryObject->AddCondition("location_id", $_SESSION['LocationId']);
            $ResulktLocation= json_decode($QueryObject->Select());
            return $ResulktLocation[0]->location_name;
        }
    }
    public function GetCurrentCity($Type_="Id")
    {
        if($Type_=="Id")
        {
            return $_SESSION['CityId'];
        }
        else
        {
            require_once(dirname(__FILE__)."/../../DataAccessLayer/DA_QueryClass.php");
            $QueryObject=new DA_QueryClass();
            $QueryObject->SetTable("city");
            $QueryObject->AddField("city_name");
            $QueryObject->AddCondition("city_id", $_SESSION['CityId']);
            $ResulktLocation= json_decode($QueryObject->Select());
            return $ResulktLocation[0]->city_name;
        }
    }
    public function CheckSet()
    {
        if((isset($_SESSION['LocationId']))&&(isset($_SESSION['CityId'])))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function UnsetLocation()
    {
        unset($_SESSION['CityId']);
        unset($_SESSION['LocationId']);
    }
}
//$Location=new BL_LocationClass();
?>