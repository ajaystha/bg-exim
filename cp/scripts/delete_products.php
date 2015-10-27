<?php
		require "../../includes/configure.php";
		require "../../includes/database.php";
		
		$dblink=tep_db_connect() or die('Unable to connect to database server!');			
		$sql="DELETE FROM products WHERE products_id =".$_REQUEST['q'];
		$result=tep_db_query($sql,$dblink);
		$sql="DELETE FROM products_description WHERE products_id =".$_REQUEST['q'];			
		$result=tep_db_query($sql,$dblink);
		//fnDeleteImage($_REQUEST['q']);			
		if(!$result)
			print("<span class='messageError'>Records couldn't be deleted this time.<br />Please try again.</span>");
		//function fnDeleteImage($pid)
		//{
			$sql = 'SELECT c.categories_name,a.products_image,a.products_thumb FROM products a INNER JOIN categories_description c ON a . products_category = c . categories_id AND a . products_id ='.$_REQUEST['q'];
			//global $dblink;
			$result=tep_db_query($sql,$dblink);
			if(!$result) tep_db_error($result);
			print $result;
			$temp=tep_db_fetch_array($result);
			if(mysql_num_rows($result)>0)
			{
				$path='../images/products/'.$temp['categories_name'].'/';
				print $path='../images/products/'.$temp['categories_name'].'/';
				unlink($path.$temp['products_thumb']);
				unlink($path.$temp['products_image']);
			}
		//return true;
		//}
?>