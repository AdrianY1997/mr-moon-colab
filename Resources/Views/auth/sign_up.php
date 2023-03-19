<div class="auth">
    <div>
        <div class="container">
            <div class="auth-form">
                <h1>
                    Ingreso
                    <hr>
                </h1>
                <form action="#">
                    <div class="form-control">
                        <input type="text" name="name" id="name" placeholder="name">
                        <label for="name">Nombre</label>
                    </div>
                    <div class="form-control">
                        <input type="text" name="lastname" id="lastname" placeholder="lastname">
                        <label for="lastname">Apellido</label>
                    </div>
                    <div class="form-control">
                        <input type="text" name="email" id="email" placeholder="email">
                        <label for="email">Email</label>
                    </div>
                    <div class="form-control">
                        <input type="text" name="password" id="password" placeholder="password">
                        <label for="password">Contraseña</label>
                    </div>
                    <div class="form-control">
                        <button>Registrarse</button>
                    </div>
                </form>
                <p>¿Ya tienes cuenta? <a href="<?= route("auth.login") ?>">Inicia Sesión</a></p>
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