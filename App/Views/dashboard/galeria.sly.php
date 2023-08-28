<div class="dash dash-galeria">
    <div>
        <div class="container">
            @include('dashboard/static/menu'):
            <div class="content d-flex gap-3">
                <div class="dash-gallery-item-container d-flex flex-wrap justify-content-between gap-3">
                    @foreach($photos as $photo):
                    <div data-bs-toggle="modal" type="button" data-bs-target="#dash-gallery-show-modal"><img class="gali-img" src="{{ asset($photo->gale_path) }}"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD
=======
<div class="modal fade" id="dash-gallery-show-modal" tabindex="-1" aria-labelledby="dash-gallery-show-label" aria-hidden="true">
    <div class="modal-dialog p-4" style="max-width: 100%">
        <div class="text-center position-relative">
            <img src="" alt="">
        </div>
    </div>
</div>
<script src="{{ asset("js/dashboard/gallery/show.js") }}"></script>
>>>>>>> 42bf7fd2133b9cebf7bb3cc593893973ff0b932e
