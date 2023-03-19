<?php

namespace Lib\Cli\Command;

use Lib\Cli\Base\Command;

class Create extends Command
{

    public function __construct($app, $argv)
    {
        parent::__construct($app, $argv);

        $array["controller"]["home"] = "hola";

        var_dump($array);

        $methods = [
            "controller" => "App\\Site\\Controller",
            "model" => "App\\Model"
        ];

        $this->printer->display("info", "Obteniendo componente");
        $componente = isset($argv[2]) ? $argv[2] : null;

        if (!isset($methods[$componente]))
            $this->printer->error(
                "El componente ingresado no se puede crear",
                "Modo de uso:",
                "$ php foxy create [componente] [name]",
                "[componente]: controller | model",
                "[name]: any"
            );

        $this->printer->display("succ", "Componente: $componente");
        $this->component($methods[$componente]);
    }

    public function component($componentFolder)
    {
        $templatePath = "Lib\\Templates\\" . ucfirst($this->argv[2]) . ".txt";
        $migrationPath = "Lib\\Templates\\Migration.txt";

        $componentTxt = $this->argv[2];
        $componentEs = $this->argv[2] != "controller" ? ($this->argv[2] != "model" ? "" : "modelo") : "controlador";

        $name
            = isset($this->argv[3])
            ? $this->argv[3]
            : "empty";

        $replacement = ucfirst($name);
        $this->printer->display("info", "Obteniendo Nombre");
        if ($name == "empty")
            $this->printer->error(
                "Falta el nombre del componente",
                "Modo de uso:",
                "$ php foxy create $componentTxt [name]"
            );
        $this->printer->display("succ", "Nombre del $componentEs: $name");

        $this->printer->display("info", "Obteniendo plantilla de \"$templatePath\"");
        if (!is_file($templatePath))
            $this->printer->error(
                "Hay un problema en la ruta de la plantilla",
                "Contacte con el desarrollador"
            );

        $templateContent = file_get_contents($templatePath);
        if (!$templateContent)
            $this->printer->error(
                "No se pudo cargar la plantilla",
                "Contacte con el desarrollador"
            );

        $fileName
            = $componentTxt != "controller"
            ? ($componentTxt != "model"
                ? ""
                : $replacement . ".php")
            : $replacement . "Controller.php";

        $componentPath = "$componentFolder\\$fileName";

        $this->printer->display("info", "Comprobando que no exista un $componentEs con el mismo nombre");

        if (file_exists($componentPath))
            $this->printer->error(
                "Ya existe un $componentEs con este nombre",
                "Intente de nuevo con un nombre diferente"
            );

        $this->printer->display("info", "Creando $componentEs en \"$componentPath\"");

        $templateContent = str_replace("{{" . $componentTxt . "Name}}", $replacement, $templateContent);

        $replacement = str_split($replacement);

        if ($componentTxt == "model" && !($replacement[array_key_last($replacement)] == "s"))
            $replacement[] = "s";

        $templateContent = strstr($templateContent, "{{tableName}}") ? str_replace("{{tableName}}", strtolower(join("", $replacement)), $templateContent) : $templateContent;

        $file = fopen($componentPath, "w");

        if (!$file)
            $this->printer->error(
                "hubo un error inesperado al crear el archivo",
                "Contacte con el desarrollador"
            );

        $write = fwrite($file, $templateContent);

        if (!$write)
            $this->printer->error(
                "El archivo ha sido creado, pero no se pudo generar el contenido",
                "Contacte con el desarrollador"
            );

        fclose($file);

        $this->printer->display("succ", "El $componentEs \"$componentPath\" ha sido creado correctamente");

        if ($componentTxt == "model") {
            $migrationFilePath = "App\\Migrations\\" . ucfirst(join("", $replacement)) . "Migration.php";

            $this->printer->display("info", "Creando migración en \"$migrationFilePath\"");

            if (!is_file($migrationPath))
                $this->printer->error(
                    "Hay un problema en la ruta de la plantilla",
                    "Contacte con el desarrollador"
                );

            $migrationContent = file_get_contents($migrationPath);

            if (!$migrationContent)
                $this->printer->error(
                    "No se pudo cargar la plantilla",
                    "Contacte con el desarrollador"
                );

            $migrationContent = str_replace("{{modelName}}", strtolower(join("", $replacement)), $migrationContent);

            $file = fopen($migrationFilePath, "w");

            if (!$file)
                $this->printer->error(
                    "hubo un error inesperado al crear el archivo",
                    "Contacte con el desarrollador"
                );

            $write = fwrite($file, $migrationContent);

            if (!$write)
                $this->printer->error(
                    "El archivo ha sido creado, pero no se pudo generar el contenido",
                    "Contacte con el desarrollador"
                );

            fclose($file);

            $this->printer->display("succ", "La migración del component ha sido creado correctamente");
        }

        // $this->printer->display("info", "Actualizando diccionario \"$dict\"");

        // $json = file_get_contents($dict);

        // if (!$json)
        //     $this->printer->error(
        //         "No se pudo cargar el diccionario $componentTxt",
        //         "Contacte con el desarrollador"
        //     );

        // $json_data = json_decode($json, true);

        // $json_data[$componentTxt][$name] = $componentPath;

        // $put = file_put_contents($dict, json_encode($json_data, JSON_PRETTY_PRINT));

        // if (!$put) {
        //     $this->printer->error(
        //         "No se pudo actualizar el diccionario $componentTxt",
        //         "Contacte con el desarrollador"
        //     );
        // }

        // $this->printer->display("succ", "El diccionario \"$dict\" ha sido actualizado");
        $this->printer->display("succ", "Saliendo");
        $this->printer->nl();
        exit;
    }
}
