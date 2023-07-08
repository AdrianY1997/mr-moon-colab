<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ constant('SITE') }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/tailwind.compiled.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <script src="{{ asset('js/fontawesome.min.js') }}"></script>
</head>

<body>
    <header>
        @include('static.app-header')
    </header>

    <main>
        @include($view)
    </main>

    <footer class="footer">
        @include('static.app-footer')
    </footer>

    <div id="notifications" class="container">
        @include('static.app-messages')
    </div>

    <script src="{{ asset('js/foxy.js') }}"></script>
    <script src="{{ asset('js/notification.js') }}"></script>
</body>

</html>