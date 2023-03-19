<?php

namespace Lib\Cli\Command\Make;

use DateTime;
use Exception;
use Lib\Cli\Core\Base\Command;

class MakeComponent extends Command
{
    public function __construct($pro, $avs)
    {
        parent::__construct($pro, $avs);
    }

    public function make()
    {
        $names = [
            "controller" => "controlador",
            "model" => "modelo",
            "migration" => "migración"
        ];

        $templatesFolder = "Lib\\Util\\Templates";
        $controllersFolder = "App\\Site\\Controllers";
        $modelsFolder = "App\\Site\\Models";
        $migrationsFolder = "App\\Site\\Migrations";

        $component = $this->property["sub"];
        $componentEs = $names[$component];
        $componentName = $this->options["--name"] ?? $this->options["--n"] ?? null;

        $this->printer->display("info", "Iniciando creación de [$componentEs]");
        $this->printer->display("info", "Obteniendo nombre de [$componentEs]");

        if (!$componentName) {
            $this->printer->error(
                "El nombre de [$componentEs] no ha sido definido",
                "Modo de uso: $ php foxy make:$component [ --name | --n ] [nombre]"
            );
        }

        $this->printer->display("succ", "Nombre de [$componentEs] obtenido: " . ucfirst($componentName));

        $componentTemplateFile = "$templatesFolder\\make-$component.template.php";
        $this->printer->display("info", "Obteniendo plantilla de [$componentEs] en \"$componentTemplateFile\"");

        $templateContent = file_get_contents($componentTemplateFile);

        if (!$templateContent) {
            $this->printer->error(
                "No se ha podido cargar la plantilla",
                "Contacte con el desarrollador",
            );
        }

        $this->printer->display("succ", "La plantilla de [$componentEs] ha sido cargada");

        $componentContent = str_replace(["__$component", "__tableName"], [ucfirst($componentName), $componentName . "s"], $templateContent);

        $componentPath = ${$component . "sFolder"} . "\\" . ($component == "controller" ? (ucfirst($componentName) . "Controller.php") : (ucfirst($componentName) . ".php"));

        $this->printer->display("succ", "Creando [$componentEs] en \"" . ${$component . "sFolder"} . "\"");

        $componentFile = fopen($componentPath, "w");

        if (!$componentFile) {
            $this->printer->error(
                "Ubo un problema al cargar el archivo",
                "Contacte con el desarrollador",
            );
        }

        $this->printer->display("succ", "\"" . ${$component . "sFolder"} . "\\$componentEs\" ha sido creado");

        $this->printer->display("succ", "Sobrescribiendo el contenido");

        $componentWrite = fwrite($componentFile, $componentContent);

        if (!$componentWrite) {
            $this->printer->error(
                "No se ha podido cargar la plantilla",
                "Contacte con el desarrollador",
            );
        }

        fclose($componentFile);

        $this->printer->display("succ", "El contenido ha sido actualizado");

        if ($component == "model") {
            $migrationTemplateFile = "$templatesFolder\\make-migration.template.php";

            $this->printer->display("info", "Obteniendo plantilla de migraciones en \"$migrationTemplateFile\"");

            $migrationContent = file_get_contents($migrationTemplateFile);

            if (!$migrationContent) {
                $this->printer->error(
                    "No se ha podido cargar la plantilla",
                    "Contacte con el desarrollador",
                );
            }

            $this->printer->display("succ", "La plantilla de la migración ha sido cargada");

            $migrationContent = str_replace(["__tableName", "__acronym"], [$componentName, substr($componentName, 0, 4)], $migrationContent);

            $migrationPath = $migrationsFolder . "\\" . $componentName . "-" . date_timestamp_get(date_create()) .  ".php";

            $this->printer->display("succ", "Creando migración en \"$migrationsFolder\"");

            $migrationFile = fopen($migrationPath, "w");

            if (!$migrationFile) {
                $this->printer->error(
                    "Ubo un problema al cargar el archivo",
                    "Contacte con el desarrollador",
                );
            }

            $this->printer->display("succ", "\"$migrationsFolder\\$componentEs\" ha sido creado");

            $this->printer->display("succ", "Sobrescribiendo el contenido");

            $migrationWrite = fwrite($migrationFile, $migrationContent);

            if (!$migrationWrite) {
                $this->printer->error(
                    "No se ha podido cargar la plantilla",
                    "Contacte con el desarrollador",
                );
            }

            fclose($migrationFile);

            $this->printer->display("succ", "El contenido ha sido actualizado");
        }

        $this->printer->display("succ", "Saliendo...\n");
    }
}
