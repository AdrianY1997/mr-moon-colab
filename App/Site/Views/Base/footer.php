<div class="container">
    <div class="visible-sect">
        <span data-function="toggle-footer"><i class="fa-solid fa-caret-up"></i></span>
        <p>Síguenos en nuestras redes sociales: </p>
        <p>
            <?= $webdata["webd_fblink"] ? "<span><a target=\"_blank\" href=\"https://" . $webdata["webd_fblink"] . "\"><i class=\"fa-brands fa-facebook\"></i></a></span>" : "" ?>
            <?= $webdata["webd_twlink"] ? "<span><a target=\"_blank\" href=\"https://" . $webdata["webd_twlink"] . "\"><i class=\"fa-brands fa-twitter\"></i></a></span>" : "" ?>
            <?= $webdata["webd_iglink"] ? "<span><a target=\"_blank\" href=\"https://" . $webdata["webd_iglink"] . "\"><i class=\"fa-brands fa-instagram\"></i></a></span>" : "" ?>
            <?= $webdata["webd_ytlink"] ? "<span><a target=\"_blank\" href=\"https://" . $webdata["webd_ytlink"] . "\"><i class=\"fa-brands fa-youtube\"></i></a></span>" : "" ?>
        </p>
    </div>
    <div class="complete-footer hide">
        <hr>
        <div>
            <h1>
                <?php
                if (!($webdata["webd_name"] && $webdata["webd_subt"])) {
                    echo "[PAGE NAME]";
                } else {
                    echo $webdata["webd_name"] . " " . $webdata["webd_subt"];
                }
                ?>
            </h1>
            <p>Texto</p>
        </div>
        <hr>
        <div>
            <h1>Menu</h1>
            <a href="#">
                <p>Principal</p>
            </a>
            <a href="#">
                <p>Bebidas</p>
            </a>
            <a href="#">
                <p>Comidas</p>
            </a>
        </div>
        <hr>
        <div>
            <h1>Link</h1>
            <a href="#">
                <p>Inicio</p>
            </a>
            <a href="#">
                <p>Eventos</p>
            </a>
            <a href="#">
                <p>Galería</p>
            </a>
            <a href="#">
                <p>Ingreso</p>
            </a>
        </div>
        <hr>
        <div>
            <h1>Contacto</h1>
            <a href="#">
                <p>
                    <?= $webdata["webd_city"] ? $webdata["webd_city"] : "[city sample]" ?>
                </p>
            </a>
            <a href="#">
                <p>
                    <?= $webdata["webd_email"] ? $webdata["webd_email"] : "[mail@sample.com]" ?>
                </p>
            </a>
            <a href="#">
                <p>
                    <?= $webdata["webd_address"] ? $webdata["webd_address"] : "[address sample]" ?>
                </p>
            </a>
            <a href="#">
                <p>
                    <?= $webdata["webd_phone"] ? $webdata["webd_phone"] : "[phone sample]" ?>
                </p>
            </a>
        </div>
        <div class="copy">
            <p>Copyright
                <?= date("Y") ?> - <strong>
                    <?php
                    if (!($webdata["webd_name"] && $webdata["webd_subt"])) {
                        echo "[PAGE NAME]";
                    } else {
                        echo $webdata["webd_name"] . " " . $webdata["webd_subt"];
                    }
                    ?> &copy;
                </strong> by HappyFox.Devs
            </p>
        </div>
    </div>
</div>