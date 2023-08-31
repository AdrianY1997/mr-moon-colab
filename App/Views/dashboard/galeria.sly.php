<div class="dash dash-galeria">
    <div>
        <div class="container">
            @include('dashboard/static/menu'):
            <div class="content position-relative">
                <p>Galeria</p>
                <div class="mb-3">
                    <button class="btn btn-primary" id="add-item">
                        <span>
                            <i class="fa-solid fa-plus"></i> Agregar
                        </span>
                    </button>
                </div>
                <div class=" d-flex dash-gallery-item-container flex-wrap gap-5 justify-content-center">
                    @foreach($photos as $photo):
                    <div data-bs-toggle="modal" type="button" data-bs-target="#dash-gallery-show-modal"><img class="gali-img" src="{{ asset($photo->gale_path) }}">
                        <a href="{{ route("gal.delete", ["id" => $photo->gale_id]) }}" class="delete-item btn p-0 px-2 text-danger">
                            <i class="fa-solid fa-trash"></i>
                        </a></div>
                    @endforeach
                </div>
                <div id="modal-add" class="modal position-absolute p-3 bg-black bg-opacity-10" style="z-index: 1">
                    <div class="position-absolute top-50 start-50 translate-middle bg-white rounded-2 p-3 w-100 h-100 p-3">
                        <span class="close-modal position-absolute top-0 start-0 btn p-3">
                            <i class="fa-solid fa-caret-left"></i>
                        </span>
                        <p class="ms-3 fs-5">Agregar Imagen</p>
                        <form action="{{ route("gal.add") }}" method="post">
                            <div class="dash-menu-item-container" data-img="gal">
                                <div class="text-center d-flex gap-3 justify-content-center mt-3">
                                    <input type="file" name="img" id="">
                                </div>
                                <div class="text-center d-flex gap-3 justify-content-center mt-3">
                                    <button class="btn btn-success upload-img">Subir</button>
                                    <button class="btn btn-primary save-img" disabled>Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="dash-gallery-show-modal" tabindex="-1" aria-labelledby="dash-gallery-show-label" aria-hidden="true">
    <div class="modal-dialog p-4" style="max-width: 100%">
        <div class="text-center position-relative">
            <img src="" alt="">
        </div>
    </div>
</div>
<script src="{{ asset("js/dashboard/gallery/show.js") }}"></script>
<script src="{{ asset("js/dashboard/gallery.js") }}"></script>
