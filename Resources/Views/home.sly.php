<div class="container p-4 py-6">
    <p class="title fs-1 fw-bold">Foxy MVC</p>
    <p class="fs-3">Sistema MVC basado en laravel para hosting gratuitos</p>
    <br>
    <a href="{{ route('error', ['msg' => 'service-unavailable']) }}" aria-label="Iniciar recorrido en el sistema">
        <button type="button" class="btn btn-success rounded-5 fs-4 p-3">
            <span class="mr-1"><i class="fa-solid fa-rocket"></i></span>
            Iniciar
        </button>
    </a>
    <a href="{{ route('error', ['msg' => 'service-unavailable']) }}" class="has-text-dark" aria-label="Documentación del sistema">
        <button type="button" class="btn btn-secondary rounded-5 fs-4 p-3">
            <span class="mr-1"><i class="fa-solid fa-search"></i></span>
            Documentación
        </button>
    </a>
</div>