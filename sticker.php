<?php
	function stamp_to_img($img)
	{
        //returns an image object (GDImage instance)
		$stamp = imagecreatefrompng('assets/img/hellocroissant.png');

		$margin_r = 10;
		$margin_b = 10;
	
		$sx = imagesx($stamp); //returns image width
		$sy = imagesy($stamp); //returns image height
	
		//both $img and $stamp have to be GDimage instances. arguments:
		// 1) destination image link
		// 2) source image link
		// 3) x-coord for dest.
		// 4) y-coord for dest.
		// 5) x-coord for src.
		// 6) y-coord for src.
		// 7) src width
		// 8) src height

		imagecopy($img, $stamp, imagesx($img) - $sx - $margin_r, imagesy($img) - $sy - $margin_b, 0, 0, imagesx($stamp), imagesy($stamp));
		header('Content-type: image/png');
		imagepng($img);
		imagedestroy($img);
    }

	/* $img = imagecreatefrompng('assets/img/rugbykids.png'); */
	/* $new_img = stamp_to_img($img); */

	// echo $new_img;
?>
