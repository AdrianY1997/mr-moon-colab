<?php

use App\Site\Models\Webdata;
?>
<?= Webdata::initialView() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?= isset($title) ? $title : "Mr. Moon" ?>
    </title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="57x57" href="<?= asset("icon/apple-icon-57x57.png") ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= asset("icon/apple-icon-60x60.png") ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= asset("icon/apple-icon-72x72.png") ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= asset("icon/apple-icon-76x76.png") ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= asset("icon/apple-icon-114x114.png") ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= asset("icon/apple-icon-120x120.png") ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= asset("icon/apple-icon-144x144.png") ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= asset("icon/apple-icon-152x152.png") ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= asset("icon/apple-icon-180x180.png") ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= asset("icon/android-icon-192x192.png") ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= asset("icon/favicon-32x32.png") ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= asset("icon/favicon-96x96.png") ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= asset("icon/favicon-16x16.png") ?>">
    <link rel="manifest" href="<?= asset("icon/manifest.json") ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= asset("icon/ms-icon-144x144.png") ?>">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="<?= asset("css/main.css") ?>">
    <script src="<?= resource("js/fontawesome.min.js") ?>"></script>
</head>

<body>
    <header>
        <?php include_once "App\\Site\\Views\\base\\header.php"; ?>
    </header>
    <main>
        <?php include_once "App\\Site\\Views\\" . $view . ".php"; ?>
    </main>
    <footer>
        <?php include_once "App\\Site\\Views\\base\\footer.php"; ?>
    </footer>
    <div class="app-messages">
        <?php include_once "App\\Site\\Views\\base\\messages.php"; ?>
    </div>

    <?php include_once "App/Site/Views/Base/messages.php" ?>

    <script src="<?= asset("js/main.js") ?>"></script>
</body>
</body>

</html>