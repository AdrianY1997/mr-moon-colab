<div class="dash dash-reservas">
    <div>
        <div class="container">
            @include('dashboard/static/menu'):
            <div class="content">
                <p>Reservas</p>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>URID.</th>
                            <th>Estado.</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!$reserves)
                        <tr>
                            <td>No hay datos.</td>
                        </tr>
                        @else
                        @foreach($reserves as $key => $reserve)
                        <tr class="item" data-href="{{ route("dash.itemGetInfo", ["id" => $reserve->rese_id]) }}">
                            <td>{{ $reserve->rese_urid }}</td>
                            <td>{{ $reserve->rese_status }}</td>
                            <td class="d-flex gap-2">
                                <span class="view-item btn p-0 px-2">
                                    <i class="fa-solid fa-eye"></i>
                                </span>
                                <span class="edit-item  btn p-0 px-2">
                                    <i class="fa-solid fa-edit"></i>
                                </span>
                                <a href="{{ route("inv.delete", ["id" => $reserve->rese_id]) }}" class="delete-item btn p-0 px-2 text-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
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
