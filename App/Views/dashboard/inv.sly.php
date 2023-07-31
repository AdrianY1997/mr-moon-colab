<div class="dash dash-inventario">
    <div>
        <div class="container">
            @include('dashboard/static/menu'):
            <div class="content position-relative">
                <p>Inventario</p>
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
                            <th>Ref.</th>
                            <th>Nombre.</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!$products):
                        <tr>
                            <td>No hay datos.</td>
                        </tr>
                        @else
                            @foreach($products as $key => $product):
                            <tr class="item" data-href="{{ route("dash.itemGetInfo", ["id" => $product->prod_id]) }}">
                                <td>{{ $product->prod_ref }}</td>
                                <td>{{ $product->prod_name }}</td>
                                <td class="d-flex gap-2">
                                    <span class="view-item btn p-0 px-2">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>
                                    <span class="edit-item  btn p-0 px-2">
                                        <i class="fa-solid fa-edit"></i>
                                    </span>
                                    <a href="{{ route("inv.delete", ["id" => $product->prod_id]) }}" class="delete-item btn p-0 px-2 text-danger">
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
                        <p class="ms-3 fs-5">Agregar Producto</p>
                        <form action="{{ route("inv.add") }}" method="post">
                            <div class="form-label-group mb-3">
                                <label for="item-ref">Referencia</label>
                                <input type="text" id="item-ref" name="item-ref" placeholder="">
                            </div>
                            <div class="form-label-group mb-3">
                                <label for="item-name">Nombre</label>
                                <input type="text" id="item-name" name="item-name" placeholder="">
                            </div>
                            <div class="form-label-group mb-3">
                                <label for="item-prov">Proveedor</label>
                                <select name="item-prov" id="item-prov" data-get-prov="{{ route("dash.getProv") }}">
                                    <option selected disabled>Cargando...</option>
                                </select>
                            </div>
                            <div class="form-label-group mb-3">
                                <label for="item-name">Descripción</label>
                                <textarea type="text" id="item-desc" name="item-desc" placeholder=""></textarea>
                            </div>
                            <div class="d-flex w-100 gap-3 mb-3">
                                <div class="form-label-group">
                                    <label for="item-stock">Stock</label>
                                    <input type="number" min="1" id="item-stock" name="item-stock">
                                </div>
                                <div class="form-label-group">
                                    <label for="item-value">Valor</label>
                                    <input type="number" min="1" id="item-value" name="item-value">
                                </div>
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
                        <form action="{{ route("inv.edit") }}" method="post">
                            <div class="form-label-group mb-3">
                                <label for="item-edit-ref">Referencia</label>
                                <input type="text" id="item-edit-ref" name="item-edit-ref" placeholder="">
                            </div>
                            <div class="form-label-group mb-3">
                                <label for="item-edit-name">Nombre</label>
                                <input type="text" id="item-edit-name" name="item-edit-name" placeholder="">
                            </div>
                            <div class="form-label-group mb-3">
                                <label for="item-edit-prov">Proveedor</label>
                                <select name="item-edit-prov" id="item-edit-prov" data-get-prov="{{ route("dash.getProv") }}">
                                    <option selected disabled>Cargando...</option>
                                </select>
                            </div>
                            <div class="form-label-group mb-3">
                                <label for="item-edit-name">Descripción</label>
                                <textarea type="text" id="item-edit-desc" name="item-edit-desc" placeholder=""></textarea>
                            </div>
                            <div class="d-flex w-100 gap-3 mb-3">
                                <div class="form-label-group">
                                    <label for="item-edit-stock">Stock</label>
                                    <input type="number" min="1" id="item-edit-stock" name="item-edit-stock">
                                </div>
                                <div class="form-label-group">
                                    <label for="item-edit-value">Valor</label>
                                    <input type="number" min="1" id="item-edit-value" name="item-edit-value">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </div>
                            <input type="hidden" name="item-edit-id" id="item-edit-id">
                        </form>
                    </div>
                </div>
                <div id="modal-view" class="modal position-absolute p-3 bg-black bg-opacity-10 overflow-hidden" style="z-index: 1">
                    <div class="position-absolute top-50 start-50 translate-middle bg-white rounded-2 p-3 w-100 h-100 p-3 overflow-auto">
                        <span class="close-modal position-absolute top-0 start-0 btn p-3">
                            <i class="fa-solid fa-caret-left"></i>
                        </span>
                        <p class="ms-3 fs-5">Ver Producto</p>
                        <div class="data">
                            <p class="fs-3">Producto</p>
                            <div class="d-flex gap-5">
                                <div>
                                    <p>Referencia</p>
                                    <p data-prod-ref></p>
                                </div>
                                <div>
                                    <p>Nombre</p>
                                    <p data-prod-name></p>
                                </div>
                                <div>
                                    <p>Stock</p>
                                    <p data-prod-stock></p>
                                </div>
                                <div>
                                    <p>Valor</p>
                                    <p data-prod-val></p>
                                </div>
                            </div>
                            <div>
                                <p>Descripción</p>
                                <p data-prod-desc></p>
                            </div>
                            <p class="fs-3">Proveedor</p>
                            <div class="d-flex gap-5">
                                <div>
                                    <p>Nit</p>
                                    <p data-prov-nit></p>
                                </div>
                                <div>
                                    <p>Nombre</p>
                                    <p data-prov-name></p>
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
<script src="{{ asset("js/dashboard/inventory.js") }}"></script>
