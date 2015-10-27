<?
/*
Creator: Saurdo - www.saurdo.com / me@saurdo.com
example images: www.saurdo.com/images/
example files: www.saurdo.com/files/
example style: www.saurdo.com/test/examples/dirlist/
Version: 1
Date of this version: April 23rd, 2007
Copyright©: GNU General Public License 2007 Saurdo - Saurdo.com

This directory listing script is designed with expandability in mind! Don't like my styling? Scrap it and create your own! Just put "listdir('folders');", "listdir('files');" or "listdir('images');" and it will display the folders images and files of the directory the script is currently in. Styling starts on line is located in the style.css file located in the di folder.

Everything is automatic. It will create your thumbs folder for you, your htaccess file, and should start right from the get go. The only things you need to upload is this script and the di folder. You can add images of your own to the di folder if you'd like. The array that defines each file type is located on line 51

If you have comments, suggestions, ideas, problems, or questions please e-mail me at me@saurdo.com.

Have fun!
*/


////////////////////
//settings
////////////////////
	// folder in which to store your thumbnails.
	$THUMBNAIL_FOLDER = "_thumbs";
	// Image that displays next to each folder. Make it a URL.
	$folderImage = "/di/folder.png";
	// generated thumbnail width for viewing in the directory
	$THUMBNAIL_WIDTH = 200;
	// generated thumbnail height.for viewing in the directory
	$THUMBNAIL_HEIGHT = 100;
	// generated thumbnail width for linking to.
	$LARGE_THUMBNAIL_WIDTH = 600;
	// generated thumbnail height for linking to
	$LARGE_THUMBNAIL_HEIGHT = 300;
	// 0-100, higher the quality the bigger the filesize but the better it looks.
	$quality = 75;
	// 1-5
	$imageFontSize = 5;
	// Image extensions to display as images.
	$imgExt = array('jpg', 'jpeg', 'png', 'gif', 'ico', 'bmp');
	// files in which you wish to not display.
	$ignored = array(
	'index.php', 
	'Thumbs.db', 
	'.htaccess',
	'favicon.ico',
	'thumbs',
	'di');
	// filetypes!
	$filetypes = array (
				'png' => 'jpg.gif',
				'jpeg' => 'jpg.gif',
				'bmp' => 'jpg.gif',
				'jpg' => 'jpg.gif', 
				'gif' => 'gif.gif',
				'zip' => 'archive.png',
				'rar' => 'archive.png',
				'exe' => 'exe.gif',
				'setup' => 'setup.gif',
				'txt' => 'text.png',
				'htm' => 'notepad++.png',
				'html' => 'notepad++.png',
				'php' => 'notepad++.png',
				'fla' => 'fla.gif',
				'swf' => 'swf.gif',
				'flv' => 'swf.gif',
				'xls' => 'xls.gif',
				'doc' => 'doc.gif',
				'sig' => 'sig.gif',
				'fh10' => 'fh10.gif',
				'pdf' => 'pdf.gif',
				'psd' => 'psd.gif',
				'rm' => 'real.gif',
				'mp3' => 'winamp.png',
				'wav' => 'winamp.png',
				'mpg' => 'video.gif',
				'mpeg' => 'video.gif',
				'mov' => 'video2.gif',
				'avi' => 'video.gif',
				'eps' => 'eps.gif',
				'gz' => 'archive.png',
				'asc' => 'sig.gif',
			);
	
////////////////////
//end settings, if you don't know PHP and you want the script to remain working don't edit beyond this line.
////////////////////

/////
// Path to top directory
/////
$rootpath = $_SERVER['DOCUMENT_ROOT'];


/////
//get base dir
/////
$info2 = pathinfo($_SERVER['PHP_SELF']);
$split = split('/', $info2['dirname']);
$basedir = $split[count($split)-1];

$info = $info2['dirname'] == '\\' ? "" : $info2['dirname'];


$basedir = $basedir == '\\' ? '' : $basedir;
	
