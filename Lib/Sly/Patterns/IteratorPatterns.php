<?php

declare(strict_types=1);

namespace FoxyMVC\Lib\Sly\Patterns;

use FoxyMVC\Lib\Sly\Interfaces\TemplatePatterns;

class IteratorPatterns implements TemplatePatterns {
    public function getPatterns() {
        return [
            '/@foreach\s*\(\s*(.*?)\s*\)\:/s' => function ($matches, $patterns, $view, $data) {
                return '<?php foreach (' . $matches[1] . ') { ?>';
            },
            '/@endforeach/' => function () {
                return '<?php } ?>';
            },
        ];
    }
}
