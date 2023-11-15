<?php

namespace FoxyMVC\Lib\Cli\Command\Make;

use DateTime;

use DateTimeZone;
use FoxyMVC\Lib\Cli\Core\Base\Command;

/**
 * Clase para crear migraciones
 */
class Migration extends Command {
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
        // Define las plantillas de cada tipo de relación y la carpeta donde se guardara
        $otmMigrationTemplate = "Lib\Util\Templates\make-otm-migration.template.php";
        $mtmMigrationTemplate = "Lib\Util\Templates\make-mtm-migration.template.php";
        $migrationsFolder = "Database\Migrations";

        $this->printer->display("info", "Iniciando creación de la migración");

        // Obtiene el nombre de la migración 
        $this->printer->display("info", "Obteniendo nombre de la migración");
        $migrationName = $this->options["--name"] ?? $this->options["--n"] ?? null;
        if (!$migrationName) {
            $this->printer->error(
                "El nombre de la migración no ha sido definido",
                "Modo de uso: $ php foxy make:migration [ --name | --n ] [ Nombre ]"
            );
        }
        $this->printer->display("succ", "Nombre de la migración obtenido: " . ucfirst($migrationName));

        // Obtiene el tipo de relación si se modifica el nombre de la tabla según el tipo de relación
        $relationType = $this->options["--type"] ?? $this->options["--t"] ?? "OneToMany";
        $tableName = strtolower($migrationName);
        if ($relationType) {
            if (array_search($relationType, ["OneToMany", "ManyToMany"]) === false) $this->printer->error(
                "El tipo de relación definida no existe.",
                "Modo de uso: $ php foxy make:model [ --name | --n ] [ Nombre ] [ --type | --t ] [ OneToMany (default) | ManyToMany ]"
            );
            $relationType = strtolower($relationType);
            switch ($relationType) {
                case "onetomany":
                    if (!preg_match("/^[A-Z][a-z]*$/", $migrationName))
                        $this->printer->error(
                            "El nombre del modelo con relación OneToMany debe seguir el patron CamelCase",
                            "Ejemplo: $ php foxy make:model --n User"
                        );
                    if (preg_match("/s$/", $migrationName))
                        $this->printer->error(
                            "El nombre del modelo con relación OneToMany no debe terminar en s, esto sera añadido por el CLI dependiendo de otras variables",
                            "Ejemplo: $ php foxy make:model --n User"
                        );
                    $migrationTemplate = $otmMigrationTemplate;
                    $tableName .= "s";
                    break;
                case "manytomany":
                    if (!preg_match("/^[A-Z][a-z]*[A-Z][a-z]*$/", $migrationName))
                        $this->printer->error(
                            "El nombre del modelo con relación ManyToMany debe seguir el patron CamelCase donde cada palabra se refiera a la tabla de referencia",
                            "Ejemplo: $ php foxy make:model --n UserRole"
                        );
                    $splittedModelName = preg_split('/(?=[A-Z])/', $migrationName, -1, PREG_SPLIT_NO_EMPTY);
                    foreach ($splittedModelName as $value) {
                        if (preg_match("/s$/", $value))
                            $this->printer->error(
                                "El nombre del modelo con relación ManyToMany debe seguir el modelo CamelCase y cada palabra no debe terminar en s, esto sera añadido por le CLI de ser necesario",
                                "Ejemplo: $ php foxy make:model --n UserRole"
                            );
                    }
                    $migrationTemplate = $mtmMigrationTemplate;
                    $tableName = join("_", array_map("strtolower", $splittedModelName));
                    break;
            }
        }

        // Obtiene el contenido de la plantilla
        $this->printer->display("info", "Obteniendo plantilla de la migración en \"$migrationTemplate\"");
        $templateContent = file_get_contents($migrationTemplate);
        if (!$templateContent) {
            $this->printer->error(
                "No se ha podido cargar la plantilla de la migración",
                "Contacte con el desarrollador",
            );
        }
        $this->printer->display("succ", "La plantilla de la migración ha sido cargada");

        // Remplaza el contenido de la plantilla por la migración
        $date = new DateTime('now', new DateTimeZone('America/Bogota'));
        switch ($relationType) {
            case "onetomany":
                $migrationContent = str_replace(["__tableName", "__acronym"], [$tableName, substr($tableName, 0, 4)], $templateContent);
                break;
            case "manytomany":
                $migrationContent = str_replace(["__tableName", "__acronym"], [$tableName, ""], $templateContent);
                break;
        }

        // Genera la ruta de la migración
        $migrationPath = $migrationsFolder . "/" . $date->format("Y-m-d_Hisu") . "-" . $tableName . ".php";
        $this->printer->display("info", "Creando e la migración en \"$migrationsFolder\"");
        $migrationFile = fopen($migrationPath, "w");
        if (!$migrationFile) {
            $this->printer->error(
                "Ubo un problema al crear el archivo",
                "Contacte con el desarrollador",
            );
        }
        $this->printer->display("succ", "\"$migrationPath\" ha sido creado");

        // Escribe el contenido remplazado en el nuevo archivo
        $this->printer->display("info", "Sobrescribiendo el contenido");
        $migrationBytes = fwrite($migrationFile, $migrationContent);
        if (!$migrationBytes) {
            $this->printer->error(
                "No se ha podido sobrescribir el contenido de la plantilla",
                "Contacte con el desarrollador",
            );
        }

        // Cierra el archivo y deja un mensaje
        fclose($migrationFile);
        $this->printer->display("succ", "El contenido ha sido actualizado");
        $this->printer->display("succ", "Finalizando creación de la migración");
        $this->printer->display("info", "Accede al archivo $migrationPath para la creación de las tablas");
    }
}
