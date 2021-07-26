<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?= public_asset('favicon.ico') ?>">
  <title>404 Not Found</title>
  <link rel="stylesheet" href="<?= public_asset('css/style.css') ?>">
</head>
<body>
  <div class="simple-container">
    <img
      class="simple-img"
      src="<?= public_asset('img/404-Page-Not-Found-Monochromatic.svg') ?>" 
      alt="Error Page Not Found"
    >
    <ul class="simple-nav">
      <li><a href="<?= base_url() ?>">↩ Back to home</a></li>
    </ul>
  </div>
</body>
</html>