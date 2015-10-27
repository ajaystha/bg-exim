<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Product Entry / Update</title>
<?php 

$dblink=tep_db_connect() or die('Unable to connect to database server!');
if($_POST)
{
	if(!empty($_REQUEST['product_id']))
		fnUpdateData($_REQUEST['product_id']);
	else 
		fnAddNewData();

}	
function fnUpdateData($pid)
{
	$prod_name=$pid.'_'.$_FILES['product_image']['name'];
	$prod_thumb=$pid.'_th_'.$_FILES['product_image']['name'];
	global $dblink;

	/*Check if photograph is to be removed during update*/
	$flag=true;
	if(isset($_REQUEST['rdNoPhoto'])){
		$sql="UPDATE products SET products_image='',products_thumb='' WHERE products_id=".$pid;
		$result=tep_db_query($sql,$dblink);
		if(!$result){ tep_db_query($result);$flag=false;}
		$flag=$flag && fnDeleteImage($pid);
		if($flag)
			echo("<span class='messageSuccess'>Image removed from the product</span><br />");
		else
			echo("<span class='messageError'>Image not removed from the product<br /></span>");
	}

	
	$flag=true;
	//products_quantity products_category products_image products_price products_date_added show_front products_weight
	$sql ="UPDATE products SET products_quantity=".$_REQUEST['product_qnty'].",products_category=".$_REQUEST['sel_cat'];
	
	//make sure products image name not to be updated if product image is not selected
	if(!empty($_FILES['product_image']['name']))
		$sql.=",products_image='".$prod_name."',products_thumb='".$prod_thumb ."'";			
	
	$sql.=" ,products_price=".$_REQUEST['product_price'].",products_date_added=now()";
	$sql.=",products_weight=".$_REQUEST['product_weight'].",products_keyword='".$_REQUEST['product_keyword']."' WHERE products_id=".$pid;
	
	$result=tep_db_query($sql,$dblink);
	if(!result){$msg=$result;$flag=false;}
	
	$sql="UPDATE products_description SET products_name='".$_REQUEST['product_name']."',products_description='".$_REQUEST['product_desc']."' WHERE products_id=".$pid;
	$result=tep_db_query($sql,$dblink);
	if(!result){$msg=$result;$flag=false;}
	if($flag) echo("<span class='messageSuccess'>Record updated successfully</span><br />");

	/* routine to upload photograph*/
	if(isset($_FILES['product_image'])&&!empty($_FILES['product_image']))
	{	
		$img_loc=fnGetImageLocation($pid);
		$img_path=$img_loc.$prod_name;
		$th_path=$img_loc.$prod_thumb;

		if($_REQUEST['sel_cat']==0)
		{	/*need to select a category*/
			echo("<span class='messageError'>Please select a category<br />Photograph not uploaded</span>");
		}
		else{
			/*if some category is selected.. make sure its folder exists.. if not make it*/
			if(!is_dir($img_loc)){
				if(!mkdir($img_loc,0777))
					echo("<span class='messageError'>Error in creating directory. <br />Please make sure write permission in the images/products directory.</span>");
			}
		}
		
		move_uploaded_file($_FILES['product_image']['tmp_name'],$img_path);
		move_uploaded_file($_FILES['product_thumb']['tmp_name'],$th_path);
		
		$flag_image=true;
		if($_FILES['product_image']['error']!=UPLOAD_ERR_OK)
			{	$flag_image=false;
				$msg.="Image not uploaded<br />";
			}
		if($_FILES['product_thumb']['error']!=UPLOAD_ERR_OK)
			{	$flag_image=false;
				$msg.="Thumb not uploaded<br />";
			}

		if($flag_image)
			echo("<span class='messageSuccess'>Images uploaded successfully</span><br />");
		else
			echo("<span class='messageError'>".$msg."</span>");	
	}
}

