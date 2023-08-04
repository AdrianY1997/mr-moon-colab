<div class="auth recovery">
    <div style="display: block;">
        <div class="container">
            <div>
                <img src="{{ asset('img\static\mr_moon_logo.png') }}">
            </div>
            <div>
                <h1>Has solicitado recuperar tú contraseña
                    <hr>
                </h1>
                <p class="fs-5">No podemos simplemente enviar tú antigua contraseña</p>
                <p class="fs-5">Para poder restablecerla has click y sigue las instrucciones.</p>
                <div>
                    <button class="send-code btn shadow">Restablecer Contraseña</button>
                </div>
            </div>
        </div>
        <div class="container">
            <div>
                <img src="{{ asset('img\static\mr_moon_logo.png') }}">
            </div>
            <div>
                <h1>Has solicitado recuperar tú contraseña
                    <hr>
                </h1>
                <p class="fs-5">Inserta tú correo electrónico donde vas a recibir tú código de recuperación.</p>
                <div>
                    <form class="mb-5" id="send-code-form" action="{{ route('auth.recovery.request.code') }}">
                        <div class="d-flex justify-content-right">
                            <div class="request-password w-100">
                                <input class="border px-3 py-2 w-100" name="email" type="email"
                                    placeholder="forexample123@email.com">
                            </div>
                            <button class="ms-3 px-3" type="submit" id="send-code-btn">Enviar&nbsp;codigó</button><br>
                        </div>
                    </form>
                    <form action="#">
                        <div class="d-flex justify-content-center">
                            <input class="border px-3 py-2" type="number" placeholder="# # # # # #" class="border">
                            <button class="ms-3 px-3"><a href="#">Confirmar</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container d-none">
            <div>
                <img src="{{ asset('img\static\mr_moon_logo.png') }}">
            </div>
            <div>
                <h1>Has solicitado recuperar tu contraseña
                    <hr>
                </h1>
                <p class="fs-5">Ingresa tu nueva contraseña.</p>
                <div>
                    <form action="">
                        <input class="mb-3 border px-3 py-2" type="password" placeholder="Escribe tú nueva contraseña">
                        <input class="mb-3 border px-3 py-2" type="password" placeholder="Confirma tú contraseña">
                        <button class="mb-3 ms-3 px-3"><a href="#">Confirmar Contraseña</a></button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="<?= asset('js/auth.recovery.js') ?>"></script>