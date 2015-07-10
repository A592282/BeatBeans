function LoadProducts(ShopId_)
{

    //document.getElementById("pleasewait").innerHTML="<img name=\"img01\" src=\"\">";
//    alert(1)
    var xmlhttp;
    var txt,x,i;
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
        alert(xmlhttp.status)
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
      //      document.getElementById("pleasewait").innerHTML="";
      alert(xmlhttp.responseText)
            document.getElementById("variablecontent").innerHTML=xmlhttp.responseText;
        }
        else
        {
        //    document.img01.src="images/loading.gif";
        }
    }
    //alert(QtyValue);

    xmlhttp.open("GET","PresentationLayer/PL_ProductInRestaurant.php?ShopId="+ShopId_,true);
    xmlhttp.send();

}