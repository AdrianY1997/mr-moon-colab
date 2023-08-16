<div class="auth">
    <div>
        <div class="container">
            <div class="auth-form">
                <h1>
                    Registro
                    <hr>
                </h1>
                <form action="{{ route('user.star') }}" method="POST">
                    <div class="form-floating mb-3">
                        <input class="form-control border shadow fs-6" required style="margin-bottom: 1px" type="text" name="name" id="name" placeholder="name">
                        <label for="name">Nombre</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control border shadow fs-6" required style="margin-bottom: 1px" type="text" name="lastname" id="lastname" placeholder="lastname">
                        <label for="lastname">Apellido</label>
                    </div>
                 
                    <div class="form-floating mb-3">
                        <input class="form-control border shadow fs-6" required pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" style="margin-bottom: 1px" type="text" name="email" id="email" placeholder="email">
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control border shadow fs-6" required style="margin-bottom: 1px" type="number" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  name="number" id="number" placeholder="number">
                        <label for="number">No. Telefono</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control border shadow fs-6" required style="margin-bottom: 1px" type="text" name="address" id="address" placeholder="address">
                        <label for="number">Direccion</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control border shadow fs-6"  data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="La contraseña debe contener entre 8 y 16 caracteres, 1 letra mayúscula y un carácter especial" required style="margin-bottom: 1px" type="password" name="password" id="password" placeholder="password">
                        <label for="password">Contraseña</label>
                    </div>
                    
                    <div class="mb-3">
                        <button class="py-2">Registrarse</button>
                    </div>
                </form>
                <p>¿Ya tienes cuenta? <a href="{{ route('auth.login') }}">Inicia Sesión</a></p>
            </div>
            <div class="auth-social">
                <h1>Inicia también con:
                    <hr>
                </h1>

                <div class="mb-3">
                    <button class="google py-2">
                        <span><i class="fa-brands fa-google"></i> Google</span>
                    </button>
                </div>
                <div class="mb-3">
                    <button class="facebook py-2">
                        <span><i class="fa-brands fa-facebook"></i> Facebook</span>
                    </button>
                </div>
                <div class="mb-3">
                    <button class="twitter py-2">
                        <span><i class="fa-brands fa-twitter"></i> Twitter</span>
                    </button>
                </div>
                <div class="mb-3">
                    <button class="instagram py-2">
                        <span><i class="fa-brands fa-instagram"></i> Instagram</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
