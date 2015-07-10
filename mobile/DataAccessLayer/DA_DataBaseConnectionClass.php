<?php
require_once 'DA_DataBaseConnectionInterface.php';
class DA_DataBaseConnectionClass implements DA_DataBaseConnectionInterface {
    private static $UserName = "beatbbeq_beatbea";
    private static $Password = "ballfilm44";
    private static $DataBase = "beatbbeq_beatbeans";
    private static $Server = "localhost";

    public function SelectDatabase()
    {
        return mysql_select_db(self::$DataBase);
    }
    /*private function SelectDatabase($Database_)
    {
        mysql_select_db($Database_);
    }*/
    public function Disconnect()
    {

    }
    public function TransactionBegin($TransactionName)
    {
        mysql_query('$TransactionName');
    }
    public function EndTransaction()
    {
        mysql_query("commit");
    }
    public function DA_DataBaseConnectionClass()
    {
        mysql_connect(self::$Server,self::$UserName,self::$Password);
        $this->SelectDatabase();
        
    }
    /*public function DA_DataBaseConnectionClass($Server_,$Database_)
    {
        mysql_connect($Server_,$this->user_name,$this->password);
        $this->SelectDatabase($DataBase_);
    }*/
}
?>
