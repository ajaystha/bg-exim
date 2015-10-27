<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Contact Address</title>
<?php 

	$dblink=tep_db_connect() or die('Unable to connect to database server!');
	$sql = 'SELECT contact_details FROM contact_details';
	$result=tep_db_query($sql,$dblink);
	if(!$result){tep_db_error(result);}
	$data=tep_db_fetch_array($result);
	if(!empty($_REQUEST['contact_details'])&&isset($_REQUEST['contact_details']))
	{
		global $dblink;
		$sql="UPDATE contact_details SET contact_details='".$_REQUEST['contact_details']."'";
		tep_db_query($sql,$dblink);
		if($result)
			print("<span class='messageSuccess'>Contact Details updated successfully</span>");	
		else
			print("<span class='messageError'>Records couldn't be updated.<br />Please try again.</span>");
	}
?>

</head>

<body>
	<div><span id="heading">Contact Address</span></div>
	<div style="height:5px"></div>
	<form action="index.php?mode=25" method="post">
	<?php 
		echo("<textarea rows='15' cols='60' id='contact_details' name='contact_details'>".$data['contact_details']."</textarea>");
	?>
	<br />
	<input type="submit" /><input type="reset" />
	</form>
</body>
</html>
<?php 
tep_db_close($dblink);
?>
