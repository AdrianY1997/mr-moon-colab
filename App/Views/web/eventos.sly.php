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
        <div class="evento-item">
            <a href="{{route("despliegue", ["id" => $evento->even_id])}}">{{ $evento->even_name }}</a>
            <div class="imagen" onclick="expandirInformacion(this)">
                <img class="w-100" src="{{ asset($evento->even_path) }}" alt="">
            </div>
            <div class="informacion hidden">
                <h2>{{ $evento->even_name }}</h2>
                <h4>{{$evento->even_fech}}</h4>
                <p>{{$evento->even_text}}</p>
            </div>
        </div>
        @endforeach
        @endif
    </div>
  </div>
  <script src="Public/js/script.js"></script>































<!-- <div class="eventos">
    <div class="title" style="background-image: url({{ asset('img/eventos/event-title-img.png') }})">
        <h1>Eventos</h1>
    </div>
    <div class="carousel">
        <div class="container">
            <div class="images">
                @foreach($events as $evento):
                <div class="image">
                    <div>
                        <p>{{ $evento->even_name }}</p>
                        <img class="w-100" src="{{ asset($evento->even_path) }}" alt="">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="carousel-complete">
            <div class="container">
                <div class="images">
                    @foreach($events as $evento):
                    <div class="image-active">
                        <h4>{{ $evento->even_name }}</h4>
                        <img class="w-100" src="{{ asset($evento->even_path) }}" alt="">
                        <p>{{$evento->even_fech}}</p>
                        <h6>{{$evento->even_text}}</h6>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div> -->
