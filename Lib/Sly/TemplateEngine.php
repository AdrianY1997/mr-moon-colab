<?php

declare(strict_types=1);

namespace FoxyMVC\Lib\Sly;

use FoxyMVC\Lib\Foxy\Core\Session;

class TemplateEngine {
    protected $patterns;

    public function __construct() {
        $this->patterns = [];
        $path = "Lib\Sly\Patterns";
        $patterns = glob($path . "\*.php");
        foreach ($patterns as $file) {
            require $file;
            $className = basename($file, '.php');
            $class = "FoxyMVC\\" . $path . "\\" . $className;
            $instance = new $class();
            $this->patterns = array_merge($this->patterns, $instance->getPatterns());
        }
    }

    public function render($view, $data = []) {
        // Convertir el array de datos en variables
        extract(Session::getMessage());
        extract($data);

        // Capturar el contenido de la vista en un buffer
        ob_start();
        include_once 'App/Views/app.sly.php';
        $content = ob_get_clean();

        // Procesar patrones
        foreach ($this->patterns as $pattern => $callback) {
            $content = preg_replace_callback($pattern, function ($matches) use ($callback, $view, $data) {
                return call_user_func($callback, $matches, $this->patterns, $view, $data);
            }, $content);
        }

        // Evaluar el contenido procesado
        ob_start();
        eval('?>' . $content);
        $content = ob_get_clean();

        // Mostrar el contenido procesado
        echo $content;
    }
}
