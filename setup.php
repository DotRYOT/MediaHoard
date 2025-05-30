<?php

if (!is_dir("./video")) {
  mkdir("./video");
}

if (!file_exists("./video/posts.json")) {
  file_put_contents("./video/posts.json", json_encode([]));
}

// copy the _videoPage.php to the video directory
if (!file_exists("./video/_video.php")) {
  copy("./scripts/_video.php", "./video/_video.php");
}

// Make sure the /scripts/temp directory exists
if (!is_dir("./scripts/temp")) {
  mkdir("./scripts/temp");
}

// Make sure the /scripts/temp/videos directory exists
if (!is_dir("./scripts/temp/videos")) {
  mkdir("./scripts/temp/videos");
}

// Check to see if yt-dlp is in the root and
// move it to the right place
if (!file_exists("./scripts/yt-dlp.exe")) {
  copy("./yt-dlp.exe", "./scripts/yt-dlp.exe");
  unlink("./yt-dlp.exe");
}