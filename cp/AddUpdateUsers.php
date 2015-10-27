<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Users Entry / Update</title>
<?php 

require 'authentication.inc';
$dblink=tep_db_connect() or die('Unable to connect to database server!');

if($_POST){
	if(!empty($_REQUEST['member_id']))
		fnUpdateData($_REQUEST['mid']);
	else
		fnAddNewData();
}

function fnUpdateData($old_id)
{
		
	if(is_numeric($_REQUEST['mid'])){
		if($_REQUEST['password']==$_REQUEST['repassword']){
			global $dblink;
			$crypt = new encryption_class;
			$key='bgi1021';
			$password=trim($_REQUEST['password']);
			$enc_password = $crypt->encrypt($key, $password, $pswdlen);							
			$sql ="UPDATE members SET username='".$_REQUEST['username']."',password='".$enc_password."',date_modified=now() WHERE member_id=".$_REQUEST['mid'];
			$result=tep_db_query($sql,$dblink);
			if($result) echo("<span class='messageSuccess'>Records saved successfully</span><br />");
			if(!$result) echo("<span class='messageError'>Problem with saving the records</span><br />Please try again<br />");		
		}
		else
			echo("<span class='messageError'>Confirm password doesnot match</span><br />");
	}
}

function fnAddNewData()
{
		if($_REQUEST['password']==$_REQUEST['repassword']){
			global $dblink;
			$crypt = new encryption_class;
			$key='bgi1021';
			$password=trim($_REQUEST['password']);
			$enc_password = $crypt->encrypt($key, $password, $pswdlen);							

			$sql="INSERT INTO members(username,password,date_created)";
			$sql.=" VALUES('".$_REQUEST['username']."','".$enc_password."',now())";
			$result=tep_db_query($sql,$dblink);

			if($result) echo("<span class='messageSuccess'>Records saved successfully</span><br />");
			if(!$result) echo("<span class='messageError'>Problem with saving the records</span><br />Please try again<br />");
		}
		else
			echo("<span class='messageError'>Confirm password doesnot match</span><br />");
}

//get member details on base of member_id to edit
	$m_id=trim($_REQUEST['mid']);
	if(!empty($m_id) && isset($m_id)){
		if(is_numeric($m_id)){
			global $dblink;
			$sql = 'SELECT * from members WHERE member_id='.$m_id;
			$result=tep_db_query($sql,$dblink);
			$rsMember=tep_db_fetch_array($result);
		}
	}

function fnIsSelected($cid,$cid2)	
{if($cid==$cid2) return 'selected';}
function fnIsChecked($status)
{if ($status==1) return 'checked';}?>
</head>

<body>

	<div><span id="heading">Add New Member</span></div>
	<SPAN style="font-weight:bold">Please enter the following user information</SPAN>
	<span>All the fields are mandatory</span>
	<br /><br />
	<div style="float:left;width:20%;">
		<ol style="line-height:19px;">			
			<li>User Name</li>
			<li>Password</li>
			<li>Confirm Password</li>
		</ol>
</div>
	<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
	<div style="float:left;width:80%;border:0px solid #FF0000">
		<ol style="line-height:20px;">
			<input type="hidden" id="member_id" name="member_id" size="20" value='<?php echo($rsMember['member_id']);?>'/>
			<li><input type="text" id="username" name="username" size="20" value='<?php echo($rsMember['username']);?>'/></li>
			<li><input type="password"  id="password" name="password" size="20" value=''/></li>
			<li><input type="password"  id="repassword" name="repassword" size="20" value=''/></li>			
			<li><input type="submit" value="Save"/><input type="reset" /></li>				
		</ol>
	</div>
	</form>
</body>
</html>
<?php tep_db_close($dblink);?>