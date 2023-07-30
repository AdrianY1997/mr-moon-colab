<div class="dash dash-usuarios">
    <div>
        <div class="container">
            @include('dashboard/static/menu')
            <div class="content">
                <p>Lista de usuarios</p>
                @if(Privileges::User->get() & Session::data("user_privileges"))
                <div class="mb-3">
                    <button class="btn btn-primary" id="add-item">
                        <span>
                            <i class="fa-solid fa-plus"></i> Agregar
                        </span>
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
