<?php $webdata = unserialize($_COOKIE["webdata"]) ?>

<div>
    <div class="container header-content">
        <div>
            <div class="logo">
                <a href="<?= route(constant("HOME")) ?>">
                    <?= $webdata["webd_logo"]
                        ? "<img width=\"30\" height=\"30\" src=\"" . asset($webdata["webd_logo"]) . "\" alt=\"\">"
                        : "<p style=\"font-size: 25px\"></p>" ?>
                    <p>
                        <span class="webname <?= $webdata["webd_subt"] ? "" : "fs-xl" ?>">
                            <?= $webdata["webd_name"] ? $webdata["webd_name"] : "[web name]" ?>
                        </span>
                        <?= $webdata["webd_subt"] ? "<span class=\"websub\">" . $webdata["webd_subt"] . "</span>" : "" ?>
                    </p>
                </a>
            </div>
            <div class="def-menu">
                <a href="<?= route("inicio") ?>">
                    <p>Inicio</p>
                </a>
                <a href="<?= route("menu") ?>">
                    <p>Menu</p>
                </a>
                <a href="<?= route("reserve") ?>">
                    <p>Reservas</p>
                </a>
                <a href="<?= route("event") ?>">
                    <p>Eventos</p>
                </a>
                <a href="<?= route("galery") ?>">
                    <p>Galería</p>
                </a>
                <a href="<?= route("auth.login") ?>">
                    <p><i class="fa-solid fa-user-circle"></i></p>
                </a>
            </div>
            <div class="mb-menu">
                <p data-group="nav" data-type="button"><i class="fa-solid fa-bars"></i></p>
                <p class="d-none" data-group="nav" data-type="button"><span><i class="fa-solid fa-times"></i></span></p>
            </div>
        </div>
        <nav class="d-none" data-group="nav">
            <a href="<?= route("inicio") ?>">
                <p>Inicio</p>
            </a>
            <a href="<?= route("menu") ?>">
                <p>Menu</p>
            </a>
            <a href="<?= route("reserve") ?>">
                <p>Reservas</p>
            </a>
            <a href="<?= route("event") ?>">
                <p>Eventos</p>
            </a>
            <a href="<?= route("galery") ?>">
                <p>Galería</p>
            </a>
            <a href="<?= route("auth.login") ?>">
                <p><i class="fa-solid fa-user-circle"></i></p>
            </a>
        </nav>
    </div>
</div>