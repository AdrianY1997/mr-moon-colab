<div class="dash-menu hide">
    <div class="icon">
        <span class=""><i class="fa-solid fa-bars"></i></span>
        <span class="d-none"><i class="fa-solid fa-times"></i></span>
    </div>
    <div class="items hide">
        <div class="<?= $active == 'home' ? 'active' : '' ?>">
            <a href="<?= route('dash.home') ?>">
                <p class="m-0">dashboard</p>
            </a>
        </div>
        <div class="<?= $active == 'info' ? 'active' : '' ?>">
            <a href="<?= route('dash.info') ?>">
                <p class="m-0">Información</p>
            </a>
        </div>
        <div class="<?= $active == 'usuarios' ? 'active' : '' ?>">
            <a href="<?= route('dash.users') ?>">
                <p class="m-0">Usuarios</p>
            </a>
        </div>
        <div class="<?= $active == 'proveedores' ? 'active' : '' ?>">
            <a href="<?= route('dash.prov') ?>">
                <p class="m-0">Proveedores</p>
            </a>
        </div>
        <div class="<?= $active == 'inventario' ? 'active' : '' ?>">
            <a href="<?= route('dash.stock') ?>">
                <p class="m-0">Inventario</p>
            </a>
        </div>
        <div class="<?= $active == 'menu' ? 'active' : '' ?>">
            <a href="<?= route('dash.menu') ?>">
                <p class="m-0">Menu</p>
            </a>
        </div>
        <div class="<?= $active == 'reservas' ? 'active' : '' ?>">
            <a href="<?= route('dash.reserve') ?>">
                <p class="m-0">Reservas</p>
            </a>
        </div>
        <div class="<?= $active == 'eventos' ? 'active' : '' ?>">
            <a href="<?= route('dash.event') ?>">
                <p class="m-0">Eventos</p>
            </a>
        </div>
        <div class="<?= $active == 'galeria' ? 'active' : '' ?>">
            <a href="<?= route('dash.galery') ?>">
                <p class="m-0">Galeria</p>
            </a>
        </div>
        <div>
            <a href="<?= route('auth.close') ?>">
                <p class="m-0">Cerrar sesion</p>
            </a>
        </div>
    </div>
</div>
