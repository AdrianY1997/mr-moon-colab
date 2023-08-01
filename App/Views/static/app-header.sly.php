@php
$webdata = unserialize($_COOKIE['webdata']);
@endphp
<div>
    <div class="container header-content">
        <div>
            <div class="logo">
                <a href="{{ route(constant('HOME')) }}" class="d-flex">
                    <img width="30" height="30" src="{{ asset($webdata->webd_logo) }}" alt="">
                    <p class="mb-1">
                        <span class="webname fs-xl">{{ $webdata->webd_name }}</span>
                        <span class="websub">{{ $webdata->webd_subt }}</span>
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
                @if(!Session::checkSession()):
                <a href="{{ route('auth.login') }}">
                    <p class="m-0"><i class="fa-solid fa-user-circle"></i></p>
                </a>
                @else
                    <a class="px-1" href="{{ route('profile.show') }}">
                        <p class="m-0"><i class="fa-solid fa-user-circle"></i></p>
                    </a>
                    @if(Privileges::check(Privileges::Admin->get())):
                    <a class="px-1" href="{{ route('dash.home') }}">
                        <p class="m-0"><i class="fa-solid fa-gauge"></i></p>
                    </a>
                    @endif
                @endif
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
            @if(!Session::checkSession()):
            <a href="{{ route('auth.login') }}">
                <p class="m-0"><i class="fa-solid fa-user-circle"></i></p>
            </a>
            @else
                <a class="px-1" href="{{ route('profile.show') }}">
                    <p class="m-0"><i class="fa-solid fa-user-circle"></i></p>
                </a>
                @if(Privileges::check(Privileges::Admin->get())):
                <a class="px-1" href="{{ route('dash.home') }}">
                    <p class="m-0"><i class="fa-solid fa-gauge"></i></p>
                </a>
                @endif
            @endif
        </nav>
    </div>
</div>
