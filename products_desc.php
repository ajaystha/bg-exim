<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Products Listing</title>

<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<link href="style.css" type="text/css" rel="stylesheet" />

</head>
<body>

<?php 
	if (isset($_REQUEST['pid'])){
	require("includes/configure.php");
	require("includes/database.php");
	$dblink=tep_db_connect() or die('Unable to connect to database server!');
	$p_category=$_REQUEST['cid'];
	$p_id=$_REQUEST['pid'];
	$sql = 'SELECT a.products_id,a.products_quantity,a.products_category,a.products_image,a.products_price,a.products_date_added,'	
		. ' a.products_weight,b.products_name,b.products_description,b.products_viewed,c.categories_name '
        . ' FROM products a INNER JOIN products_description b ON a . products_id = b . products_id AND a.products_id='.$p_id." AND a.products_category=".$p_category.
          ' INNER JOIN categories_description c ON a . products_category = c . categories_id WHERE a.products_status=1';
	
	$result=tep_db_query($sql,$dblink);
	if(!$result){tep_db_error(result);}
	//print($sql);
	 /*while ($products_desc = tep_db_fetch_array($result)) {
		print($products_desc['categories_name']."<br/>");
	}*/
	}
?>
<div id="wrap">
<?php require("header.php");?>
<div class="container">
		<span id="heading">Product  Detail</span>		
		<?php if(isset($_REQUEST['pid'])){ 

			while ($products_desc = tep_db_fetch_array($result)) {
				print("<span class='notice'>-- " . $products_desc['products_name']."<br ></span>");
				require("navigation.php");
				if (!empty($products_desc['products_name'])){		
		?>				

			<div class="Image2">
					<?php 
					//display picture 
					if(!empty($products_desc['products_image'])){
						$pic_name="./images/products/". $products_desc['categories_name']."/".$products_desc['products_image'];
						$alt_text=$products_desc['products_image'];							
					}
					else{
						$pic_name="./images/na.gif"; $alt_text="Image not found";
						}
					//print("<a href=product_desc.php?pid=".$_REQUEST['pid']."&id=".$products_desc['products_id'].">");
					print("<a rel='lightbox' href='$pic_name'><img src='$pic_name' width='120px' height='150px' alt='$alt_text' border='0'/></a>");
					
			?>				
			</div>					

			<div class="prod_desc_detail">				
					<?php
					if (($products_desc['products_name'])!=" ") print("<span class='prod_list'>Name : <strong>". $products_desc['products_name']."</strong></span>");
					if (($products_desc['products_quantity'])!=" ") print("<span class='prod_list'>Available Qnty :<strong> ". $products_desc['products_quantity']."</strong></span>");
					if (($products_desc['products_weight'])!=" ") print("<span class='prod_list'>Weight : <strong>". $products_desc['products_weight']."</strong></span>");					
					if (($products_desc['categories_name'])!=" ") print("<span class='prod_list'>Category :<strong> ". $products_desc['categories_name']."</strong></span>");
					if (($products_desc['products_price'])!=" ") print("<span class='prod_list'>Price : <strong>Rs. ". $products_desc['products_price']."</strong></span>");
					if (($products_desc['products_date_added'])!=" ") print("<span class='prod_list'>Added on : <strong>". $products_desc['products_date_added']."</strong></span>");
					if (($products_desc['products_description'])!=" ") print("<span class='prod_list'>". $products_desc['products_description']."</span>");
					if (($products_desc['products_viewed'])!=" ") print("<span class='prod_list'><em>This product has been viewed ". $products_desc['products_viewed']." times</em></span>");
				?>
			</div>			

	<?php 
			}	//if (!empty($products_desc['products_name'])){		
		}		//while ($products_desc = tep_db_fetch_array($result)) {
	}
		tep_db_close($dblink);
	?>	
	<!--<div style="clear:both;padding:2px 2px 2px 12px;">Click <a href="javascript:history.go(-1);"><STRONG>here</STRONG></a> to return back</div>	-->
<?php require("similiar_products.php");?>
</div>
<?php require("footer.php");?>
</div>
</body>
</html>