<div class="dash-menu hide">
    <div class="icon">
        <span class=""><i class="fa-solid fa-bars"></i></span>
        <span class="d-none"><i class="fa-solid fa-times"></i></span>
    </div>
    <div class="items hide">
        <div class="@if ($active == 'home') active @endif">
            <a href="{{ route('dash.home') }}">
                <p>dashboard</p>
            </a>
        </div>
        <div class="{{ $active == 'info' ? 'active' : '' }}">
            <a href="{{ route('dash.info') }}">
                <p>Información</p>
            </a>
        </div>
        <div class="{{ $active == 'usuarios' ? 'active' : '' }}">
            <a href="{{ route('dash.users') }}">
                <p>Usuarios</p>
            </a>
        </div>
        <div class="{{ $active == 'inventario' ? 'active' : '' }}">
            <a href="{{ route('dash.stock') }}">
                <p>Inventario</p>
            </a>
        </div>
        <div class="{{ $active == 'facturas' ? 'active' : '' }}">
            <a href="{{ route('dash.bill') }}">
                <p>Facturas</p>
            </a>
        </div>
        <div class="{{ $active == 'menu' ? 'active' : '' }}">
            <a href="{{ route('dash.menu') }}">
                <p>Menu</p>
            </a>
        </div>
        <div class="{{ $active == 'reservas' ? 'active' : '' }}">
            <a href="{{ route('dash.reserve') }}">
                <p>Reservas</p>
            </a>
        </div>
        <div class="{{ $active == 'eventos' ? 'active' : '' }}">
            <a href="{{ route('dash.event') }}">
                <p>Eventos</p>
            </a>
        </div>
        <div class="{{ $active == 'galeria' ? 'active' : '' }}">
            <a href="{{ route('dash.galery') }}">
                <p>Galeria</p>
            </a>
        </div>
    </div>
</div>
