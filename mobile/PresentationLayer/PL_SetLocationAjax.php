<?php
@Session_Start();
require_once(dirname(__FILE__)."/../BusinessLogicLayer/Location/BL_LocationClass.php");
$Location=new BL_LocationClass();
if((isset($_GET['CITY']))&&(isset($_GET['LOCATION']))) {
    $Location->SetCurrent($_GET['CITY'],$_GET['LOCATION']);//Location is set in the session variable
    //and hence Location object need not be serialised and stored in session
    ?>
<div id="main">
    <center>
        <table  bgcolor="#f5f5f5" border="0" width="400">
            <tr>
                <td align="center" valign="middle">
                    <font size="5">CITY : </font>
    <?php
                        echo $Location->GetCurrentCity("name");
                        echo "<br />";
                        ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <font size="5">LOCATION : </font>
    <?php
                        echo $Location->GetCurrentLocation("name");
                        ?>
                    <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <table>
                        <tr>
                            <td>
                                <form action="index.php" method="GET" name="locationchangeandset">
                                    <img style="cursor: pointer" src="images/buttons/changelocation.png" onclick="document['locationchangeandset'].submit()" />
                                    <input type="hidden" name="newloc" value="2626">
                                </form>
                            </td>
                            <td>
                                <form action="shops_in_location.php" method="GET">
                                    <img style="cursor: pointer" src="images/buttons/searchfood.png" onclick="LoadShops();"/>
                                </form>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </center>
</div>
    <?php
}
?>
