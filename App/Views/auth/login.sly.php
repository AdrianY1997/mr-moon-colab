<div class="auth">
    <div>
        <div class="container">
            <div>
                <img class="img-login" src="{{ asset('img\static\mr_moon_logo.png') }}">
            </div>
            <div class="form">
                <div class="auth-form">
                    <h1>Ingreso
                        <hr>
                    </h1>
                    <form action="{{ route('auth.start') }}" method="POST">
                        <div class="form-floating mb-3">
                            <input class="form-control border shadow fs-6" style="margin-bottom: 1px" type="text" name="email" id="email" placeholder="email">
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control border shadow fs-6" style="margin-bottom: 1px" type="password" name="password" id="password" placeholder="password">
                            <label for="password">Contraseña</label>
                        </div>
                        <div class="mb-3">
                            <button class="py-2">Iniciar Sesión</button>
                        </div>
                    </form>
                    <p class="m-0">¿No tienes cuenta? <a href="{{ route('auth.signup') }}">Regístrate</a></p>
                    <p class="m-0">¿Olvidaste tu contraseña? Click <a href="{{ route('auth.recovery') }}">aquí</a></p>
                </div>
                <div class="auth-social">
                    <h1>Inicia también con:
                        <hr>
                    </h1>

                    <div class="mb-3">
                        <button class="google py-2 btn">
                            <span><i class="fa-brands fa-google"></i> Google</span>
                        </button>
                    </div>
                    <div class="mb-3">
                        <button class="facebook py-2 btn">
                            <span><i class="fa-brands fa-facebook"></i> Facebook</span>
                        </button>
                    </div>
                    <div class="mb-3">
                        <button class="twitter py-2 btn">
                            <span><i class="fa-brands fa-twitter"></i> Twitter</span>
                        </button>
                    </div>
                    <div class="mb-3">
                        <button class="instagram py-2 btn">
                            <span><i class="fa-brands fa-instagram"></i> Instagram</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>