<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Company News Entry / Update</title>
<?php 

$dblink=tep_db_connect() or die('Unable to connect to database server!');
if ($_POST && !empty($_REQUEST['mode'])) {
	if($_REQUEST['mode']==5) {
		if(!empty($_REQUEST['news_id']))
			fnUpdateData($_REQUEST['rsNews_id']);
		else fnAddNewData();
	}
}
	
function fnUpdateData($pid)
{
		global $dblink;
		$sql ="UPDATE company_news SET news_head='".$_REQUEST['news_head']."',news_slug='".$_REQUEST['news_slug']."',company_news='".$_REQUEST['company_news']."',last_modified=now() WHERE news_id=".$_REQUEST['news_id'];
		$result=tep_db_query($sql,$dblink);
		if(!$result) tep_db_error($result);
		
		if($result) echo("<span class='messageSuccess'>Record updated successfully</span><br />");
		if(!$result) echo("<span class='messageError'>Record not updated this time.<br />Please try again later</span><br />");		
}
function fnAddNewData()
{
		global $dblink;
		$sql="INSERT INTO company_news (news_head,news_slug,company_news,published_date) ";
		$sql.="VALUES('".$_REQUEST['news_head']."','".$_REQUEST['news_slug']."','".$_REQUEST['company_news']."',now())";
		$result=tep_db_query($sql,$dblink);
		if($result) echo("<span class='messageSuccess'>Record saved successfully</span><br />");
		if(!$result) echo("<span class='messageError'>Record not saved this time.<br />Please try again later</span><br />");		
}

if($_REQUEST['mode']==5){
	$nid=$_REQUEST['nid'];
	if(!empty($nid) && isset($_REQUEST['nid'])){
		if(is_numeric($nid)){
			global $dblink;
			$sql = 'SELECT * FROM company_news WHERE news_id='.$nid;
			$result=tep_db_query($sql,$dblink);
			$rsNews=tep_db_fetch_array($result);
		}
	}
}
function fnIsSelected($cid,$cid2)	
{if($cid==$cid2) return 'selected';}
function fnIsChecked($status)
{if ($status==1) return 'checked';}?>
</head>

<body>

	<div><span id="heading">Add New Categories</span></div>
	<SPAN style="font-weight:bold">Please enter the cateogry details</SPAN>
	<span>All the fields are mandatory</span>
	<br /><br />
	<div style="float:left;width:20%;">
		<ol style="line-height:30px;">			
			<li>News Head</li>
			<li>News Slug</li>
			<li><br /><br /><br /></li>
			<li>Company News</li>
		</ol>
</div>
	<form name="frmAddUpdateCompanyNews" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
	<div style="float:left;width:80%;border:0px solid #FF0000">
		<ol style="line-height:30px;">
			<input type="hidden" id="news_id" name="news_id" value='<?php echo($rsNews[news_id]);?>'/>
			<li><input type="text" id="news_head" name="news_head" size="68" value='<?php echo($rsNews['news_head']);?>'/></li>
			<li><textarea id="news_slug" name="news_slug" cols="50" rows="5"><?php echo($rsNews['news_slug']);?></textarea></li>
			<li><textarea id="company_news" name="company_news" cols="50" rows="10"><?php echo($rsNews['company_news']);?></textarea></li>
			<li><input type="submit" value="Save"/><input type="reset" /></li>
		</ol>
	</div>
	</form>
</body>
</html>
<?php tep_db_close($dblink);?>