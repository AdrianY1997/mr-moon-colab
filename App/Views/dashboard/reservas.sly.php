<style>
    #reserve-status p:hover {
        border-color: rgb(var(--color)) !important;
    }

    #reserve-status.show {
        display: block !important;
    }

</style>

<div class="dash dash-reservas">
    <div>
        <div class="container">
            @include('dashboard/static/menu'):
            <div class="content">
                <p>Reservas</p>
                <div class="mb-3 position-relative">
                    <button class="d-flex align-items-center border-0 border-dark bg-dark text-white shadow px-1 rounded-2" data-bs-target="#reserve-status" data-bs-toggle="collapse" role="button">
                        <span class="d-flex justify-content-center align-items-center bg-white text-dark py-1 px-2 rounded-start-1">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </span>
                        <span class="d-flex justify-content-center align-items-center py-1 px-2 gap-1">
                            <span id="status-title">Estado</span> <i class="fa-solid fa-caret-down"></i>
                        </span>
                    </button>
                    <div class="position-absolute collapse top-100 fade bg-white shadow mt-1" id="reserve-status">
                        <p data-hash="status=" class="m-0 d-flex align-items-center px-1 btn p-1 border-start border-end rounded-0 border-2" style="border-color: transparent; --color: var(--bs-secondary-rgb)">
                            <span class="d-flex justify-content-center align-items-center py-1 px-2 text-warning">
                                <i class="fa-solid fa-xmark"></i>
                            </span>
                            <span class="d-flex justify-content-center align-items-center py-1 px-2">
                                Estado
                            </span>
                        </p>
                        <p data-hash="status={{Reservation::WAITING_FOR_PAYMENT}}-waiting-payment" class="m-0 d-flex align-items-center px-1 btn p-1 border-start border-end rounded-0 border-2" style="border-color: transparent; --color: var(--bs-warning-rgb)">
                            <span class="d-flex justify-content-center align-items-center py-1 px-2 text-warning">
                                <i class="fa-solid fa-thumbtack"></i>
                            </span>
                            <span class="d-flex justify-content-center align-items-center py-1 px-2">
                                Esperando pago
                            </span>
                        </p>
                        <p data-hash="status={{Reservation::WAITING_FOR_CONFIRMATION}}-waiting-confirmation" class="m-0 d-flex align-items-center px-1 btn p-1 border-start border-end rounded-0 border-2" style="border-color: transparent; --color: var(--bs-primary-rgb)">
                            <span class="d-flex justify-content-center align-items-center py-1 px-2 text-primary">
                                <i class="fa-solid fa-thumbtack"></i>
                            </span>
                            <span class="d-flex justify-content-center align-items-center py-1 px-2">
                                Esperando confirmación
                            </span>
                        </p>
                        <p data-hash="status={{Reservation::RESERVED}}-reserved" class="m-0 d-flex align-items-center px-1 btn p-1 border-start border-end rounded-0 border-2" style="border-color: transparent; --color: var(--bs-success-rgb)">
                            <span class="d-flex justify-content-center align-items-center py-1 px-2 text-success">
                                <i class="fa-solid fa-thumbtack"></i>
                            </span>
                            <span class="d-flex justify-content-center align-items-center py-1 px-2">
                                Reservado
                            </span>
                        </p>
                        <p data-hash="status={{Reservation::CANCELLED}}-cancelled" class="m-0 d-flex align-items-center px-1 btn p-1 border-start border-end rounded-0 border-2" style="border-color: transparent; --color: var(--bs-danger-rgb)">
                            <span class="d-flex justify-content-center align-items-center py-1 px-2 text-danger">
                                <i class="fa-solid fa-thumbtack"></i>
                            </span>
                            <span class="d-flex justify-content-center align-items-center py-1 px-2">
                                Cancelado
                            </span>
                        </p>
                    </div>
                </div>
                <table class="table w-100" id="reserves-table" data-ref="{{ route("dash.reserve.get") }}">
                    <thead class="table-dark">
                        <tr>
                            <th>URID.</th>
                            <th>Estado.</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">Cargando...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reservation-modal" tabindex="-1" aria-labelledby="reservation-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-start text-black p-4">
                    <div class="modal-title text-uppercase mb-2">
                        <img class="w-100" src="Public\img\facturas\16915973922-1691597057-164d3b901ec0da.png" data-root="{{constant("BASE_URL")}}" alt="" data-reservation-image>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h4 style="color: #35558a;">ID: </h4>
                        <h4 class="mb-2" style="color: #35558a;" data-reservation-urid></h4>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h5 style="color: #35558a;">Estado: </h5>
                        <h5 class="mb-2" style="color: #35558a;" data-reservation-status></h5>
                    </div>
                    <div>
                        <h5 style="color: #35558a;">fecha reservacion: </h5>
                        <h5 class="mb-2" style="color: #35558a;" data-reservation-date></h5>
                    </div>
                    <hr class="mt-2 mb-2" style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
                    <p class="mb-0" style="color: #35558a;">Detalles</p>
                    <hr class="mt-2 mb-4" style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
                    <div class="d-flex justify-content-between">
                        <p class="fw-bold mb-0">Nombre:</p>
                        <p class="text-muted mb-0" data-reservation-name></p>
                    </div>
                    <div class="d-flex justify-content-between pb-1">
                        <p class="fw-bold mb-0">Email:</p>
                        <p class="text-muted mb-0" data-reservation-email></p>
                    </div>
                    <hr class="mt-4 mb-2" style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
                    <div class="d-flex justify-content-between pb-1">
                        <div>
                            <p>Personas</p>
                            <p data-reservation-quantity></p>
                        </div>
                        <div>
                            <p>Mesa</p>
                            <p data-reservation-table></p>
                        </div>
                        <div>
                            <p>Dia</p>
                            <p data-reservation-day></p>
                        </div>
                        <div>
                            <p>Hora</p>
                            <p data-reservation-time></p>
                        </div>
                    </div>
                    <div>
                        <p class="m-0">Nota: </p>
                        <p class="m-0" data-reservation-description></p>
                    </div>
                </div>
                <div class="p-4 modal-footer border-top-0 pt-2">
                    <p class="m-0">Nota: </p>
                    <p class="m-0" data-reservation></p>
                </div>
                <div class="text-center mb-4">
                    <button type="button" class="btn btn-primary" style="width: fit-content" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset("js/dashboard/reserves.js") }}"></script>
