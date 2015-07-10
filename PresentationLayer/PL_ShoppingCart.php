<?php
@session_start();
require_once(dirname(__FILE__)."/../BusinessLogicLayer/Location/BL_LocationClass.php");
include_once(dirname(__FILE__)."/../BusinessLogicLayer/BL_FoodCartClass.php");
$Location=new BL_LocationClass();
if(isset($_SESSION['Cart'])) {
    $Cart=unserialize($_SESSION['Cart']);
}
else $Cart=new BL_FoodCartClass();

if(($Cart->FoodCartCount())>0) {
    ?>
<script type="text/javascript">
    function Update(prodId,shopid,Qty)
    {
        var xmlhttp;
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                if(xmlhttp.responseText=="Deleted")
                {
                    jQuery('tr').remove("#ProdDiv"+prodId);
                    var url="PresentationLayer/PL_ReturnCart.php";
                    document.getElementById("cart").innerHTML="<img src=\"images/spinloading.gif\" />Updating Plate";
                    jQuery('#cart').load(url,function() {
                        jQuery('#cart').fadeOut("slow");
                        jQuery('#cart').fadeIn("slow");
                    });
                }
                else if(xmlhttp.responseText=="cartempty")
                    window.location.href ="index.php?redirect=cartempty";
                else
                {
                    document.getElementById("cart").innerHTML="<img src=\"images/spinloading.gif\" />Updating Plate";
                    var url="PresentationLayer/PL_ReturnCart.php";
                    document.getElementById("cart").innerHTML="<img src=\"images/spinloading.gif\" />Updating Plate";
                    jQuery('#cart').load(url,function() {
                        jQuery('#cart').fadeOut("slow");
                        jQuery('#cart').fadeIn("slow");
                    });

                    document.getElementById("info"+prodId).innerHTML=xmlhttp.responseText;
                    jQuery("#info"+prodId).fadeOut(5000);
                }
            }
            else
            {
                document.getElementById("info"+prodId).innerHTML="Processing..Please Wait";
                jQuery("#info"+prodId).fadeIn(1000);
            }
        }
        var QtyValue;
        if(Qty==0)
        {
            QtyValue=0;
        }
        else
        {
            QtyValue=document.getElementById("Qty"+prodId).value;
        }
        if(QtyValue<0)
        {
            alert("Check Quantity :-)");

        }
        else
        {
            xmlhttp.open("GET","BusinessLogicLayer/UpdateCart.php?pid="+prodId+"&Qty="+QtyValue+"&ShopId="+shopid,true);
            xmlhttp.send();
        }
    }
</script>
<form>
                    <table>
                        <thead><tr><th>Food Name:</th><th>Quantity:</th></tr></thead>
                        <tbody>
                                    <?php
                                    $SelectedFoodArray=json_decode($Cart->GetCartFood());
                                    foreach($SelectedFoodArray as $SelectedFoodItem) {
                                        ?>
                            <tr id="ProdDiv<?php echo $SelectedFoodItem->SelectedProductId?>">
                                <td><?php echo $Cart->GetFoodName($SelectedFoodItem->SelectedProductId) ?><br />From: <?php echo $Cart->GetShopName($SelectedFoodItem->ShopId)?></td>
                                <td><input class="input-mini" type="text" value="<?php echo $SelectedFoodItem->Quantity;?>" id="Qty<?php echo $SelectedFoodItem->SelectedProductId;?>" size="2" maxlength="2"/></td>
                                <td><div id="info<?php echo $SelectedFoodItem->SelectedProductId; ?>"></div></td>
                                <td><img style="cursor: pointer" src="images/buttons/del.gif" onclick="Update(<?php echo $SelectedFoodItem->SelectedProductId?>,<?php echo $SelectedFoodItem->ShopId ?>,0)" /></td>
                            </tr>
                                        <?php
                                    }
                                    ?>
                        </tbody>
                    </table>
                </form>
<p>Approximate Price. Read F.A.Q. for more</p>
    <?php
}
else
    {
    echo "No Food In Your Plate";
}
?>