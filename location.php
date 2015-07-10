<?php
if(isset($_GET['lat'])&&isset($_GET['lon']))
{
$url = "http://maps.googleapis.com/maps/api/geocode/xml?latlng=".$_GET['lat'].",".$_GET['lon']."&sensor=true";
$raw = file_get_contents($url);
$newlines = array("\t","\n","\r","\x20\x20","\0","\x0B");
$content = str_replace($newlines, "", html_entity_decode($raw));


$start = strpos($content,'<formatted_address>')+19;

$end = strpos($content,'</formatted_address>',$start);

$data = substr($content,$start,$end-$start);
echo $data;
}
else
    {
    echo "ERROR";
}

?>