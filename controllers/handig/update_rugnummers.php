<?php
require_once('databaseConnection.class.php');
require_once('config.local.php');
$conn = new DBconnection($pdoconfig);
$x = 100;
for($i=0;$i<440;$i++)
{
$qry = "UPDATE renner SET rugnummer = $x WHERE id = $i";
$conn->doUpdate($qry);
$x++;
}
?>