<?php

declare(strict_types=1);

namespace FoxyMVC\Lib\Sly\Patterns;

class StringPatterns {
    public function getPatterns() {
        return [
            '/{!!\s*(.+?)\s*!!}/' => function ($matches) {
                return '<?= ' . $matches[1] . ' ?>';
            },
            '/{{\s*(.+?)\s*}}/' => function ($matches, $view, $data) {
                return '<?= htmlspecialchars(' . $matches[1] . ') ?>';
            },
            '/@dump\s*\(\s*(.*?)\s*\)\:/s' => function ($matches) {
                return '<?php var_dump(' . $matches[1] . ') ?>';
            },
            '/@php\s+(.+?)\s+@endphp/s' => function ($matches) {
                return '<?php ' . $matches[1] . ' ?>';
            }
        ];
    }
}
