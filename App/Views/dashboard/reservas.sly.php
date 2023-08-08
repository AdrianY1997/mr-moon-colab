<style>
    #reserve-status {
        display: inherit
    }

    #reserve-status p:hover {
        border-color: rgb( var(--color)) !important;
    }
</style>

<div class="dash dash-reservas">
    <div>
        <div class="container">
            @include('dashboard/static/menu'):
            <div class="content">
                <p>Reservas</p>
                <div class="mb-3 position-relative">
                    <button class="d-flex align-items-center border-0 border-dark bg-dark text-white shadow px-1 rounded-2" data-bs-target="#reserve-status" data-bs-toggle="collapse" role="button">
                        <span class="d-flex justify-content-center align-items-center bg-white text-dark py-1 px-2 rounded-start-1">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </span>
                        <span class="d-flex justify-content-center align-items-center py-1 px-2 gap-1">
                            <span>Estado</span> <i class="fa-solid fa-caret-down"></i>
                        </span>
                    </button>
                    <div class="position-absolute collapse top-100 fade show bg-white shadow mt-1" id="reserve-status">
                        <p class="m-0 d-flex align-items-center px-1 btn p-1 border-start border-end rounded-0 border-2" style="border-color: transparent; --color: var(--bs-warning-rgb)">
                            <span class="d-flex justify-content-center align-items-center py-1 px-2 text-warning">
                                <i class="fa-solid fa-thumbtack"></i>
                            </span>
                            <span class="d-flex justify-content-center align-items-center py-1 px-2">
                                Esperando pago
                            </span>
                        </p>
                        <p class="m-0 d-flex align-items-center px-1 btn p-1 border-start border-end rounded-0 border-2" style="border-color: transparent; --color: var(--bs-primary-rgb)">
                            <span class="d-flex justify-content-center align-items-center py-1 px-2 text-primary">
                                <i class="fa-solid fa-thumbtack"></i>
                            </span>
                            <span class="d-flex justify-content-center align-items-center py-1 px-2">
                                Esperando confirmación
                            </span>
                        </p>
                        <p class="m-0 d-flex align-items-center px-1 btn p-1 border-start border-end rounded-0 border-2" style="border-color: transparent; --color: var(--bs-success-rgb)">
                            <span class="d-flex justify-content-center align-items-center py-1 px-2 text-success">
                                <i class="fa-solid fa-thumbtack"></i>
                            </span>
                            <span class="d-flex justify-content-center align-items-center py-1 px-2">
                                Reservado
                            </span>
                        </p>
                        <p class="m-0 d-flex align-items-center px-1 btn p-1 border-start border-end rounded-0 border-2" style="border-color: transparent; --color: var(--bs-danger-rgb)">
                            <span class="d-flex justify-content-center align-items-center py-1 px-2 text-danger">
                                <i class="fa-solid fa-thumbtack"></i>
                            </span>
                            <span class="d-flex justify-content-center align-items-center py-1 px-2">
                                Cancelado
                            </span>
                        </p>
                    </div>
                </div>
                <table class="table w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>URID.</th>
                            <th>Estado.</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!$reserves):
                        <tr>
                            <td>No hay datos.</td>
                        </tr>
                        @else
                        @foreach($reserves as $key => $reserve):
                        <tr class="item" data-href="{{ route("dash.itemGetInfo", ["id" => $reserve->rese_id]) }}">
                            <td>
                                <p style="text-wrap: nowrap; overflow: hidden; text-overflow: ellipsis; width: 150px" class="m-0">{{ $reserve->rese_urid }}</p>
                            </td>
                            <td>
                                <p class="m-0">{{ Reservation::getText($reserve->rese_status) }}</p>
                            </td>
                            <td class="d-flex gap-2">
                                <p class="m-0">
                                    <span class="view-item btn p-0 px-2">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>
                                    <span class="edit-item  btn p-0 px-2">
                                        <i class="fa-solid fa-edit"></i>
                                    </span>
                                    <a href="{{ route("inv.delete", ["id" => $reserve->rese_id]) }}" class="delete-item btn p-0 px-2 text-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </p>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
