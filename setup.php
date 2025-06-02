<?php

// Make sure the /video directory exists
if (!is_dir("./video")) {
  mkdir("./video");
}

// Make sure the /video/posts.json file exists
if (!file_exists("./video/posts.json")) {
  file_put_contents("./video/posts.json", json_encode([]));
}

// Copy the _videoPage.php to the video directory
if (!file_exists("./video/_video.php")) {
  copy("./scripts/_video.php", "./video/_video.php");
}

// Copy the config.json to the root directory
if (!file_exists("./config.json")) {
  copy("./scripts/config.json", "./config.json");
}

// Make sure the /scripts/temp directory exists
if (!is_dir("./scripts/temp")) {
  mkdir("./scripts/temp");
}

// Make sure the /scripts/temp/videos directory exists
if (!is_dir("./scripts/temp/videos")) {
  mkdir("./scripts/temp/videos");
}

// Copy the .htaccess file to the root directory
if (!file_exists("./.htaccess")) {
  copy("./scripts/temp/.htaccess", "./.htaccess");
}

// Copy the favicon.png file to the root directory
if (!file_exists("./favicon.png")) {
  copy("./scripts/temp/favicon.png", "./favicon.png");
}

if (isset($_GET['update'])) {
  if ($_GET['update'] == "true") {
    header("Location: ./");
    exit();
  }
}