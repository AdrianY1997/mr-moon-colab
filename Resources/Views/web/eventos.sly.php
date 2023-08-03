<div class="eventos">
    <div class="title" style="background-image: url({{ asset('img/eventos/event-title-img.png')}})">
        <h1>Eventos</h1>
    </div>
    <div class="container">
        <div class="images">
            @foreach($events as $eventos)
            <div class="image">
                <div>
                    <p>Bartender</p>
                </div>
                <img class="w-100" src="{{ asset($eventss->eventos_path) }}" alt="">
            </div>
            @endforeach
        </div>
    </div>
</div>