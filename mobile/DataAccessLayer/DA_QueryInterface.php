<?php

/**
 *
 * @author Nithin Devang
 */
interface DA_QueryInterface {
    public function Insert($TableName_,$FieldArray_);
    public function Select();
    public function Update();
    public function Delete();
    public function Count();
    public function descrite();
    public function TransactionBegin($TransactionName);
    public function EndTransaction();
}
?>
