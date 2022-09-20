<?php include("header.php"); ?>
    
<div class="layout-video">
  <div class="row-video">
        <div class="cell-video">
            <video id="player" width="320px" height="240px" autoplay></video>
        </div>
        <div class="cell-video"></div>
            <canvas id="canvas" width="320px" height="240px"></canvas>
        </div>
  </div>
  <div class="center-video">
        <button class="video-btn video-btn-primary" id="capture-btn">Capture</button>
  </div>
  <div id="pick-image">
        <label>Video is not supported. Pick an Image instead</label>
        <input type="file" accept="image/*" id="image-picker">
  </div>
</div>

<script src="script.js"></script>


</body>
</html>