/////
// URL
/////
$url = 'http://'.$_SERVER['HTTP_HOST'].$info.'/';

/////
//Check if image thumbnailer is being called
thumbnailImage();
/////

////////////////////
// big list o' functions
////////////////////

function count_dir_elements($dir_path, $type = 'file') {

    $file_count = 0;

    $dir_count = 0;

    if ($dh = opendir($dir_path)) {

        $i = 0;

        while ($el = readdir($dh)) {

            $path = $dir_path.'/'.$el;

    

            if (is_dir($path) && $el != '.' && $el != '..' && !ignoredFiles($el)) {

                $dir_count++;

            } elseif (is_file($path) && !ignoredFiles($el)) {

                $file_count++;

            }

            $i++;

        }               

       closedir($dh);

    } else {

        return false;

    }

    return $type == 'file' ? $file_count : $dir_count;

}

function ignoredFiles($file){
global $ignored;
$count = 0;
	for($i=0;$i<sizeof($ignored);$i++){
		if(strtolower($file) == strtolower($ignored[$i])){
			$count += 1;
		}
	}
	if ($count > 0){
	return TRUE;}
}


////////
// Check if file is an image
////////
function isimage($file){
global $imgExt;
$count = 0;
	for($i=0;$i<sizeof($imgExt);$i++){
		if(stristr($file, ".".$imgExt[$i])){
			$count += 1;
		}
	}
	if ($count > 0){
	return TRUE;}
}
////////

////////
// Thumb Creation for unsuported image types. just displays images with the name of the file inside it. Doesn't bother caching them due to the small amount of processing power it takes.
////////
function imageCenterString( $imgw, $imgh, $image_text = '', $text_size=5 )
{
   $im = imagecreate( $imgw, $imgh );
  
   // white background and blue text
   $bg = imagecolorallocate($im, 255, 255, 255);
   $textcolor = imagecolorallocate($im, 0, 0, 0);
  
   $t_h = $t_w = $t_x = $t_y = 0;
   $base_w =9; $base_h = 16;
   $m = 0.88;
   switch ( $text_size )
   {
     case 1: $t_w = $base_w*pow(($m*.98),4);
         $t_h = $base_h*pow(($m*.98),4);
         break;
     case 2: $t_w = $base_w*pow($m,3);
         $t_h = $base_h*pow($m,3);
         break;
     case 3: $t_w = $base_w*pow($m,2);
         $t_h = $base_h*pow($m,2);
         break;
     case 4: $t_w = $base_w*$m;
         $t_h = $base_h*$m;
         break;
     case 5: $t_w = $base_w;
         $t_h = $base_h;
         break;
     default:
         if ( $text_size >= 5 ) // set to 5
         {  $t_w = $base_w; $t_h = $base_h; }
         if ( $text_size < 5 ) // set to 1
         {
           $t_w = $base_w*pow(($m*.98),4);
           $t_h = $base_h*pow(($m*.98),4);
         }
         break;
   }
  
   $text_array = array();
  
   $max = floor($imgw/$t_w);
  
   for( $i=0; strlen($image_text) > 0; $i += $max)
   {
     array_push($text_array, substr($image_text,0,$max));
     if ( strlen($image_text) >= $max )
     {  $image_text = substr($image_text,$max); }
     else
     {  $image_text = ''; }
   }
  
   $t_y = ($imgh/2) - ($t_h*count($text_array)/2);

   foreach ( $text_array as $text )
   {
     $t_x = ($imgw/2)-($t_w*strlen($text)/2);
     imagestring($im, $text_size, $t_x, $t_y,
         $text, $textcolor);
     $t_y += $t_h;
   }

   // output the image
   header("Content-type: image/gpeg");
   imagejpeg($im);
}

