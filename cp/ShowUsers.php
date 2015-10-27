<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Showing Users</title>
<?php 
	$dblink=tep_db_connect() or die('Unable to connect to database server!');
	function fnIsChecked($id)
	{
		if ($id==1) return "checked";
	}

	if($_POST){

		if(!empty($_REQUEST['delete']))
		{	
			$sql="DELETE FROM members WHERE member_id IN(";
			$state=$_POST['del'];
			if(!empty($state)){				
				foreach ($state as $statename)
					$sql1.=$statename.",";
				$sql.=substr($sql1,0,strlen($sql2)-1).")";
				global $dblink;
				$result=tep_db_query($sql,$dblink);
				if(!$result)
					print("<span class='messageError'>Records couldn't be deleted this time.<br />Please try again.</span>");
			}
		}

		if(isset($_REQUEST['status']))
		{
			global $dblink;
	
			$sql='UPDATE members SET member_status=0';
			tep_db_query($sql,$dblink);
			
			if(isset($_REQUEST['member_status'])){
	
				$sql="UPDATE members SET member_status=1 WHERE member_id IN(";
				$state=$_REQUEST['member_status'];
				if(!empty($state)){
					foreach ($state as $statename)
						$sql1.=$statename.",";
					$sql.=substr($sql1,0,strlen($sql1)-1).")";
					$res=tep_db_query($sql,$dblink);
					if(!$res) print("<span class='messageError'>Records couldn't be marked as active.<br />Please try again.</span>");
				}
			}
		}
	}

	$sql = "SELECT member_id,username,date_created,date_modified,member_status FROM members ORDER BY username ASC,date_created DESC,date_modified DESC";
	$result=tep_db_query($sql,$dblink);
	if(!$result){tep_db_error(result);}

?>
</head>

<body>
	<div><span id="heading">User Management</span></div>
	<form name="frmUserMgmt" method="post" action="index.php?mode=16">
<?php 
	if(mysql_num_rows($result)>0){
		echo ("<table class='tbllisting' border=0>");
		echo("<tr><th>SN</th><th>User name</th><th>Date Created</th><th>Last modified date</th><th>Edit</th><th>Status</th><th>Delete</th></tr>");
	
		while($member=tep_db_fetch_array($result)){
			$css=(($var % 2)==0)?" class='even'":" class='odd'";		
			echo("<tr>");
			echo ("<td".$css.">".++$var."</td>");								
			echo ("<td".$css."><a href='index.php?mode=15&mid=".$member['member_id']."'>".$member['username']."</a></td>");
			echo ("<td".$css.">".$member['date_created']."</td>");
			echo ("<td".$css.">".$member['date_modified']."</td>");
	
			echo("<td align='center' ".$css."><a href='index.php?mode=15&mid=".$member['member_id']."'><img border=0 src='../images/edit.png' alt='edit'></a></td>");
			echo("<td align='center' ".$css."><input id='member_status[]' name='member_status[]' type='checkbox' value=".$member['member_id']." ".fnIsChecked($member['member_status'])." /></td>");
			echo("<td align='center' ".$css."><input id='del[]' name='del[]' type='checkbox' value=".$member['member_id']." /></td>");						
			
			
			echo ("</tr>");
		}//while
		echo("<tr><td colspan='5'></td><td><input type='submit' value='save' name='status' /></td><td><input type='submit' value='delete' name='delete' /></td></tr>");		
		echo("</table>");
	}//if row>0
	else{
		echo("<span class='messageError'>Record doesnot exist</span>");
	}
	?>
</form>
</body>
</html>
<?php 
tep_db_close($dblink);
?>
