<?php

declare(strict_types=1);

namespace FoxyMVC\Lib\Sly\Patterns;

use FoxyMVC\Lib\Sly\Interfaces\TemplatePatterns;

class ClassPatterns implements TemplatePatterns {
    public function getPatterns() {
        return [
            '/([A-Z][a-z]+::)/' => function ($matches) {
                $file = search_file(constant("DIR"), explode("::", $matches[0])[0] . ".php");
                $class = "FoxyMVC" . explode(".php", str_replace("/", '\\', explode(constant("DIR"), $file[0])[1]))[0];
                return $class . "::";
            }
        ];
    }
}
