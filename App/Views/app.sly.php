<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ isset($title) ? $title : constant('SITE') }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('icon/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('icon/favicon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/boostrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <script src="{{ asset('js/fontawesome.min.js') }}"></script>
</head>

<body>
    <header>
        @include('static.app-header'):
    </header>

    <main>
        @include($view):
    </main>

    <footer class="footer shadow">
        @include('static.app-footer'):
    </footer>

    <div id="notifications" class="container">
        @include('static.app-messages'):
    </div>

    <script src="{{ asset('js/foxy.js') }}"></script>
    <script src="{{ asset('js/boostrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/helper.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

    </script>
</body>

</html>
