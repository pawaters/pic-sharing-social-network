<?php include("header.php"); ?>
    
    <div class="camera-container">

        <?php if(isset($_GET['success_message'])) { ?>
            <p class="mt-4 text-center alert-success"><?php echo $_GET['success_message']; ?> </p>
        <?php } ?>

        <?php if(isset($_GET['error_message'])) { ?>
            <p class="mt-4 text-center alert-danger"><?php echo $_GET['error_message']; ?> </p>
        <?php } ?>
         
        <div class="camera">
            <div class="camera-img" style="display:flex;">
				<div style="width:90%;">
					<form style="width:95%;"  class="camera-form" method="POST" action="create_camera_post.php" enctype="multipart/form-data">
						<div>
							<p class="sticker-description">1. Choose a sticker to jazz up your awesome photo!</p>
							<div class="stickers-box">
								<div class="stickers-container">
									<img class="sticker" src="assets/stickers/different.png" alt="rugby-sticker" id="sticker1">
									<img class="sticker" src="assets/stickers/football.png" alt="rugby-sticker" id="sticker2">
									<img class="sticker" src="assets/stickers/love.png" alt="rugby-sticker" id="sticker3">
									<img class="sticker" src="assets/stickers/pink.png" alt="rugby-sticker" id="sticker4">
									<img class="sticker" src="assets/stickers/rugby.png" alt="rugby-sticker" id="sticker5">
									<img class="sticker" src="assets/stickers/vibes.png" alt="rugby-sticker" id="sticker6">
								</div>
							</div>
						</div>
						<p style="margin-top: 30px;" class="sticker-description">2. Take an awesome awesome photo!</p>
						<button class="capture-btn" id="start-camera">Start Camera</button>
						<div>
							<video class="is-hidden" id="video" width="700" height="500" autoplay></video>
						</div>
						<button class="capture-btn" id="click-photo">Capture Photo</button>
						<p style="margin-top: 30px;" class="sticker-description">The awesome photo you have taken:</p>
						<div style="position:relative;">
							<div style="position:absolute; ">
								<canvas class="is-hidden" width="700" height="500" id="canvas"></canvas>
								<input type="hidden" id="webcam-file" value="" name="webcam_file">
							</div>
							<!-- <p style="margin-top: 30px;" class="sticker-description">The stickers you have chosen:</p> -->
							<div style="position:relative; ">
								<canvas class="is-hidden" width="700" height="500" id="stickers_canvas"></canvas>
								<input type="hidden" id="sticker-canvas" value="" name="sticker-canvas">
								<input type="hidden" id="sticker1_path" value="" name="sticker1_path">
								<input type="hidden" id="sticker2_path" value="" name="sticker2_path">
								<input type="hidden" id="sticker3_path" value="" name="sticker3_path">
								<input type="hidden" id="sticker4_path" value="" name="sticker4_path">
								<input type="hidden" id="sticker5_path" value="" name="sticker5_path">
								<input type="hidden" id="sticker6_path" value="" name="sticker6_path">
							</div>
						</div>
						<div class="control">
							<input type="text" class="my-input input" name="caption" placeholder="Write a caption here" required>
						</div>
						<div class="control" >
							<input type="text" class="my-input input" name="hashtags" placeholder="Add hashtags here" required>
						</div>
						<div>
							<button type="submit" class="upload-btn" name="webcam_img_btn">Publish</button>
						</div>
					</form>
				</div>
            </div>
        </div>

    </div>

    <div class="thumbnails-box">
					<p>🌟 Your previous awesome photos 🌟</p>
						<?php
							 
							require_once('connection.php');
							
							$user_id = $_SESSION['id'];
							$webcam = 1;

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

							foreach($get_posts as $post){ 
						?>
							<img src="<?php echo "assets/img/".$post['image']; ?>" alt="user-post">
						<?php } ?>
							
				</div>
			</div>
		</div>
	</div>

	<script>	

		const filter = document.querySelectorAll(".sticker");
		let camera_button = document.querySelector("#start-camera");
		let video = document.querySelector("#video");
		let capture_button = document.querySelector("#click-photo");
		let canvas = document.querySelector("#canvas");

		let sticker1 = document.getElementById("sticker1_path");
		let sticker2 = document.getElementById("sticker2_path");
		let sticker3 = document.getElementById("sticker3_path");
		let sticker4 = document.getElementById("sticker4_path");
		let sticker5 = document.getElementById("sticker5_path");
		let sticker6 = document.getElementById("sticker6_path");

		camera_button.disabled = true;
		capture_button.disabled = true;

		for(let i=0; i<filter.length; i++){
			filter[i].addEventListener("click", (e) => {
				camera_button.disabled = false;
				capture_button.disabled = false;
				myCanvas(e.target.id);
			})
		}
		
		camera_button.addEventListener('click', async function() {
			let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
			video.classList.remove("is-hidden");
			video.srcObject = stream;
		});
		
		function myCanvas(sticker) {
			let stickers_canvas = document.getElementById("stickers_canvas");
			let stickers_ctx = stickers_canvas.getContext("2d");
			let Selectedsticker = document.getElementById(sticker);

			switch (sticker){
				case 'sticker1':
					stickers_ctx.drawImage(Selectedsticker, 30, 40, Selectedsticker.width * 0.8, Selectedsticker.height * 0.8);
					sticker1.value = "assets/stickers/different.png"
					break;
				case 'sticker2':
					stickers_ctx.drawImage(Selectedsticker, 300, 40, Selectedsticker.width * 0.8, Selectedsticker.height * 0.8);
					sticker2.value = "assets/stickers/football.png"
					break;
				case 'sticker3':
					stickers_ctx.drawImage(Selectedsticker, 150, 220, Selectedsticker.width * 0.8, Selectedsticker.height * 0.8);
					sticker3.value = "assets/stickers/love.png"
					break;
				case 'sticker4':
					stickers_ctx.drawImage(Selectedsticker, 170, 80, Selectedsticker.width * 0.8, Selectedsticker.height * 0.8);
					sticker4.value = "assets/stickers/pink.png"
					break;
				case 'sticker5':
					stickers_ctx.drawImage(Selectedsticker, 30, 200, Selectedsticker.width * 0.8, Selectedsticker.height * 0.8);
					sticker5.value = "assets/stickers/rugby.png"
					break;
				case 'sticker6':
					stickers_ctx.drawImage(Selectedsticker, 300, 200, Selectedsticker.width * 0.8, Selectedsticker.height * 0.8);
					sticker6.value = "assets/stickers/vibes.png"
					break;
			}
			let stickersUrl = stickers_canvas.toDataURL();	
			let finalStickers = document.getElementById("sticker-canvas");
			finalStickers.value = stickersUrl;		
		}

		capture_button.addEventListener('click', function() {
			let canvas = document.getElementById("canvas");
			canvas.classList.remove("is-hidden");
			stickers_canvas.classList.remove("is-hidden");
			let ctx = canvas.getContext("2d");
			ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
			let canvasUrl = canvas.toDataURL();
			let finalImage = document.getElementById("webcam-file");
			finalImage.value = canvasUrl;
		});

	</script>
    
</body>
</html>