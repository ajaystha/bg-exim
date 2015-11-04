<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script type="text/javascript">var dmWorkPath = "menu.files/";</script>
	<script type="text/javascript" src="menu.files/dmenu.js"></script>\
	<!-- (c) 2007, by Deluxe-Menu.com -->
	<?php require("datetime.js"); ?>
</head>
<BODY onload="fnShowDateTime();">

	<div id="headerarea">
			<span id="MyDateTime" style="float:right;"></span>
			<input type="hidden" id="txtHrs" value="<?php print(date("H:i:s:A",mktime(date("H")+10,date("i")-15)));?>">
			<input type="hidden" id="txtDate" value="<?php print(date("l F dS, Y"));?>"/>
			<img src="./images/head-BG.jpg" />
			<span style="clear:both"><script type="text/javascript" src="menu.js"></script></span>
			<span style="height:0px;">	</span>

	</div>
	<div id="topline"><img src="./images/main-file_08.gif" /></div>
</body>
</html>
