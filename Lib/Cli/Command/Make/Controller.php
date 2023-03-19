<?php

namespace Lib\Cli\Command\Make;

use Lib\Cli\Core\Base\Command;

class Controller extends Command
{
    public function __construct($pro, $avs)
    {
        parent::__construct($pro, $avs);
    }

    public function init()
    {
        $controllerTemplate = "Lib/Util/Templates/make-controller.template.php";
        $controllersFolder = "App/Site/Controllers";

        $this->printer->display("info", "Iniciando creación del controlador");

        $this->printer->display("info", "Obteniendo nombre del controlador");
        $controllerName = $this->options["--name"] ?? $this->options["--n"] ?? null;

        if (!$controllerName) {
            $this->printer->error(
                "El nombre del controlador no ha sido definido",
                "Modo de uso: $ php foxy make:controller [ --name | --n ] [nombre]"
            );
        }

        $this->printer->display("succ", "Nombre del controlador obtenido: " . ucfirst($controllerName));

        $this->printer->display("info", "Obteniendo plantilla del controlador en \"$controllerTemplate\"");
        $templateContent = file_get_contents($controllerTemplate);

        if (!$templateContent) {
            $this->printer->error(
                "No se ha podido cargar la plantilla del controlador",
                "Contacte con el desarrollador",
            );
        }

        $this->printer->display("succ", "La plantilla del controlador ha sido cargada");

        $controllerContent = str_replace("__controller", ucfirst($controllerName), $templateContent);

        $controllerPath = $controllersFolder . "/" . ucfirst($controllerName) . "Controller.php";

        $this->printer->display("info", "Creando el controlador en \"$controllersFolder\"");

        $controllerFile = fopen($controllerPath, "w");

        if (!$controllerFile) {
            $this->printer->error(
                "Ubo un problema al crear el archivo",
                "Contacte con el desarrollador",
            );
        }

        $this->printer->display("succ", "\"$controllerPath\" ha sido creado");

        $this->printer->display("info", "Sobrescribiendo el contenido");

        $controllerBytes = fwrite($controllerFile, $controllerContent);

        if (!$controllerBytes) {
            $this->printer->error(
                "No se ha podido sobrescribir el contenido de la plantilla",
                "Contacte con el desarrollador",
            );
        }

        fclose($controllerFile);

        $this->printer->display("succ", "El contenido ha sido actualizado");
        $this->printer->display("succ", "Finalizando creación del controlador");
    }
}
