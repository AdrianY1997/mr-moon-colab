<?php

namespace FoxyMVC\Lib\Cli\Command\Make;

use FoxyMVC\Lib\Cli\Core\Base\Command;

/**
 * Clase para crear migraciones
 */
class Model extends Command {
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
     * Inicializa el proceso de copia de seguridad
     *
     * @return void
     */
    public function init() {
        // Define las plantillas del modelo y la carpeta donde se guardara
        $modelTemplate = "Lib\Util\Templates\make-model.template.php";
        $modelsFolder = "App\Models";

        $this->printer->display("info", "Iniciando creación del modelo");

        // Obtiene el nombre del modelo
        $this->printer->display("info", "Obteniendo nombre del modelo");
        $modelName = ucfirst($this->options["--name"] ?? $this->options["--n"] ?? null);
        if (!$modelName) {
            $this->printer->error(
                "El nombre del modelo no ha sido definido",
                "Modo de uso: $ php foxy make:model [ --name | --n ] [ Nombre ]"
            );
        }
        $this->printer->display("succ", "Nombre del modelo obtenido: $modelName");

        // Obtiene el tipo de relación si se modifica el nombre de la tabla según el tipo de relación
        $relationType = $this->options["--type"] ?? $this->options["--t"] ?? "OneToMany";
        $tableName = strtolower($modelName);
        if ($relationType) {
            if (array_search($relationType, ["OneToMany", "ManyToMany"]) === false) $this->printer->error(
                "El tipo de relación definida no existe.",
                "Modo de uso: $ php foxy make:model [ --name | --n ] [ Nombre ] [ --type | --t ] [ OneToMany (default) | ManyToMany ]"
            );
            $relationType = strtolower($relationType);
            switch ($relationType) {
                case "onetomany":
                    if (!preg_match("/^[A-Z][a-z]*$/", $modelName))
                        $this->printer->error(
                            "El nombre del modelo con relación OneToMany debe seguir el patron CamelCase",
                            "Ejemplo: $ php foxy make:model --n User"
                        );
                    if (preg_match("/s$/", $modelName))
                        $this->printer->error(
                            "El nombre del modelo con relación OneToMany no debe terminar en s, esto sera añadido por el CLI dependiendo de otras variables",
                            "Ejemplo: $ php foxy make:model --n User"
                        );
                    $tableName .= "s";
                    break;
                case "manytomany":
                    if (!preg_match("/^[A-Z][a-z]*[A-Z][a-z]*$/", $modelName))
                        $this->printer->error(
                            "El nombre del modelo con relación ManyToMany debe seguir el patron CamelCase donde cada palabra se refiera a la tabla de referencia",
                            "Ejemplo: $ php foxy make:model --n UserRole"
                        );
                    $splittedModelName = preg_split('/(?=[A-Z])/', $modelName, -1, PREG_SPLIT_NO_EMPTY);
                    foreach ($splittedModelName as $key => $value) {
                        if (preg_match("/s$/", $value))
                            $this->printer->error(
                                "El nombre del modelo con relación ManyToMany debe seguir el modelo CamelCase y cada palabra no debe terminar en s, esto sera añadido por le CLI de ser necesario",
                                "Ejemplo: $ php foxy make:model --n UserRole"
                            );
                    }
                    $tableName = join("_", array_map("strtolower", $splittedModelName));
                    break;
            }
        }


        // Obtiene el contenido de la plantilla
        $this->printer->display("info", "Obteniendo plantilla del modelo en \"$modelTemplate\"");
        $templateContent = file_get_contents($modelTemplate);
        if (!$templateContent) {
            $this->printer->error(
                "No se ha podido cargar la plantilla del modelo",
                "Contacte con el desarrollador",
            );
        }
        $this->printer->display("succ", "La plantilla del modelo ha sido cargada");

        // Remplaza el contenido de la plantilla por el modelo
        $modelContent = str_replace(["__model", "__tableName"], [$modelName, $tableName], $templateContent);

        // Genera la ruta del modelo
        $modelPath = $modelsFolder . "/" . $modelName . ".php";
        $this->printer->display("info", "Creando modelo en \"$modelsFolder\"");
        $modelFile = fopen($modelPath, "w");
        if (!$modelFile) {
            $this->printer->error(
                "Ubo un problema al crear el archivo",
                "Contacte con el desarrollador",
            );
        }
        $this->printer->display("succ", "\"$modelPath\" ha sido creado");

        // Escribe el contenido remplazado en el nuevo archivo
        $this->printer->display("info", "Sobrescribiendo el contenido");
        $modelBytes = fwrite($modelFile, $modelContent);
        if (!$modelBytes) {
            $this->printer->error(
                "No se ha podido sobrescribir el contenido de la plantilla",
                "Contacte con el desarrollador",
            );
        }

        // Cierra el archivo y deja un mensaje
        fclose($modelFile);
        $this->printer->display("succ", "El contenido ha sido actualizado");
        $this->printer->display("succ", "Finalizando creación del modelo");

        // Inicia la migración con los mismos argumentos
        $migration = new Migration($this->property, $this->options);
        $migration->init();
    }
}
