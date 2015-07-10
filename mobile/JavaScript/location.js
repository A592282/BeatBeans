Image1 = new Image();
Image1.src = "images/wheel.gif";
Image2 = new Image();
Image2.src = "images/spinloading.gif";
function SetLocation()
{

    var sel = document.getElementById("city");
    city=sel.options[sel.selectedIndex].value;

    if(city==0)
    {
        alert("Select City Is Not A City ;-)")
    }
    else
    {
        var LOCATIONe=document.getElementById("location");
        var location = LOCATIONe.options[LOCATIONe.selectedIndex].value;
        document.getElementById("locationmenu").innerHTML="<img src=\"images/wheel.gif\" alt=Loading /> Seting Your Location Setting";
        var url="PresentationLayer/PL_SetLocationAjax.php?CITY="+city+"&LOCATION="+location;
        $('#locationmenu').load(url,function() {
            $('#locationmenu').fadeOut("slow");
            //  document.getElementById("pleasewait").innerHTML="";
            $('#locationmenu').fadeIn("slow");
            LoadShops();
        });
    }
}
function cityChange()
{
    document.getElementById("setlocationbutton").innerHTML="";
    var selecttemp="<img src=\"images/wheel.gif\" alt=Loading /> Loading Location(s)";
    document.getElementById("locationajax").innerHTML=selecttemp;

    var sel = document.getElementById("city");
    city=sel.options[sel.selectedIndex].value;

    if(city==0)
    {
        document.getElementById("locationajax").innerHTML="";
    }
    else
    {
        // document.getElementById("pleasewait").innerHTML="<img name=\"img01\" src=\"\">";
        var url="PresentationLayer/PL_LocationInCity.php?CITY="+city;
        $('#locationajax').load(url,function() {
            $('#locationajax').fadeOut("slow");
            //    document.img01.src="images/loading.gif";
            //  document.getElementById("pleasewait").innerHTML="";
            $('#locationajax').fadeIn("slow");
            document.getElementById("setlocationbutton").innerHTML="<img style=\"cursor: pointer\" src=\"images/buttons/setlocation.png\" onclick=\"SetLocation()\" />";
        });
    }
}
function LoadShops()
{
    document.getElementById("locationmenu").innerHTML=document.getElementById("locationmenu").innerHTML+"<img src=\"images/wheel.gif\" alt=Loading /> Loading Restaurants(s)";
    var url="PresentationLayer/PL_DisplayShop.php";
    $('#variablecontent').load(url,function() {
        $('#variablecontent').fadeOut("slow");
        //    document.img01.src="images/loading.gif";
        //  document.getElementById("pleasewait").innerHTML="";
        $('#variablecontent').fadeIn("slow");
    });
}
function LoadProducts(ShopId_,Category_)
{
    var url;
    //document.getElementById("pleasewait").innerHTML="<img name=\"img01\" src=\"\">";
    if(typeof Category_ !== 'undefined')
    {
        document.getElementById("info").innerHTML="<img src=\"images/wheel.gif\" alt=Loading /> Loading Category";
        $('#info').fadeIn("slow");
        url="PresentationLayer/PL_ProductInRestaurant.php?ShopId="+ShopId_+"&CategoryName="+Category_;
        $('#catrefresh').load(url,function() {
            $('#info').fadeOut("slow");
            $('#catrefresh').fadeOut("slow")
            document.getElementById("currentcategory").innerHTML="Current Category: "+decodeURIComponent(Category_);
            $('#catrefresh').fadeIn("slow");
        });
        window.scrollTo(0,100);
    }
    else
    {
        document.getElementById("loadingmenu").innerHTML= "<img src=\"images/wheel.gif\" alt=Loading /> Loading Menu"
        url="PresentationLayer/PL_ProductInRestaurant.php?ShopId="+ShopId_;
        $('#variablecontent').load(url,function() {
            //    $('#info').fadeOut("slow");
            $('#variablecontent').fadeOut("slow")
            $('#variablecontent').fadeIn("slow");
        });
        window.scrollTo(0,100);
    }
}
function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
} 
function AddCart(ProductId,ShopId)
{
    var Quantity=document.getElementById("Qty"+ProductId).value;
    if(Quantity=="0"||Quantity=="00"||Quantity=="")
    {
        if(Quantity=="")
        {
            $("#info"+ProductId).fadeIn(0);
            document.getElementById("info"+ProductId).innerHTML="No Value Entered";
            $("#info"+ProductId).fadeOut(5000);
        }
        else
        {
            $("#info"+ProductId).fadeIn(0);
            document.getElementById("info"+ProductId).innerHTML="Quantity Canot Be 0";
            $("#info"+ProductId).fadeOut(5000);
        }
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
                document.getElementById("info"+ProductId).innerHTML=xmlhttp.responseText;
                UpdateCartDisplay();
                $("#info"+ProductId).fadeOut(5000);
            }
            else
            {
                document.getElementById("info"+ProductId).innerHTML="<img src=\"images/spinloading.gif\" /> Processing..Please Wait";
                $("#info"+ProductId).fadeIn(1000);
            }
        }
        //alert(QtyValue);

        xmlhttp.open("GET","BusinessLogicLayer/BL_AddToCart.php?ProductId="+ProductId+"&Quantity="+Quantity+"&ShopId="+ShopId,true);
        xmlhttp.send();
    }
}
function UpdateCartDisplay()
{
    var url="PresentationLayer/PL_ReturnCart.php";
    document.getElementById("cart").innerHTML="<img src=\"images/spinloading.gif\" />Updating Plate";
    $('#cart').load(url,function() {
        $('#cart').fadeOut("slow");
        $('#cart').fadeIn("slow");
    });
}