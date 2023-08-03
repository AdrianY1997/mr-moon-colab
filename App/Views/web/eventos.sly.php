<div class="event">
    <div class="title" style="background-image: url({{ asset('img/eventos/event-title-img.png') }})">
        <h1>Eventos</h1>
    </div>
    <div class="imgs container position-relative p-0">
        @if(!$events):
        <tr>
            <td>No hay Eventos.</td>
        </tr>
        @else
        @foreach($events as $evento):
        <div class="evento-item" data-event-href="{{ route("event.get", ["id" => $evento->even_id]) }}" type="button" data-bs-target="#show-event-modal">
            <div class="imagen">
                <img src="{{ asset($evento->even_path) }}" alt="">
            </div>
            <div class="informacion">
                <h5 class="fw-bold">{{$evento->even_name}}</h5>
            </div>
            <div class="detalles"><button  type="button" class="btn btn-primary" style="width: fit-content" aria-label="Close">Ver Detalles</button></div>
        </div>

        @endforeach
        @endif
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="show-event-modal" tabindex="-1" aria-labelledby="show-event-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-start text-black p-4">
                <div class="modal-title text-uppercase mb-2">
                    <img class="w-100" src="" alt="" data-event-image>
                </div>
                <h4 class="mb-2" style="color: #35558a;" data-event-title></h4>
                <p class="mb-0" style="color: #35558a;">Detalles</p>
                <hr class="mt-2 mb-4" style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
                <div class="d-flex justify-content-between">
                    <p class="fw-bold mb-0">Fecha:</p>
                    <p class="text-muted mb-0" data-event-date></p>
                </div>
                <div class="d-flex justify-content-between pb-1">
                    <p class="fw-bold mb-0">Hora:</p>
                    <p class="text-muted mb-0" data-event-time></p>
                </div>
            </div>
            <div class="p-4 modal-footer d-flex justify-content-center border-top-0 pt-2" data-event-description>

            </div>
            <div class="text-center mb-4">
                <button type="button" class="btn btn-primary" style="width: fit-content" data-mdb-dismiss="modal" aria-label="Close">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset("js/eventos/show.js") }}"></script>
<script src="Public/js/script.js"></script>