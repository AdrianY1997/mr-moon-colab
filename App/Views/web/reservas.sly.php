<div class="reservas">
    <div class="title" style="background-image: url({{ asset('img/reservas/reservas-title-img.png') }});">
        <h1>Reservas</h1>
    </div>

    <div class="form container">
        <div>
            <h4>Importante!</h4>
            <p class="m-0">
                Tenga en cuenta que para realizar una reservación es necesario un deposito de $20.000 pesos<br>
                El dinero en deposito se tendra en cuenta en la factura final
            </p>
        </div>
        <hr>
        <div>
            <p>Si ya tienes tu reservación puedes introducirla aqui</p>
            <div class="form-floating">
                <input type="text" id="urid" name="urid" class="form-control" placeholder="12345">
                <label for="urid">Identificación de reserva</label>
            </div>
            <button data-href="{{ route("reserve.show", ["urid" => ":urid"]) }}" class="btn btn-primary" id="search-reservation">Buscar</button>
        </div>
        <hr class="border-3 border-success-subtle" />
        <form action="{{ route("reserve.new") }}" method="post">
            <div>
                <p>Llena el siguiente formulario para realizar una reserva</p>
            </div>
            <div class="info-mesa">
                <div class="form-floating">
                    <input class="form-control" type="number" name="people" id="people" placeholder="people" min="1" max="4">
                    <label for="people">Personas<span class="text-danger">*</span></label>
                </div>
                <div class="form-floating">
                    <select class="form-control" name="table" id="table" placeholder="table">
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                    <label for="table">Mesa<span class="text-danger">*</span></label>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="date" min="<?= $now ?>" name="day" id="day" placeholder="day" data-href="{{ route("reserve.hours") }}">
                    <label for="day">Dia<span class="text-danger">*</span></label>
                </div>
                <div class="form-floating position-relative">
                    <button id="reserve-time-btn" class="btn border h-100 w-100 text-start" type="button" data-bs-target="#reserve-time-container" aria-expanded="false" aria-controls="reserve-time-container"></button>
                    <label id="time-label" for="time">Hora<span class="text-danger">*</span></label>
                    <div class="collapse position-absolute w-100" style="z-index: 1" id="reserve-time-container">
                        <div class="card card-body mt-2 d-flex flex-column gap-2">
                            <div class="position-absolute end-0 top-0 m-2 my-1">
                                <div class="text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Cuando Selecciones una hora, se deshabilitaran el resto a excepción la casillas siguiente."><i class="fa-solid fa-info-circle"></i></div>
                            </div>
                            <div>
                                <p class="mb-0">Mañana</p>
                                <div class="d-flex justify-content-between gap-2" data-day-section="morning">
                                    <div class="time-cell w-100 border text-center p-1">8</div>
                                    <div class="time-cell w-100 border text-center p-1">9</div>
                                    <div class="time-cell w-100 border text-center p-1">10</div>
                                    <div class="time-cell w-100 border text-center p-1">11</div>
                                </div>
                            </div>
                            <div>
                                <p class="mb-0">Tarde</p>
                                <div class="d-flex justify-content-between gap-2" data-day-section="afternoon">
                                    <div class="time-cell w-100 border text-center p-1">2</div>
                                    <div class="time-cell w-100 border text-center p-1">3</div>
                                    <div class="time-cell w-100 border text-center p-1">4</div>
                                    <div class="time-cell w-100 border text-center p-1">5</div>
                                </div>
                            </div>
                            <div>
                                <p class="mb-0">Noche</p>
                                <div class="d-flex justify-content-between gap-2" data-day-section="night">
                                    <div class="time-cell w-100 border text-center p-1">7</div>
                                    <div class="time-cell w-100 border text-center p-1">8</div>
                                    <div class="time-cell w-100 border text-center p-1">9</div>
                                    <div class="time-cell w-100 border text-center p-1">10</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span id="time-clean" class="btn btn-outline-warning">Limpiar</span><span id="time-confirm" class="btn btn-outline-primary">Confirmar</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info-persona mt-3">
                <div class="form-floating">
                    <input class="form-control" type="text" name="name" id="name" placeholder="name" value="{{ Session::data("user_name") ?: "" }}">
                    <label for="">Nombre<span class="text-danger">*</span></label>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="text" name="lastname" id="lastname" placeholder="lastname" value="{{ Session::data("user_lastname") ?: "" }}">
                    <label for="">Apellido<span class="text-danger">*</span></label>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="text" name="email" id="email" placeholder="email" value="{{ Session::data("user_email") ?: "" }}">
                    <label for="">Correo<span class="text-danger">*</span></label>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="text" name="phone" id="phone" placeholder="phone" pattern="3[0-9]{2}[0-9]{7}" value="{{ Session::data("user_phone") ?: "" }}">
                    <label for="">Teléfono<span class="text-danger">*</span></label>
                </div>
            </div>
            <div class="info-details">
                <div class="form-floating">
                    <textarea class="form-control" type="text" name="details" id="details" placeholder="details"></textarea>
                    <label for="">Detalles</label>
                </div>
            </div>
            <div class="info-send d-grid gap-2">
                <button type="submit" class="btn btn-dark p-2">Enviar</button>
            </div>
            <!-- <input type="hidden" id="day" name="day"> -->
            <input type="hidden" id="time" name="time">
        </form>
    </div>
</div>
<script src="{{ asset("js/reserve.js") }}"></script>


<!-- hola -->