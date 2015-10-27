<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>top products</title>
<?php 
	require("includes/configure.php");
	require("includes/database.php");
	$dblink=tep_db_connect() or die('Unable to connect to database server!');
	$sql = 'SELECT a.products_id,a.products_category,a.products_thumb,b.products_name,b.products_description,c.categories_id,'
		  .'c.categories_name FROM products a LEFT OUTER JOIN products_description b ON a.products_id=b.products_id '
		  .'INNER JOIN categories_description c ON a.products_category = c.categories_id '
		  .'WHERE a.products_status=1 AND a.show_front=1 LIMIT 0, 2';
	/*
	$sql = 'SELECT b.products_id,b.products_name,b.products_description,a.products_image,c.categories_name FROM products a '
		  .'INNER JOIN products_description b ON a.products_model='.$p_category.' AND a.products_id = b.products_id '
		  .'INNER JOIN categories_description c ON c.categories_id=a.products_model '
		  .'AND a.products_status=1 LIMIT 0, 30 ';	
	*/
	$result=tep_db_query($sql,$dblink);
	if(!$result){tep_db_error(result);}
	 /*while ($products_desc = tep_db_fetch_array($result)) {
		print($products_desc['categories_name']."<br/>");
	}*/
?>
</head>

<body>
<div class="container" style="background-color:#DFF0EE">
		<img src="images/latest_products.gif" title="latest products" style="margin-left:-5px"/>
		<?php 

				//printing the record count
				if(mysql_num_rows($result)<=0)
					print("</h3><span class='confirm'>Sorry we don't have any products under this category right now.<br>
					Please visit in a short while. <br/><strong>Thank You</strong></span>");

			while ($products_desc = tep_db_fetch_array($result)) {
				//if (!empty($products_desc['products_name'])){		
		?>
		
				<div class="Image1">
				<?php 
						//display picture 
						if(!empty($products_desc['products_thumb'])){
							$pic_name="./images/products/". $products_desc['categories_name']."/".$products_desc['products_thumb'];
							$alt_text=$products_desc['products_image'];							
						}
						else{
							$pic_name="./images/na.gif"; $alt_text="Image not found";
							}
						print("<a href=products_desc.php?cid=".$products_desc['categories_id']."&pid=".$products_desc['products_id'].">");
						print("<img title='lastest products' src='$pic_name' width='90px' height='113px' alt='$alt_text' border='0'/></a>");
				?>				
	   			</div>					
	
				<div class="prod_desc_detail">
				
				<?php
					if (($products_desc['products_name'])!=" ") print("<span class='prod_list'>Name : <strong>". $products_desc['products_name']."</strong></span>");
					if (!empty($products_desc['products_quantity'])) print("<span class='prod_list'>Available Qnty :<strong> ". $products_desc['products_quantity']."</strong></span>");
					if (!empty($products_desc['products_weight'])) print("<span class='prod_list'>Weight : <strong>". $products_desc['products_weight']."</strong></span>");					
					if (!empty($products_desc['categories_name'])) print("<span class='prod_list'>Category :<strong> ". $products_desc['categories_name']."</strong></span>");
					if (!empty($products_desc['products_price'])) print("<span class='prod_list'>Price : <strong>Rs. ". $products_desc['products_price']."</strong></span>");
					if (!empty($products_desc['products_date_added'])) print("<span class='prod_list'>Added on : <strong>". $products_desc['products_date_added']."</strong></span>");
					if (!empty($products_desc['products_description'])) print("<span class='prod_list'>". $products_desc['products_description']."</span>");
					if (!empty($products_desc['products_viewed'])) print("<span class='prod_list'><em>This product has been viewed ". $products_desc['products_viewed']." times</em></span>");
				?>
	   		</div>
			<div style="clear:both "></div>
			<?php 
			}	//if (!empty($products_desc['products_name'])){		
			tep_db_close($dblink);
		//}		//while ($products_desc = tep_db_fetch_array($result)) {
			?>
</div>  
</body>
</html>
