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
        <div class="fw-bolder mb-4"><span class="fas fa-dollar-sign"></span><span class="ps-1">599,00</span></div>
        <div class="d-flex flex-column">
            <div class="d-flex align-items-center justify-content-between text"> <span class="">Commission</span> <span class="fas fa-dollar-sign"><span class="ps-1">1.99</span></span> </div>
            <div class="d-flex align-items-center justify-content-between text mb-4"> <span>Total</span> <span class="fas fa-dollar-sign"><span class="ps-1">600.99</span></span> </div>
            <div class="border-bottom mb-4"></div>
            <div class="mb-4 align-items-center">
                <p class="m-0">ID de reservación:</p>
                <p><span>{{$reservation->rese_urid}}</span></p>
            </div>
            <div class="align-items-center">
                <p class="m-0">Dia:</p>
                <p><span data-date></span></p>
                <script>
                    document.querySelector("[data-date]").innerHTML = new Date('{{$reservation->rese_day}}').toLocaleString('default', { dateStyle: 'long' })
                </script>
            </div>
            <div class="align-items-center">
                <p class="m-0">Hora:</p>
                <p>{{$reservation->rese_time}}</p>
            </div>
        </div>
    </div>
    <div class="card box2 shadow-sm py-4">
        <div class="d-flex align-items-center justify-content-between px-md-5 pb-5 px-4"> <span class="h5 fw-bold m-0">Payment methods</span>
            <div class="btn btn-primary bar"><span class="fas fa-bars"></span></div>
        </div>
        <ul class="nav nav-tabs mb-3 px-md-4 px-2">
            <li class="nav-item"> <a class="nav-link px-2 active" aria-current="page" href="#">Credit Card</a> </li>
            <li class="nav-item"> <a class="nav-link px-2" href="#">Mobile Payment</a> </li>
            <li class="nav-item ms-auto"> <a class="nav-link px-2" href="#">+ More</a> </li>
        </ul>
        <div class="px-md-5 px-4 mb-4 d-flex align-items-center">
            <div class="btn btn-success me-4"><span class="fas fa-plus"></span></div>
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group"> <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked> <label class="btn btn-outline-primary" for="btnradio1"><span class="pe-1">+</span>5949</label> <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off"> <label class="btn btn-outline-primary" for="btnradio2"><span class="lpe-1">+</span>3894</label> </div>
        </div>
        <form action="">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex flex-column px-md-5 px-4 mb-4"> <span>Credit Card</span>
                        <div class="inputWithIcon"> <input class="form-control" type="text" value="5136 1845 5468 3894"> <span class=""> <img src="https://www.freepnglogos.com/uploads/mastercard-png/mastercard-logo-logok-15.png" alt=""></span> </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-column ps-md-5 px-md-0 px-4 mb-4"> <span>Expiration<span class="ps-1">Date</span></span>
                        <div class="inputWithIcon"> <input type="text" class="form-control" value="05/20"> <span class="fas fa-calendar-alt"></span> </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-column pe-md-5 px-md-0 px-4 mb-4"> <span>Code CVV</span>
                        <div class="inputWithIcon"> <input type="password" class="form-control" value="123"> <span class="fas fa-lock"></span> </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex flex-column px-md-5 px-4 mb-4"> <span>Name</span>
                        <div class="inputWithIcon"> <input class="form-control text-uppercase" type="text" value="valdimir berezovkiy"> <span class="far fa-user"></span> </div>
                    </div>
                </div>
                <div class="col-12 px-md-5 px-4 mt-3">
                    <div class="btn btn-primary w-100">Pay $599.00</div>
                </div>
            </div>
        </form>
    </div>
</div>
