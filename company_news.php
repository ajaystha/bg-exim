<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" type="text/css" rel="stylesheet" />
<?php 

	$dblink=tep_db_connect() or die('Unable to connect to database server!');
	$sql = 'SELECT * FROM company_news WHERE news_status = 1 ORDER BY published_date DESC LIMIT 0, 5';
	$result=tep_db_query($sql,$dblink);
	if(!$result){tep_db_error(result);}

?>
</head>
<body>
<div id="newsright">
<img src="images/company_news.gif" alt="Comany News" style="margin:5px 0px 2px -7px"/>
<?php
	while ($comp_news= tep_db_fetch_array($result)) {
		//if(empty($company_news['products_description'])){
			print("<h5 align='left' style='margin-bottom:2px'>".$comp_news['news_head']."</h5>");
			print("<div class='dateline'>".$comp_news['published_date']."</div>");			
			print("<span class='companynews'>". $comp_news['news_slug']."</span>");
			print("<div style='height:10px'>&nbsp;</div>");
		//}
	}
?>

</div>
</body>
</html>
<?php 
tep_db_close($dblink);
?>
