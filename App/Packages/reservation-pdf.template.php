<?php

function getImage()
{
    $path = constant("BASE_URL") . "Public/img/static/mr_moon_logo.png";
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    return $base64;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="./bs3.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>
</head>

<body>
    <div class="container-fluid" style="padding: .5rem 1rem;">
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td><h1 style="margin: 0;">Comprobante</h1></td>
                    <td><img src="<?= getImage() ?>" width="50" height="50" /></td>
                </tr>
            </tbody>
        </table>
        <hr>
        <div class="row">
            <div class="col-xs-10">
                <h1 class="h6" style="font-size: 12pt; margin: 0;">Mr. Moon - Coffee & Bar</h1>
                <h1 class="h6" style="font-size: 12pt; margin: 0; color: gray"><?= constant("BASE_URL") ?></h1>
            </div>
            <br>
            <div class="col-xs-2 text-center">
                <strong>Factura No.</strong>
                <br>
                <?= $data["urid"]  ?>
                <br>
                <br>
                <strong>Fecha</strong>
                <br>
                <?= $data["date"] ?>
            </div>
        </div>
        <hr>
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="text-align: center;">
                        <h1 style="margin: 0;" class="h2">Cliente</h1>
                        <strong><?= $data["name"] . " " . $data["last"] ?></strong>
                    </td>
                    <td style="text-align: center;">
                <h1 style="margin: 0;" class="h2">Remitente</h1>
                <strong><?= constant("SITE") ?></strong>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-condensed table-bordered table-striped" style="border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th style="text-align: left; border-bottom: 1px solid black; padding-left: .5rem;">Mesa</th>
                            <th style="text-align: left; border-bottom: 1px solid black; border-left: 1px solid black; padding-left: .5rem;">Personas</th>
                            <th style="text-align: left; border-bottom: 1px solid black; border-left: 1px solid black; padding-left: .5rem;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding-left: .5rem; "><?= $data["tabl"] ?></td>
                            <td style="padding-left: .5rem; border-left: 1px solid black"><?= $data["quan"] ?></td>
                            <td style="text-align: right;padding-left: .5rem; border-left: 1px solid black">$ 20.000</td>
                        </tr>
                    </tbody>
                </table>
                <p style="border-top: 1px solid gray; margin: 0; margin-top: .5rem; padding-top: .5rem"><span style="font-weight: bold;">Método de pago:</span> <?= $rese->rese_method ?></p>
                <p><?= $rese->rese_details ?: "No se definieron detalles adicionales" ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <!-- <p class="h5"><?php echo $mensajePie ?></p> -->
            </div>
        </div>
    </div>
</body>

</html>