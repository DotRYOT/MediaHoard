<?php $PUID = $_GET['puid'];
$ImageFilePath = $_GET['filePath'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $PUID; ?></title>
  <link rel="stylesheet" href="../../css/imagePage.min.css">
</head>

<body class="imageViewerBody">
  <img class="imageViewer" src="../..<?= $ImageFilePath; ?>" alt="">
</body>

</html>