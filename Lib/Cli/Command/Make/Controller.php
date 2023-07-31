<?php

namespace FoxyMVC\Lib\Cli\Command\Make;

use FoxyMVC\Lib\Cli\Core\Base\Command;

/**
 * Clase para crear controladores
 */
class Controller extends Command {
    /**
     * Constructor de la clase Backup
     *
     * @param array $pro Propiedades
     * @param array $avs Argumentos
     */
    public function __construct($pro, $avs) {
        parent::__construct($pro, $avs);
    }

    /**
     * Inicializa la creación del controlador
     *
     * @return void
     */
    public function init() {
        // Define la plantilla y la carpeta donde se guardara
        $controllerTemplate = "Lib\Util\Templates\make-controller.template.php";
        $controllersFolder = "App\Controllers";

        $this->printer->display("info", "Iniciando creación del controlador");

        // Obtiene el nombre del controlador
        $this->printer->display("info", "Obteniendo nombre del controlador");
        $controllerName = $this->options["--name"] ?? $this->options["--n"] ?? null;
        if (!$controllerName) {
            $this->printer->error(
                "El nombre del controlador no ha sido definido",
                "Modo de uso: $ php foxy make:controller [ --name | --n ] [nombre]"
            );
        }
        $this->printer->display("succ", "Nombre del controlador obtenido: " . ucfirst($controllerName));

        // Obtiene el contenido de la plantilla
        $this->printer->display("info", "Obteniendo plantilla del controlador en \"$controllerTemplate\"");
        $templateContent = file_get_contents($controllerTemplate);
        if (!$templateContent) {
            $this->printer->error(
                "No se ha podido cargar la plantilla del controlador",
                "Contacte con el desarrollador",
            );
        }
        $this->printer->display("succ", "La plantilla del controlador ha sido cargada");

        // Remplaza el contenido de la plantilla con la información del controlador
        $controllerContent = str_replace("__controller", ucfirst($controllerName), $templateContent);

        // Crea el archivo en la ruta de controladores
        $controllerPath = $controllersFolder . "\\" . ucfirst($controllerName) . "Controller.php";
        $this->printer->display("info", "Creando el controlador en \"$controllersFolder\"");
        $controllerFile = fopen($controllerPath, "w");
        if (!$controllerFile) {
            $this->printer->error(
                "Hubo un problema al crear el archivo",
                "Contacte con el desarrollador",
            );
        }
        $this->printer->display("succ", "\"$controllerPath\" ha sido creado");

        // Escribe el contenido remplazado en el nuevo archivo
        $this->printer->display("info", "Sobrescribiendo el contenido");
        $controllerBytes = fwrite($controllerFile, $controllerContent);
        if (!$controllerBytes) {
            $this->printer->error(
                "No se ha podido sobrescribir el contenido de la plantilla",
                "Contacte con el desarrollador",
            );
        }

        // Cierra el archivo y deja un mensaje
        fclose($controllerFile);
        $this->printer->display("succ", "El contenido ha sido actualizado");
        $this->printer->display("succ", "Finalizando creación del controlador");
    }
}