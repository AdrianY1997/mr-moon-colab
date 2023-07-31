<div class="event">
    <div class="title" style="background-image: url({{ asset('img/eventos/event-title-img.png') }})">
        <h1>Eventos</h1>
    </div>
    <div class="imgs container">
        @foreach($events as $evento):
        <div>
            <div>
                <img class="w-100" src="{{ asset($evento->even_path) }}" alt="">
                <h2>{{ $evento->even_name }}</h2>
                <h4>{{$evento->even_fech}}</h4>
                <p>{{$evento->even_text}}
                </p>
            </div>
        </div>
        @endforeach
    </div>
</div>
















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
