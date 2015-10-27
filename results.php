<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Search results</title>
<link href="style.css" type="text/css" rel="stylesheet"></link>
</head>

<body>
<div id="wrap">
<?php require("header.php");?>

<div class="container">
<?php require("search_main.html");?>
<br />
<!-- Google Search Result Snippet Begins -->
<div id="googleSearchUnitIframe"></div>

<script type="text/javascript">
   var googleSearchIframeName = 'googleSearchUnitIframe';
   var googleSearchFrameWidth = 700;
   var googleSearchFrameborder = 0 ;
   var googleSearchDomain = 'www.google.com.np';
</script>
<script type="text/javascript"
         src="http://www.google.com/afsonline/show_afs_search.js">
</script>
<!-- Google Search Result Snippet Ends -->
</div>

</body>
</html>