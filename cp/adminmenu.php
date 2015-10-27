<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>admin menu</title>

<style type="text/css">
	a.nava{	font-weight:100;
			text-decoration:none;
		}
</style>

</head>
<body>
<br />

<ol class='menuitems'>	

	<li><a href="../index.php">Visit Website</a></li>
	<li><a href="index.php">Home</a></li>

	<li>Products
		<ol class="innermenu">
			<li><a class='nava' href="index.php?mode=1">Add New Products</a></li>
			<li><a class="nava" href="index.php?mode=2">View Products</a></li>
		</ol>
	</li>		


	<li>Company News
		<ol class="innermenu">
			<li><a class='nava' href="index.php?mode=5">Add News</a></li>
			<li><a class='nava' href="index.php?mode=6">View News</a>
		</ol>
		
	</li>		
	<li>Product Category
		<ol class="innermenu">
			<li><a class='nava' href="index.php?mode=10">Add New Category</a></li>
			<li><a class='nava' href="index.php?mode=11">View Categories</a>
		</ol>	
	</li>	
		
	<li>User Management</li>	
		<ol class="innermenu">
			<li><a class='nava' href="index.php?mode=15">Add User</a></li>
			<li><a class='nava' href="index.php?mode=16">View Users</a></li>
		</ol>
	</li>

	<li>Feedback</li>	
		<ol class="innermenu">
			<li><a class='nava' href="index.php?mode=20">Add New Feedback</a></li>
			<li><a class='nava' href="index.php?mode=21">View Feedback</a></li>
		</ol>
	</li>
	
	<li><a class='nava' href="index.php?mode=25">Edit Contact Address</a></li>
	
	<li><a href="authentication.php">Log Out</a></li>

</ol>

<div style="height:160px"></div>
</body>
</html>
