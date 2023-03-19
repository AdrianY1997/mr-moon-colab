<?php

namespace Lib\Cli\Command\Make;

use DateTime;
use DateTimeZone;
use Lib\Cli\Core\Base\Command;

class Migration extends Command
{
    public function __construct($pro, $avs)
    {
        parent::__construct($pro, $avs);
    }

    public function init()
    {
        $migrationTemplate = "Lib/Util/Templates/make-migration.template.php";
        $migrationsFolder = "Database/Migrations";

        $this->printer->display("info", "Iniciando creación de la migración");

        $this->printer->display("info", "Obteniendo nombre de la migración");
        $migrationName = $this->options["--name"] ?? $this->options["--n"] ?? null;

        if (!$migrationName) {
            $this->printer->error(
                "El nombre de la migración no ha sido definido",
                "Modo de uso: $ php foxy make:migration [ --name | --n ] [nombre]"
            );
        }

        $this->printer->display("succ", "Nombre de la migración obtenido: " . ucfirst($migrationName));

        $this->printer->display("info", "Obteniendo plantilla de la migración en \"$migrationTemplate\"");
        $templateContent = file_get_contents($migrationTemplate);

        if (!$templateContent) {
            $this->printer->error(
                "No se ha podido cargar la plantilla de la migración",
                "Contacte con el desarrollador",
            );
        }

        $this->printer->display("succ", "La plantilla de la migración ha sido cargada");

        $migrationContent = str_replace(["__tableName", "__acronym"], [$migrationName, substr($migrationName, 0, 4)], $templateContent);

        $date = new DateTime('now', new DateTimeZone('America/Bogota'));
        $migrationPath = $migrationsFolder . "/" . $date->format("Y-m-d_Hisu") . "-" . $migrationName . ".php";

        $this->printer->display("info", "Creando e la migración en \"$migrationsFolder\"");

        $migrationFile = fopen($migrationPath, "w");

        if (!$migrationFile) {
            $this->printer->error(
                "Ubo un problema al crear el archivo",
                "Contacte con el desarrollador",
            );
        }

        $this->printer->display("succ", "\"$migrationPath\" ha sido creado");

        $this->printer->display("info", "Sobrescribiendo el contenido");

        $migrationBytes = fwrite($migrationFile, $migrationContent);

        if (!$migrationBytes) {
            $this->printer->error(
                "No se ha podido sobrescribir el contenido de la plantilla",
                "Contacte con el desarrollador",
            );
        }

        fclose($migrationFile);

        $this->printer->display("succ", "El contenido ha sido actualizado");
        $this->printer->display("succ", "Finalizando creación de la migración");
    }
}
