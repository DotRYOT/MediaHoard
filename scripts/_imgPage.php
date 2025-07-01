<?php
$PUID = $_GET['puid'];
$ImageFilePath = $_GET['filePath'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $PUID; ?></title>
  <link rel="stylesheet" href="../../css/imagePage.min.css">
  <link rel="shortcut icon" href="../../favicon.png" type="image/x-icon">
</head>

<body class="imageViewerBody">
  <div class="settingsMenu" style="display: none;">
    <div class="settingsMenuItem">
      <div class="settingsMenuContainer">
        <h3>Settings</h3>
        <button class="deleteImageButton">
          <ion-icon name="trash-outline"></ion-icon>
          <p>Delete</p>
        </button>
        <button class="deleteImageButton">
          <ion-icon name="trash-outline"></ion-icon>
          <p>Delete</p>
        </button>
        <button class="deleteImageButton">
          <ion-icon name="trash-outline"></ion-icon>
          <p>Delete</p>
        </button>
        <button class="deleteImageButton">
          <ion-icon name="trash-outline"></ion-icon>
          <p>Delete</p>
        </button>
      </div>
    </div>
  </div>
  <div class="settingsButton">
    <button type="button" onclick="toggleSettingsMenu()">
      <ion-icon name="ellipsis-vertical-outline"></ion-icon>
    </button>
  </div>
  <img class="imageViewer" src="../..<?= $ImageFilePath; ?>" alt="">
  <script>
    document.querySelector('.imageViewer').addEventListener('click', function () {
      this.classList.toggle('zoomed');
    });

    function toggleSettingsMenu() {
      document.querySelector('.settingsMenu').style.display = document.querySelector('.settingsMenu').style.display === 'flex' ? 'none' : 'flex';
    }
  </script>
  <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" crossorigin></script>
</body>

</html>