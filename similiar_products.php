<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Similiar Products</title>
<link href="style.css" type="text/css" rel="stylesheet"></link>
<style type="text/css">
	.thimage{height:120px;width:90px; border:1px groove #003333;display:inline;float:left;text-align:center;vertical-align:middle;margin:10px;padding:3px;padding-top:7px}
	html>body .thimage{min-height:90px;}
</style>
<?php 
	if (isset($_REQUEST['cid'])){
		$dblink=tep_db_connect() or die('Unable to connect to database server!');
		$p_category=$_REQUEST['cid'];
		$sql = 'SELECT a.products_id,b.products_name,a.products_thumb,c.categories_name,c.categories_id FROM products a INNER JOIN categories_description c ON a.products_category=c.categories_id '
	        . ' INNER JOIN products_description b ON a.products_id=b.products_id'
    	    . ' AND c.categories_id='.$p_category.' AND a.products_status=1 LIMIT 0, 5';
		$result=tep_db_query($sql,$dblink);
	if(!$result){tep_db_error(result);}
	}
?>
</head>

<body>
<div style="width:400px">
		<div style="clear:both">&nbsp;</div>
		<span class="title" style="margin-left:0px">Similiar products</span>		
		<?php if(isset($_REQUEST['cid'])){ 
					if(mysql_num_rows($result)<=0) 
					print("<span class='notice'>No more similiar products on this category</span>");
					
					while ($products_desc = tep_db_fetch_array($result)) {				
						if (!empty($products_desc['products_thumb'])){		
		?>
								<div class="thimage">
						<?php 
								//display picture 
								//print ($products_desc['categories_name']);
								if(!empty($products_desc['products_thumb'])){
									$pic_name="./images/products/". $products_desc['categories_name']."/".$products_desc['products_thumb'];
									$alt_text=$products_desc['products_image'];							
								}
								else{
									$pic_name="./images/na.gif"; $alt_text="Image not found";
									}
								print("<a href=products_desc.php?cid=".$_REQUEST['cid']."&pid=".$products_desc['products_id'].">");
								print("<img src='$pic_name' width='75px' height='90px' alt='$alt_text' border='0'/></a>");
						?>				
			
						<span class="prod_desc" style="text-align:center;">
							<?php 
								if (($products_desc['products_name'])!=" ")
									print(substr($products_desc['products_name'],0,50));
							?>
						</span>
					</div>					
		<?php 
						}	//if (!empty($products_desc['products_name'])){		
		       		}		//while ($products_desc = tep_db_fetch_array($result)) {
	  } 			//if(isset($_REQUEST['pid'])){ 
		?>		
</div>
</body>
</html>