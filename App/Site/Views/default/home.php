<div class="container p-4 py-6">
    <p class="title is-1">Foxy MVC</p>
    <p>Sistema MVC basado en laravel para hosting gratuitos</p>
    <br>
    <button class="button is-rounded is-primary">
        <a href="<?= route("error", ["msg" => "service-unavailable"]) ?>" class="has-text-white">
            <span class="mr-1"><i class="fa-solid fa-rocket"></i></span>
            Iniciar
        </a>
    </button>
    <button class="button is-rounded is-light">
        <a href="<?= route("error", ["msg" => "service-unavailable"]) ?>" class="has-text-dark">
            <span class="mr-1"><i class="fa-solid fa-search"></i></span>
            Descubre
        </a>
    </button>
</div>