<div class="dash dash-inventario">
    <div>
        <div class="container">
            @include('dashboard/static/menu')
            <div class="content position-relative">
                <p>Inventario</p>
                <div class="mb-3">
                    <button class="btn btn-primary">
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
                        @if(!$products)
                        <tr>
                            <td>No hay datos.</td>
                        </tr>
                        @else
                        @foreach($products as $key => $product)
                        <tr class="item" data-href="{{ route("dash.itemGetInfo", ["id" => $product->prod_id]) }}">
                            <td>{{ $product->prod_ref }}</td>
                            <td>{{ $product->prod_name }}</td>
                            <td class="d-flex gap-2">
                                <span class="view-item btn p-0 px-2">
                                    <i class="fa-solid fa-eye"></i>
                                </span>
                                <span class="btn p-0 px-2">
                                    <i class="fa-solid fa-edit"></i>
                                </span>
                                <span class="btn p-0 px-2 text-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <div id="modal" class="modal position-absolute p-3 bg-black bg-opacity-10">
                    <div class="position-absolute top-50 start-50 translate-middle bg-white rounded-2 p-3">
                        <span id="close-modal" class="position-absolute top-0 end-0 btn p-3">
                            <i class="fa-solid fa-times"></i>
                        </span>
                        hola
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset("js/dashboard/inventory.js") }}"></script>