/////////
// Image Thumbnailer!
////////
function thumbnailImage(){
global $THUMBNAIL_FOLDER, $THUMBNAIL_WIDTH, $LARGE_THUMBNAIL_WIDTH, $THUMBNAIL_HEIGHT, $LARGE_THUMBNAIL_HEIGHT, $rootpath, $quality, $imageFontSize, $basedir, $info;

	if ( !is_dir($rootpath.'/'.$info.'/'.$THUMBNAIL_FOLDER.'/') ){
			mkdir($rootpath.'/'.$info.'/'.$THUMBNAIL_FOLDER.'/', 0777);}

		$image = $_GET['img'];
		$sizeType = $_GET['size'];
		
		if (!$image) return;
		
		if ($sizeType == 'large'){
		$THUMBNAIL_WIDTH = $LARGE_THUMBNAIL_WIDTH;
		$THUMBNAIL_HEIGHT = $LARGE_THUMBNAIL_HEIGHT;
		}
		
		
		$imagecache = $THUMBNAIL_FOLDER . "/" . md5($sizeType.$image) . ".jpg";
		
		$im = @imagecreatefromjpeg( $imagecache );
		
		if ( $im )
		{
			header("Content-type: image/jpg");
			imagejpeg($im);							
			imagedestroy($im);									
			exit();
		}
		
		$imgsize = getimagesize ( $image );
		
		// If i forgot to take this out before releasing it then feel free to delete this.
		$imgsize = basename($image) == "huge.jpg" ? "poop" : $imgsize;
		
		switch ($imgsize[2]) 
		{
	  		case 1: // GIF
	    		$im    	= imagecreatefromgif( $image );
	    		break;
	   		case 2: // JPG
	    		$im    	= imagecreatefromjpeg( $image );
	    		break;
	   		case 3: // PNG
	    		$im    	= imagecreatefrompng( $image );
	    		break;
	    	default: // UNKNOWM!
			imageCenterString( $THUMBNAIL_WIDTH, $THUMBNAIL_HEIGHT, basename($image), $imageFontSize );
				exit();
			}
		
		header("Content-type: image/jpg");

		$img_thumb = imagecreatetruecolor( $THUMBNAIL_WIDTH, $THUMBNAIL_HEIGHT );
		
		$dsth = ($THUMBNAIL_WIDTH / ImageSX($im)) * ImageSY($im);
		
		imagecopyresampled( $img_thumb, $im, 0,($THUMBNAIL_HEIGHT-$dsth)/2, 0,0, $THUMBNAIL_WIDTH, $dsth, ImageSX($im), ImageSY($im) );
		
		imagejpeg( $img_thumb );
		
		// This will fail if you haven't created and chmodded your thumbnails folder
		@imagejpeg( $img_thumb, $imagecache, $quality );
		
		imagedestroy( $img_thumb );
		imagedestroy( $im );
		exit();
		}

