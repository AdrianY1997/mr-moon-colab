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
<div class="container reserve-confirm-container bg-light d-md-flex align-items-center justify-content-center mb-4">
    <div class="card box1 shadow-sm p-md-5 p-md-5 p-5 px-3">
        <p class="fs-5">Detalles</p>
        <div class="align-items-center pb-2">
            <p class="m-0">A nombre de:</p>
            <p class="m-0"><span>{{$reservation->rese_name}} {{$reservation->rese_lastname}}</span></p>
        </div>
        <div class="row row-cols-2">
            <div class="align-items-center pb-2 col">
                <p class="m-0">Mesa:</p>
                <p class="m-0"><span>{{$reservation->rese_table}}</span></p>
            </div>
            <div class="align-items-center pb-2">
                <p class="m-0">Personas:</p>
                <p class="m-0"><span>{{$reservation->rese_quantity}}</span></p>
            </div>
        </div>
        <div class="align-items-center pb-2 col">
            <p class="m-0">Dia:</p>
            <p class="m-0"><span data-date></span></p>
            <script>
                document.querySelector("[data-date]").innerHTML = new Date('{{$reservation->rese_day}}').toLocaleString('default', {
                    dateStyle: 'long'
                })

            </script>
        </div>
        <div class="align-items-center pb-2">
            <p class="m-0">Hora:</p>
            <p class="m-0"><span data-time></span></p>
            <script>
                const section = {
                    "morning": {
                        "text": "Mañana"
                        , "sect": "am"
                    }
                    , "afternoon": {
                        "text": "Tarde"
                        , "sect": "pm"
                    }
                    , "evening": {
                        "text": "Noche"
                        , "sect": "pm"
                    }
                , }
                const time = "{{$reservation->rese_time}}".split(":")
                document.querySelector("[data-time]").innerHTML = `${section[time[0].trim()].text}: ${time[1].trim()} ${section[time[0]].sect}`;

            </script>
        </div>
        <div class="d-flex flex-column">
            <div class="d-flex align-items-center justify-content-between text mb-4"> <span>Total</span> <span class="fas fa-dollar-sign"><span class="ps-1">600.99</span></span> </div>
            <div class="border-bottom mb-4"></div>
            <div class="align-items-center">
                <p class="m-0">ID de reservación:</p>
                <p><span>{{$reservation->rese_urid}}</span></p>
            </div>
        </div>
    </div>
    <div class="card box2 shadow-sm py-4">
        <div class="d-flex align-items-center justify-content-between px-md-5 pb-4 px-4">
            <span class="h5 fw-bold m-0">Metodos de pago</span>
        </div>
        <ul class="nav nav-tabs mb-3 px-md-4 px-2">
            <li class="nav-item"> <a class="nav-link px-2 active" aria-current="page" href="#" id="pay-selected">Nequi</a> </li>
            <li class="nav-item ms-auto position-relative">
                <a class="nav-link px-2" href="#" type="button" data-bs-toggle="collapse" data-bs-target="#payment-choises" aria-expanded="false" aria-controls="payment-choises">+ Opciones</a>
                <div class="collapse position-absolute end-0 bg-white shadow" id="payment-choises" style="z-index: 1">
                    <p class="m-0 px-3 py-2" data-method="NEQU" data-logo="{{ asset("img/logos/nequi.webp") }}" data-img="{{ asset("img/qr.jpg") }}">Nequi</p>
                    <p class="m-0 px-3 py-2" data-method="AALM" data-logo="{{ asset("img/logos/ahorroalamano") }}" data-img="{{ asset("img/qr.jpg") }}">Ahorro a la mano</p>
                    <p class="m-0 px-3 py-2" data-method="DVPT" data-logo="{{ asset("img/logos/daviplata") }}" data-img="{{ asset("img/qr.jpg") }}">Daviplata</p>
                    <p class="m-0 px-3 py-2" data-method="TPSE" data-logo="{{ asset("img/logos/pse") }}" data-img="{{ asset("img/qr.jpg") }}">Transferencia bancaria (PSE)</p>
                </div>
            </li>
        </ul>
        <div class="d-flex flex-column align-items-center mb-4">
            <div style="width: 150px;" class="mb-2">
                <img id="pay-img" src="{{ asset("img/qr.jpg") }}" class="w-100 h-100" alt="">
            </div>
            <p>Escanee este codigo QR<br>con su aplicación Nequi</p>
        </div>
        <form action="">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex flex-column px-md-5 px-4 mb-4">
                        <span class="mb-2">Captura de pantalla:</span>
                        <div class="inputWithIcon form-group">
                            <div class="form-control">
                                <p class="m-0">Elejir archivo</p>
                            </div>
                            <input class="form-control d-none" type="file"> <span class=""> <img style="width: fit-content" class="me-2" id="pay-logo" src="{{ asset("img/logos/nequi.webp") }}" alt=""></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 px-md-5 px-4 mt-3">
                    <div class="btn btn-primary w-100">Confirmar</div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{{asset("js/reservation/confirm.js")}}"></script>
