<?php
use FoxyMVC\App\Models\Reservation;
?>
<style>
    .card.box1 {
        width: 350px;
        background-color: var(--color-principal);
        color: white;
        border-radius: 0
    }

    .card.box2 {
        width: 450px;
        background-color: #ffffff;
        border-radius: 0
    }

    .box2 .btn.btn-primary.bar {
        width: 20px;
        background-color: transparent;
        border: none;
        color: #3ecc6d
    }

    .box2 .btn.btn-primary.bar:hover {
        color: #baf0c3
    }

    .box1 .btn.btn-primary {
        background-color: #57c97d;
        width: 45px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #ddd
    }

    .box1 .btn.btn-primary:hover {
        background-color: #f6f8f7;
        color: #57c97d
    }


    .inputWithIcon {
        position: relative
    }

    img {
        width: 50px;
        height: 20px;
        object-fit: cover
    }

    .inputWithIcon span {
        position: absolute;
        right: 0px;
        bottom: 9px;
        color: #57c97d;
        cursor: pointer;
        transition: 0.3s;
        font-size: 14px
    }
</style>
<div class="container reserve-confirm-container d-md-flex align-items-center justify-content-center mb-5">
    <div class="card box1 shadow-sm p-4 rounded-start-3">
        <p class="fs-5 fw-bold">Detalles</p>
        <div class="align-items-center pb-2">
            <p class="m-0">Cliente:</p>
            <p class="m-0 fw-bold bg-black bg-opacity-10 px-2 py-1"><span id="cCustomer"><?= $reservation->rese_name ?>
                    <?= $reservation->rese_lastname ?></span></p>
        </div>
        <div class="row row-cols-2">
            <div class="align-items-center pb-2 col">
                <p class="m-0">Mesa:</p>
                <p class="m-0 fw-bold bg-black bg-opacity-10 px-2 py-1"><span
                        id="cTable"><?= $reservation->rese_table ?></span></p>
            </div>
            <div class="align-items-center pb-2">
                <p class="m-0">Personas:</p>
                <p class="m-0 fw-bold bg-black bg-opacity-10 px-2 py-1"><span
                        id="cPeople"><?= $reservation->rese_quantity ?></span></p>
            </div>
        </div>
        <div class="align-items-center pb-2 col">
            <p class="m-0">Dia:</p>
            <p class="m-0 fw-bold bg-black bg-opacity-10 px-2 py-1"><span id="cDate" data-date></span></p>
            <script>
                document.querySelector("[data-date]").innerHTML = new Date('<?= $reservation->rese_day ?>').toLocaleString(
                    'default', {
                        dateStyle: 'long'
                    })
            </script>
        </div>
        <div class="align-items-center pb-2">
            <p class="m-0">Hora:</p>
            <p class="m-0 fw-bold bg-black bg-opacity-10 px-2 py-1"><span id="cTime" data-time></span></p>
            <script>
                const section = {
                    "morning": {
                        "text": "Mañana",
                        "sect": "am"
                    },
                    "afternoon": {
                        "text": "Tarde",
                        "sect": "pm"
                    },
                    "night": {
                        "text": "Noche",
                        "sect": "pm"
                    },
                }
                const time = "<?= $reservation->rese_time ?>".split(":")
                document.querySelector("[data-time]").innerHTML =
                    `${section[time[0].trim()].text}: ${time[1].trim()} ${section[time[0]].sect}`;
            </script>
        </div>
        <div class="d-flex flex-column">
            <div class="row row-cols-2">
                <div class="align-items-center pb-2 col">
                    <p class="m-0">Metodo de pago:</p>
                    <p class="m-0 fw-bold bg-black bg-opacity-10 px-2 py-1"><span
                            id="cMethod"><?= $reservation->rese_method ?></span></p>
                </div>
                <div class="align-items-center pb-2">
                    <p class="m-0">Total:</p>
                    <p class="m-0 fw-bold bg-black bg-opacity-10 px-2 py-1"><span><i
                                class="fa-solid fa-dollar-sign"></i> 20.000</span></p>
                </div>
            </div>
            <div class="border-bottom mb-4"></div>
            <div class="align-items-center" style="font-size: 10pt">
                <p class="m-0">ID de reservación:</p>
                <p class="m-0 fw-bold bg-black bg-opacity-10 px-2 py-1"><span
                        id="cUrid"><?= $reservation->rese_urid ?></span></p>
            </div>
        </div>
    </div>
    <div class="card box2 shadow-sm py-4 rounded-3">
        <div class="d-flex align-items-center justify-content-between px-md-5 pb-4 px-4">
            <?php if($reservation->rese_status == Reservation::CANCELLED) { ?>
            <span class="h5 fw-bold m-0">Cancelado</span>
            <?php } ?>
            <?php if($reservation->rese_status == Reservation::WAITING_FOR_PAYMENT) { ?>
            <span class="h5 fw-bold m-0">Metodos de pago</span>
            <?php } ?>
            <?php if($reservation->rese_status == Reservation::WAITING_FOR_CONFIRMATION) { ?>
            <span class="h5 fw-bold m-0">Esperando confirmación</span>
            <?php } ?>
            <?php if($reservation->rese_status == Reservation::RESERVED) { ?>
            <span class="h5 fw-bold m-0">Confirmado</span>
            <?php } ?>
        </div>
        <ul class="nav nav-tabs mb-3 px-md-4 px-2">
            <li class="nav-item">
                <?php if($reservation->rese_method) { ?>
                <a class="nav-link px-2 active" aria-current="page" href="#"
                    id="pay-selected"><?= $reservation->rese_method ?></a>
                <?php } else { ?>
                <a class="nav-link px-2 active" aria-current="page" href="#" id="pay-selected">Nequi</a>
                <?php } ?>

            </li>
            <?php if($reservation->rese_status == Reservation::WAITING_FOR_PAYMENT) { ?>
            <li class="nav-item ms-auto position-relative">
                <a class="nav-link px-2" href="#" type="button" data-bs-toggle="collapse"
                    data-bs-target="#payment-choises" aria-expanded="false" aria-controls="payment-choises">+
                    Opciones</a>
                <div class="collapse position-absolute end-0 bg-white shadow" id="payment-choises" style="z-index: 1">
                    <p class="m-0 px-3 py-2" data-method="NEQU" data-logo="<?= asset('img/logos/nequi.webp') ?>"
                        data-img="<?= asset('img/logos/nequi-qr.png') ?>">Nequi</p>
                    <p class="m-0 px-3 py-2" data-method="AALM" data-logo="<?= asset('img/logos/ahorroalamano.webp') ?>"
                        data-img="<?= asset('img/logos/ahorroalamano-qr.png') ?>">Ahorro a la mano</p>
                    <p class="m-0 px-3 py-2" data-method="DVPT" data-logo="<?= asset('img/logos/daviplata.png') ?>"
                        data-img="<?= asset('img/logos/daviplata-qr.png') ?>">Daviplata</p>
                    <!--<p class="m-0 px-3 py-2" data-method="TPSE" data-logo="<?= asset('img/logos/pse.webp') ?>" data-img="<?= asset('img/logos/pse-qr.png') ?>">Transferencia bancaria (PSE)</p>-->
                </div>
            </li>
            <?php } ?>
        </ul>
        <div class="d-flex flex-column align-items-center mb-4">
            <div style="width: 150px;" class="mb-2">
                <?php if($reservation->rese_status == Reservation::CANCELLED) { ?>
                <img id="pay-img" src="<?= asset('img/static/cancelled.png') ?>" class="w-100 h-100" alt="">
                <?php } ?>
                <?php if($reservation->rese_status == Reservation::WAITING_FOR_PAYMENT) { ?>
                <img id="pay-img" src="<?= asset('img/logos/nequi-qr.png') ?>" class="w-100 h-100" alt="">
                <?php } ?>
                <?php if($reservation->rese_status == Reservation::WAITING_FOR_CONFIRMATION) { ?>
                <img id="pay-img" src="<?= asset('img/static/waiting.png') ?>" class="w-100 h-100" alt="">
                <?php } ?>
                <?php if($reservation->rese_status == Reservation::RESERVED) { ?>
                <img id="pay-img" src="<?= asset('img/static/check.png') ?>" class="w-100 h-100" alt="">
                <?php } ?>
            </div>
            <?php if($reservation->rese_status == Reservation::CANCELLED) { ?>
            <p id="pay-sub" class="text-center">Su reservación ha sido cancelada</p>
            <?php } ?>
            <?php if($reservation->rese_status == Reservation::WAITING_FOR_PAYMENT) { ?>
            <p id="pay-sub" class="text-center">Escanee este codigo QR<br>con su aplicación Nequi</p>
            <?php } ?>
            <?php if($reservation->rese_status == Reservation::WAITING_FOR_CONFIRMATION) { ?>
            <p id="pay-sub" class="text-center">Su pago ha sido enviado y esta<br>en proceso de confirmación</p>
            <?php } ?>
            <?php if($reservation->rese_status == Reservation::RESERVED) { ?>
            <div class="text-center">
                <p id="pay-sub" class="text-center">
                    Su pago se ha confirmado correctamente<br>
                    y se realizo la reserva<br><br>
                    ¿Desea descargar su comprobante de pago?
                </p>
                <form id="download-pdf-form" action="<?= route('reserve.download') ?>" target="_blank"
                    method="post">
                    <input type="hidden" name="urid" value="<?= $reservation->rese_urid ?>">
                    <input type="hidden" name="name" value="<?= $reservation->rese_name ?>">
                    <input type="hidden" name="last" value="<?= $reservation->rese_lastname ?>">
                    <input type="hidden" name="mail" value="<?= $reservation->rese_email ?>">
                    <input type="hidden" name="quan" value="<?= $reservation->rese_quantity ?>">
                    <input type="hidden" name="tabl" value="<?= $reservation->rese_table ?>">
                    <input type="hidden" name="date" value="">
                    <input type="hidden" name="time" value="">
                    <input type="hidden" name="meth" value="<?= $reservation->rese_method ?>">
                    <button id="download-pdf" class="btn btn-success">Descargar</button>
                </form>
            </div>
            <script>
                const dSection = {
                    "morning": {
                        "text": "Mañana",
                        "sect": "am"
                    },
                    "afternoon": {
                        "text": "Tarde",
                        "sect": "pm"
                    },
                    "night": {
                        "text": "Noche",
                        "sect": "pm"
                    },
                }

                document.querySelector("[name='date']").value = new Date('<?= $reservation->rese_day ?>').toLocaleString(
                    'default', {
                        dateStyle: 'long'
                    })

                const dTime = "<?= $reservation->rese_time ?>".split(":")
                document.querySelector("[name='time']").value =
                    `${dSection[dTime[0].trim()].text}: ${dTime[1].trim()} ${dSection[time[0]].sect}`;
            </script>
            <?php } ?>
        </div>
        <?php if($reservation->rese_status == Reservation::WAITING_FOR_PAYMENT) { ?>
        <form id="pay-form" action="<?= route('reserve.confirm') ?>" enctype="multipart/form-data">
            <div class="col">
                <div class="col-12">
                    <div class="d-flex flex-column px-md-5 px-4 mb-4">
                        <div class="inputWithIcon form-group" style="cursor: pointer" id="pay-input">
                            <div class="form-control">
                                <p class="m-0" id="pay-input-text">Elejir archivo</p>
                            </div>
                            <div>
                                <input class="form-control d-none" type="file">
                                <input class="form-control d-none" type="text" id="pay-id-input" name="id"
                                    value="<?= $reservation->rese_urid ?>">
                                <span class="">
                                    <img style="width: fit-content" class="me-2" id="pay-logo"
                                        src="<?= asset('img/logos/nequi.webp') ?>" alt="">
                                </span>
                            </div>
                        </div>
                        <p class="mt-3">Confirme su reservación subiendo una captura de pantalla de la transferencia
                        </p>
                    </div>
                </div>
                <div class="col-12 px-md-5 px-4 mt-3">
                    <button type="submit" class="btn btn-primary w-100">Confirmar</button>
                </div>
            </div>
        </form>
        <?php } else { ?>
        <div class="col">
            <div class="col-12">
                <div class="d-flex flex-column px-md-5 px-4 mb-4">
                    <?php if($reservation->rese_status == Reservation::CANCELLED) { ?>
                    <p class="fs-5 m-0 border-bottom border-1">Detalles</p>
                    <p class="mt-2"><?= $reservation->rese_details ?></p>
                    <?php } ?>
                    <?php if($reservation->rese_status == Reservation::WAITING_FOR_PAYMENT) { ?>
                    <p class="mt-3">Confirme su reservación subiendo una captura de pantalla de la transferencia</p>
                    <?php } ?>
                    <?php if($reservation->rese_status == Reservation::WAITING_FOR_CONFIRMATION) { ?>
                    <p class="mt-3">Sera notificado mediante correo electronico</p>
                    <?php } ?>
                </div>
            </div>
            <div class="col-12 px-md-5 px-4 mt-3">
                <a href="<?= route(constant('HOME')) ?>" type="submit" class="btn btn-primary w-100">Volver al
                    inicio</a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<script src="<?= asset('js/reservation/confirm.js') ?>"></script>
