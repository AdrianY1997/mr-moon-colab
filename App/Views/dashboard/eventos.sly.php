<div class="dash dash-eventos">
    <div>
        <div class="container">
            @include('dashboard/static/menu'):
            <div class="content position-relative">
                <p>Proveedores</p>
                <div class="mb-3">
                    <button class="btn btn-primary" id="add-item">
                        <span>
                            <i class="fa-solid fa-plus"></i> Agregar
                        </span>
                    </button>
                </div>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre.</th>
                            <th>Descripcion.</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!$evento):
                        <tr>
                            <td>No hay datos.</td>
                        </tr>
                        @else
                            @foreach($evento as $key => $Event):
                            <tr class="item" data-href="{{ route("prov.getInfo", ["id" => $Event->evento_id]) }}">
                                <td>{{ $Event->even_name }}</td>
                                <td>{{ $Event->even_text }}</td>
                                <td>{{ $Event->even_fech }}</td>
                                <td>{{ $Event->even_path }}</td>
                                <td class="d-flex gap-2">
                                    <span class="view-item btn p-0 px-2">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>
                                    <span class="edit-item  btn p-0 px-2">
                                        <i class="fa-solid fa-edit"></i>
                                    </span>
                                    <a href="{{ route("even.delete", ["id" => $Event->even_id]) }}" class="delete-item btn p-0 px-2 text-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div id="modal-add" class="modal position-absolute p-3 bg-black bg-opacity-10" style="z-index: 1">
                    <div class="position-absolute top-50 start-50 translate-middle bg-white rounded-2 p-3 w-100 h-100 p-3">
                        <span class="close-modal position-absolute top-0 start-0 btn p-3">
                            <i class="fa-solid fa-caret-left"></i>
                        </span>
                        <p class="ms-3 fs-5">Agregar evento</p>
                        <form action="{{ route("even.add") }}" method="post">
                            <div class="form-label-group mb-3">
                                <label for="item-name">Nomnbre</label>
                                <input type="text" id="item-name" name="item-name" placeholder="">
                            </div>
                            <div class="form-label-group mb-3">
                                <label for="item-text">Descripcion</label>
                                <input type="text" id="item-text" name="item-text" placeholder="">
                            </div>
                            <div class="form-label-group mb-3">
                                <label for="item-fech">Fecha</label>
                                <input type="fecha" id="item-email" name="item-email">
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="modal-edit" class="modal position-absolute p-3 bg-black bg-opacity-10" style="z-index: 1">
                    <div class="position-absolute top-50 start-50 translate-middle bg-white rounded-2 p-3 w-100 h-100 p-3">
                        <span class="close-modal position-absolute top-0 start-0 btn p-3">
                            <i class="fa-solid fa-caret-left"></i>
                        </span>
                        <p class="ms-3 fs-5">Editar Producto</p>
                        <form action="{{ route("prov.edit") }}" method="post">
                            <div class="form-label-group mb-3">
                                <label for="prov-edit-name">Nombre</label>
                                <input type="text" id="prov-edit-name" name="prov-edit-name" placeholder="">
                            </div>
                            <div class="form-label-group mb-3">
                                <label for="prov-edit-text"></label>
                                <input type="text" id="prov-edit-text" name="prov-edit-text" placeholder="">
                            </div>
                            <div class="form-label-group mb-3">
                                <label for="prov-edit-phone">Teléfono</label>
                                <input type="text" id="prov-edit-phone" name="prov-edit-phone" placeholder="">
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </div>
                            <input type="hidden" name="prov-edit-id" id="prov-edit-id">
                        </form>
                    </div>
                </div>
                <div id="modal-view" class="modal position-absolute p-3 bg-black bg-opacity-10 overflow-hidden" style="z-index: 1">
                    <div class="position-absolute top-50 start-50 translate-middle bg-white rounded-2 p-3 w-100 h-100 p-3 overflow-auto">
                        <span class="close-modal position-absolute top-0 start-0 btn p-3">
                            <i class="fa-solid fa-caret-left"></i>
                        </span>
                        <p class="ms-3 fs-5">Ver Proveedor</p>
                        <div class="data">
                            <div class="d-flex gap-5">
                                <div>
                                    <p>NIT</p>
                                    <p data-prov-nit></p>
                                </div>
                                <div>
                                    <p>Nombre</p>
                                    <p data-prov-name></p>
                                </div>
                                <div>
                                    <p>Email</p>
                                    <p data-prov-email></p>
                                </div>
                                <div>
                                    <p>Teléfono</p>
                                    <p data-prov-phone></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>