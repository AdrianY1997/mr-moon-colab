<?php

$messages = $GLOBALS["messages"] ? $GLOBALS["messages"] : [];

?>
<div class="notify absolute foxy-container center-horizontal bottom">
    <?php
    foreach ($messages as $key => $message) {
        switch ($key) {
            case 'success':
    ?>
                <div class="foxy-flex foxy-justify-between bg-success foxy-pad-3 border-top-rounded text-white">
                    <div>
                        <p class="foxy-flex"><i class="foxy-marx-2 foxy-icon foxy-icon-check"></i><?php echo $message[0]; ?></p>
                    </div>
                    <div class="notify-close">
                        <i class="foxy-icon foxy-icon-times"></i>
                    </div>
                </div>
            <?php
                break;
            case 'warning':
            ?>
                <div class="foxy-flex foxy-justify-between bg-warning foxy-pad-3 border-top-rounded text-black">
                    <div>
                        <p class="foxy-flex"><i class="foxy-marx-2 foxy-icon foxy-icon-warning"></i><?php echo $message[0]; ?></p>
                    </div>
                    <div class="notify-close">
                        <i class="foxy-icon foxy-icon-times"></i>
                    </div>
                </div>
            <?php
                break;
            case 'error':
            ?>
                <div class="foxy-flex foxy-justify-between bg-error foxy-pad-3 border-top-rounded text-white">
                    <div>
                        <p class="foxy-flex"><i class="foxy-marx-2 foxy-icon foxy-icon-times"></i><?php echo $message[0]; ?></p>
                    </div>
                    <div class="notify-close">
                        <i class="foxy-icon foxy-icon-times"></i>
                    </div>
                </div>
    <?php
                break;
        }
    }
    ?>
</div>