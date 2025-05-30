<?php

$videoUID = $_GET['id'];
$videoTime = $_GET['time'];
$videoTitle = $_GET['title'];
$videoPath = $_GET['video_path'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Video</title>
  <link rel="stylesheet" href="../css/videoPage.min.css">
</head>

<body>
  <div class="leftVideoSection">
    <div class="video-wrapper">
      <video preload="auto">
        <source src="..<?= $videoPath; ?>" type="video/mp4">
        Your browser does not support the video tag.
      </video>
      <div class="controls">
        <button id="play-pause"><ion-icon name="play"></ion-icon></button>

        <!-- Volume control group -->
        <div class="volume-control">
          <button id="volume"><ion-icon name="volume-high"></ion-icon></button>
          <div class="volume-slider">
            <input type="range" min="0" max="1" step="0.05" value="1">
          </div>
        </div>

        <div class="progress-bar"></div>
        <button id="fullscreen"><ion-icon name="expand"></ion-icon></button>
      </div>
    </div>
    <div class="videoTitle">
      <?= $videoTitle; ?>
    </div>
    <div class="timeStamp">
      <?= date('Y-m-d H:i:s', $videoTime); ?>
    </div>
  </div>
  <div class="rightVideoSection">
    
  </div>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="../scripts/videoPlayer.js"></script>
</body>

</html>