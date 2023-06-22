<div class="dash dash-usuarios">
    <div>
        <div class="container">
            @include('dashboard/static/menu')
            <div class="content">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $l = count($usuarios);
                        @endphp
                        @foreach($usuarios as $user)
                        @if($l > 2 && $user->user_id != 1 && $user->user_id != 2)
                        <tr>
                            <td style="vertical-align: middle">
                                <p class="m-0">{{ $user->user_id }}</p>
                            </td>
                            <td style="vertical-align: middle">
                                <p class="m-0">{{ $user->user_name }} {{ $user->user_lastname}}</p>
                            </td>
                            <td style="vertical-align: middle">
                                <a href="#"><button class="btn text-primary"><i class="fa-solid fa-eye"></i></button></a>
                                <a href="#"><button class="btn text-black"><i class="fa-solid fa-edit"></i></button></a>
                                <a href="{{ route("user.delete", ["user_id" => $user->user_id]) }}"><button class="btn text-danger"><i class="fa-solid fa-trash-alt"></i></button></a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        @if($l <= 2) <tr>
                            <td colspan="3">
                                <p class="mb-0">No hay usuarios registrados</p>
                            </td>
                            </tr>
                            @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
