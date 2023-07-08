<div class="reservas">
    <div class="title" style="background-image: url({{ asset('img/reservas/reservas-title-img.png') }});">
        <h1>Reservas</h1>
    </div>

    <div class="container">
        <div class="card p-4 my-4">
            <form action="{{ route("reserve.search") }}" method="post">
                <div class="form-floating mb-4">
                    <input class="form-control border shadow fs-6" style="margin-bottom: 1px" type="text" name="urid" id="urid" placeholder="ID">
                    <label for="email">ID de reserva </label>
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>
    </div>
</div>
