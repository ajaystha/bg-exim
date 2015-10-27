<?php

function fixmenu ($name1) {

$name2 = ucfirst($name1);

$item= "<a href=\"/$name1/\">$name2 </a>";

$theur = $_SERVER['REQUEST_URI'];

if ( ($theur =="/$name1/") or ($theur =="/$name1/index.php") )
{
$item= "<img src=\"/images/arrow.gif\" alt=\"arrow \">$name2";
}
return $item;
}

echo fixmenu(directoryname1) . "<br/>Screen Text If Required";

echo fixmenu(directoryname2) . "<br/>Different Screen Text If Required";

echo fixmenu(directoryname3) . "<br/>More Screen Text If Required";

?>