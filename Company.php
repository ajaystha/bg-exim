<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>About our Company</title>
<link href="style.css" rel="stylesheet" type="text/css"></link>

</head>
<body>

<div id="wrap">

	<?php require("header.php");
		
		switch($_REQUEST['id'])
		{
			case 4: $strTitle="Location Map";
					break;
			case 2: $strTitle="Show Room";	
					break;
			case 3: $strTitle="Workshop";
					break;
			default: $strTitle="Company Profile";
		}
	?>
	<div class="container">
	
	<h3 style="margin:10px 10px 5px 0px;"><?php echo($strTitle); ?></h3>
	<?php if(isset($_REQUEST['id'])&&!empty($_REQUEST['id'])){?>

		<?php if(trim($_REQUEST['id'])==4){?>
			<p>Below is the company location map of our company. We are situated near Thamel. <br />You are always welcome at our company</p>
			<div><br /><img src="images/Location map.jpg" width="700px" align="location map" border=1 alt="location map"/></div>
			<br />
		<?php }
			if(trim($_REQUEST['id'])==1){
				require("company_profile.php");	
			}
			if(trim($_REQUEST['id'])==3){
				require("company_profile.php");	
			}
			if(trim($_REQUEST['id'])==2){
				require("company_profile.php");	
			}
	}

echo("</div>");
require("footer.php");?>
</div>

		
</body>
</html>
