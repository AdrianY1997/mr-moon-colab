<?php

if (isset($messages["error"])) {
    $array = $messages["error"];

    foreach ($array as $key => $value) {
        ?>

        <div class="red-msg container">
            <div class="error">
                <p>
                    <?= $value ?>
                </p>
                <p class="close"><i class="fa-solid fa-times"></i></p>
            </div>
        </div>

        <?php
    }
}

if (isset($messages["success"])) {
    $array = $messages["success"];

    foreach ($array as $key => $value) {
        ?>

        <div class="red-msg container">
            <div class="success">
                <p>
                    <?= $value ?>
                </p>
                <p class="close"><i class="fa-solid fa-times"></i></p>
            </div>
        </div>

        <?php
    }
}

?>