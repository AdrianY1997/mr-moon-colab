<div class="dash dash-galeria">
    <div>
        <div class="container">
            @include('dashboard/static/menu'):
            <div class="content ">
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
