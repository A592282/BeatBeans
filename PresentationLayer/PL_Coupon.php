<?php
require_once(dirname(__FILE__)."/../BusinessLogicLayer/BL_CouponClass.php");
$CouponVariable=new BL_CouponClass();
if($CouponVariable->IsCouponSet()) {
    if(isset($_GET['delete']))
    {
        if($CouponVariable->DeleteCoupon())
?>
<p>Deleted</p>
<hr/>
<div class="control-group">
        <label class="control-label" for="input01">Coupon Code:</label>
        <div class="controls">
            <input type="text" class="input-xlarge" id="CouponCodeText" name="CouponCodeText" rel="popover" data-content="Enter your coupon code or Gift code here if available" data-original-title="Coupon" />
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="input01"></label>
        <div class="controls">
            <button type="submit" class="btn btn-success" rel="Add" title="Add :)" onclick="addCoupon();">Add Coupon</button>
        </div>
    </div>
<?php

}
    else
    {
    ?>
<table>
    <tr>
        <td><?php echo $_SESSION["CouponCode"];?></td></tr>
<tr>        <td><?php echo $CouponVariable->GetCouponMessage();?></td>
    </tr>
</table>

    <div class="control-group">
        <label class="control-label" for="input01"></label>
        <div class="controls">
            <button type="submit" class="btn btn-success" rel="DeleteCoupon" title="Delete :)" onclick="deleteCoupon();">Delete Coupon</button>
        </div>
    </div>
<?php
    }
}
else {
    if(isset($_GET['CouponCode'])) {
        if($CouponVariable->ApplyCoupon($_GET['CouponCode'])) {
            ?>
<table>
    <tr>
        <td><?php echo $_SESSION["CouponCode"];?></td></tr>
<tr>        <td><?php echo $CouponVariable->GetCouponMessage();?></td>
    </tr>
</table>

    <div class="control-group">
        <label class="control-label" for="input01"></label>
        <div class="controls">
            <button type="submit" class="btn btn-success" rel="DeleteCoupon" title="Delete :)" onclick="deleteCoupon();">Delete Coupon</button>
        </div>
    </div>
            <?php echo $CouponVariable->GetCouponMessage()." Added"; ?>
            <?php
        }
        else {
            ?>
    <div class="control-group">
        <label class="control-label" for="input01">Coupon Code:</label>
        <div class="controls">
            <input type="text" class="input-xlarge" id="CouponCodeText" name="CouponCodeText" rel="popover" data-content="Enter your coupon code or Gift code here if available" data-original-title="Coupon" />
            <p>Coupon code not found.</p>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="input01"></label>
        <div class="controls">
            <button type="submit" class="btn btn-success" rel="Add" title="Add :)" onclick="addCoupon();">Add Coupon</button>
        </div>
    </div>

            <?php
        }
    }
    else {
        ?>
    <div class="control-group">
        <label class="control-label" for="input01">Coupon Code:</label>
        <div class="controls">
            <input type="text" class="input-xlarge" id="CouponCodeText" name="CouponCodeText" rel="popover" data-content="Enter your coupon code or Gift code here if available" data-original-title="Coupon" />
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="input01"></label>
        <div class="controls">
            <button type="submit" class="btn btn-success" rel="Add" title="Add :)" onclick="addCoupon();">Add Coupon</button>
        </div>
    </div>
        <?php
    }
}
?>