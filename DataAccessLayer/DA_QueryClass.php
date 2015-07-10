<?php
require_once 'DA_DataBaseConnectionClass.php';
require_once 'DA_QueryInterface.php';
class DA_QueryClass {
    private $TableName=array();
    private $FieldListArray=array();
    private $ConditionArray=array();
    private $FieldLink=array();
    private $Sql="";
    public function DA_QueryClass() //Constructor
    {
        $DataBaseConnect=new DA_DataBaseConnectionClass();

    }
    public function SetTable($TableName_) {
        array_push($this->TableName, $TableName_);
    }
    public function AddField($FieldValue_,$ColumnName_="0") {
        if($ColumnName_=="0") {
            array_push($this->FieldListArray, $FieldValue_);
        }
        else {
            $this->FieldListArray[$ColumnName_]=$FieldValue_;
        }
    }
    public function AddCondition($Key_,$Value_) {
        $this->ConditionArray[$Key_]=$Value_;
    }
    public function AddFieldLink($Key_,$Value_) {
        $this->FieldLink[$Key_]=$Value_;
    }
    public function Insert() {
        $Sql="INSERT INTO ".$this->TableName[0]." VALUES (";
        foreach ($this->FieldListArray as $FieldValueTemp) {
            $Sql=$Sql."'".$FieldValueTemp."',";
        }
        $Sql = substr($Sql, 0, strlen($Sql)-1);
        $Sql=$Sql.")";
        if((mysql_query($Sql))==1) {
            return true;
        }
        else
            return false;
    }
    public function Select() {
        $Sql="SELECT ";
        foreach ($this->FieldListArray as $FieldValueTemp) {
            $Sql=$Sql.$FieldValueTemp.",";
        }
        $Sql = substr($Sql, 0, strlen($Sql)-1);
        $Sql=$Sql." FROM ";
        foreach($this->TableName as $TempTableName) {
            $Sql=$Sql.$TempTableName.",";
        }
        $Sql = substr($Sql, 0, strlen($Sql)-1);
        if((count($this->ConditionArray)>0)||(count($this->FieldLink)>0)) {
            $Sql=$Sql." WHERE ";
            foreach ($this->ConditionArray as $Key_=>$Value_) {
                $Sql=$Sql."$Key_='$Value_' AND ";
            }
            foreach ($this->FieldLink as $Key_=>$Value_) {
                $Sql=$Sql."$Key_=$Value_ AND ";
            }
            $Sql = substr($Sql, 0, strlen($Sql)-4);
        }
        //echo $Sql;
        $Table= mysql_query($Sql);
        $Json=array(); // Json is just an array variable and not in Json format
        while($Row=mysql_fetch_assoc($Table)) {
                array_push($Json,$Row);
        }
        return json_encode($Json);
    }
    public function Update() {
        //UPDATE table_name SET column1=value, column2=value2 WHERE some_column=some_value
        $Sql="UPDATE ".$this->TableName[0]." SET ";
        foreach ($this->FieldListArray as $Key_=>$Value_) {
                $Sql=$Sql."$Key_='$Value_', ";
            }
            $Sql = substr($Sql, 0, strlen($Sql)-2);
            $Sql=$Sql." WHERE ";
            foreach ($this->ConditionArray as $Key_=>$Value_) {
                $Sql=$Sql."$Key_='$Value_' AND ";
            }
            $Sql = substr($Sql, 0, strlen($Sql)-4);
            return mysql_query($Sql);
    }
    public function Delete($TableName_,$FieldArray_,$ConditionArray_) {

    }
    public function Count() {

    }
    public function descrite() {

    }
    public function TransactionBegin($TransactionName_) {
        mysql_query("begin $TransactionName_");
    }
    public function EndTransaction() {
        mysql_query("commit");
    }
    public function SelectQueryRun($Sql_) {
        $Sql=$Sql_;
        $Table= mysql_query($Sql);
        $Json=array(); // Json is just an array variable and not in Json format
        while($Row=mysql_fetch_assoc($Table)) {
                array_push($Json,$Row);
        }
        return json_encode($Json);
    }
}
/*$a=new DA_QueryClass;
$a->SetTable("location");
$a->AddField("location_id");
$a->AddField("location_name");
$a->Select();*/
?>
