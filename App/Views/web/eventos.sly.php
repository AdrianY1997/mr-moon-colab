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
        <div class="evento-item" data-event-href="{{ route("event.get", ["id" => $evento->even_id]) }}" type="button" data-bs-toggle="modal" data-bs-target="#show-event">
            <div class="imagen">
                <img class="w-100" src="{{ asset($evento->even_path) }}" alt="">
            </div>
            <div class="informacion hidden">
                <h2>{{$evento->even_name}}</h2>
                <h4>{{$evento->even_fech}}</h4>
                <p>{{$evento->even_text}}</p>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="show-event" tabindex="-1" aria-labelledby="show-eventLabel" aria-hidden="true" style="width: 100%">
    <div class="modal-dialog w-100" style="max-width: 100%;">
        <div class="modal-content container p-3">
            Hola
        </div>
    </div>
</div>

<script src="{{ asset("js/eventos/show.js") }}"></script>
<script src="Public/js/script.js"></script>
