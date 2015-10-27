<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Showing Feedback</title>
<?php 
	$dblink=tep_db_connect() or die('Unable to connect to database server!');
	function fnIsChecked($id)
	{
		if ($id==1) return "checked";
	}

	if($_POST){

		if(!empty($_REQUEST['delete']))
		{	
			$sql="DELETE FROM Feedback WHERE FeedbackID IN(";
			$state=$_POST['del'];
			if(!empty($state)){
				foreach ($state as $statename)
					$sql1.=$statename.",";
				$sql.=substr($sql1,0,strlen($sql1)-1).")";
				global $dblink;
				$result=tep_db_query($sql,$dblink);
				if(!$result)
					print("<span class='messageError'>Records couldn't be deleted this time.<br />Please try again.</span>");
			}
		}
		

		if(isset($_REQUEST['status']))
		{
			global $dblink;
	
			$sql='UPDATE feedback SET feedback_status=0';
			tep_db_query($sql,$dblink);
			
			if(isset($_REQUEST['publish'])){
	
				$sql="UPDATE feedback SET feedback_status=1 WHERE feedbackid IN(";
				$state=$_REQUEST['publish'];
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
	
	$sql = "SELECT FeedbackID,Feedback,DateTime,SenderName,SenderAddress,SenderEmail,SenderTelephone,feedback_status FROM feedback ";
	$sql.=" ORDER BY DateTime DESC,Feedback ASC,SenderAddress ASC LIMIT 0, 30 ";
	$result=tep_db_query($sql,$dblink);
	if(!$result){tep_db_error(result);}

	if(isset($_REQUEST['fid']) && !empty($_REQUEST['fid'])){
		$sql="SELECT * FROM feedback WHERE FeedbackID=".$_REQUEST['fid'];
		$result1=tep_db_query($sql,$dblink);
		if(!$result1) tep_db_error($result1);
	}
?>

</head>

<body>
	<div><span id="heading">Feedbacks</span></div>
	<form name="frmFeedback" method="post" action="index.php?mode=21">
<?php 
	if(mysql_num_rows($result)>0){
		echo ("<table class='tbllisting'>");
		echo("<tr><th>SN</th><th>Feedback By</th><th>Address</th><th>Datetime</th><th>Feedback</th><th>Edit</th><th>publish?</th><th>Delete</th></tr>");		
		while($fdb=tep_db_fetch_array($result)){
			$css=(($var % 2)==0)?" class='even'":" class='odd'";		
			echo("<tr>");
			echo ("<td".$css.">".++$var."</td>");		
			echo ("<td".$css."><a href='index.php?mode=21&fid=".$fdb['FeedbackID']."'>".$fdb['SenderName']."</a></td>");
			echo ("<td".$css.">".$fdb['SenderAddress']."</td>");
			echo ("<td".$css.">".$fdb['DateTime']."</td>");
			echo ("<td".$css.">".substr($fdb['Feedback'],0,200)."</td>");
	
			echo("<td align='center' ".$css."><a href='index.php?mode=20&fid=".$fdb['FeedbackID']."'><img border=0 src='../images/edit.png' alt='edit'></a></td>");
			echo("<td align='center' ".$css."><input id='publish[]' name='publish[]' type='checkbox' value=".$fdb['FeedbackID']." ".fnIsChecked($fdb['feedback_status'])." /></td>");
			echo("<td align='center' ".$css."><input id='del[]' name='del[]' type='checkbox' value=".$fdb['FeedbackID']." /></td>");						
			
			echo ("</tr>");
		}//while
		echo("<tr><td colspan='6'></td><td><input type='submit' value='save' name='status' /></td><td><input type='submit' value='delete' name='delete' /></td></tr>");
		echo("</table>");
	}//if row>0
	else{
		echo("<span class='messageError'>Record doesnot exist</span>");
	}
	
	if(isset($_REQUEST['fid']) && !empty($_REQUEST['fid']))
	{
		if(mysql_num_rows($result1)>0){
			while($feedback=tep_db_fetch_array($result1)){		
		?>
			<br />
			<div style="background-color:#F2F2F2;width:80%;padding:5px 10px;border:1px thin">
			
			<ol style="line-height:15px">
				<li><span class="">Name      : <?php echo($feedback['SenderName'])?></span></li>
				<li><span class="">Address   : <?php echo($feedback['SenderAddress'])?></span></li>			
				<li><span class="">Telephone : <?php echo($feedback['SenderTelephone'])?></span></li>
				<li><span class="">Email     : <?php echo($feedback['SenderEmail'])?></span></li>
				<li><span class="">DateTime  :<?php echo($feedback['DateTime'])?></span></li>
				<li><br /></li>
				<li><span class=""><?php echo($feedback['Feedback'])?></span></li>
				<li><br /></li>
			</ol>
			
			</div>
		<?php 
			}//while	
		}//if row>0
		else{
			echo("<span class='messageError'>Record doesnot exist</span>");
		}
	}
	?>
</form>
</body>
</html>
<?php 
tep_db_close($dblink);
?>
