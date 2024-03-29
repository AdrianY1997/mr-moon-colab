@isset($notifications['success']):
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white" style="margin-bottom: -3px;">
            <i class="fa-solid fa-check-circle"></i>
            <strong class="me-auto ms-2">Acceso permitido</strong>
            <small>now</small>
            <button type="button" class="btn p-0 m-0 ps-2" data-bs-dismiss="toast" aria-label="Close"><i class="fa-solid fa-times text-white"></i></button>
        </div>
        <div class="toast-loader bg-white notification-loader"></div>
        <div class="toast-body">
            {{ $notifications['success'] }}
        </div>
    </div>
</div>
@endisset

@isset($notifications['warning']):
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-warning text-white" style="margin-bottom: -3px;">
            <i class="fa-solid fa-check-circle"></i>
            <strong class="me-auto ms-2">Warning</strong>
            <small>now</small>
            <button type="button" class="btn p-0 m-0 ps-2" data-bs-dismiss="toast" aria-label="Close"><i class="fa-solid fa-times text-white"></i></button>
        </div>
        <div class="toast-loader bg-white notification-loader"></div>
        <div class="toast-body">
            {{ $notifications['warning'] }}
        </div>
    </div>
</div>
@endisset

@isset($notifications['error']):
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white" style="margin-bottom: -3px;">
            <i class="fa-solid fa-check-circle"></i>
            <strong class="me-auto ms-2">Acceso denegado</strong>
            <small>now</small>
            <button type="button" class="btn p-0 m-0 ps-2" data-bs-dismiss="toast" aria-label="Close"><i class="fa-solid fa-times text-white"></i></button>
        </div>
        <div class="toast-loader bg-white notification-loader"></div>
        <div class="toast-body">
            {{ $notifications['error'] }}
        </div>
    </div>
</div>
@endisset
@php
unset ($_COOKIE ['messages']);
setcookie ('messages', '', time () - 3600, '/');
@endphp
