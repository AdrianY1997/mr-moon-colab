<div class="dash dash-home">
    <div>
        <div class="container">
            @extend('dashboard/static/menu', $data)
            <div class="content">
                <p>Bienvenido de nuevo
                    <?= $user ?>
                </p>
            </div>
        </div>
    </div>
</div>
