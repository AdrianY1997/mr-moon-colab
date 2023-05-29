@if ($reservation)
<div class="container reserve-confirm-container">
    <div class="card">
        <div class="card-header">
            <h1>Confirme su reserva</h1>
        </div>
        <div class="card-body">
            <form action="#" method="post">
                <input type="file">
            </form>
        </div>
        <div class="card-footer">
            <p>Tiene una hora para confirmar su reserva</p>
        </div>
    </div>
</div>
@else
<div class="container reserve-confirm-container">
    <div class="card">
        <div class="card-header">
            <h1>Confirme</h1>
        </div>
        <div class="card-body">
            <form action="#" method="post">
                <input type="file">
            </form>
        </div>
        <div class="card-footer">
            <p>Tiene una hora para confirmar su reserva</p>
        </div>
    </div>
</div>
@endif
