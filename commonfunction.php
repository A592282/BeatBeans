<?php
function menuifnologin() {
    ?>
<li><a href="#">Your Plate</a>
    <ul>
        <li><a id="dialog-link" href="#">Your Plate:</a>
        </li>
        <li><a href="checkout.php">Checkout</a>
        </li>
        <li><a href="#" id="couponbutton">Coupon</a>
        </li>
    </ul>
</li>
<li><a href="#">My Account</a>
    <ul>

        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>

</li>
    <?php
    loadgeneral();
}
function menuiflogin() {
    require_once(dirname(__FILE__)."/BusinessLogicLayer/BL_LoginClass.php");
    if(isset($_SESSION['Login'])) {
        $Login=unserialize($_SESSION['Login']);
    }
    else $Login=new BL_LoginClass();
    ?>
<li><a href="#">Your Plate</a>
    <ul>
        <li><a href="#" id="dialog-link">Your Plate</a>
        </li>
        <li><a href="checkout.php">Checkout</a>
        </li>
        <li><a href="#" id="couponbutton">Coupon</a>
        </li>
    </ul>
</li>
<li><a href="#"><?php echo $Login->GetUserInfo("FullName"); ?></a>
    <ul>

        <li><a href="logout.php">Log Out</a></li>
    </ul>

</li>

    <?php
    loadgeneral();
}
function loadgeneral() {
    ?>
<link href="css/sunny/jquery-ui-1.9.1.custom.css" rel="stylesheet" />

<script src="js/jquery-ui-1.9.1.custom.js"></script>

<script>
    jQuery(function() {
        jQuery( "#button" ).button();
        jQuery( "#radioset" ).buttonset();
        jQuery( "#dialog" ).dialog({
            autoOpen: false,
            width: 400,
            buttons: [
                {
                    text: "Ok",
                    click: function() {
                        jQuery( this ).dialog( "close" );
                    }
                },

            ]
        });
        jQuery( "#coupon" ).dialog({
            autoOpen: false,
            width: 400,
            buttons: [
                {
                    text: "Ok",
                    click: function() {
                        jQuery( this ).dialog( "close" );
                    }
                },

            ]
        });


        // Link to open the dialog
        jQuery( "#dialog-link" ).click(function( event ) {
            document.getElementById("dialog").innerHTML="Loading";
            jQuery("#dialog").load("PresentationLayer/PL_ShoppingCart.php",function() {
            });

            jQuery( "#dialog" ).dialog( "open" );
            event.preventDefault();
        });
        jQuery( "#couponbutton" ).click(function( event ) {
            document.getElementById("coupon").innerHTML="Loading";
            jQuery("#coupon").load("PresentationLayer/PL_Coupon.php",function() {
            });

            jQuery( "#coupon" ).dialog( "open" );
            event.preventDefault();
        });

        // Hover states on the static widgets
        jQuery( "#dialog-link, #icons li" ).hover(
        function() {
            jQuery( this ).addClass( "ui-state-hover" );
        },
        function() {
            jQuery( this ).removeClass( "ui-state-hover" );
        }
    );
        jQuery( "#couponbutton, #icons li" ).hover(
        function() {
            jQuery( this ).addClass( "ui-state-hover" );
        },
        function() {
            jQuery( this ).removeClass( "ui-state-hover" );
        }
    );
    })
    function addCoupon()
    {
        CouponCode=document.getElementById("CouponCodeText").value;
        if(CouponCode=="")
        {
            alert("Cannot add blank coupon");
        }
        else
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
                    document.getElementById("coupon").innerHTML=xmlhttp.responseText;
                }
                else
                {
                    document.getElementById("coupon").innerHTML="Processing...";
                }
            }

            xmlhttp.open("GET","PresentationLayer/PL_Coupon.php?CouponCode="+CouponCode,true);
            xmlhttp.send();
        }

    }
    function deleteCoupon()
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
                    document.getElementById("coupon").innerHTML=xmlhttp.responseText;
                }
                else
                {
                    document.getElementById("coupon").innerHTML="Processing...";
                }
            }

            xmlhttp.open("GET","PresentationLayer/PL_Coupon.php?delete=yes",true);
            xmlhttp.send();

    }
</script>
<style>

    .demoHeaders {
        margin-top: 2em;
    }
    #dialog-link span.ui-icon {
        margin: 0 5px 0 0;
        position: absolute;
        left: .2em;
        top: 50%;
        margin-top: -8px;
    }
    #icons {
        margin: 0;
        padding: 0;
    }
    #icons li {
        margin: 2px;
        position: relative;
        padding: 4px 0;
        cursor: pointer;
        float: left;
        list-style: none;
    }
    #icons span.ui-icon {
        float: left;
        margin: 0 4px;
    }
</style>

<div id="dialog" title="Your Orders">
    Plate Contents
</div>
<div id="coupon"title="Coupon">
    </div>

    <?php
}
function footer() {
    ?>
<div id="footer">
    Ojasvi Labs
    <br/>
    <a href="career.php" style="text-decoration: none">Career | </a>
    <a href="faq.php" style="text-decoration: none">F.A.Q. | </a>
    <a href="contact.php" style="text-decoration: none">Contacts | </a>
    <a href="android.php" style="text-decoration: none">Android |</a>
    <a href="affiliate.php" style="text-decoration: none">Affiliation</a>
</div>
    <?php
}
?>
