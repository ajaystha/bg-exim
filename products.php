<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Products Listing</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>

<?php 
	if (isset($_REQUEST['cid'])){
		require("includes/configure.php");
		require("includes/database.php");
		$dblink=tep_db_connect() or die('Unable to connect to database server!');
		$p_category=$_REQUEST['cid'];
	/*$sql = 'SELECT a.products_id,a.products_quantity,a.products_model,a.products_image,a.products_price,a.products_date_added,'	
		. ' products_last_modified,a.products_weight,b.products_name,b.products_description,b.products_viewed,c.categories_name '
        . ' FROM products a LEFT OUTER JOIN products_description b ON a . products_id = b . products_id '
        . ' LEFT OUTER JOIN categories_description c ON a . products_model = c . categories_id WHERE a.products_status=1';
	*/
	$sql = 'SELECT b.products_id,b.products_name,b.products_description,a.products_image,c.categories_name FROM products a '
		  .'INNER JOIN products_description b ON a.products_category='.$p_category.' AND a.products_id = b.products_id '
		  .'INNER JOIN categories_description c ON c.categories_id=a.products_category '
		  .'AND a.products_status=1 LIMIT 0, 30 ';	
	$result=tep_db_query($sql,$dblink);
	if(!$result){tep_db_error(result);}
	 /*while ($products_desc = tep_db_fetch_array($result)) {
		print($products_desc['categories_name']."<br/>");
	}*/
	}
?>
<div id="wrap">
<?php require("header.php");?>
<div class="container">
		<span id="heading">Products</span><br />
		<?php 
			if(isset($_REQUEST['cid'])){ 
				//printing the record count
				if(mysql_num_rows($result)>0){
					require("navigation.php");
					print("<span class='notice'>&nbsp;" . mysql_num_rows($result). " record(s) found</span>");
					}
				else
					print("</h3><span class='confirm' style='height:300px;vertical-align:middle'><br /><br /><br /><br /><br /><br />Sorry we don't have any products under this category right now.<br />
					Please visit in a short while. <br /><br /><strong>Thank You</strong></span>");
		?>	
			
		<?php 
			while ($products_desc = tep_db_fetch_array($result)) {
				if (!empty($products_desc['products_name'])){		
		?>
		
				<div class="Image">
				<?php 
						//display picture 
						//print ($products_desc['categories_name']);
						if(!empty($products_desc['products_image'])){
							$pic_name="./images/products/". $products_desc['categories_name']."/".$products_desc['products_image'];
							$alt_text=$products_desc['products_image'];							
						}
						else{
							$pic_name="./images/na.gif"; $alt_text="Image not found";
							}
						print("<a href=products_desc.php?cid=".$_REQUEST['cid']."&pid=".$products_desc['products_id'].">");
						print("<img src='$pic_name' width='120px' height='150px' alt='$alt_text' border='0'/></a>");
				?>				
	
				<span class="prod_desc">
					<?php 
						if (($products_desc['products_name'])!=" ")
							print(substr($products_desc['products_description'],0,45));
						else
							print("product info not available.");
					?>
				</span>
	   		</div>					
			<?php 
			}	//if (!empty($products_desc['products_name'])){		
		}		//while ($products_desc = tep_db_fetch_array($result)) {
	} 			//if(isset($_REQUEST['pid'])){ 
			?>		
  </div>
<?php 
	require("footer.php");
	if (!empty($_REQUEST['cid'])) tep_db_close($dblink);
?>
</body>
</html>