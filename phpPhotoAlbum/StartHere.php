<?php
$imageGroup=$_GET['imageGroup'];
?>
<HTML>
<HEAD>
<meta http-equiv=Content-Type content="text/html;  charset=ISO-8859-1">
<TITLE>StartHere</TITLE>
</HEAD>
<BODY bgcolor="#000033">


		
<!-- URL's used in the movie-->
<!-- text used in the movie-->
<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
 codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
 WIDTH="777" HEIGHT="433" id="pictures" ALIGN="">
 <PARAM NAME=movie VALUE="pictures.swf?imageGroup=<?php print("$imageGroup"); ?>"> <PARAM NAME=quality VALUE=high> <PARAM NAME=bgcolor VALUE=#000033> <EMBED src="pictures.swf" quality=high bgcolor=#000033  WIDTH="777" HEIGHT="433" NAME="StartHere" ALIGN=""
 TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
</OBJECT>
<br>
<font color="white"> 
<!--<?php echo $imageGroup; ?>-->
<br>
<font color="#CCCCCC" size="2" face="Arial, Helvetica, sans-serif"><strong>OPTIONS:</strong></font><font color="#CCCCCC" size="2" face="Arial, Helvetica, sans-serif"><br>
Choose a collection from the scrolling menu. | Click on the images to toggle size. 
| Choose a viewing option to change view.</font></font> 
</BODY>
</HTML>
