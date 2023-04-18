<div class="auth">
    <div>
        <div class="container">
            <div class="auth-form">
                <h1>
                    Ingreso
                    <hr>
                </h1>
                <form action="<?= route("auth.start") ?>" method="POST">
                    <div class="form-control">
                        <input type="text" name="email" id="email" placeholder="email">
                        <label for="email">Email</label>
                    </div>
                    <div class="form-control">
                        <input type="password" name="password" id="password" placeholder="password">
                        <label for="password">Contraseña</label>
                    </div>
                    <div class="form-control">
                        <button>Iniciar Sesión</button>
                    </div>
                </form>
                <p>¿No tienes cuenta? <a href="<?= route("auth.signup") ?>">Regístrate</a></p>
                <p>¿Olvidaste tu contraseña? Click <a href="<?= route("auth.recovery") ?>">aquí</a></p>
            </div>
            <div class="auth-social">
                <h1>
                    También puedes iniciar sesión con:
                    <hr>
                </h1>

                <div>
                    <button class="google">
                        <span><i class="fa-brands fa-google"></i> Google</span>
                    </button>
                </div>
                <div>
                    <button class="facebook">
                        <span><i class="fa-brands fa-facebook"></i> Facebook</span>
                    </button>
                </div>
                <div>
                    <button class="twitter">
                        <span><i class="fa-brands fa-twitter"></i> Twitter</span>
                    </button>
                </div>
                <div>
                    <button class="instagram">
                        <span><i class="fa-brands fa-instagram"></i> Instagram</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>