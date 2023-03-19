<?php

namespace Lib\Sly;

class Sly
{
    protected $viewsDir = "App\\Site\\Resources\\View";
    protected $layout = "app.sly.php";

    public function __construct()
    {

    }

    public function render($view, $data = [])
    {
        $layout = $this->viewsDir . '/' . $this->layout;
        $viewFile = $this->viewsDir . '/' . $view . '.sly.php';

        if (!file_exists($viewFile)) {
            throw new \Exception("View file not found: {$viewFile}");
        }

        $data = array_merge($data, ['render' => [$this, 'render']]);

        extract($data, EXTR_SKIP);

        ob_start();

        include $viewFile;

        $content = ob_get_clean();

        if (!file_exists($layout)) {
            throw new \Exception("Layout file not found: {$layout}");
        }

        ob_start();

        include $layout;

        $output = $this->parser(ob_get_clean());

        return $output;
    }

    public function parser($data)
    {
        $structureMap = [
            "{{" => "<?php echo htmlspecialchars(",
            "}}" => "); ?>",
            "@Do" => "{ ?>",
            "@If" => "<?php if",
            "@EndIf" => "<?php } ?>"
        ];

        $template = $data;

        foreach ($structureMap as $structure => $php) {
            $template = str_replace($structure, $php, $template);
        }

        return $this->renderTemplate($template, $data);
    }

    function renderTemplate($template, $data)
    {
        $pattern = '/<\?php(.*?)\?>/is';

        $template = preg_replace_callback($pattern, function ($match) use ($data) {
            ob_start();
            eval($match[1]);
            $output = ob_get_contents();
            ob_end_clean();

            return $output;
        }, $template);

        $template = str_replace(['<?php', '?>'], ['&lt;?php', '?&gt;'], $template);

        return $template;
    }
}