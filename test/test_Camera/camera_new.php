<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Web app that takes pictures</title>
    <link rel="stylesheet" href="video_style.css">
</head>
<body>
<div class="layout">
  <div id="newImages"></div>
  
  <div class="row">
    <div class="cell">
      <video id="player" autoplay></video>
    </div>
    <div class="cell"></div>
      <canvas id="canvas" width="320px" height="240px"></canvas>
    </div>
  </div>
  <div class="center">
    <button class="btn btn-primary" id="capture-btn">Capture</button>
  </div>
  <div id="pick-image">
    <label>Video is not supported. Pick an Image instead</label>
    <input type="file" accept="image/*" id="image-picker">
  </div>
</div>

<script src="script.js"></script>
</body>
</html>