<?php
require_once './version.php';
if (!is_dir("./video") || !file_exists("./video/posts.json") || !file_exists("./video/_video.php") || !is_dir("./scripts/temp/videos")) {
  require_once './setup.php';
  echo "Setup complete! Please refresh the page.";
  exit();
}
require_once './scripts/_inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="shortcut icon" href="./favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="./css/index.min.css">
  <script type="module" src="https://cdn.jsdelivr.net/npm/ldrs/dist/auto/zoomies.js"></script>
</head>

<body>
  <?php
  displayMessage();

  // Check to see if the user wants to download yt-dlp automatically
  if (!file_exists("./scripts/yt-dlp.exe")) {
    ?>
    <div class="updateAlert">
      <ion-icon name="help-outline" title="Update a program"></ion-icon>
      <h2>Do you want to update/install YT-DLP?</h2>
      <div class="answer">
        <a href="./scripts/updates/_updateYTDLP.php">
          <ion-icon name="checkmark-outline"></ion-icon>
        </a>
        <a href="./">
          <ion-icon name="close-circle-outline"></ion-icon>
        </a>
      </div>
    </div>
    <?php
  }
  ?>
  <nav>
    <div class="navLeft">
      <h3>Off-Platform Video Player <span><?= $version; ?></span></h3>
    </div>
    <div class="navRight">
      <div class="videoPostForm">
        <form action="./scripts/_downloader.php" method="get">
          <div class="hLine"></div>
          <div id="formSwap">
            <div id="spinner" style="display: none;">
              <l-zoomies size="150" stroke="5" bg-opacity="0.1" speed="1.4" color="#ff4500"></l-zoomies>
            </div>
            <div id="form">
              <input type="text" name="url" placeholder="YouTube URL" required>
              <button type="submit" onclick="toggleSpinner()">Download</button>
            </div>
          </div>
          <div class="hLine"></div>
          <button type="button" onclick="togglePageFiltertab()">
            <ion-icon name="filter-outline"></ion-icon>
          </button>
          <button type="button">
            <ion-icon name="settings-outline"></ion-icon>
          </button>
          <div class="hLine"></div>
        </form>
      </div>
    </div>
  </nav>
  <div class="pageFiltertab" style="display: none;">
    <div class="filterTab">
      <button>All</button>
      <button>Random</button>
      <button>Newest</button>
      <button>Oldest</button>
    </div>
  </div>
  <div class="PostLoadedArea"></div>

  <script>
    function toggleSpinner() {
      const spinner = document.querySelector('#spinner');
      const form = document.querySelector('#form');
      spinner.style.display = spinner.style.display === 'none' ? 'flex' : 'none';
      form.style.display = form.style.display === 'none' ? 'flex' : 'none';
    }

    function togglePageFiltertab() {
      const pageFiltertab = document.querySelector('.pageFiltertab');
      pageFiltertab.style.display = pageFiltertab.style.display === 'none' ? 'block' : 'none';
    }

    // Helper to decode HTML entities (e.g., &quot; → ")
    function decodeHTMLEntities(text) {
      const textArea = document.createElement('textarea');
      textArea.innerHTML = text;
      return textArea.value;
    }

    function createPostCard(post) {
      if (!post || !post.video_path || !post.title) return '';

      const decodedTitle = decodeHTMLEntities(post.title);
      const thumbnailPath = post.thumbnail_path;
      const videoUID = post.PUID;
      const date = new Date(post.Time * 1000).toLocaleDateString();

      return `
    <div class="post-card">
      <a href="./video/_video.php?id=${videoUID}&time=${post.Time}&title=${post.title}&video_path=${post.video_path}&thumbnail_path=${post.thumbnail_path}" class="post-link">
        <img src=".${thumbnailPath}" alt="${decodedTitle} thumbnail" class="post-thumbnail">
        <h3 class="post-title">${decodedTitle}</h3>
      </a>
      <p class="post-date">Posted: ${date}</p>
    </div>
  `;
    }

    function loadPosts() {
      fetch('./video/posts.json')
        .then(response => {
          if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
          return response.json();
        })
        .then(data => {
          const container = document.querySelector('.PostLoadedArea');
          if (!container) return;

          if (!Array.isArray(data)) {
            container.innerHTML = `<div class="noPosts">Invalid data format.</div>`;
            return;
          }

          if (data.length === 0) {
            container.innerHTML = `<div class="noPosts">No posts available.</div>`;
            return;
          }

          container.innerHTML = data.map(post => createPostCard(post)).join('');
        })
        .catch(error => {
          console.error("Fetch error:", error.message);
          const container = document.querySelector('.PostLoadedArea');
          if (container) {
            container.innerHTML = `<div class="noPosts">Error loading posts. Please try again later.</div>`;
          }
        });
    }

    document.addEventListener('DOMContentLoaded', loadPosts);
  </script>

  <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" crossorigin></script>
</body>

</html>