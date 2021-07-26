<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple MVC</title>
    <link rel="stylesheet" href="<?= public_asset('css/style.css') ?>">
</head>
<body>
    <div class="simple-container">
        <h1 class="logo">Simple MVC</h1>
        <p>Simple application framework for PHP by Rizky Alam</p>
        <p>Version 1.0.0</p>
        <ul class="simple-nav">
            <li><a href="https://github.com/rizkyalam/simplemvc">Github</a></li>
            <li><a href="<?= base_url('/foo/test') ?>">Dynamic Route</a></li>
        </ul>
    </div>
    <script src="<?= public_asset('js/script.js') ?>"></script>
</body>
</html>