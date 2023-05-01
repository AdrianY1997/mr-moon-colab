@php
    $webdata = unserialize($_COOKIE['webdata']);
@endphp
<div>
    <div class="container header-content">
        <div>
            <div class="logo">
                <a href="{{ route(constant('HOME')) }}" class="d-flex">
                    <img width="30" height="30" src="{{ asset($webdata['webd_logo']) }}" alt="">
                    <p class="mb-1">
                        <span class="webname fs-xl">{{ $webdata['webd_name'] }}</span>
                        <span class="websub">{{ $webdata['webd_subt'] }}</span>
                    </p>
                </a>
            </div>
            <div class="def-menu">
                <a href="{{ route(constant('HOME')) }}">
                    <p class="m-0">Inicio</p>
                </a>
                <a href="{{ route('menu') }}">
                    <p class="m-0">Menu</p>
                </a>
                <a href="{{ route('reserve') }}">
                    <p class="m-0">Reservas</p>
                </a>
                <a href="{{ route('event') }}">
                    <p class="m-0">Eventos</p>
                </a>
                <a href="{{ route('galery') }}">
                    <p class="m-0">Galería</p>
                </a>
                <a href="{{ route('auth.login') }}">
                    <p class="m-0"><i class="fa-solid fa-user-circle"></i></p>
                </a>
            </div>
            <div class="mb-menu">
                <p data-group="nav" data-type="button"><i class="fa-solid fa-bars"></i></p>
                <p class="d-none" data-group="nav" data-type="button"><span><i class="fa-solid fa-times"></i></span></p>
            </div>
        </div>
        <nav class="d-none" data-group="nav">
            <a href="{{ route(constant('HOME')) }}">
                <p class="m-0">Inicio</p>
            </a>
            <a href="{{ route('menu') }}">
                <p class="m-0">Menu</p>
            </a>
            <a href="{{ route('reserve') }}">
                <p class="m-0">Reservas</p>
            </a>
            <a href="{{ route('event') }}">
                <p class="m-0">Eventos</p>
            </a>
            <a href="{{ route('galery') }}">
                <p class="m-0">Galería</p>
            </a>
            <a href="{{ route('auth.login') }}">
                <p class="m-0"><i class="fa-solid fa-user-circle"></i></p>
            </a>
        </nav>
    </div>
</div>
<!-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <div class="navbar-brand ff-edu-nsw-act-foundation">
            <a href="{{ route(constant('HOME')) }}" class="navbar-brand">
                <img src="{{ resource('img/logo.png') }}" alt="logo" height="24">
            </a>
        </div>
        <button class="navbar-toggler btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbar-menu" class="collapse navbar-collapse">
            <div class="navbar-end ms-auto">
                <div class="navbar-item">
                    <p class="control m-0">
                        <a href="https://github.com/AdrianY1997/foxy-mvc" class="btn btn-dark">
                            <span class="icon">
                                <i class="fa-brands fa-github"></i>
                            </span>
                            <span>GitHub</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</nav>
-->
