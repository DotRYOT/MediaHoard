<?php
require_once '../version.php';
require_once '../scripts/_inc.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings</title>
  <link rel="shortcut icon" href="./favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="./css/index.min.css">
  <script type="module" src="https://cdn.jsdelivr.net/npm/ldrs/dist/auto/zoomies.js"></script>
</head>

<body>
  <?php
  displayMessage();
  ?>
  <nav>
    <div class="navLeft">
      <h3>Off-Platform Video Player <span><?= $version; ?></span></h3>
    </div>
    <div class="navRight">
      <div class="videoNav">
        <div class="hLine"></div>
        <button type="button" onclick="window.location.href='../'">
          <ion-icon name="home-outline"></ion-icon>
        </button>
        <button type="button" onclick="window.location.href='./'">
          <ion-icon name="settings-outline"></ion-icon>
        </button>
        <div class="hLine"></div>
      </div>
    </div>
  </nav>

  <div class="settingsUpdateSection">
    <h3>Update System</h3>
    <p  class="version">Current Version: <?= $version ?></p>
    <button type="button" onclick="window.location.href='../scripts/updates/_update.php'">
      <ion-icon name="cloud-download-outline"></ion-icon>
      <p>Check for Updates</p>
    </button>
  </div>


  <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" crossorigin></script>
</body>

</html>