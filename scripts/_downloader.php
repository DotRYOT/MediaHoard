<?php

require "./_inc.php";

$url = $_GET['url'];
$video_id = null;
$parsed_url = parse_url($url);

// Handle normal YouTube links (e.g., https://www.youtube.com/watch?v=VIDEO_ID)
if (isset($parsed_url['query'])) {
  parse_str($parsed_url['query'], $query_params);
  if (isset($query_params['v'])) {
    $video_id = $query_params['v'];
  }
}

if (!$video_id && isset($parsed_url['host']) && isset($parsed_url['path'])) {
  if ($parsed_url['host'] === 'youtu.be') {
    $video_id = trim($parsed_url['path'], '/');
  }
}

// Output the results
if ($video_id) {
  echo "Video ID: " . htmlspecialchars($video_id);
} else {
  echo "Invalid YouTube URL.";
  $error = "Invalid YouTube URL.";
  handleError($error);
}

// Generate random filename
$randNumber = randStringGen(16, 'numbers');
$outputFileName = './temp/videos/' . $randNumber . '.mp4';

// Command to download the video (commented out for now)
$command = 'yt-dlp.exe --format "bestvideo[ext=mp4]+bestaudio[ext=m4a]" --output "' . $outputFileName . '" ' . $url;
$output = [];
$returnVar = 0;

exec($command, $output, $returnVar);

// Fetch the video title
$title = getYoutubeVideoTitleScrape($video_id);
$safeTitle = urlencode($title);

// Redirect to the download page with the sanitized title
// header('Location: ./_downloadedVideo.php/?url=' . $randNumber . '.mp4&title=' . $safeTitle);
exit();