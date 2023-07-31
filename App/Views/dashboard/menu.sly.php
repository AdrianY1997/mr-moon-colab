<div class="dash dash-menu">
    <div>
        <div class="container">
            @include('dashboard/static/menu'):
            <div class="content d-flex gap-3">
                <div class="dash-menu-item-container" data-img="main">
                    <p>Principal</p>
                    <img class="w-100" src="{{ asset("img/menu/menu-principal.jpg") }}" alt="">
                    <div class="text-center d-flex gap-3 justify-content-center mt-3">
                        <button class="btn btn-success upload-img">Subir</button>
                        <button class="btn btn-primary save-img" disabled>Guardar</button>
                    </div>
                    <form action="{{ route("dash.menuSetImg", ["id" => 2]) }}" method="post" class="d-none" enctype="multipart/form-data">
                        <input class="menu-img" name="menu-img" type="file">
                    </form>
                </div>
                <div class="dash-menu-item-container" data-img="drink">
                    <p>Bebidas</p>
                    <img class="w-100" src="{{ asset("img/menu/menu-bebidas.jpg") }}" alt="">
                    <div class="text-center d-flex gap-3 justify-content-center mt-3">
                        <button class="btn btn-success upload-img">Subir</button>
                        <button class="btn btn-primary save-img" disabled>Guardar</button>
                    </div>
                    <form action="{{ route("dash.menuSetImg", ["id" => 1]) }}" method="post" class="d-none" enctype="multipart/form-data">
                        <input class="menu-img" name="menu-img" type="file">
                    </form>
                </div>
                <div class="dash-menu-item-container" data-img="food">
                    <p>Comidas</p>
                    <img class="w-100" src="{{ asset("img/menu/menu-comidas.jpg") }}" alt="">
                    <div class="text-center d-flex gap-3 justify-content-center mt-3">
                        <button class="btn btn-success upload-img">Subir</button>
                        <button class="btn btn-primary save-img" disabled>Guardar</button>
                    </div>
                    <form action="{{ route("dash.menuSetImg", ["id" => 3]) }}" method="post" class="d-none" enctype="multipart/form-data">
                        <input class="menu-img" name="menu-img" type="file">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset("js/dash.menu.js") }}"></script>
