<div class="menu">
    <div class="title" style="background-image: url(<?= asset('img/menu/menu-title-img.jpg') ?>)">
        <h1>Menu</h1>
    </div>
    <div class="carousel">
        <div class="container">
            <div class="images">
                <?php foreach($menus as $menu) { ?>
                <div class="image">
                    <div>
                        <p>Bebidas</p>
                    </div>
                    <img class="w-100" src="<?= asset($menu->menu_path) ?>" alt="">
                </div>
                <?php } ?>
                <div class="slider-btn">
                    <span data-function="carousel-btn" data-type="slider" data-param="left"><i class="fa-solid fa-chevron-left"></i></span>
                    <span data-function="carousel-btn" data-type="slider" data-param="right"><i class="fa-solid fa-chevron-right"></i></span>
                </div>
            </div>
            <div class="dots">
                <span data-function="carousel-btn" data-type="ebtn" data-param="0"></span>
                <span data-function="carousel-btn" data-type="ebtn" data-param="1" class="active"></span>
                <span data-function="carousel-btn" data-type="ebtn" data-param="2"></span>
            </div>
        </div>
    </div>
    <div class="carousel-complete">
        <div class="container">
            <div class="images">
                <?php foreach($menus as $menu) { ?>
                <div class="image active">
                    <img class="w-100" src="<?= asset($menu->menu_path) ?>" alt="">
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script src="<?= asset("js/carousel.js") ?>"></script>
