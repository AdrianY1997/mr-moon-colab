<div class="event">
    <div class="title" style="background-image: url({{ asset('img/eventos/event-title-img.png') }})">
        <h1>Eventos</h1>
    </div>
    <div class="imgs container">
        @if(!$events):
        <tr>
            <td>No hay Eventos.</td>
        </tr>
        @else
        @foreach($events as $evento):
        <div class="evento-item" data-event-href="{{ route("event.get", ["id" => 1]) }}">
            <div class="imagen">
                <img src="{{ asset($evento->even_path) }}" alt="">
                <div>
                    <h2>{{$evento->even_name}}</h2>
                    <h4>{{$evento->even_fech}}</h4>
                    <p>{{$evento->even_text}}</p>
                </div>
            </div>
        </div>

        @endforeach
        @endif
    </div>
</div>
<script src="{{ asset("js/eventos/show.js") }}"></script>