<?php

use App\Models\Webdata;

Webdata::initialView()
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?= isset($title) ? $title : "Mr. Moon" ?>
    </title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="<?= asset("img/static/mr_moon_logo.png") ?>" type="image/x-icon">

    <link rel="stylesheet" href="<?= asset("css/main.css") ?>">
    <script src="<?= asset("js/pre.js") ?>"></script>
    <script src="<?= resource("js/fontawesome.min.js") ?>"></script>
</head>

<body>
    <header>
        <?php include_once "Resources/Views/base/header.php"; ?>
    </header>
    <main>
        <?php include_once "Resources/Views/" . $view . ".php"; ?>
    </main>
    <footer>
        <?php include_once "Resources/Views/base/footer.php"; ?>
    </footer>
    <div class="app-messages">
        <?php include_once "Resources/Views/base/messages.php"; ?>
    </div>

    <?php include_once "Resources/Views/Base/messages.php" ?>

    <script src="<?= asset("js/main.js") ?>"></script>
    <script src="<?= resource("js/jquery.min.js") ?>"></script>
</body>
</body>

</html>