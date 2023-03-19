<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= constant("SITE") ?></title>

    <link rel="stylesheet" href="<?= resource("css/bulma.min.css") ?>">
    <link rel="stylesheet" href="<?= resource("css/custom.css") ?>">

    <link rel="shortcut icon" href="<?= asset("img/favicon.png") ?>" type="image/x-icon">
    <link rel="icon" href="<?= asset("img/favicon.png") ?>" type="image/x-icon">

    <script src="<?= resource("js/fontawesome.min.js") ?>"></script>
</head>

<body>
    <?php include_once "App\\Site\\Views\\static\\app.header.php" ?>

    <main>
        <?php include_once "App\\Site\\Views\\$view.php" ?>
    </main>

    <?php include_once "App\\Site\\Views\\static\\app.footer.php" ?>

    <script src="<?= asset("js/foxy.js") ?>"></script>
</body>

</html>