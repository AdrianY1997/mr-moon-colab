<div class="home">
    <div class="hero" style="background-image: url({{ asset('img/static/home-bg.jpg') }})">
        <div class="container">
            <div>
                <h1>¡Bienvenidos!</h1>
                <p class="m-0">Somos <strong>Mr. Moon Coffee & Bar</strong></p>
                <p class="m-0">Estamos en Calle 4 Sur # 5- 456</p>
                <p class="m-0">La Plata, Huila - Colombia</p>
                @if(!$session):
                <p class="m-0">
                    <a href="{{ route('auth.login') }}">Iniciar Sesión</a>
                    <span>|</span>
                    <a href="{{ route('auth.signup') }}">Regístrate</a>
                </p>
                @endif
            </div>
        </div>
    </div>
    <div class="bol">
        <div class="container">
            <p class="">Suscríbete a nuestro boletín</p>
            <p>Regístrate con tu dirección de correo electrónico para recibir noticias y actualizaciones</p>
            <form action="#">
                <div class="form-floating mb-2">
                    <input class="form-control" type="text" placeholder="Nombre" name="name" id="name">
                    <label for="name">Nombre</label>
                </div>
                <div class="form-floating mb-2">
                    <input class="form-control" type="text" placeholder="Apellido" name="lastname" id="lastname">
                    <label for="lastname">Apellido</label>
                </div>
                <div class="form-floating mb-2">
                    <input class="form-control" type="text" placeholder="Correo" name="email" id="email">
                    <label for="email">Correo</label>
                </div>
                <div><button class="btn p-3" type="submit">Subscribirse</button></div>
            </form>
        </div>
    </div>
</div>
