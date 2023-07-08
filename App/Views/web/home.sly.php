<div class="container mx-auto p-4 py-6">
    <p class="text-4xl font-bold">Foxy MVC</p>
    <p class="text-xl">Sistema MVC basado en laravel para hosting gratuitos</p>
    <br>
    <a href="{{ route('error', ['msg' => 'service-unavailable']) }}" aria-label="Iniciar recorrido en el sistema">
        <button type="button" class="btn btn-success !rounded-2xl">
            <span class="icon-container">
                <i class="fa-solid fa-rocket"></i> Iniciar
            </span>
        </button>
    </a>
    <a href="{{ route('error', ['msg' => 'service-unavailable']) }}">
        <button type="button" class="btn btn-secondary !rounded-2xl">
            <span class="icon-container">
                <i class="fa-solid fa-search"></i> Documentación
            </span>
        </button>
    </a>
</div>