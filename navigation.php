<?php 
	//require("includes/configure.php");
	//require("includes/database.php");
	//$dblink=tep_db_connect() or die('Unable to connect to database server!');
	$cat_array=array();
	
	if (isset($_REQUEST['cid']))
	{
		$p_cat=$_REQUEST['cid'];
		$current_category=fnGetCategory($p_cat);
		array_push($cat_array,$current_category);
		getParentCategory($p_cat);
		for($i=count($cat_array)-2;$i>=0;$i--){
		$var=$var . $cat_array[$i]." >> ";
		}
		$var=substr($var,0,strlen($var)-4);
		print "<strong>" .$var . "</strong>";
	}
	function fnGetCategory($p_cat)
	{
		global $dblink;
		$sql='SELECT categories_name FROM categories_description WHERE categories_id='.$p_cat;
		$result=tep_db_query($sql,$dblink);
		$n=tep_db_fetch_array($result);
		if(mysql_num_rows($result)>0)
			return $n['categories_name'];
	}
	
	function getParentCategory($id)
	{
		global $cat_array;
		global $dblink;
		$sql = 'SELECT c.categories_name,b.parent_id FROM categories a INNER JOIN categories b ON a.categories_id = b.parent_id INNER JOIN categories_description c ON  c.categories_id=a.categories_id and b.categories_id = ' . $id;
		$result=tep_db_query($sql,$dblink);
		//while ($cat = tep_db_fetch_array($result)) {
		$cat = tep_db_fetch_array($result);
		array_push($cat_array,"<a href='./products.php?cid=$id'>".$cat['categories_name']."</a>");		
		if(mysql_num_rows($result)>0)
		{
			getParentCategory($cat['parent_id']);
		}

	}
?>