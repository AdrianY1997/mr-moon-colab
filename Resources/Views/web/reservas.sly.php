<div class="reservas">
    <div class="title" style="background-image: url({{ asset('img/reservas/reservas-title-img.png') }});">
        <h1>Reservas</h1>
    </div>

    <div class="form container">
        <form action="#">
            <div>
                <p>Condiciones de antelación del servicio y pago anticipado</p>
            </div>
            <div class="info-mesa">
                <div class="form-floating">
                    <input class="form-control" type="number" name="people" id="people" placeholder="people">
                    <label for="people">Personas</label>
                </div>
                <div class="form-floating">
                    <select class="form-control" name="table" id="table" placeholder="table">
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                    <label for="table">Mesa</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="time" name="time" id="time" placeholder="time">
                    <label for="time">Hora</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="date" name="date" id="date" placeholder="date">
                    <label for="date">Fecha</label>
                </div>
            </div>
            <hr>
            <div class="info-persona">
                <div class="form-floating">
                    <input class="form-control" type="text" name="name" id="name" placeholder="name">
                    <label for="">Nombre</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="text" name="lastname" id="lastname" placeholder="lastname">
                    <label for="">Apellido</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="text" name="email" id="email" placeholder="email">
                    <label for="">Correo</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="text" name="phone" id="phone" placeholder="phone">
                    <label for="">Teléfono</label>
                </div>
                <div class="mb-3">
                    <label for="ant-pay" class="form-label">Default file input example</label>
                    <input class="form-control" type="file" id="ant-pay" name="ant-pay" id="ant-pay">
                </div>
            </div>
            <div>
                <div class="form-floating">
                    <textarea class="form-control" type="text" name="details" id="details" placeholder="details"></textarea>
                    <label for="">Detalles</label>
                </div>
            </div>
        </form>
    </div>
</div>
