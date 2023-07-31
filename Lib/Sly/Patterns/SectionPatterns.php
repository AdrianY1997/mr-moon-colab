<?php

declare(strict_types=1);

namespace FoxyMVC\Lib\Sly\Patterns;

class SectionPatterns {
    public function getPatterns() {
        return [
            '/@include\s*\(\s*(.*?)\s*\)\:/s' => function ($matches, $patterns, $view, $data) {
                // Determine if the captured text is a quoted string or a variable name
                if (preg_match('/^[\'"](.+?)[\'"]$/', $matches[1], $stringMatches)) {
                    // Captured text is a quoted string
                    $viewName = $stringMatches[1];
                } else {
                    // Captured text is a variable name
                    $viewName = $view;
                }

                // Generate the view path
                $viewPath = 'App\Views\\' . str_replace('.', '\\', $viewName) . '.sly.php';

                // Include the view and capture its contents
                ob_start();
                extract($data);
                include $viewPath;
                $content = ob_get_clean();
                
                // Process patterns
                foreach ($patterns as $pattern => $callback) {
                    $content = preg_replace_callback($pattern, function ($matches) use ($callback, $patterns, $view, $data) {
                        return call_user_func($callback, $matches, $patterns, $view, $data);
                    }, $content);
                }
                // Return the processed content
                return $content;
            }
        ];
    }
}
