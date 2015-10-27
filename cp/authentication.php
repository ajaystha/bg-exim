<?php 
	session_start();
	if(isset($_SESSION['adminuser']))
		unset($_SESSION['adminuser']);		

	if($_POST)
	{
		require 'authentication.inc';
		require '../includes/configure.php';
		require '../includes/database.php';

		$dblink=tep_db_connect() or die('Unable to connect to database server!');
		
		/*
		//encryption
		$encrypt_result = $crypt->encrypt($key, $password, $pswdlen);
		$errors = $crypt->errors;		
		//decryption
		$decrypt_result = $crypt->decrypt($key, $password);
		$errors = $crypt->errors;		
		*/

		//encryption
		$crypt = new encryption_class;
		$key='bgi1021';
		$password=trim($_REQUEST['txtPassword']);
		$enc_password = $crypt->encrypt($key, $password, $pswdlen);				
		$sql="SELECT * FROM members WHERE username='".trim($_REQUEST['txtUserName'])."' AND password='".$enc_password."'";
		$result=tep_db_query($sql,$dblink);
		$authenticated=false;
		if(mysql_num_rows($result)>0) $authenticated=true;
		tep_db_close($dblink);
		if ($authenticated){
			$_SESSION['adminuser']=trim($_REQUEST['txtUserName']);
			header("Location:index.php?uid=".$_SESSION['adminuser']);
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Welcome to BG Exim Traders Control Panel</title>
<link href="../style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php require("./header.php");?>

			<div style="height:50px"></div>
			<div style="margin-left:300px">
			<div class="loginbox">
				
				<div id="heading" style="height:25px;padding:5px;padding-left:15px;background-color:#CCCCCC;text-align:left">Authentication</div>
				<br />
				
				<div style="border:0px solid;margin-left:40px;">
				
					<p align="left" style="padding:0px 5px 10px 0px ">Please enter the username and password to proceed </p>
				
						<!--left column-->
						<div style="float:left;width:50px;">
							<ol style="line-height:20px;text-align:left;">
								<li>UserName</li>
								<li>Password</li>
							</ol>
						</div>
				
						<!--right column-->
						<div style="width:200px;float:left;margin-left:20px;">
							<form name="frmLogin" method="post" action="<?php $_SERVER['PHP_SELF']?>">
							<ol style="line-height:20px;text-align:left">
								<li><input type="text" id="txtUserName" name="txtUserName" /></li>
								<li><input type="password" id="txtPassword" name="txtPassword" /></li>
								<li>
									<div class="linebreak"></div>									
									<input type="submit"  value="Login "/><input type="reset" />
									<div class="linebreak"></div>									
								</li>
							</ol>
							</form>
						</div>
				

					<?php 
							if(!$authenticated && $_POST)
								print ("<div id='status' class='messageError' style='border:0px medium;float:left;text-align:left;padding:5px;width:80%'>Invalid user name or password.<br/>Please try again</div>");
					?>

			</div>
	</div>
	</div>
	<div style="height:50px"></div>	
<?php require('../footer.php'); ?>
</body>
</html>
