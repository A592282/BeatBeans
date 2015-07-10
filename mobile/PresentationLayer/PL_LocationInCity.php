<?php
require_once(dirname(__FILE__)."/../BusinessLogicLayer/Location/BL_LocationClass.php");
if($_GET['CITY']==0)
{
    echo "<option value=0>First Select City</option>";
}
else
{
?>
    <font size="5">LOCATION : </font>
    <label class="custom-select">
    <select name="LOCATION" id="location">
<?php
    $Location=new BL_LocationClass();
    $ResultLocation=json_decode($Location->GetLocation($_GET['CITY']));
    foreach($ResultLocation as $LocationValue)
    {
        echo "<option value=$LocationValue->location_id>$LocationValue->location_name</option>";
    }
}
?>
</select>
        </label>