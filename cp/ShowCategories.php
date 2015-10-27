<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Showing Categories</title>
<?php 
	$dblink=tep_db_connect() or die('Unable to connect to database server!');
	function fnIsChecked($id)
	{
		if ($id==1) return "checked";
	}

	if($_POST){

		if(!empty($_REQUEST['delete']))
		{	
		$sql='DELETE FROM categories_description WHERE categories_id IN(';
		$sql1='DELETE FROM categories WHERE categories_id IN(';

		$state=$_POST['del'];
		if(!empty($state)){
			foreach ($state as $statename)
				$sql2.=$statename.",";
			$sql.=substr($sql2,0,strlen($sql2)-1).")";
			$sql1.=substr($sql2,0,strlen($sql2)-1).")";
			global $dblink;
			$result1=tep_db_query($sql,$dblink);
			$result2=tep_db_query($sql1,$dblink);
	
			if(!$result1 || !$result2)
				print("<span class='messageError'>Records couldn't be deleted this time.<br />Please try again.</span>");
			}
		}
	
		if(isset($_REQUEST['status']))
		{
			global $dblink;
	
			$sql='UPDATE categories_description SET categories_status=0';
			tep_db_query($sql,$dblink);
			
			if(isset($_REQUEST['cat_status'])){
	
				$sql="UPDATE categories_description SET categories_status=1 WHERE categories_id IN(";
				$state=$_REQUEST['cat_status'];
				if(!empty($state)){
					foreach ($state as $statename)
						$sql1.=$statename.",";
					$sql.=substr($sql1,0,strlen($sql1)-1).")";
	
					$res=tep_db_query($sql,$dblink);
					if(!$res) print("<span class='messageError'>Records couldn't be marked as active.<br />Please try again.</span>");
				}
			}
		}
	}		
	
	$sql = 'SELECT a.categories_id, b.categories_name,a.date_added,a.last_modified,b.categories_status FROM `categories` a INNER JOIN categories_description b on a . categories_id = b . categories_id ORDER BY categories_name ASC , date_added DESC LIMIT 0, 30 ';
	$result=tep_db_query($sql,$dblink);
	if(!$result){tep_db_error(result);}

?>
</head>

<body>
	<div><span id="heading">Product Categories</span></div>
	<form method="post" name="frmCategory" action="index.php?mode=11">
	<?php 
	if(mysql_num_rows($result)>0){
		echo ("<table class='tbllisting'> ");
		echo("<tr><th>SN</th><th>Category name</th><th>Date added</th><th>Last modified date</th><th>Edit</th><th>Status</th><th>Delete</th></tr>");				
		while($cat=tep_db_fetch_array($result)){ 		
		$css=(($var % 2)==0)?" class='even'":" class='odd'";
		echo ("<tr>");
		echo ("<td".$css.">".++$var."</td>");
		echo ("<td".$css."><a href='index.php?mode=10&cid=".$cat['categories_id']."'>".$cat['categories_name']."</a></td>");
		echo ("<td".$css.">".$cat['date_added']."</td>");
		echo ("<td".$css.">".$cat['last_modified']."</td>");
		echo("<td align='center' ".$css."><a href='index.php?mode=10&cid=".$cat['categories_id']."'><img border=0 src='../images/edit.png' alt='edit'></a></td>");
		echo("<td align='center' ".$css."><input id='cat_status[]' name='cat_status[]' type='checkbox' value=".$cat['categories_id']." ".fnIsChecked($cat['categories_status'])." /></td>");
		echo("<td align='center' ".$css."><input id='del[]' name='del[]' type='checkbox' value=".$cat['categories_id']." /></td>");						
		
		echo ("</tr>");
		
?>

<?php 
		}//while
		echo("<tr><td colspan='4'></td><td><td><input type='submit' value='save' name='status' /></td><td><input type='submit' value='delete' name='delete' /></td></tr>");		
		echo("</table>");
	}//if row>0
	else{
		echo("<span class='messageError'>Record doesnot exist</span>");
	}
?>
</form>
</body>
</html>
<?php 
tep_db_close($dblink);
?>
