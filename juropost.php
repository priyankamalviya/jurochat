<?php
session_start();
date_default_timezone_set('America/Los_Angeles');
echo "Called";
if(isset($_SESSION['name'])){
	$text=$_POST['text'];
	$file=$_POST['filename'];
	echo $file;
	//echo "Received $text";
	$fp=fopen($file,'a');
	//fwrite($fp, "<div class='msgln'>(".date("F j,Y,g:i A").") <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
	fwrite($fp, "<p>(".date("F j,Y,g:i A").") <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></p>");
    fclose($fp);
}
?>