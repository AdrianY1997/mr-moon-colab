<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= isset($title) ? $title : constant('SITE') ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?= asset('icon/favicon.ico') ?>" type="image/x-icon">
    <link rel="icon" href="<?= asset('icon/favicon.ico') ?>" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= asset('css/custom.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/main.css') ?>">

    <script src="https://kit.fontawesome.com/36c66f440a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= asset('js/helper.js') ?>"></script>
</head>

<body>

    <div id="notifications" class="container">
        <?php include_once 'App/Views/static/app-messages.sly.php' ?>
    </div>

    <header>
        <?php include_once 'App/Views/static/app-header.sly.php' ?>
    </header>

    <main>
        <?php include_once 'App/Views/' . $view . '.sly.php' ?>
    </main>

    <footer class="footer shadow">
        <?php include_once 'App/Views/static/app-footer.sly.php' ?>

        <script src="<?= asset('js/foxy.js') ?>"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="<?= asset('js/main.js') ?>"></script>
        <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>
    </footer>
</body>

</html>
