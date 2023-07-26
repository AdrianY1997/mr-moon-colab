<div class="profile container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle border" width="150">
                            <div class="mt-3">
                                <h4>
                                    @if($user->user_nick)
                                    <p>{{ $user->user_nick }}</p>
                                    @else
                                    <p>Sin Especificar</p>
                                    @endif
                                </h4>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Editar</button>
                                <a href="{{ route("auth.close") }}"><button class="btn btn-outline-danger">Cerrar Sesión</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nombres</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->user_name ?? "Sin Especificar"}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Apellidos</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->user_lastname ?? "Sin Especificar"}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->user_email ?? "Sin Especificar"}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Dirección</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->user_address ?? "Sin Especificar"}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Teléfono</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->user_phone ?? "Sin Especificar"}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Ultima Edición</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ wordsDate($user->updated_at) ?? "Sin Especificar"}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog container">
        <div class="modal-content">
            <form action="{{ route("profile.edit") }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
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
                                                <input name="nick" id="nick" type="text" class="form-control" placeholder="John Doe" value="@if($user->user_nick){{ $user->user_nick }}@endif">
                                                <label for="nick">Nick</label>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="form-floating">
                                                <input name="new-pass" id="new-pass" type="text" class="form-control" placeholder="Contraseña" @endif">
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
                                            <input name="name" id="name" type="text" class="form-control" placeholder="John" value="@if($user->user_name) {{ $user->user_name }} @endif">
                                            <label for="name">Nombre</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="lastname" id="lastname" type="text" class="form-control" placeholder="Doe" value="@if($user->user_lastname) {{ $user->user_lastname }} @endif">
                                            <label for="lastname">Apellido</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="email" id="email" type="text" class="form-control" placeholder="mail@domain.com" value="@if($user->user_email){{ $user->user_email }}@endif" readonly>
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="address" id="address" type="text" class="form-control" placeholder="mail@domain.com" value="@if($user->user_address) {{ $user->user_address }} @endif">
                                            <label for="address">Dirección</label>
                                        </div>
                                    </div>
                                    <div class="row mx-1 mb-3">
                                        <div class="form-floating p-0">
                                            <input name="phone" id="phone" type="text" class="form-control" placeholder="mail@domain.com" value="@if($user->user_phone) {{ $user->user_phone }} @endif">
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
