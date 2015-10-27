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