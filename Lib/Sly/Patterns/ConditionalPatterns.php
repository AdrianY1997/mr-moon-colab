<?php
declare(strict_types=1);

namespace FoxyMVC\Lib\Sly\Patterns;

use FoxyMVC\Lib\Sly\Interfaces\TemplatePatterns;

class ConditionalPatterns implements TemplatePatterns {
    public function getPatterns() {
        return [
            '/@if\s*\(\s*(.*?)\s*\)\:/s' => function ($matches) {
                return '<?php if (' . $matches[1] . ') { ?>';
            },
            '/@elseif\s*\(\s*(.*?)\s*\)\:/s' => function ($matches) {
                return "<?php } else if (" . $matches[1] . ') { ?>';
            },
            '/@else/s' => function () {
                return '<?php } else { ?>';
            },
            '/@endif/s' => function () {
                return "<?php } ?>";
            },
            '/@isset\s*\(\s*(.*?)\s*\)\:/s' => function ($matches) {
                return '<?php if (isset(' . $matches[1] . ')) { ?>';
            },
            '/@endisset/s' => function () {
                return '<?php } ?>';
            },
        ];
    }
}