////////
// File Organizer
////////
function organize($haw){
	global $images, $images2, $folders, $folders2, $files, $files2, $dir, $THUMBNAIL_FOLDER, $rootpath, $basedir, $info;
	
	$dir = $_GET['dir'];
	
	// if $dir is  the  current directory make make $dir "." so opendir doesn't fail.
	$dir = $dir == "" ? "." : $dir."/";
	
	if ($dirReadHandle = @opendir($dir)) {
	
		// if $dir is "." make it blank again so it doesn't screw up links in the main directory.
		if($dir == "."){$dir = "";}
		
		// check if the  directory trying to be accessed is  the directory in which the thumbnails are stored. You would not want to view the thumbnails directory with this script because then you'd thumbnail the thumbnails  and then thumbnail the thumbnailed thumbnails and then thumbnail the thumbnailed thumbnails of the already thumbnailed thumbnails, and just make an infinite loops of thumbnailing.
		if($haw == 'check'){
			if($rootpath.'/'.$info.'/'.$dir == $rootpath.'/'.$info.'/'.$THUMBNAIL_FOLDER.'/' ){
				die('<center><h2>Accessing directory of thumbnailed files, not a good idea.</h2></center>');
			}

		// check if directory has an index and if it does don't list the directory and go to the index.
			$noIndex = 0;
			$fileCount = -2;
			while (false !== ($file = readdir($dirReadHandle))) {
			$fileCount += 1;
				if(!strstr($file, "index.") && $file != "." && $file != ".."){
				$noIndex += 1; 
				}
				else{$indexFile = $file;}
			}
			
			if ($noIndex != $fileCount && $dir != ""){
			header("location:".$indexFile."");
			die;}
		
		}
		
			// Loop through directory files time!
			while (false !== ($file = readdir($dirReadHandle))) {
		
		
			// ignore all this stuff
			if ($file != "." && $file != ".." && $rootpath.$dir.'/'.$file.'/' != $rootpath.'/'.$THUMBNAIL_FOLDER.'/' && !ignoredFiles($file)) {
					
				// organize folders!
				if ($haw == 'folders'){
					if (is_dir($dir.$file)){
						$filesAmount = count_dir_elements($dir.$file);
						$folderAmount = count_dir_elements($dir.$file, $type = 'folders');
						
						$size = ($folderAmount + $filesAmount);
						
						$time = filectime($dir.$file);
						
						if($_GET['sortby'] == "time"){
						$folders[$time."-".$file] = $file;}
						elseif($_GET['sortby'] == "size"){
						$folders[$size."-".$file] = $file;}
						else{
						$folders[]= $file;
						}
					}
				}
				
				// organize files!
				elseif ($haw == 'files'){
					if (!is_dir($dir.$file) && !isimage($file)){
						$time = filectime($dir.$file);
						$size = filesize($dir.$file);
						if($_GET['sortby'] == "time"){
						$files[$time."-".$file] = $file;}
						elseif($_GET['sortby'] == "size"){
						$files[$size."-".$file] = $file;}
						else{
						$files[]= $file;
						}
					}
				}
				
				// organize images!
				elseif ($haw == 'images'){
					if(isimage($file)){
						$time = filectime($dir.$file);
						$size = filesize($dir.$file);
						if($_GET['sortby'] == "time"){
						$images[$time."-".$file] = $file;}
						elseif($_GET['sortby'] == "size"){
						$images[$size."-".$file] = $file;}
						else{
						$images[]= $file;
						}
					}
				}
			}
		}
		
   closedir($dirReadHandle);
}
else{die('<center><h3>Cannot open directory! It might not exist or it might not have the correct chmod.</h3><center>');}
}
////////
// Directory listing
////////
function listdir($haw){
global $images, $images2, $folders, $folders2, $files, $files2, $dir, $rootpath, $THUMBNAIL_FOLDER, $folderImage, $url, $THUMBNAIL_WIDTH, $THUMBNAIL_HEIGHT, $filetypes, $info;

	// List all images!
	if($haw == 'images'){
		// organize the images first.
		//organize('images');
		
		if(isset($images)){
		
			// Organize by time/size/name!
			$dir = substr_replace($dir,"",-1);
			if(!isset($_GET['sortby']) && $_GET['d'] == "desc"){
				rsort($images, SORT_STRING);}
			elseif($_GET['sortby'] == "time" && $_GET['d'] == "desc"){
				ksort($images, SORT_NUMERIC);}
			elseif($_GET['sortby'] == "time"){
				krsort($images, SORT_NUMERIC);}
			elseif($_GET['sortby'] == "size" && $_GET['d'] == "desc"){;
				ksort($images, SORT_NUMERIC);}
			elseif($_GET['sortby'] == "size"){
				krsort($images, SORT_NUMERIC);}
			else{
				sort($images, SORT_STRING);}
				
				$dir = $dir == "" ? "" : $dir."/";
		
			// loop through the images!
			$n = 0;
			foreach ($images as $image){
				
				// if the loop just started make the images div box.
				if($n==0){echo '<div class="center"><div class="images">';}
				
				// check if if it's  an image first... again.
				if(isimage($image)){
				$imgSize = getimagesize($dir.$image);
				$filesize = filesize($dir.$image)/1024;
				$sizeSplit = split('\.', $filesize);
				$hur = substr($sizeSplit[1], 0, 2);
				$hur = $hur == "" ? ".00" : ".".$hur."";
				$filesize = $sizeSplit[0].$hur;
				
				$encoded = implode("/", array_map("rawurlencode", explode("/", $dir.$image)));
				
					echo "<div class=\"image\"><div class=\"imagebox\"><a href=".$url.$encoded."><img src=\"".$url."index.php?img=".$dir.$image."\" width=".$THUMBNAIL_WIDTH." height=".$THUMBNAIL_HEIGHT."></a><br><small>".$image."<br>".$imgSize[0]." x ".$imgSize[1]."<br>".$filesize." kbs<br><a href=\"#links\" onclick=\"makeLinks('".$url.$dir.$image."', '".$url."index.php?img=".$dir.$image."', '".$image."')\">Link to this</a></small></div></div>";}
				// uh oh
				else{
					echo "Something went way wrong!";
				}
				// close the div box if this is the end of the loop.
				if($n==(count($images)-1)){echo "</div></div>";}
				$n++;
			}
		}
	}
	
	// list all files!
	elseif($haw == 'files'){
		// organize them first
		//organize('files');
		
		// let's make sure we actually have files before we start this perade 
		if(isset($files)){
			// Organize by time/size/name!
			$dir = substr_replace($dir,"",-1);
			if(!isset($_GET['sortby']) && $_GET['d'] == "desc"){
				rsort($files, SORT_STRING);}
			elseif($_GET['sortby'] == "time" && $_GET['d'] == "desc"){
				ksort($files, SORT_NUMERIC);}
			elseif($_GET['sortby'] == "time"){
				$sortlinkstime = $url.'?dir='.$dir.'&sortby=time&d=desc';
				krsort($files, SORT_NUMERIC);}
			elseif($_GET['sortby'] == "size" && $_GET['d'] == "desc"){
				ksort($files, SORT_NUMERIC);}
			elseif($_GET['sortby'] == "size"){	
				krsort($files, SORT_NUMERIC);}
			else{
				sort($files, SORT_STRING);}
				
				$dir = $dir == "" ? "" : $dir."/";
			
			$class = "w";
		// loop through the files!
			$n=0;
			foreach ($files as $file){
				
				$icon = 'unknown.png';
				$ext = strtolower(substr($file, strrpos($file, '.')+1));
				
				if($filetypes[$ext]) {
				$icon = $filetypes[$ext];
			}
				
				// if it's the beginning of the loop make the div box.
				if($n==0){echo '
				<div class="files">
				<table class="list">
				<tr class="hed">
				<td>Files</td>
				<td class="right">Size</td>
				<td class="right">Date</td>
				</tr>';}
				$class = $class == "w" ? "b" : "w";
				
				$size = (filesize($dir.$file)) / 1024;
				$sizeSplit = split('\.', $size);
				$hur = substr($sizeSplit[1], 0, 2);
				$hur = $hur == "" ? ".00" : ".".$hur."";
				$size = $sizeSplit[0].$hur;
				
				$encoded = implode("/", array_map("rawurlencode", explode("/", $dir.$file)));
				
				$date = date("F d Y H:i:s", filectime($dir.$file));
				echo "
					<tr class=\"".$class."\">
					<td><a href=".$url.$encoded."><img src=".$url."/di/".$icon."> ".$file."</a></td>
					<td class=\"right\">".$size." kbs</td>
					<td class=\"right\">".$date."</td>
					</tr>";
				
				// if it's the end close the div box.
				if($n==(count($files)-1)){echo "</table></div>";}
				$n++;
				}
		}
	}
	
	// list folders!
	elseif($haw == 'folders'){
		if(isset($folders)){
			// organize them first
			//organize('folders');
			
			// Organize by time/size/name!
			$dir = substr_replace($dir,"",-1);
			if(!isset($_GET['sortby']) && $_GET['d'] == "desc"){
				rsort($folders, SORT_STRING);}
			elseif($_GET['sortby'] == "time" && $_GET['d'] == "desc"){
				ksort($folders, SORT_NUMERIC);}
			elseif($_GET['sortby'] == "time"){
				krsort($folders, SORT_NUMERIC);}
			elseif($_GET['sortby'] == "size" && $_GET['d'] == "desc"){
				ksort($folders, SORT_NUMERIC);}
			elseif($_GET['sortby'] == "size"){
				krsort($folders, SORT_NUMERIC);}
			else{
				sort($folders, SORT_STRING);}
				
				$dir = $dir == "" ? "" : $dir."/";
		
		$class = "w";
		// loop!
			$n=0;
			foreach($folders as $folder){
				// if it's the beginning of the loop make the div box.
				if($n==0){echo '
					<div class="folders">
					<table class="list">
					<tr class="hed">
					<td>Folders</td>
					<td class="right">Folders & Files</td>
					<td class="right">Last Modified</td>
					</tr>';}
				$class = $class == "w" ? "b" : "w";
			
				$filesAmount = count_dir_elements($dir.$folder);
				$filesAmount .= $filesAmount > 0 ? " Files" : "";
				$folderAmount = count_dir_elements($dir.$folder, $type = 'folders');
				$folderAmount .= $folderAmount > 0 ? " Folders" : "";
			
				if ($folderAmount > 0 && $filesAmount > 0){
				$size = $folderAmount." and ".$filesAmount;}
				elseif ($folderAmount > 0){
				$size = $folderAmount;}
				elseif ($filesAmount > 0){
				$size = $filesAmount;}
				else {
				$size = "empty!";}
				$encoded = implode("/", array_map("rawurlencode", explode("/", $dir.$folder)));
				
				$date = date("F d Y H:i:s", filectime($dir.$folder));
				echo "<tr class=\"".$class."\">";
				echo "<td><a href=".$url.$encoded."/><img src=".$folderImage."> ";
				echo $folder."</a></td>";
				echo "<td class=\"right\">".$size."</td>";
				echo "<td class=\"right\">".$date."</td>";
				// if it's the end of the loop close the div box.
				if($n == (count($folders)-1)){echo "</table></div>";}
				$n++;
			}
		
		}
	}
}

/////////////////////
// end of functions
/////////////////////

/////
// Echo everything
/////

	// check if the current dir is the dir of the thumbnails and check if current  dir already has an index and if it does display it instead of listing the dir.
	organize('check');
	// organize everything so we can make sure certain things exist before styling their boxes.
	organize('folders');
	organize('files');
	organize('images');
	
	// What directory am I in? (named $dir2 so it wouldn't mess with $dir.)
	$dir2 = $_GET['dir'] == '' ? '' : $_GET['dir'].'/';
	
	// Split the directories into an array!
	if ($dir2 != '' || $dir2 != '\\'){
		$dirlinks = split('/', $dir2);
		array_pop($dirlinks);
		}
		$c = $dirlinks[(count($dirlinks) - 1)];
	if(ignoredFiles($c) == true){die('<center><h1>You are restricted from viewing this page</h1><center>');}
	
	if(!file_exists($rootpath.'/'.$info.'/.htaccess')){
		$content = "Options +FollowSymlinks\r\nRewriteEngine on\r\nRewriteRule ^(.+)/$ index.php?dir=$1";
		file_put_contents('.htaccess', $content);}


	// styling!
echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>/'.$basedir.'/'.$dir2.'</title>
<link rel="stylesheet" href="'.$url.'di/style.css"  type="text/css">
<style type="text/css">
.imagebox {
width: '.$THUMBNAIL_WIDTH.'px;}

.image img {
width: '.$THUMBNAIL_WIDTH.'px;
height: '.$THUMBNAIL_HEIGHT.'px;}
</style>';?>
<!-- I do not want to deal with PHP and javascript clashes so i'll end the PHP echo right there and god fucking damn IE sucks-->
<script type="text/javascript">
if((navigator.appName.indexOf("Microsoft")>-1) || (navigator.appName.indexOf("MSIE")>-1)){
document.write( "<style type=\"text/css\">");
document.write("/* some css fixes for IE browsers */");
document.write(".sortby{float:left;}");
document.write("</style>");
}

function makeLinks(i, i2, i3) {
javascript: document.getElementById('links').setAttribute("className", "links")
javascript: document.getElementById('links').setAttribute("class", "links")
document.getElementById('linksInput').innerHTML='<div class="title">Links to '+i3+'</div><div class="input">URL of image:<br><input type="text" value=\''+i+'\'></div><div class="input">URL of small thumb:<br><input type="text" value=\''+i2+'\'></div><div class="input">URL of large thumb:<br><input type="text" value=\''+i2+'&size=large\'></div><div class="input">HTML Link:<br><input type="text" value=\'<a href="'+i+'" target="_blank">'+i3+'</a>\'></div><div class="input">Forum Link:<br><input type="text" value=\'[url='+i+']'+i3+'[/url]\'></div><div class="input">HTML - small thumb:<br><input type="text" value=\'<a href="'+i+'" target="_blank"><img src="'+i2+'"></a>\'></div><div class="input">Forum - small thumb:<br><input type="text" value=\'[url='+i+'][img]'+i2+'[/img][/url]\'></div><div class="input">HTML - large thumb:<br><input type="text" value=\'<a href="'+i+'" target="_blank"><img src="'+i2+'&size=large"></a>\'></div><div class="input">Forum - large thumb:<br><input type="text" value=\'[url='+i+'][img]'+i2+'&size=large[/img][/url]\'></div>';
}
</script>
<!-- and start it again right here -->
<?
echo '
</head>
<body>';

$dir = substr_replace($dir,"",-1);
$sortlinkname = $url.'?dir='.$dir.'&d=desc';
$sortlinkssize = $url.'?dir='.$dir.'&sortby=size';
$sortlinkstime = $url.'?dir='.$dir.'&sortby=time';
if(!isset($_GET['sortby']) && $_GET['d'] == "desc"){
	$sortlinkname = $url.$dir;}
elseif($_GET['sortby'] == "time" && $_GET['d'] == "desc"){
	$sortlinkstime = $url.'?dir='.$dir.'&sortby=time';}
elseif($_GET['sortby'] == "time"){
	$sortlinkstime = $url.'?dir='.$dir.'&sortby=time&d=desc';}
elseif($_GET['sortby'] == "size" && $_GET['d'] == "desc"){
	$sortlinkssize = $url.'?dir='.$dir.'&sortby=size';}
elseif($_GET['sortby'] == "size"){
	$sortlinkssize = $url.'?dir='.$dir.'&sortby=size&d=desc';}
	
	$dir = $dir == "" ? "" : $dir."/";

	// display the current directory.
echo '<div class="main">';
echo '<div class="currentfolder">/<a href="'.$url.'">'.$basedir.'</a>/';
if (isset($dirlinks)){
	$n=0;
	foreach($dirlinks as $i){
	$num .= $n != 0 ? $dirlinks[($n-1)].'/' : "";
	echo '<a href="'.$url.$num.$i.'">'.$i.'</a>/';
	$n++;
	}
}
echo "<div class=\"sortby\">Sort by:&nbsp;&nbsp;&nbsp;&nbsp; <a href=\"".$sortlinkname."\">Name</a> &nbsp;|&nbsp; <a href=\"".$sortlinkssize."\">Size</a> &nbsp;|&nbsp; <a href=\"".$sortlinkstime."\">Date</a> </div>";
echo '</div>';
	listdir('folders');
	listdir('files');
echo '<a name="links"></a>';
echo '<div class="" id="links"><div id="linksInput"></div><div style="clear: left;"></div></div>';
	listdir('images');
echo '<div style="clear:left;"></div></div>';
echo '<div style="margin-top: 10px; text-align: center; font-size: 10px;">Copyright &copy; 2007 <a href="http://www.saurdo.com" target="_blank">Saurdo</a></div>'
?>
</body>
</html>