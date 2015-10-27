<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Feedback Management</title>
<link href="../style.css" rel="stylesheet" type="text/css"></link>

<?php 

	$dblink=tep_db_connect() or die('Unable to connect to database server!');

	if($_POST){
		if(!empty($_REQUEST['prev_feedbackid']))
			fnUpdateData($_REQUEST['prev_feedbackid']);
		else 
			fnAddNewData();	
	}
	
	function fnUpdateData($old_id)
	{
		if(!empty($_REQUEST['txtfeedback']) &&!empty($_REQUEST['txtname']))
			{
				$sendername=$_REQUEST['txtname'];
				$senderemail=$_REQUEST['txtemail'];
				$senderaddress=$_REQUEST['txtaddress'];
				$feedback=$_REQUEST['txtfeedback'];
				$sendertelephone=$_REQUEST['txttelephone'];

				global $dblink;
				$sql ="UPDATE feedback SET feedback='".$feedback."',SenderName='".$sendername."',SenderAddress='".$senderaddress."',SenderEmail='".$senderemail."',SenderTelephone='".$sendertelephone."' WHERE FeedbackID=".$old_id;
				$result=tep_db_query($sql,$dblink);
				if($result)
					echo("<span class='messageSuccess'>Records saved successfully</span><br />");
				else
					echo("<span class='messageError'>Problem with saving the records</span><br />Please try again<br />");		
		}
		else
			echo("<span class='messageError'>Please enter some feedback and try again</span><br /><br />");					
	}

	function fnAddNewData()
	{		
		if(!empty($_REQUEST['txtfeedback']) &&!empty($_REQUEST['txtname']))
		{
			$sendername=$_REQUEST['txtname'];
			$senderemail=$_REQUEST['txtemail'];
			$senderaddress=$_REQUEST['txtaddress'];
			$feedback=$_REQUEST['txtfeedback'];
			$sendertelephone=$_REQUEST['txttelephone'];
			global $dblink;
			$sql="insert into feedback(feedback, sendername, senderaddress,senderemail,sendertelephone,datetime) values ('".$feedback."','".$sendername."','".$senderaddress."','".$senderemail."','".$sendertelephone."',now())";
			$insert_result=tep_db_query($sql,$dblink);
			if($insert_result)
				echo("<span class='messageSuccess'>Records saved successfully</span><br />");
			else
				echo("<span class='messageError'>Problem with saving the records</span><br />Please try again<br />");		

		}
	}

	//getting data
	$fid=$_REQUEST['fid'];
	if(!empty($fid) && isset($fid))
	{
		$sql = 'SELECT * FROM feedback WHERE FeedbackID='.$fid;
		global $dblink;			
		$result=tep_db_query($sql,$dblink);
		$feedback=tep_db_fetch_array($result);
	}
	
	function fnIsSelected($cid,$cid2)	
	{
		if($cid==$cid2) return 'selected';
	}
?>

</head>
<body>


	<div class="container">
	<h3 style="margin:10px 10px 5px 0px;">Feedback Form</h3>
	<p>Please enter all the details<br /><br /></p>

	<?php
		if($insert_result){
			print("<span class='messageSuccess'>");
			print("Thank You for your valuable feedback.<br/>Your feedback have been successfully saved.<br/>");
			print("</span>");
		}
		elseif(!insert_result){
			print("<span class='messageError'>");
			print("We are sorry that your feedback could not be saved into our database this time. This may be due to some technical difficulties. Please resend your feedback. <br/><strong>Thank You</strong>");
			print("</span>");
		}
	?>
	<form name="frmFeedback" action='<?php $_SERVER['PHP_SELF'] ?>' METHOD="post">
		<div class="feedback" >
			<input type="hidden" name="prev_feedbackid" id="prev_feedbackid" size=35 value='<?php echo($feedback['FeedbackID']);?>' />
			<div class="inputs">
				Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="txtname" size=35 value='<?php echo($feedback['SenderName']);?>' />
			</div>
			<div class="inputs">
				Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="txtaddress" size=35 value='<?php echo($feedback['SenderAddress']);?>'/>
			</div>
			<div class="inputs">
				Telephone&nbsp;&nbsp;&nbsp;<input type="text" size=35 name="txttelephone" value='<?php echo($feedback['SenderTelephone']);?>'/>
			</div>
			<div class="inputs">
				Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="txtemail" size=35 value='<?php echo($feedback['SenderEmail']);?>' />
				<span class="messageWarning"></span>
			</div>
			<div class="inputs">
				Feedback
				<div class="inputs" style="margin-top:-5px;">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<textarea name="txtfeedback" rows="15" cols="50"><?php echo($feedback['Feedback']);?></textarea>
				</div>
			</div>
		</div>
		<div style="height:10px"></div>
		<div>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" value="Submit" />
			<input type="reset" />
		</div>		
		<div style="height:5px"></div>		
	</form>
	</div>
</body>
</html>
<?php tep_db_close($dblink)?>