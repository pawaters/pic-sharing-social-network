<?php
	function stamp_to_img($img)
	{
        $stamp = imagecreatefrompng('assets/img/croissant.png');

		$margin_r = 10;
		$margin_b = 10;
	
		$sx = imagesx($stamp);
		$sy = imagesy($stamp);
	
		imagecopy($img, $stamp, imagesx($img) - $sx - $margin_r, imagesy($img) - $sy - $margin_b, 0, 0, imagesx($stamp), imagesy($stamp));
		header('Content-type: image/png');
		imagepng($img);
		imagedestroy($img);
    }

	//steps:
	// 1) research how to display an img on website
	// 2) add this to display
	// 3) test
	// 4) make web camp work

?>