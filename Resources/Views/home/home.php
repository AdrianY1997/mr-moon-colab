<div class="home">
    <div class="hero" style="background-image: url(Public/img/static/home-bg.jpg)">
        <div class="container">
            <div>
                <h1>¡Bienvenidos!</h1>
                <br>
                <p>Somos <strong>Mr. Moon Coffee & Bar</strong></p>
                <p>Estamos en Calle 4 Sur # 5- 456</p>
                <p>La Plata, Huila, Colombia</p>
                <p><a href="<?= route("auth.login") ?>">Iniciar Sesión</a> | <a href="<?= route("auth.signup") ?>">Regístrate</a></p>
            </div>
        </div>
    </div>
    <div class="bol">
        <div class="container">
            <p class="">Suscríbete a nuestro boletín</p>
            <p>Regístrate con tu dirección de correo electrónico para recibir noticias y actualizaciones</p>
            <form action="#">
                <div>
                    <input type="text" placeholder="Nombre" name="name" id="name">
                    <label for="name">Nombre</label>
                </div>
                <div>
                    <input type="text" placeholder="Apellido" name="lastname" id="lastname">
                    <label for="lastname">Apellido</label>
                </div>
                <div>
                    <input type="text" placeholder="Correo" name="email" id="email">
                    <label for="email">Correo</label>
                </div>
                <div><button type="submit">Subscribirse</button></div>
            </form>
        </div>
    </div>
</div>