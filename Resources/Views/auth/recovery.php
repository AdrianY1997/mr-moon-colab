<div class="auth recovery">
    <div style="display: block;">
        <div class="container">
            <div>
                <img src="<?= asset("img\static\mr_moon_logo.png") ?>">
            </div>
            <div>
                <h1>Has solicitado recuperar tú contraseña
                    <hr>
                </h1>
                <p>No podemos simplemente enviar tú antigua contraseña</p>
                <p>Un link único para restablecer tú contraseña ha sido generado. Para restablecer tú contraseña has click en el siguiente link y sigue las instrucciones.</p>
                <div>
                    <button><a href="#">Restablecer Contraseña</a></button>
                </div>
            </div>
        </div>
        <div class="container">
            <div>
                <img src="<?= asset("img\static\mr_moon_logo.png") ?>">
            </div>
            <div>
                <h1>Has solicitado recuperar tú contraseña
                    <hr>
                </h1>
                <p>Inserta tú correo electrónico donde vas a recibir tú código de recuperación.</p>
                <div>
                    <form id="send-code-form" action="<?= route("auth.recovery.request.code") ?>">
                        <div class="request-password">
                            <input name="email" type="email" placeholder="forexample123@email.com">
                            <button type="submit" id="send-code-btn">Enviar</button><br>
                        </div>
                    </form>
                    <form action="#">
                        <input type="number" placeholder="# # # # # #">
                        <button><a href="#">Confirmar código</a></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div>
                <img src="<?= asset("img\static\mr_moon_logo.png") ?>">
            </div>
            <div>
                <h1>Has solicitado recuperar tu contraseña
                    <hr>
                </h1>
                <p>Ingresa tu nueva contraseña.</p>
                <div>
                    <form action="">
                        <input type="password" placeholder="Escribe tú nueva contraseña">
                        <input type="password" placeholder="Confirma tú contraseña">
                        <button><a href="#">Confirmar Contraseña</a></button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="<?= asset("js/auth.recovery.js") ?>"></script>