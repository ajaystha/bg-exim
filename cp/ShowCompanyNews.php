<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Showing News</title>
<?php 

	$dblink=tep_db_connect() or die('Unable to connect to database server!');
	function fnIsChecked($id)
	{
		if ($id==1) return "checked";
	}

	if($_POST){

		if(!empty($_REQUEST['delete']))
		{	
			$sql="DELETE FROM company_news WHERE news_id IN(";
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
		
		if(isset($_REQUEST['showfront']))
		{
			global $dblink;
	
			$sql='UPDATE company_news SET show_front=0';
			tep_db_query($sql,$dblink);
			
			if(isset($_REQUEST['show_front'])){
	
				$sql="UPDATE company_news SET show_front=1 WHERE news_id IN(";
				$state=$_POST['show_front'];
				if(!empty($state)){				
					foreach ($state as $statename)
						$sql1.=$statename.",";
					$sql.=substr($sql1,0,strlen($sql1)-1).")";
					$res=tep_db_query($sql,$dblink);
					if(!$res) print("<span class='messageError'>Records couldn't be updated to show in front page.<br />Please try again.</span>");
				}
			}
		}
	
		if(isset($_REQUEST['status']))
		{
			global $dblink;
	
			$sql='UPDATE company_news SET news_status=0';
			tep_db_query($sql,$dblink);
			
			if(isset($_REQUEST['news_status'])){
	
				$sql="UPDATE company_news SET news_status=1 WHERE news_id IN(";
				$state=$_REQUEST['news_status'];
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

	$sql = 'SELECT * FROM company_news ORDER BY published_date DESC';
	$result=tep_db_query($sql,$dblink);
	if(!$result){tep_db_error(result);}	
	
?>

</head>

<body>
	<div><span id="heading">Company News</span></div>
	<form method="post" name="frmCompanyNews" action="index.php?mode=6">	
	<?php 
	if(mysql_num_rows($result)>0){
		echo ("<table class='tbllisting' style='text-align:left' border=0>");
		
		echo("<tr><th>SN</th><th>Heading</th><th>Slug</th><th>Published Date</th><th>Edit</th><th>Front?</th><th>Status</th><th>Delete</th></tr>");		
		while($prod=tep_db_fetch_array($result)){		
			$css=(($var % 2)==0)?"class='even'":"class='odd'";

			echo ("<tr><td ".$css.">".++$var."</td>");
			echo ("<td ".$css.">"."<a href='index.php?mode=5&nid=".$prod['news_id']."'>".$prod['news_head']."</a></td>");
			echo ("<td ".$css.">".substr($prod['news_slug'],0,130)."</td>");
			echo ("<td ".$css.">".$prod['published_date']."</td>");

			echo("<td align='center' ".$css."><a href='index.php?mode=5&nid=".$prod['news_id']."'><img border=0 src='../images/edit.png' alt='edit'></a></td>");
			echo("<td align='center'".$css."><input id='show_front[]' name='show_front[]' type='checkbox' value=".$prod['news_id']." ".fnIsChecked($prod['show_front'])." /></td>");			
			echo("<td align='center' ".$css."><input id='news_status[]' name='news_status[]' type='checkbox' value=".$prod['news_id']." ".fnIsChecked($prod['news_status'])." /></td>");
			echo("<td align='center' ".$css."><input id='del[]' name='del[]' type='checkbox' value=".$prod['news_id']." /></td>");						
			echo ("</tr>");
		}
		echo("<tr><td colspan='5'></td><td><input type='submit' value='save' name='showfront' /><td><input type='submit' value='save' name='status' /></td><td><input type='submit' value='delete' name='delete' /></td></tr>");
		echo("</table>");			
	}
	else
		echo("<span class='messageError'>Record doesnot exist</span>");
	?>
	</form>
</body>
</html>
<?php 
tep_db_close($dblink);
?>
