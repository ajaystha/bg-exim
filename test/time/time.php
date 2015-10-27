<?php
//
// Copyright 2001 Xavier Media Group
// http://www.xaviermedia.com/php/
//
// If you need help or have suggestions, please visit
// http://forum.xaviermedia.net/ or
// http://www.xaviermedia.com/php/time.phtml
//
  Header("Content-type: image/gif");
  $im = imagecreatefromgif("time.gif");
  $text_color = ImageColorAllocate($im, 0, 0, 0);
  if (isset($line1))
  {
     $line1 = str_replace("HH",date('H'),$line1);
     $line1 = str_replace("hh",date('h'),$line1);
     $line1 = str_replace("MM",date('i'),$line1);
     $line1 = str_replace("SS",date('s'),$line1);
     $line1 = str_replace("YY",date('y'),$line1);
     $line1 = str_replace("mm",date('m'),$line1);
     $line1 = str_replace("DD",date('d'),$line1);
     ImageString($im,2,30,4,$line1,$text_color);
  } 
  if (isset($line2))
  {
     $line2 = str_replace("HH",date('H'),$line2);
     $line2 = str_replace("hh",date('h'),$line2);
     $line2 = str_replace("MM",date('i'),$line2);
     $line2 = str_replace("SS",date('s'),$line2);
     $line2 = str_replace("YY",date('y'),$line2);
     $line2 = str_replace("mm",date('m'),$line2);
     $line2 = str_replace("DD",date('d'),$line2);
     ImageString($im,2,30,15,$line2,$text_color);
  }
  ImageGif($im);
  ImageDestroy($im);
?> 
