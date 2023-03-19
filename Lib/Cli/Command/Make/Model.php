<?php

namespace Lib\Cli\Command\Make;

use Lib\Cli\Core\Base\Command;

class Model extends Command
{
    public function __construct($pro, $avs)
    {
        parent::__construct($pro, $avs);
    }

    public function init()
    {
        $modelTemplate = "Lib/Util/Templates/make-model.template.php";
        $modelsFolder = "App/Models";

        $this->printer->display("info", "Iniciando creación del modelo");

        $this->printer->display("info", "Obteniendo nombre del modelo");
        $modelName = $this->options["--name"] ?? $this->options["--n"] ?? null;

        if (!$modelName) {
            $this->printer->error(
                "El nombre del modelo no ha sido definido",
                "Modo de uso: $ php foxy make:model [ --name | --n ] [nombre]"
            );
        }

        $this->printer->display("succ", "Nombre del modelo obtenido: " . ucfirst($modelName));

        $this->printer->display("info", "Obteniendo plantilla del modelo en \"$modelTemplate\"");
        $templateContent = file_get_contents($modelTemplate);

        if (!$templateContent) {
            $this->printer->error(
                "No se ha podido cargar la plantilla del modelo",
                "Contacte con el desarrollador",
            );
        }

        $this->printer->display("succ", "La plantilla del modelo ha sido cargada");

        $modelContent = str_replace(["__model", "__tableName"], [ucfirst($modelName), $modelName . "s"], $templateContent);

        $modelPath = $modelsFolder . "/" . ucfirst($modelName) . ".php";

        $this->printer->display("info", "Creando modelo en \"$modelsFolder\"");

        $modelFile = fopen($modelPath, "w");

        if (!$modelFile) {
            $this->printer->error(
                "Ubo un problema al crear el archivo",
                "Contacte con el desarrollador",
            );
        }

        $this->printer->display("succ", "\"$modelPath\" ha sido creado");

        $this->printer->display("info", "Sobrescribiendo el contenido");

        $modelBytes = fwrite($modelFile, $modelContent);

        if (!$modelBytes) {
            $this->printer->error(
                "No se ha podido sobrescribir el contenido de la plantilla",
                "Contacte con el desarrollador",
            );
        }

        fclose($modelFile);

        $this->printer->display("succ", "El contenido ha sido actualizado");
        $this->printer->display("succ", "Finalizando creación del modelo");

        $migration = new Migration($this->property, $this->options);
        $migration->init();
    }
}
