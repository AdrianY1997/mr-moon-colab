<div class="error-container container align-self-center">
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-bg">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <h1 class="pt-2">oops!</h1>
            <h2>Error {{ $num }} : {{ $cod }}</h2>
            <a href="{{ route(constant("HOME")) }}">go home</a>
            <div class="notfound-social pb-3">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-pinterest"></i></a>
                <a href="#"><i class="fa-brands fa-google-plus"></i></a>
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelector("main").style.setProperty("display", "flex");

</script>
