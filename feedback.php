<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Please leave your feedback</title>
<link href="style.css" rel="stylesheet" type="text/css"></link>

<SCRIPT language=JavaScript>
<!-- Hide from older browsers...
//Function to check form is filled in correctly before submitting
function CheckForm () 
{
//********** Validate First Name Field **********//

if (frmFeedback.txtname.value == "") {
alert("Please enter your \"good name\" ");
frmFeedback.txtname.focus();
return false;
}

var okChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789 '";
var xChars = frmFeedback.txtname.value;
var allChar = true;
for (i=0; i<xChars.length; i++) 
{
	ch = xChars.charAt(i);
	for (j=0; j<okChars.length; j++) 
	{
		if (ch == okChars.charAt(j)) 
			{break}
	}
	if (j == okChars.length) {
		allChar = false;
		break;
	}
}
if (!allChar) {
alert("Please use only letter, \"-\", and \"'\" characters for the \"Full Name\" field.");
frmFeedback.txtname.focus();
return false
}


//********** Validate email Field **********//

if (frmFeedback.txtemail.value == "") {
alert("Please enter an \"E-mail Address\".");
frmFeedback.txtemail.focus();
return false;
}

if ((frmFeedback.txtemail.value.length < 6) || (frmFeedback.txtemail.value.length > 40)) {
alert("Invalid!! Please enter a value with at most 40 characters for the \"E-mail Address\" field.");
frmFeedback.txtemail.focus();
return false;
}

var okChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789 @_-.";
var xChars = frmFeedback.txtemail.value;
var allChar = true;
for (i=0; i<xChars.length; i++) {
ch = xChars.charAt(i);
for (j=0; j<okChars.length; j++) {
if (ch == okChars.charAt(j)) {
break
}
}
if (j == okChars.length) {
allChar = false;
break;
}
}
if (!allChar) {
alert("Invalid Entry!! Check your email again.");
frmFeedback.txtemail.focus();
return false
}

if ((frmFeedback.txtemail.value.indexOf("@")) < 1 || 
((frmFeedback.txtemail.value.lastIndexOf("."))-(frmFeedback.txtemail.value.indexOf("@"))) < 2 || ((frmFeedback.txtemail.value.length-1)-(frmFeedback.txtemail.value.lastIndexOf(".")) > 3) ||
((frmFeedback.txtemail.value.length-1)-(frmFeedback.txtemail.value.lastIndexOf(".")) < 2))
{
alert("Invalid Entry! Check your email again.");
frmFeedback.txtemail.focus();
return false;
}

//********** Validate Comment Field **********//

if (frmFeedback.txtfeedback.value == "") {
alert("Please fill in some \"Feedbacks\" ");
frmFeedback.txtFeedback.focus();
return false;
}


return true;
}
// -->

</SCRIPT>
<?php
if(isset($_REQUEST['txtname'])&&!empty($_REQUEST['txtname'])){
	$sendername=$_REQUEST['txtname'];
	$senderemail=$_REQUEST['txtemail'];
	$senderaddress=$_REQUEST['txtaddress'];
	$feedback=$_REQUEST['txtfeedback'];
	$sendertelephone=$_REQUEST['txttelephone'];
	
	require("./includes/configure.php");
	require("./includes/database.php");

	$dblink=tep_db_connect() or die('Unable to connect to database server!');
	$sql="insert into feedback(feedback, sendername, senderaddress,senderemail,sendertelephone,datetime) values ('".$feedback."','".$sendername."','".$senderaddress."','".$senderemail."','".$sendertelephone."',now())";
	$insert_result=tep_db_query($sql,$dblink);
	if(!$insert_result){print($insert_result);}
	tep_db_close($dblink);
}

?>
</head>
<body>

<div id="wrap">
<?php require("header.php");?>

	<div class="container">
	<h3 style="margin:10px 10px 5px 0px;">Feedback Form</h3>
	<p>
		Please feel free to post any feedbacks or suggestions about the website and the company as well.<br />
		Your valuable feedback will be highly appreciated and kept confidential.</p><br/>
		<strong>Please enter all the details</strong><br /><br />

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
	<form name="frmFeedback" action="feedback.php" METHOD="post" onSubmit="return CheckForm();">
		<div class="feedback">
			<div class="inputs">
				Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="txtname" />
			</div>
			<div class="inputs">
				Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="txtaddress" />
			</div>
			<div class="inputs">
				Telephone&nbsp;&nbsp;&nbsp;<input type="text" name="txttelephone" />
			</div>
			<div class="inputs">
				Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="txtemail" />
				<span class="messageWarning"></span>
			</div>
			<div class="inputs">
				Feedback
				<div class="inputs" style="margin-top:-5px;">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<textarea name="txtfeedback" rows="10" cols="40"></textarea>
				</div>
			</div>
		</div>
		<div style="height:10px"></div>
		<div>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" value="Submit Feedback" />
			<input type="reset" />
		</div>		
		<div style="height:5px"></div>		
	</form>
	</div>
<?php require("footer.php");?>
</div>

		
</body>
</html>
