<div class="container">
    <div class="visible-sect">
        <span data-function="toggle-footer"><i class="fa-solid fa-caret-up"></i></span>
        <p class="m-0">Síguenos en nuestras redes sociales: </p>
        <p class="m-0">
            <span>
                <a target="_blank" href="{{ $webdata->webd_fblink }}">
                    <i class="fa-brands fa-facebook"></i>
                </a>
            </span>
            <span>
                <a target="_blank" href="{{ $webdata->webd_twlink }}">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
            </span>
            <span>
                <a target="_blank" href="{{ $webdata->webd_iglink }}">
                    <i class="fa-brands fa-instagram"></i>
                </a>
            </span>
            <span>
                <a target="_blank" href="{{ $webdata->webd_ytlink }}">
                    <i class="fa-brands fa-youtube"></i>
                </a>
            </span>
        </p>
    </div>
    <div class="complete-footer hide">
        <hr>
        <div>
            <h1>{{ $webdata->webd_name }} {{ $webdata->webd_subt }}</h1>
            <p class="m-0">Mision: {{$webdata->webd_m}}</p>
            <p class="m-0">Vision:  {{$webdata->webd_v}}</p>
        </div>
        <hr>
        <div>
            <h1>Menu</h1>
            <a href="{{ route('menu') }}">
                <p class="m-0">Principal</p>
            </a>
            <a href="{{ route('menu') }}">
                <p class="m-0">Bebidas</p>
            </a>
            <a href="{{ route('menu') }}">
                <p class="m-0">Comidas</p>
            </a>
        </div>
        <hr>
        <div>
            <h1>Link</h1>
            <a href="{{ route(constant('HOME')) }}">
                <p class="m-0">Inicio</p>
            </a>
            <a href="{{ route('event') }}">
                <p class="m-0">Eventos</p>
            </a>
            <a href="{{ route('galery') }}">
                <p class="m-0">Galería</p>
            </a>
            <a href="{{ route('auth.login') }}">
                <p class="m-0">Ingreso</p>
            </a>
        </div>
        <hr>
        <div>
            <h1>Contacto</h1>
            <a href="#">
                <p class="m-0">{{ $webdata->webd_city }}</p>
            </a>
            <a href="mailto:{{ $webdata->webd_email }}">
                <p class="m-0">{{ $webdata->webd_email }}</p>
            </a>
            <a href="">
                <p class="m-0">{{ $webdata->webd_address }}</p>
            </a>
            <a href="tel:{{ $webdata->webd_phone }}">
                <p class="m-0">{{ $webdata->webd_phone }}</p>
            </a>
        </div>
        <div class="copy">
            <p class="m-0">Copyright {{ date('Y') }} - <strong> {{ $webdata->webd_name }}
                    {{ $webdata->webd_subt }}&copy;</strong> by <a href="https://adriany1997.github.io/porfolio/home" class="text-primary-emphasis" target="_blank">HappyFox.Devs</a></p>
        </div>
    </div>
</div>
