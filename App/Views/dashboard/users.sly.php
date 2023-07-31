<div class="dash dash-usuarios">
    <div>
        <div class="container">
            @include('dashboard/static/menu'):
            <div class="content">
                <p>Lista de usuarios</p>
                @if((Privileges::Master->get() & Session::data("user_privileges")) == Privileges::Master->get()):
                <div class="mb-3">
                    <button class="btn btn-primary" id="add-item">
                        <span>
                            <i class="fa-solid fa-plus"></i> Agregar
                        </span>
                    </button>
                </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            @if((Privileges::Master->get() & Session::data("user_privileges")) == Privileges::Master->get()):
                            <th>Nick</th>
                            @endif
                            <th>Nombres</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody data-url-info="{{ route("dash.userGetInfo", ["id" => ":id"]) }}">
                        @if(count($usuarios) <= 3 && !(Privileges::Master->get() & Session::data("user_privileges")) == Privileges::Master->get()): 
                        <tr>
                            <td colspan="3">
                                <p class="mb-0">No hay usuarios registrados</p>
                            </td>
                        </tr>
                        @else
                            @foreach($usuarios as $key => $user):
                            <tr data-user-id="{{ $user->user_id }}">
                                <td style="vertical-align: middle">
                                    <p class="m-0">{{ $user->user_id }}</p>
                                </td>
                                @if((Privileges::Master->get() & Session::data("user_privileges")) == Privileges::Master->get()):
                                <td style="vertical-align: middle">
                                    <p class="user-name m-0">{{ $user->user_nick }}</p>
                                </td>
                                @endif
                                <td style="vertical-align: middle">
                                    <p class="user-name m-0">{{ $user->user_name }} {{ $user->user_lastname }}</p>
                                </td>
                                <td style="vertical-align: middle">
                                    <button class="btn text-primary show-profile-btn" data-bs-target="#show-profile"><i class="fa-solid fa-eye"></i></button>
                                    <a href="{{ route("user.delete", ["user_id" => $user->user_id]) }}"><button class="btn text-danger"><i class="fa-solid fa-trash-alt"></i></button></a>
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
@if((Privileges::Master->get() & Session::data("user_privileges")) == Privileges::Master->get()):
<div class="modal fade" id="add-profile" tabindex="-1" aria-labelledby="add-profile-label" aria-hidden="true">
    <div class="modal-dialog container">
        <div class="modal-content">
            <form action="{{ route("profile.add") }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-profile-label">Editar Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row gutters-sm">
                        <div class="col-md-4 mb-3">
                            <div>
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input name="nick" id="nick" type="text" class="form-control" placeholder="John Doe" value="@if($user->user_nick): {{ $user->user_nick }} @endif">
                                                <label for="nick">Nick</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <div class="card-body">
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="name" id="name" type="text" class="form-control" placeholder="John" value="@if($user->user_name): {{ $user->user_name }} @endif">
                                            <label for="name">Nombre</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="lastname" id="lastname" type="text" class="form-control" placeholder="Doe" value="@if($user->user_lastname): {{ $user->user_lastname }} @endif">
                                            <label for="lastname">Apellido</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="email" id="email" type="text" class="form-control" placeholder="mail@domain.com" value="@if($user->user_email): {{ $user->user_email }} @endif" disabled>
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="address" id="address" type="text" class="form-control" placeholder="mail@domain.com" value="@if($user->user_address): {{ $user->user_address }} @endif">
                                            <label for="address">Dirección</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="phone" id="phone" type="text" class="form-control" placeholder="mail@domain.com" value="@if($user->user_phone): {{ $user->user_phone }} @endif">
                                            <label for="phone">Teléfono</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="pass" id="pass" type="text" class="form-control" placeholder="*" required>
                                            <label for="pass">Contraseña <sup class="text-danger">*</sup></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
<div class="modal fade" id="show-profile" tabindex="-1" aria-labelledby="show-profile-label" aria-hidden="true">
    <div class="modal-dialog container">
        <div class="modal-content">
            <form id="show-profile-form" action="{{ route("dash.userSetInfo") }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="show-profile-label">Editar Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row gutters-sm">
                        <div class="col-md-4 mb-3">
                            <div>
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img id="show-profile-item-img" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle border mb-4" width="150" heigth="150">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input name="img_path" id="show-profile-img-path" type="input" class="form-control" placeholder="John Doe" disabled>
                                                <label for="img_path">Avatar</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input name="nick" id="show-profile-nick" type="text" class="form-control" placeholder="John Doe">
                                                <label for="nick">Nick</label>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="form-floating">
                                                <input name="pass" id="show-profile-pass" type="text" class="form-control" placeholder="Contraseña">
                                                <label for="pass">Contraseña</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <div class="card-body">
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="name" id="show-profile-name" type="text" class="form-control" placeholder="John">
                                            <label for="name">Nombre</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="lastname" id="show-profile-lastname" type="text" class="form-control" placeholder="Doe">
                                            <label for="lastname">Apellido</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="email" id="show-profile-email" type="text" class="form-control" placeholder="mail@domain.com">
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="address" id="show-profile-address" type="text" class="form-control" placeholder="mail@domain.com">
                                            <label for="address">Dirección</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="phone" id="show-profile-phone" type="text" class="form-control" placeholder="mail@domain.com">
                                            <label for="phone">Teléfono</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="show-profile-id" name="id">
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <div>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-profile" tabindex="-1" aria-labelledby="edit-profile-label" aria-hidden="true">
    <div class="modal-dialog container">
        <div class="modal-content">
            <form action="{{ route("profile.edit") }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-profile-label">Editar Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row gutters-sm">
                        <div class="col-md-4 mb-3">
                            <div>
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle border mb-4" width="150">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input name="img_path" id="img_path" type="text" class="form-control" placeholder="John Doe" value="Avatar 1" disabled>
                                                <label for="img_path">Avatar</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input name="nick" id="nick" type="text" class="form-control" placeholder="John Doe" value="@if($user->user_nick): {{ $user->user_nick }} @endif">
                                                <label for="nick">Nick</label>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="form-floating">
                                                <input name="new-pass" id="new-pass" type="text" class="form-control" placeholder="Contraseña">
                                                <label for="new-pass">Nueva Contraseña</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <div class="card-body">
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="name" id="name" type="text" class="form-control" placeholder="John" value="@if($user->user_name): {{ $user->user_name }} @endif">
                                            <label for="name">Nombre</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="lastname" id="lastname" type="text" class="form-control" placeholder="Doe" value="@if($user->user_lastname): {{ $user->user_lastname }} @endif">
                                            <label for="lastname">Apellido</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="email" id="email" type="text" class="form-control" placeholder="mail@domain.com" value="@if($user->user_email): {{ $user->user_email }} @endif" disabled>
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="address" id="address" type="text" class="form-control" placeholder="mail@domain.com" value="@if($user->user_address): {{ $user->user_address }} @endif">
                                            <label for="address">Dirección</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="phone" id="phone" type="text" class="form-control" placeholder="mail@domain.com" value="@if($user->user_phone): {{ $user->user_phone }} @endif">
                                            <label for="phone">Teléfono</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="pass" id="pass" type="text" class="form-control" placeholder="*" required>
                                            <label for="pass">Contraseña Actual <sup class="text-danger">*</sup></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <div>
                        <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" data-bs-html="true" title="Para eliminar su perfil, envie un correo electronico a un administrador">
                            <button type="button" class="btn btn-danger" disabled>Eliminar</button>
                        </span>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset("js/dash.profiles.js") }}"></script>
