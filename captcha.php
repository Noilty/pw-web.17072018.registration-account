<?php
	session_start();
	$string = "";
	for ($i = 0; $i < 7; $i++)
		$string .= chr(rand(97, 122));
	
	$_SESSION['rand_code'] = $string;

	$dir = "fonts/";

	$image = imagecreatetruecolor(104, 29);
	$black = imagecolorallocate($image, 0, 0, 0);
	$color = imagecolorallocate($image, 200, 100, 90);
	$white = imagecolorallocate($image, 255, 255, 255);

	imagefilledrectangle($image,0,0,399,99,$white);
	imagettftext ($image, 20, 0, 5, 20, $color, $dir."11144.ttf", $_SESSION['rand_code']);

	header("Content-type: image/png");
	imagepng($image);
?>