<div class="dash dash-galeria">
    <div>
        <div class="container">
            @include('dashboard/static/menu'):
            <div class="content d-flex gap-3">
                <div class="dash-gallery-item-container" data-img="main">
                    <p></p>
                    <img class="w-100" src="{{ asset("img/gallery") }}" alt="">
                    <div class="text-center d-flex gap-3 justify-content-center mt-3">
                        <button class="btn btn-success upload-img">Subir</button>
                        <button class="btn btn-primary save-img" disabled>Guardar</button>
                    </div>
                    <form action="{{ route("dash.gallerySetImg", ["id" => 2]) }}" method="post" class="d-none" enctype="multipart/form-data">
                        <input class="gallery-img" name="gallery-img" type="file">
                    </form>
                </div>
                <div class="dash-gallery-item-container" data-img="drink">
                    <p></p>
                    <img class="w-100" src="{{ asset("img/gallery") }}" alt="">
                    <div class="text-center d-flex gap-3 justify-content-center mt-3">
                        <button class="btn btn-success upload-img">Subir</button>
                        <button class="btn btn-primary save-img" disabled>Guardar</button>
                    </div>
                    <form action="{{ route("dash.gallerySetImg", ["id" => 1]) }}" method="post" class="d-none" enctype="multipart/form-data">
                        <input class="gallery-img" name="gallery-img" type="file">
                    </form>
                </div>
                <div class="dash-gallery-item-container" data-img="food">
                    <p></p>
                    <img class="w-100" src="{{ asset("img/gallery") }}" alt="">
                    <div class="text-center d-flex gap-3 justify-content-center mt-3">
                        <button class="btn btn-success upload-img">Subir</button>
                        <button class="btn btn-primary save-img" disabled>Guardar</button>
                    </div>
                    <form action="{{ route("dash.gallerySetImg", ["id" => 3]) }}" method="post" class="d-none" enctype="multipart/form-data">
                        <input class="gallery-img" name="gallery-img" type="file">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset("js/dash.gallery.js") }}"></script>