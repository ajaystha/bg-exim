<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Category Entry / Update</title>
<?php 

	$dblink=tep_db_connect() or die('Unable to connect to database server!');

	if($_POST){
		if(is_numeric($_REQUEST['category_id'])){	
			if(!empty($_REQUEST['prev_category_id']))
				fnUpdateData($_REQUEST['prev_category_id']);
				else 
					fnAddNewData();	
		}
	}
	function fnGetCategoryName($cat_id)
	{
		global $dblink;
		$sql="SELECT * FROM categories_description WHERE categories_id=".$cat_id;
		$result1=tep_db_query($sql,$dblink);
		if($result1){
			if(mysql_num_rows($result1)>=0){
				$data=tep_db_fetch_array($result1);
				return $data['categories_name'];
			}
			else return '';
		}
	}
	function fnUpdateData($old_id)
	{
		if(is_numeric($_REQUEST['category_id'])){		
			//$myvar=fnGetCategoryName($_REQUEST['category_id']);		
			//if(empty($myvar)){	
				global $dblink;$flag=true;
				$sql ="UPDATE categories_description SET categories_id=".$_REQUEST['category_id'].",categories_name='".$_REQUEST['category_name']."',categories_description='".$_REQUEST['category_desc']."' WHERE categories_id=".$old_id;
				$result=tep_db_query($sql,$dblink);
				if(!result){$msg=$result;$flag=false;}
				$sql="UPDATE categories SET categories_id=".$_REQUEST['category_id'].",parent_id=".$_REQUEST['parent_cat'].",last_modified=now() WHERE categories_id=".$old_id;
				$result=tep_db_query($sql,$dblink);
				if(!result){$msg=$result;$flag=false;}
		
				if($flag) echo("<span class='messageSuccess'>Records saved successfully</span><br />");
				if(!$flag) echo("<span class='messageError'>Problem with saving the records</span><br />Please try again<br />");		
			//}
			//else
			//	echo("<span class='messageError'>Records not saved<br />Category ID already used by \"".$myvar."\"</span><br /><br />");
		}
		else
			echo("<span class='messageError'>Category id is expected to be numeric value<br />Please try again</span><br /><br />");					
	}

	function fnAddNewData()
	{		
		if(is_numeric($_REQUEST['category_id'])){
		
			$myvar=fnGetCategoryName($_REQUEST['category_id']);		
			if(empty($myvar)){
				
				global $dblink;	$flag=true;
				$sql="INSERT INTO categories_description(categories_id,categories_name,categories_description,categories_status)";
				$sql.=" VALUES(".$_REQUEST['category_id'].",'".$_REQUEST['category_name']."','".$_REQUEST['category_desc']."',0)";
				$result=tep_db_query($sql,$dblink);
				if(!result) $flag=false;
				
				$sql="INSERT INTO categories (categories_id,parent_id,date_added) VALUES(".$_REQUEST['category_id'].",".$_REQUEST['parent_cat'].",now())";
				$result=tep_db_query($sql,$dblink);
				if(!result) $flag=false;
						
				if($flag) echo("<span class='messageSuccess'>Records saved successfully</span><br />");
				if(!$flag) echo("<span class='messageError'>Problem with saving the records</span><br />Please try again<br />");
			}
			else
			echo("<span class='messageError'>Records not saved<br />Category ID already used by \"".$myvar."\"</span><br /><br />");
		}
		else
			echo("<span class='messageError'>Category id is expected to be numeric value<br />Please try again</span><br /><br />");		
	}

//get category details on base of cid to edit
	$cid=$_REQUEST['cid'];
	if(!empty($cid) && isset($_REQUEST['cid'])){
		if(is_numeric($cid)){
			global $dblink;
			$sql = 'SELECT a.categories_id,a.parent_id,b.* FROM categories a INNER JOIN categories_description b ON a.categories_id=b.categories_id  AND a.categories_id='.$cid;
			$result=tep_db_query($sql,$dblink);
			$category=tep_db_fetch_array($result);
		}
	}
function fnIsSelected($cid,$cid2)	
{
	if($cid==$cid2) return 'selected';
}
?>
</head>

<body>

	<div><span id="heading">Add New Categories</span></div>
	<SPAN style="font-weight:bold">Please enter the cateogry details</SPAN>
	<span>All the fields are mandatory</span>
	<br /><br />
	<div style="float:left;width:20%;">
		<ol style="line-height:19px;">
			
			<li>Category ID</li>
			<li>Category Name</li>
			<li>Parent Category </li>
			<li>Category Description </li>
		</ol>
</div>
	<form name="frmAddUpdateCategories" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
	<div style="float:left;width:80%;border:0px solid #FF0000">
		<ol style="line-height:20px;">
			<input type="hidden" id="prev_category_id" name="prev_category_id" size="25" value='<?php echo($category['categories_id']);?>'/>
			<li><input type="text" id="category_id" name="category_id" size="25" value='<?php echo($category['categories_id']);?>'/></li>
			<li><input type="text"  id="category_name" name="category_name" size="25" value='<?php echo($category['categories_name']); ?>'/></li>
			<li>
				<select id="parent_cat" name="parent_cat" style="width:166px">
					<option selected="selected" value="0" >Top Level</option>					
					<?php
						$sql = 'SELECT	 a.categories_id,a.categories_name FROM `categories_description` a ORDER BY categories_name ASC LIMIT 0, 10 ';
						global $dblink;
						$result=tep_db_query($sql,$dblink);
						if(mysql_num_rows($result)>0)
						{
							while($cat=tep_db_fetch_array($result))
							{
								echo('<option ');
								if(isset($_REQUEST['mode']) && $_REQUEST['mode']==10)
									print(fnIsSelected($_REQUEST['cid'],$cat['categories_id']));
								echo(' value='.$cat['categories_id'] .'>'.$cat['categories_name'].'</option>');
							}
						}
					?>
				</select>

			</li>					
			<li><textarea id="category_desc" name="category_desc" cols="50" rows="10"><?php echo($category['categories_description']);?></textarea></li>				
			<li><input type="submit" value="Save"/><input type="reset" /></li>				
		</ol>
	</div>
	</form>
</body>
</html>
<?php tep_db_close($dblink);?>