function fnDeleteImage($pid)
{
	$img_loc=fnGetImageLocation($pid);
	if(!empty($_REQUEST['h_product_image'])&& !empty($_REQUEST['h_product_thumb']))
	{	unlink($img_loc.$_REQUEST['h_product_image']);
		unlink($img_loc.$_REQUEST['h_product_thumb']);
		return true;
	}

}
function fnAddNewData()
{
	global $dblink;
	$sql="INSERT INTO products(products_quantity,products_category,products_image,products_thumb,products_price,products_date_added,show_front,products_weight)";
	$sql.="VALUES(0,0,'','',0,now(),0,0)";
	$result=tep_db_query($sql,$dblink);
	if(!result){echo("<span class='errorMsg'>Couldn't add new record</span>");}
	
	if(mysql_affected_rows($dblink)){
		$sql="SELECT MAX(products_id) as products_id FROM products";
		$result=tep_db_query($sql,$dblink);
		if(!$result)echo($result);
		$prod_id=tep_db_fetch_array($result);
		if(mysql_num_rows($result)>0)
		{
			$pid=$prod_id['products_id'];
			fnInsertIntoProductDescriptions($pid);
			fnUpdateData($pid);
		}
	}
}
function fnInsertIntoProductDescriptions($pid)
{
	global $dblink;
	$sql="INSERT INTO products_description(products_id,products_name) VALUES(".$pid.",'')";
	$result=tep_db_query($sql,$dblink);
	if(mysql_affected_rows($dblink)<=0)
		echo("<span class='messageError'>Could not insert records into products_description.<br />Please try again.</span>");
	
}
function fnGetImageLocation($pid)
{
	global $dblink;
	//$sql = 'SELECT b . products_name , c . categories_name FROM products a INNER JOIN products_description b ON a . products_id = b . products_id INNER JOIN categories_description c ON a . products_category = c . categories_id AND a . products_id ='.$pid;
	$sql = 'SELECT c . categories_name FROM products a INNER JOIN categories_description c ON a . products_category = c . categories_id AND a . products_id ='.$pid;
	$result=tep_db_query($sql,$dblink);
	$temp=tep_db_fetch_array($result);
	if(mysql_num_rows($result)>0)
	{
		return '../images/products/'.$temp['categories_name'].'/';
	}
}
//get product details on base of pid to edit
if(!empty($_REQUEST['pid'])&& isset($_REQUEST['pid'])){
	$pid=$_REQUEST['pid'];
	if(!empty($pid) && isset($_REQUEST['pid'])){
		if(is_numeric($pid)){
			global $dblink;
			$sql = 'SELECT a.*,b.products_name,b.products_description,c.categories_name FROM products a INNER JOIN products_description b ON a.products_id=b.products_id INNER JOIN categories_description c ON a.products_category=c.categories_id AND a.products_id='.$pid;
			$result=tep_db_query($sql,$dblink);
			$prod=tep_db_fetch_array($result);
		}
	}
}
function fnIsSelected($pid,$cid)	
{
		global $dblink;
		$sql = 'SELECT products_category FROM products WHERE products_id='.$pid;
		$result=tep_db_query($sql,$dblink);
		if(mysql_num_rows($result)>0){
			while($cat=tep_db_fetch_array($result)){
				if($cid==$cat['products_category']){
					return 'selected';
					break;
				}
			}
		}
}
?>
</head>

<body>

	<div><span id="heading">Add New Products</span></div>
	<SPAN style="font-weight:bold">Please enter the product details</SPAN>
	<span>All the fields are mandatory</span>
	<br /><br />
	<div style="float:left;width:20%;">
		<ol style="line-height:19px;">
			<li>Product Name</li>
			<li>Quantity</li>
			<li>Category</li>
			<li>Weight</li>				
			<li>Price</li>
			<li>Keywords</li>								
			<li>Image</li>
			<li>Thumbnail</li>													
			<li><br /><br /></li>
			<li>Description</li>
			<li><span id="product_thumb"><br />
				<?php
				
				$img="../images/products/".$prod['categories_name']."/".$prod['products_thumb'];
				if(is_file($img))
					echo "<img src=".$img." title=". $prod['products_thumb']." width='80' height='100'>";
				else
					echo "<img src='../images/na.gif' width='90' height='110' title='Image not available'>";
				?>
				</span>
			</li>			
		</ol>
	</div>
	<form name="frmAddUpdateProducts" method="post" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
	<div style="float:left;width:80%;border:0px solid #FF0000">
		<ol style="line-height:20px;">
				<input type="hidden" id="product_id" name="product_id" value='<?php echo($prod['products_id']);?>'/>
			<li><input type="text"  id="product_name" name="product_name" size="25" value='<?php echo($prod['products_name']); ?>'/></li>
			<li><input type="text" id="product_qnty" name="product_qnty" size="25" value='<?php echo($prod['products_quantity']);?>'/></li>
			<li>
				<select id="sel_cat" name="sel_cat" style="width:166px">
					<option selected="selected" value="0" >Please select a category</option>					
					<?php
					$sql = 'SELECT * FROM `categories_description` 	ORDER BY categories_name ASC LIMIT 0, 10 ';
					global $dblink;
					$result=tep_db_query($sql,$dblink);
					if(mysql_num_rows($result)>0)
					{
						while($cat=tep_db_fetch_array($result))
						{
							echo('<option ');
							if(!empty($_REQUEST['pid'])){print(fnIsSelected($_REQUEST['pid'],$cat['categories_id']));}
							echo(' value='.$cat['categories_id'] .'>'.$cat['categories_name'].'</option>');
						}
					}
					?>
				</select>
			</li>					
			<li><input type="text" id="product_weight" name="product_weight" size="25"  value='<?php echo($prod['products_weight']);?>'/></li>
			<li><input type="text" id="product_price" name="product_price"  size="25" value='<?php echo($prod['products_price']);?>'/></li>
			<li><input type="text" id="product_keyword" name="product_keyword" size="25" value='<?php echo($prod['products_name']);?>'/></li>
			<li>
				<input type="hidden" name="MAX_FILE_SIZE" value="2048000">
				<input type="hidden" name="h_product_image" id="h_product_image" value='<?php echo($prod['products_image']);?>' />
				<input type="hidden" name="h_product_thumb" id="h_product_thumb" value='<?php echo($prod['products_thumb']);?>'/>
				<input type="file" id="product_image" name="product_image"  size="43">
			</li>
			<li><input type="file" id="product_thumb" name="product_thumb" size="43"/><br/>>>Max size of image is 2mb >>Thumbnail size 100px*80px</li>
			<?php if(!empty($_REQUEST['pid'])){?>
			<li>
				<input type="checkbox" id="rdNoPhoto" name="rdNoPhoto"> Click here to remove existing image on update
			</li>
			<?php }?>
			
			<li><textarea id="product_desc" name="product_desc" cols="60" rows="12"><?php echo($prod['products_description']);?></textarea></li>				
			<li><input type="submit" /><input type="reset" /></li>				
		</ol>
	</div>
	</form>
</body>
</html>
<?php tep_db_close($dblink);?>