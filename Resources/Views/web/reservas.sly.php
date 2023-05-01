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
                <div class="form-control">
                    <input type="number" name="people" id="people" placeholder="people">
                    <label for="people">Personas</label>
                </div>
                <div class="form-control">
                    <select name="table" id="table" placeholder="table">
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                    <label for="table">Mesa</label>
                </div>
                <div class="form-control">
                    <input type="time" name="time" id="time" placeholder="time">
                    <label for="time">Hora</label>
                </div>
                <div class="form-control">
                    <input type="date" name="date" id="date" placeholder="date">
                    <label for="date">Fecha</label>
                </div>
            </div>
            <hr>
            <div class="info-persona">
                <div class="form-control">
                    <input type="text" name="name" id="name" placeholder="name">
                    <label for="">Nombre</label>
                </div>
                <div class="form-control">
                    <input type="text" name="lastname" id="lastname" placeholder="lastname">
                    <label for="">Apellido</label>
                </div>
                <div class="form-control">
                    <input type="text" name="email" id="email" placeholder="email">
                    <label for="">Correo</label>
                </div>
                <div class="form-control">
                    <input type="text" name="phone" id="phone" placeholder="phone">
                    <label for="">Teléfono</label>
                </div>
                <div class="form-control">
                    <input type="file" name="ant-pay" id="ant-pay" placeholder="ant-pay">
                    <label for=""></label>
                </div>
            </div>
            <div>
                <div class="form-control">
                    <textarea type="text" name="details" id="details" placeholder="details"></textarea>
                    <label for="">Detalles</label>
                </div>
            </div>
        </form>
    </div>
</div>
