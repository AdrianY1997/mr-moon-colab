<div class="galeria">
    <div class="title" style="background-image: url({{ asset('img/gallery/galeria-title-img.jpg') }})">
        <h1>Galería</h1>
    </div>
    <div class="imgs">
        @foreach($galerias as $galeria):
        <div>
            <div>
                <img class="gal-img" src="{{ asset($galeria->gale_path) }}" alt="">
            </div>
        </div>

        @endforeach
    </div>
</div>