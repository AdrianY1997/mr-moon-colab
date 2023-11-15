<?php
use FoxyMVC\App\Packages\Privileges;
?>

<div class="dash dash-info">
    <div>
        <div class="container">
            <?php include_once 'App/Views/dashboard/static/menu.sly.php'; ?>
            <div class="content">
                <div class="sections">
                    <p style="cursor: pointer" class="active text-black" data-section="0">Ver Información</p>
                    <?php if(Privileges::check(Privileges::Master->get())) { ?>
                    <p style="cursor: pointer" data-section="1">Editar</p>
                    <?php } ?>
                </div>
                <div class="get-info show" data-section="0">
                    <p class="m-0">Datos del sitio web</p>
                    <div class="web-data">
                        <div class="logo">
                            <?php if($webdata->webd_logo) { ?>
                            <img class="show" width="150px" src="<?= asset($webdata->webd_logo) ?>" alt="">
                            <?php } else { ?>
                            <p class="show"
                                style="width:150px;height:150px;display:flex;justify-content:center;align-items:center;box-shadow:0 0 5px 0 lightgrey">
                                NO IMAGE</p>
                            <?php } ?>
                        </div>
                        <div>
                            <div class="info-control mb-3">
                                <p class="m-0"><span><i class="fa-solid fa-file-signature"></i></span>
                                    <?= $webdata->webd_name ?>
                                </p>
                            </div>
                            <div class="info-control mb-3">
                                <p class="m-0"><span><i class="fa-solid fa-closed-captioning"></i></span>
                                    <?= $webdata->webd_subt ?>
                                </p>
                            </div>
                            <div class="info-control mb-3">
                                <p class="m-0"><span><i class="fa-regular fa-star"></i></span>
                                    <?= explode('/', $webdata->webd_logo)[2] ?>
                                </p>
                            </div>
                            <div class="info-control mb-3">
                                <p class="m-0"><span><i class="fa-solid fa-bullseye"></i></span>
                                    <?= $webdata->webd_m ?>
                                </p>
                            </div>
                            <div class="info-control mb-3">
                                <p class="m-0"><span><i class="fa-solid fa-eye"></i></span>
                                    <?= $webdata->webd_v ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p class="m-0">Datos de contacto</p>
                    <div class="info-control mb-3">
                        <p class="m-0"><span><i class="fa-solid fa-at"></i></span>
                            <?= $webdata->webd_email ?>
                        </p>
                    </div>
                    <div class="info-control mb-3">
                        <p class="m-0"><span><i class="fa-solid fa-phone"></i></span>
                            <?= $webdata->webd_phone ?>
                        </p>
                    </div>
                    <div class="info-control mb-3">
                        <p class="m-0"><span><i class="fa-solid fa-location-dot"></i></span>
                            <?= $webdata->webd_address ?>
                        </p>
                    </div>
                    <div class="info-control mb-3">
                        <p class="m-0"><span><i class="fa-solid fa-earth-americas"></i></span>
                            <?= $webdata->webd_city ?>
                        </p>
                    </div>
                    <hr>
                    <p class="m-0">Redes sociales</p>
                    <div class="info-control mb-3">
                        <p class="m-0"><span><i class="fa-brands fa-facebook"></i></span>
                            <?= $webdata->webd_fblink ?>
                        </p>
                    </div>
                    <div class="info-control mb-3">
                        <p class="m-0"><span><i class="fa-brands fa-twitter"></i></span>
                            <?= $webdata->webd_twlink ?>
                        </p>
                    </div>
                    <div class="info-control mb-3">
                        <p class="m-0"><span><i class="fa-brands fa-instagram"></i></span>
                            <?= $webdata->webd_iglink ?>
                        </p>
                    </div>
                    <div class="info-control mb-3">
                        <p class="m-0"><span><i class="fa-brands fa-youtube"></i></span>
                            <?= $webdata->webd_ytlink ?>
                        </p>
                    </div>
                </div>
                <?php if(Privileges::check(Privileges::Master->get())) { ?>
                <form class="set-info hide" data-section="1" method="post" action="<?= route('dash.info.update') ?>"
                    enctype="multipart/form-data">
                    <p class="m-0">Datos del sitio web</p>
                    <div class="web-data">
                        <div class="logo">
                            <?php if($webdata->webd_logo) { ?>
                            <img class="show" width="150px" src="<?= asset($webdata->webd_logo) ?>" alt="">
                            <?php } else { ?>
                            <p class="show"
                                style="width:150px;height:150px;display:flex;justify-content:center;align-items:center;box-shadow:0 0 5px 0 lightgrey">
                                NO IMAGE</p>
                            <?php } ?>
                        </div>
                        <div>
                            <div class="position-relative d-flex mb-2">
                                <label class="form-label bg-body-secondary rounded-start-2 p-2 m-0"><i
                                        class="fa-solid fa-file-signature"></i></label>
                                <input class="ps-2 form-control border-start-0 rounded-0 rounded-end-2" name="name"
                                    type="text" value="<?= $webdata->webd_name ?>">
                            </div>
                            <div class="position-relative d-flex mb-2">
                                <label class="form-label bg-body-secondary rounded-start-2 p-2 m-0"><i
                                        class="fa-solid fa-closed-captioning"></i></label>
                                <input class="ps-2 form-control border-start-0 rounded-0 rounded-end-2" name="subt"
                                    type="text" value="<?= $webdata->webd_subt ?>">
                            </div>
                            <div class="position-relative d-flex mb-2">
                                <label class="form-label bg-body-secondary rounded-start-2 p-2 m-0"><i
                                        class="fa-solid fa-bullseye"></i></label>
                                <input class="ps-2 form-control border-start-0 rounded-0 rounded-end-2" name="mision"
                                    type="text" value="<?= $webdata->webd_m ?>">
                            </div>
                            <div class="position-relative d-flex mb-2">
                                <label class="form-label bg-body-secondary rounded-start-2 p-2 m-0"><i
                                        class="fa-solid fa-eye"></i></label>
                                <input class="ps-2 form-control border-start-0 rounded-0 rounded-end-2" name="vision"
                                    type="text" value="<?= $webdata->webd_v ?>">
                            </div>
                            <div class="position-relative d-flex mb-2">
                                <label class="form-label bg-body-secondary rounded-start-2 p-2 m-0"><i
                                        class="fa-regular fa-star"></i></label>
                                <input class="ps-2 form-control border-start-0 rounded-0 rounded-end-2 py-2"
                                    name="image" type="file">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <p class="m-0">Datos de contacto</p>
                    <div class="position-relative d-flex mb-2">
                        <label class="form-label bg-body-secondary rounded-start-2 p-2 m-0"><i
                                class="fa-solid fa-at"></i></label>
                        <input class="ps-2 form-control border-start-0 rounded-0 rounded-end-2" name="email"
                            type="text" value="<?= $webdata->webd_email ?>">
                    </div>
                    <div class="position-relative d-flex mb-2">
                        <label class="form-label bg-body-secondary rounded-start-2 p-2 m-0"><i
                                class="fa-solid fa-phone"></i></label>
                        <input class="ps-2 form-control border-start-0 rounded-0 rounded-end-2" name="phone"
                            type="text" value="<?= $webdata->webd_phone ?>">
                    </div>
                    <div class="position-relative d-flex mb-2">
                        <label class="form-label bg-body-secondary rounded-start-2 p-2 m-0"><i
                                class="fa-solid fa-location-dot"></i></label>
                        <input class="ps-2 form-control border-start-0 rounded-0 rounded-end-2" name="address"
                            type="text" value="<?= $webdata->webd_address ?>">
                    </div>
                    <div class="position-relative d-flex mb-2">
                        <label class="form-label bg-body-secondary rounded-start-2 p-2 m-0"><i
                                class="fa-solid fa-earth-americas"></i></label>
                        <input class="ps-2 form-control border-start-0 rounded-0 rounded-end-2" name="city"
                            type="text" value="<?= $webdata->webd_city ?>">
                    </div>
                    <hr>
                    <p class="m-0">Redes sociales</p>
                    <div class="position-relative d-flex mb-2">
                        <label class="form-label bg-body-secondary rounded-start-2 p-2 m-0"><i
                                class="fa-brands fa-facebook"></i></label>
                        <input class="ps-2 form-control border-start-0 rounded-0 rounded-end-2" name="fblink"
                            type="text" value="<?= $webdata->webd_fblink ?>">
                    </div>
                    <div class="position-relative d-flex mb-2">
                        <label class="form-label bg-body-secondary rounded-start-2 p-2 m-0"><i
                                class="fa-brands fa-twitter"></i></label>
                        <input class="ps-2 form-control border-start-0 rounded-0 rounded-end-2" name="twlink"
                            type="text" value="<?= $webdata->webd_twlink ?>">
                    </div>
                    <div class="position-relative d-flex mb-2">
                        <label class="form-label bg-body-secondary rounded-start-2 p-2 m-0"><i
                                class="fa-brands fa-instagram"></i></label>
                        <input class="ps-2 form-control border-start-0 rounded-0 rounded-end-2" name="iglink"
                            type="text" value="<?= $webdata->webd_iglink ?>">
                    </div>
                    <div class="position-relative d-flex mb-2">
                        <label class="form-label bg-body-secondary rounded-start-2 p-2 m-0"><i
                                class="fa-brands fa-youtube"></i></label>
                        <input class="ps-2 form-control border-start-0 rounded-0 rounded-end-2" name="ytlink"
                            type="text" value="<?= $webdata->webd_ytlink ?>">
                    </div>
                    <hr>
                    <div>
                        <div class="reverse">
                            <div class="position-relative d-flex mb-2">
                                <label class="form-label bg-body-secondary rounded-start-2 p-2 m-0"><i
                                        class="fa-solid fa-key"></i></label>
                                <input class="ps-2 form-control border-start-0 rounded-0 rounded-end-2"
                                    name="password" type="password" placeholder="Contraseña">
                            </div>
                            <div>
                                <button>Enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script src="<?= asset('js/dashboard/information.js') ?>"></script>
