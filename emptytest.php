<?php

print("<br>empty() test<br>");	
print("When var is not defined nor initialised ");
if (empty($var)) print("var is empty");else	print("var is not empty");	print("<br>");
print("When var=' '");$var="";if (empty($var)) print("var is empty");else	print("var is not empty");	print("<br>");
print("When var=0 ");$var=0;if (empty($var))	print("var is empty");else	print("var is not empty");	print("<br>");
print("When var=null or NULL ");$var=NULL;if (empty($var))	print("var is empty");else	print("var is not empty");	print("<br>");
print("When var=ad " );$var="ad";if (empty($var))	print("var is empty");else	print("var is $var");		

/*-----------------------------------*/		
print("<br><br>isset() test<br>");	
print("When var1 is not defined nor initialised ");
if (isset($var1))print("var1 is set");else print("var1 is not set"); print("<br>");
print("When var1=' '");$var1="";if (isset($var1))	print("var1 is set");else	print("var1 is not set");	print("<br>");
print("When var1=0 ");$var1=0;if (isset($var1))	print("var1 is set");else	print("var1 is not set");	print("<br>");
print("When var1=null or NULL ");$var1=NULL;if (isset($var1))	print("var1 is set");else	print("var1 is not set");print("<br>");
print("When var1=ad " );$var1="ad";if (isset($var))	print("var1 is set. It is $var1");else	print("var1 is $var1");
?>