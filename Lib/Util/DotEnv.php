<?php

namespace FoxyMVC\Lib\Util;

class DotEnv
{
    protected $path;
    protected $variables = [];

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function load()
    {
        $file = fopen($this->path, 'r');

        while (!feof($file)) {
            $line = fgets($file);
            if (strpos($line, '=') !== false) {
                list($name, $value) = explode('=', $line, 2);
                $this->variables[$name] = trim($value);
            }
        }

        fclose($file);

        foreach ($this->variables as $name => $value) {
            putenv("$name=$value");
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }

    public function get($name)
    {
        return isset($this->variables[$name]) ? $this->variables[$name] : null;
    }
}
