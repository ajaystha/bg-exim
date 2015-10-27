<?php



# build an array with the subdirectories of the directory argument

function listrootDirs($rootdirpath) {
	if ($dir = @opendir($rootdirpath)) {
		$dirarray[] = NULL;
		while (($file = readdir($dir)) !== false) {
			if (is_dir($rootdirpath."/".$file) && ($file != ".") && 
			   ($file != "..")) {
				$dirarray = array_merge($dirarray,($rootdirpath."/".$file));
			}
		}
		closedir($dir);
	}
	array_shift($dirarray);
	return $dirarray;
}

# display directory list
print("collection=");
function displaydirlist($arraydata) {
	//print("\n<table cellpadding=\"3\" cellspacing=\"0\" border=\"0\">\n");
rsort($arraydata);

	foreach($arraydata as $dir){
		$count=$count+1;
		
		
		//!!!!!!!! the number 66 will change according to the length of your directory path below ($dirlist)
		$dir = substr_replace($dir,'',0,66);
		
		
		

		$nam = substr($dir,0);
		print("<a href=\"StartHere.php?imageGroup=$nam\">$nam</a><br>");
		//print("$nam<br>");
		//print("\t<tr><td width=\"30\"></td><td class=\"demi\"><a href=\"images/$dir\" target=\"$nam\">$nam</a></td></tr>\n");

	}

	//print("</table>\n");
}

# output the subdirectories as a vertical list



//!!!!!!!!!! change this to your path to the images folder for this album !!!!!!!!!!!!!!!!!!!!!
//$dirlist = listrootDirs('/usr32/home/aesper1/public_html/FlashSamples/phpPhotoAlbum/images');
$dirlist = listrootDirs('C:/Documents and Settings/user/My Documents/My Pictures');




if (count($dirlist) > 0) {
	displaydirlist($dirlist);
}
print("&Loaded=done&");

?>