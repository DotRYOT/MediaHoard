<?php
require_once __DIR__ . '/../_inc.php';
// Delete the temp videos
$tempVideosDir = '../temp/videos';
if (file_exists($tempVideosDir)) {
  $files = glob($tempVideosDir . '/*');
  foreach ($files as $file) {
    unlink($file);
  }
}
$success = generateMessageUrl("Cache file and temp videos deleted successfully", 'success');
header("Location: ../../settings/$success");
exit();