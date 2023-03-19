<?php

// Definir la ruta base de nuestro proyecto

// Registrar la función de auto carga con spl_autoload_register()
spl_autoload_register(function ($class) {
    // Convertir la clase en formato de espacio de nombres PSR-4
    $class = str_replace('\\', '/', $class);
    // Obtener la ruta del archivo de la clase
    $file = constant("DIR") . '/' . $class . '.php';
    // Cargar el archivo de la clase si existe
    if (file_exists($file)) {
        require_once $file;
    }
});
