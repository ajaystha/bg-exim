<?php

$theuri = $_SERVER['REQUEST_URI'];

if ( ($theuri =="/") or ($theuri =="/index.php") )
{
$itemis = "<img src=\"images/arrow.gif\" alt=\"arrow \">
<span class=\"note\"> Screen Text Here </span>";

} else {

$itemis = "<a href=\"www.yourdomain.com/index.php\">Screen Text Here </a>";
}
echo $itemis;
?>
