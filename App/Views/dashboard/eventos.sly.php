<div class="dash dash-eventos">
    <div>
        <div class="container">
            @include('dashboard/static/menu'):
            <div class="content position-relative">
                <p>Eventos</p>
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
                            <th>Imagen</th>
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
                            <tr class="item" data-href="{{ route("event.get", ["id" => $Event->even_id]) }}">
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
                                    <a href="{{ route("event.delete", ["id" => $Event->even_id]) }}" class="delete-item btn p-0 px-2 text-danger">
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
                        <form action="{{ route("even.add") }}" method="post" class="event.add">
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
                                <input type="text" id="item-fech" name="item-fech">
                            </div>
                            <div class="form-label-group mb-3">
                                <label for="item-path">Imagen</label>
                                <input type="file" id="item-path" name="item-path">
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
                        <p class="ms-3 fs-5">Editar Evento</p>
                        <form action="{{ route("even.edit") }}" method="post">
                            <div class="form-label-group mb-3">
                                <label for="even-edit-name">Nombre</label>
                                <input type="text" id="even-edit-name" name="even-edit-name" placeholder="">
                            </div>
                            <div class="form-label-group mb-3">
                                <label for="even-edit-text">Descripcion</label>
                                <input type="text" id="even-edit-text" name="even-edit-text" placeholder="">
                            </div>
                            <div class="form-label-group mb-3">
                                <label for="even-edit-fech">Fecha</label>
                                <input type="text" id="even-edit-fech" name="even-edit-fech" placeholder="">
                            </div>
                            <div class="form-label-group mb-3">
                                <label for="even-edit-path">imagen</label>
                                <input type="file" id="even-edit-path" name="even-edit-path" placeholder="">
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </div>
                            <input type="hidden" name="even-edit-id" id="even-edit-id">
                        </form>
                    </div>
                </div>
                <div id="modal-view" class="modal position-absolute p-3 bg-black bg-opacity-10 overflow-hidden" style="z-index: 1">
                    <div class="position-absolute top-50 start-50 translate-middle bg-white rounded-2 p-3 w-100 h-100 p-3 overflow-auto">
                        <span class="close-modal position-absolute top-0 start-0 btn p-3">
                            <i class="fa-solid fa-caret-left"></i>
                        </span>
                        <p class="ms-3 fs-5">Ver Eventos</p>
                        <div class="data">
                            <div class="d-flex gap-5">
                                <div>
                                    <p>Nombre</p>
                                    <p data-even-name></p>
                                </div>
                                <div>
                                    <p>Descripcion</p>
                                    <p data-even-text></p>
                                </div>
                                <div>
                                    <p>Fecha</p>
                                    <p data-even-fech></p>
                                </div>
                                <div>
                                    <p>imagen</p>
                                    <p data-even-path></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset("js/dashboard/evento.js") }}"></script>
<script src="{{ asset("js/dash.eventos.js") }}"></script>