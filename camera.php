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
							<p class="sticker-description">1. First, Click on one or more stickers (Do it first, or next button won't be clickable!)</p>
							<div class="stickers-box">
								<div class="stickers-container">
									<img style="width:100px;" class="sticker" src="assets/stickers/different.png" alt="rugby-sticker" id="sticker1">
									<img style="width:100px;" class="sticker" src="assets/stickers/football.png" alt="rugby-sticker" id="sticker2">
									<img style="width:100px;" class="sticker" src="assets/stickers/love.png" alt="rugby-sticker" id="sticker3">
									<img style="width:100px;" class="sticker" src="assets/stickers/pink.png" alt="rugby-sticker" id="sticker4">
									<img style="width:100px;" class="sticker" src="assets/stickers/rugby.png" alt="rugby-sticker" id="sticker5">
								</div>
							</div>
						</div>
						<p class="sticker-description">2. Start your webcam</p>
						<button class="capture-btn" id="start-camera">Start Camera</button>

						<a href="upload.php">(or follow this link to upload an image instead)</a>

						<!-- 2. The video stream -->
						<div>
							<video class="is-hidden" id="video" width="700" height="500" autoplay></video>
						</div>
						<p style="margin-top: 30px;" class="sticker-description">3. Take your photo</p>
						<button class="capture-btn" id="click-photo">Capture Photo</button>
						<p style="margin-top: 30px;" class="sticker-description">4. Check below the current state of the image with sticker(s):</p>
						<!-- Both canvas overlap: webcam canvas and sticker canvas -->
						<div style="position:relative;">
							<!-- webcam canvas -->
							<div style="position:absolute; ">
								<canvas class="is-hidden" width="700" height="500" id="canvas"></canvas>
								<input type="hidden" id="webcam-file" value="" name="webcam_file">
							</div>
							<!-- sticker canvas -->
							<div style="position:relative; ">
								<canvas class="is-hidden" width="700" height="500" id="stickers_canvas"></canvas>
								<input type="hidden" id="sticker-canvas" value="" name="sticker-canvas">
								<input type="hidden" id="sticker1_path" value="" name="sticker1_path">
								<input type="hidden" id="sticker2_path" value="" name="sticker2_path">
								<input type="hidden" id="sticker3_path" value="" name="sticker3_path">
								<input type="hidden" id="sticker4_path" value="" name="sticker4_path">
								<input type="hidden" id="sticker5_path" value="" name="sticker5_path">
							</div>
						</div>
						<p class="sticker-description">5. Add a caption and hashtag, then hit "publish"</p>
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
		<div class="thumbnails-box">
			<p style="margin-top: 30px;" class="sticker-description"> Below you can check your previous creations:</p>
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
		<?php include_once('footer.php'); ?>
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

		camera_button.disabled = true;
		capture_button.disabled = true;

		//when clicking on a sticker, activates button, draws sticker on sticker canvas
		for(let i=0; i<filter.length; i++){
			filter[i].addEventListener("click", (e) => {
				event.preventDefault();
				camera_button.disabled = false;
				capture_button.disabled = false;
				// Gets the id of the element that triggered the event
				myCanvas(e.target.id);
			})
		}
		
		//if does not work --> upload option
		camera_button.addEventListener('click', async function() {
			event.preventDefault();
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
			}
			let stickersUrl = stickers_canvas.toDataURL();	
			let finalStickers = document.getElementById("sticker-canvas");
			finalStickers.value = stickersUrl;		
		}

		capture_button.addEventListener('click', function() {
			event.preventDefault();
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