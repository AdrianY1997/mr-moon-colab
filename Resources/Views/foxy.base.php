<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= constant("SITE") ?></title>

    <link rel="stylesheet" href="<?= resource("css/boostrap.min.css") ?>">
    <link rel="stylesheet" href="<?= asset("css/custom.css") ?>">

    <link rel="shortcut icon" href="<?= asset("img/favicon.png") ?>" type="image/x-icon">
    <link rel="icon" href="<?= asset("img/favicon.png") ?>" type="image/x-icon">

    <script src="<?= resource("js/fontawesome.min.js") ?>"></script>
</head>

<body>
    <?php include_once "Resources\\Views\\static\\app.header.php" ?>

    <main>
        <?php include_once "Resources\\Views\\$view.php" ?>
    </main>

    <?php include_once "Resources\\Views\\static\\app.footer.php" ?>
    <?php include_once "Resources\\Views\\static\\app.messages.php" ?>

    <script src="<?= asset("js/foxy.js") ?>"></script>
    <script src="<?= resource("js/boostrap.bundle.min.js") ?>"></script>
</body>

</html>