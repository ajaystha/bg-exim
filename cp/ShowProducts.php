<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Showing Products</title>
<style type="text/css">
.link{
	border:1px solid #666666;
	min-height:5px;
	padding:3px;
	background-color:#CCCCCC;
	text-align:left;
	}
</style>
<?php 
	$dblink=tep_db_connect() or die('Unable to connect to database server!');
	function fnIsChecked($id)
	{
		if ($id==1) return "checked";
	}
	function fnDeleteImage($pid)
	{
		global $dblink;
		$sql = 'SELECT c.categories_name,a.products_image,a.products_thumb FROM products a INNER JOIN categories_description c ON a . products_category = c . categories_id AND a . products_id ='.$pid;
		$result=tep_db_query($sql,$dblink);
		$temp=tep_db_fetch_array($result);
		if(mysql_num_rows($result)>0)
		{
			$path='../images/products/'.$temp['categories_name'].'/';
			unlink($path.$temp['products_thumb']);
			unlink($path.$temp['products_image']);
		}
	return true;
	}
	if($_POST){
		
		if(!empty($_REQUEST['delete']))
		{	$prod_id=array();
			$sql="DELETE FROM products WHERE products_id IN(";
			$sql1="DELETE FROM products_description WHERE products_id IN(";
			$state=$_POST['del'];
			if (!empty($state)){
				foreach ($state as $statename)
				{
					$sql2.=$statename.",";
					array_push($prod_id,$statename);				//collecting product ids
				}	
	
				/*deleting photographs*/
				for($i=0;$i<count($prod_id);$i++)
				{
					if(!fnDeleteImage($prod_id[$i]))
						print("Couldn't delete image with id $prod_id[$i]");
				}
				
				$sql.=substr($sql2,0,strlen($sql2)-1).")";
				$sql1.=substr($sql2,0,strlen($sql2)-1).")";
	
				global $dblink;			
				$result=tep_db_query($sql,$dblink);
				$result=tep_db_query($sql1,$dblink);
				if(!$result)
					print("<span class='messageError'>Records couldn't be deleted this time.<br />Please try again.</span>");
			}
		}
		
		if(isset($_REQUEST['showfront']))
		{
			global $dblink;
	
			$sql='UPDATE products SET show_front=0';
			tep_db_query($sql,$dblink);
			
			if(isset($_REQUEST['show_front'])){
	
				$sql="UPDATE products SET show_front=1 WHERE products_id IN(";
				$state=$_POST['show_front'];
				if(!empty($state)){
					foreach ($state as $statename)
						$sql1.=$statename.",";
					$sql.=substr($sql1,0,strlen($sql1)-1).")";
					$res=tep_db_query($sql,$dblink);
					if(!$res) print("<span class='messageError'>Records couldn't be updated to show in front page.<br />Please try again.</span>");
				}
			}
		}
	
		if(isset($_REQUEST['status']))
		{
			global $dblink;
	
			$sql='UPDATE products SET products_status=0';
			tep_db_query($sql,$dblink);
			
			if(isset($_REQUEST['products_status'])){
	
				$sql="UPDATE products SET products_status=1 WHERE products_id IN(";
				$state=$_REQUEST['products_status'];
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
	
	$sql = 'SELECT a.products_id,a.products_quantity,a.products_weight,a.products_price,a.products_status,a.show_front,b.products_name,b.products_description,c.categories_name FROM products a INNER JOIN products_description b ON a.products_id=b.products_id LEFT JOIN categories_description c ON a.products_category=c.categories_id ';
	if(!empty($_REQUEST['cid']) && isset($_REQUEST['cid'])){
		$sql .='WHERE c.categories_id='.$_REQUEST['cid'];
	}
	$sql .=' ORDER BY products_status DESC,products_name ASC,categories_name ASC';

	$result=tep_db_query($sql,$dblink);
	if(!$result) tep_db_error(result);

	function fnProductCategory()
	{
		global $dblink;
		$sql = 'SELECT * FROM `categories_description` 	ORDER BY categories_name ASC LIMIT 0, 10 ';
		$result=tep_db_query($sql,$dblink);
		if(mysql_num_rows($result)>0)
		{	//print "Browse by category<br />";
			print '<a href='.$_SERVER['PHP_SELF'].'?mode=2>| Show All | </a>';
			while($cat=tep_db_fetch_array($result))
				print '<a href='.$_SERVER['PHP_SELF'].'?mode=2&cid='.$cat['categories_id'].'>'.$cat['categories_name'].' | </a>';
		}
	}
?>
</head>

<body>
	<form method="post" name="frmProducts" action="index.php?mode=2">
	<div>
		<span id="heading">Available Products</span></div><br />
		<div class='' id='ProductCategory'><?php fnProductCategory()?>
	</div>	
	<div style="height:5px"></div>
	<input type="hidden" id="h_front" name="h_front"/>
	<input type="hidden" id="h_delete" name="h_delete"/>
	<?php 
	if(mysql_num_rows($result)>0){
		echo ("<table class='tbllisting'>");
		echo("<tr><th>SN</th><th>Product Name</th><th>Price (NRS)</th><th>Quantity</th><th>Weight</th><th>Category</th><th>Edit</th><th>Front?</th><th>Status</th><th>Delete</th></tr>");

		while($prod=tep_db_fetch_array($result)){ 		

			$css=(($var % 2)==0)?" class='even'":" class='odd'";					
			echo("<tr>");
			echo ("<td".$css.">".++$var."</td>");		
						
			echo ("<td".$css.">"."<a href='index.php?mode=1&pid=".$prod['products_id']."'>".$prod['products_name']."</a></td>");
			echo ("<td".$css.">".$prod['products_price']."</td>");
			echo ("<td".$css.">".$prod['products_quantity']."</td>");
			echo ("<td".$css.">".$prod['products_weight']."</td>");
			echo ("<td".$css.">". $prod['categories_name'] ."</td>");

			echo("<td align='center' ".$css."><a href='index.php?mode=1&pid=".$prod['products_id']."'><img border=0 src='../images/edit.png' alt='edit'></a></td>");
			echo("<td align='center'".$css."><input id='show_front[]' name='show_front[]' type='checkbox' value=".$prod['products_id']." ".fnIsChecked($prod['show_front'])." /></td>");			
			echo("<td align='center' ".$css."><input id='products_status[]' name='products_status[]' type='checkbox' value=".$prod['products_id']." ".fnIsChecked($prod['products_status'])." /></td>");
			echo("<td align='center' ".$css."><input id='del[]' name='del[]' type='checkbox' value=".$prod['products_id']." /></td>");			
			echo ("</tr>");
		}
		echo("<tr><td colspan='2'></td><td colspan='2'></td><td colspan='3'></td><td><input type='submit' value='save' name='showfront' /><td><input type='submit' value='save' name='status' /></td><td><input type='submit' value='delete' name='delete' /></td></tr>");
		echo("</table>");

	}
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
