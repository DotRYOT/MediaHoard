<?php
function randStringGen($length, $type = 'normal')
{
  switch ($type) {
    case 'normal':
    default:
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
      }
      return $randomString;

    case 'numbers':
      $characters = '0123456789';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
      }
      return $randomString;

    case 'letters':
      $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
      }
      return $randomString;
  }
}
function getYoutubeVideoTitleScrape($videoId)
{
  $url = "https://www.youtube.com/watch?v={$videoId}";

  // Initialize cURL session
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

  // Execute the request and get the HTML content
  $html = curl_exec($ch);
  curl_close($ch);

  // Use a regular expression to extract the title
  if (preg_match('/<title>(.*?)<\/title>/i', $html, $matches)) {
    $title = trim($matches[1]);
    // Remove " - YouTube" suffix
    $title = str_replace(' - YouTube', '', $title);
    return $title;
  } else {
    return 'Error: Unable to retrieve video title.';
  }
}
function filter_user_input($input, $type = 'string')
{
  // Ensure input is a string
  $input = $input ?? ''; // Set to empty string if null

  // First, trim whitespace
  $input = trim($input);

  // Apply type-specific filtering
  switch ($type) {
    case 'email':
      $input = filter_var($input, FILTER_SANITIZE_EMAIL);
      if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
        return false;
      }
      break;

    case 'url':
      $input = filter_var($input, FILTER_SANITIZE_URL);
      if (!filter_var($input, FILTER_VALIDATE_URL)) {
        return false;
      }
      break;

    case 'int':
      $input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
      if (filter_var($input, FILTER_VALIDATE_INT) === false) {
        return false;
      }
      break;

    case 'float':
      $input = filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      if (filter_var($input, FILTER_VALIDATE_FLOAT) === false) {
        return false;
      }
      break;

    case 'string':
    default:
      // Remove any HTML tags
      $input = strip_tags($input);
      // Convert special characters to HTML entities
      $input = htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
      break;
  }

  // Additional security measures
  $input = str_replace(array("\r", "\n", "%0a", "%0d"), '', $input); // Remove line breaks
  $input = preg_replace('/[^\p{L}\p{N}\s\-_,\.]/u', '', $input); // Allow only letters, numbers, spaces, and some punctuation

  // Limit the length of the input (adjust as needed)
  $input = substr($input, 0, 255);

  return $input;
}
function redirectTo($url)
{
  $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domain = $_SERVER['HTTP_HOST'];
  $redirecturl = $protocol . $domain . $url;

  if ($domain == "localhost") {
    $redirecturl = $protocol . "localhost/videoArchiver/" . $url;
  }

  header("Location: $redirecturl");
  exit;
}
function filePath($url)
{
  $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domain = $_SERVER['HTTP_HOST'];
  $redirecturl = $protocol . $domain . $url;

  if ($domain == "localhost") {
    $redirecturl = $protocol . "localhost/pixlshare.cc/app" . $url;
  }

  return $redirecturl;
}
function generateErrorUrl($errorMessage)
{
  $encodedError = urlencode($errorMessage);

  $fullUrl = "?error={$encodedError}";

  return $fullUrl;
}
function generateGetUrl($Message)
{
  $encodedUrl = urlencode($Message);

  $fullUrl = "?status={$encodedUrl}";

  return $fullUrl;
}
function extractNumbersFromUrl($url)
{
  $path = parse_url($url, PHP_URL_PATH);
  preg_match('/\d+/', $path, $matches);
  return $matches[0] ?? null;
}
function handleError($message)
{
  $Error = generateErrorUrl($message);
  redirectTo("$Error");
  exit;
}
function displayError()
{
  if (isset($_GET['error'])) {
    $error = $_GET['error'];
    echo '
  <div class="errorHeader">
    <ion-icon name="help-outline"></ion-icon>
    <h2>' . $error . '</h2>
    <a href="./">
        <ion-icon name="close-circle-outline"></ion-icon>
    </a>
  </div>
';
  }
}