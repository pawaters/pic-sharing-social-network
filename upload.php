<?php

require_once('header.php');

?>

<div class="camera-container">

	<?php if(isset($_GET['success_message'])) { ?>
		<p class="mt-4 text-center alert alert-success"><?php echo $_GET['success_message']; ?> </p>
	<?php } ?>

	<?php if(isset($_GET['error_message'])) { ?>
		<p class="mt-4 text-center alert alert-danger"><?php echo $_GET['error_message']; ?> </p>
	<?php } ?>
		
	<div class="camera">
		<div class="camera-img" style="display:flex;">
			<div style="width:90%;">
				<form class="camera-form" method="POST" action="create_uploaded_post.php" enctype="multipart/form-data">
					<p class="sticker-description" style="margin-top: 30px;">1. SELECT AN IMAGE TO UPLOAD</p>
					<div class="canvas-container">
						<!-- <img id="picture"> -->
						<canvas class="d-none" width="700" height="500" id="myCanvas"></canvas>
						<input type="hidden" id="upload-file" value="" name="upload_file">
					</div>
					<input accept="image/*" type="file" class="my-input input" id="imgInp" name="image" required>
					<!-- TD: review these classes to the same in "other upload"-->
					<div class="form-group">
						<input class="form-control" type="text"  class="my-input input" name="caption" placeholder="Write a caption here" required>
					</div>
					<div class="form-group">
						<input class="form-control" type="text"  class="my-input input" name="hashtags" placeholder="add hastags here" required>
					</div>
					<div>
						<p class="sticker-description" style="margin-top: 30px;">2. BONUS: ADD A STICKER</p>
						<div class="stickers-box">
							<div class="stickers-container">
								<img style="width:100px;" class="sticker" src="assets/stickers/different.png" alt="rugby-sticker" id="sticker1">
								<img style="width:100px;" class="sticker" src="assets/stickers/football.png" alt="rugby-sticker" id="sticker2">
								<img style="width:100px;" class="sticker" src="assets/stickers/love.png" alt="rugby-sticker" id="sticker3">
								<img style="width:100px;" class="sticker" src="assets/stickers/pink.png" alt="rugby-sticker" id="sticker4">
								<img style="width:100px" class="sticker" src="assets/stickers/rugby.png" alt="rugby-sticker" id="sticker5">
							</div>
						</div>	
					</div>
					<div>
						<p class="sticker-description" style="margin-top: 30px;">3. CLICK ON PUBLISH</p>
						<button type="submit" class="upload-btn" name="upload_img_btn">Publish</button>
					</div>
				</form>
			</div>
		
		</div>
	</div>
	<div class="left-col">
		<p style="margin-top: 30px;" class="sticker-description"> Below you can check your previous creations made with uploaded images:</p>
		<?php
				
			require_once('connection.php');
			
			$user_id = $_SESSION['id'];
			$webcam = 0;

			try {
				$conn = connect_PDO();
				$stmt = $conn->prepare("SELECT * FROM posts WHERE user_id = ? AND webcam = ? ORDER BY date DESC");
				$stmt->bindParam(1, $user_id, PDO::PARAM_INT);
				$stmt->bindParam(2, $webcam, PDO::PARAM_INT);
				$stmt->execute();
				$get_posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $error) {
				echo $error->getMessage(); 
				exit;
			}
			$conn = null;

			foreach($get_posts as $post){ ?>
				<div class="post">	
					<div class="post-img">
						<img src="<?php echo "assets/img/" . $post['image']; ?>" class="post-img">
					</div>
				</div>
			<?php } ?>
			
	</div>
	<?php include_once('footer.php'); ?>
</div>

<script>
	imgInp.onchange = evt => {
		const [file] = imgInp.files;
		let canvas = document.getElementById("myCanvas");
		let ctx = canvas.getContext("2d");
		if (file) {
			picture.src = URL.createObjectURL(file);
			setTimeout(() => {
				if(picture.width < picture.height) {
					let maxHeight = 700;
					let maxWidth = 500;
					if (picture.width > maxWidth || picture.height > maxHeight) {
						let ratio = picture.width/picture.height;
						if(ratio > 1) {
								picture.width = maxWidth;
								picture.height = maxHeight/ratio;
							} else {
								picture.width = maxWidth*ratio;
								picture.height = maxHeight;
						}
					}
				} 
			}, 50);
		}
 	}

	const filter = document.querySelectorAll(".sticker");

	for(let i=0; i<filter.length; i++){
		filter[i].addEventListener("click", (e) => {
			myCanvas(e.target.id);
		})
	}

	function myCanvas(sticker) {
		let c = document.getElementById("myCanvas");
		let ctx = c.getContext("2d");
		let Selectedsticker = document.getElementById(sticker);
		switch (sticker){
			case 'sticker1':
				ctx.drawImage(Selectedsticker, 30, 40, Selectedsticker.width * 0.8, Selectedsticker.height * 0.8);
				break;
			case 'sticker2':
				ctx.drawImage(Selectedsticker, 300, 40, Selectedsticker.width * 0.8, Selectedsticker.height * 0.8);
				break;
			case 'sticker3':
				ctx.drawImage(Selectedsticker, 150, 200, Selectedsticker.width * 0.8, Selectedsticker.height * 0.8);
				break;
			case 'sticker4':
				ctx.drawImage(Selectedsticker, 150, 80, Selectedsticker.width * 0.8, Selectedsticker.height * 0.8);
				break;
			case 'sticker5':
				ctx.drawImage(Selectedsticker, 30, 200, Selectedsticker.width * 0.8, Selectedsticker.height * 0.8);
				break;
		}
		let canvasUrl = c.toDataURL();
		let finalImage = document.getElementById("upload-file");
		finalImage.value = canvasUrl;
	}

</script>
	
</body>
</html>
