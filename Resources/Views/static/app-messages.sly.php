@isset($notifications["success"])
<div class="red-msg">
    <div class="success">
        <p class="m-1">{{ $notifications["success"] }}</p>
        <p class="close m-1"><i class="fa-solid fa-times"></i></p>
    </div>
</div>
@endisset

@isset($notifications["warning"])
<div class="red-msg">
    <div class="warning">
        <p class="m-1">{{ $notifications["warning"] }}</p>
        <p class="close m-1"><i class="fa-solid fa-times"></i></p>
    </div>
</div>
@endisset

@isset($notifications["error"])
<div class="red-msg">
    <div class="error">
        <p class="m-1">{{ $notifications["error"] }}</p>
        <p class="close m-1"><i class="fa-solid fa-times"></i></p>
    </div>
</div>
@endisset