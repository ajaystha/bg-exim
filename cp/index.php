<?php	
	session_start();
	//if(!isset($_SESSION['adminuser']))
	//	header("Location:authentication.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BG Exim Traders Admin Module</title>
<link href="../style.css" type="text/css" rel="stylesheet" />
<style type="text/css">
	.leftcol{float:left;width:15%;display:block;border-right:1px solid;margin-left:10px}
	.rightcol{float:left;width:80%;display:block;border:0px solid;margin-left:20px;}
</style>
</head>

<body>
	
	<?php 
		require("../includes/configure.php");
		require("../includes/database.php");
		require("./header.php")
	?>
	<div class="leftcol">
		<?php require("./adminmenu.php")?>
	</div>
	<div class="rightcol">
	<?php 
		switch($_REQUEST['mode']){
			case 1:	require("./AddUpdateProducts.php");
					break;
			case 2: require("./ShowProducts.php");
					break;
			case 5: require("./AddUpdateCompanyNews.php");
					break;
			case 6: require("./ShowCompanyNews.php");
					break;					
			case 10:require("./AddUpdateCategories.php");
					break;					
			case 11:require("./ShowCategories.php");
					break;					
			case 15:require("./AddUpdateUsers.php");
					break;																			
			case 16:require("./ShowUsers.php");
					break;										
			case 20:require("./AddUpdateFeedback.php");
					break;
			case 21:require("./ShowFeedback.php");
					break;					
			case 25:require("./ShowContacts.php");
					break;					
			default:require("./welcome.php");	
		}
	?>
	</div>
	
	<?php require('./footer.php'); ?>
	
</body>
</html>
