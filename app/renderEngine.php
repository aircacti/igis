<?php

class renderEngine
{
    public function render($content_path, $layout_path)
    {

        $filename = $this->mixContentWithLayout($content_path, $layout_path);

        ob_start();

        include PATH . '/buffer/' . $filename;

        $compiled = ob_get_clean();

        unlink(PATH . '/buffer/' . $filename);

        return $compiled;
    }

    private function mixContentWithLayout($content_path, $layout_path)
    {
        $content = file_get_contents(PATH . $content_path);
        $layout = file_get_contents(PATH . $layout_path);

        $mixed = str_replace('{{ IGIS_CONTENT }}', $content, $layout);

        $filename = hash("crc32", $mixed) . (int)microtime(true);

        file_put_contents(PATH . '/buffer/' . $filename, $mixed);

        return $filename;
    }

    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new renderEngine();
        }
        return self::$instance;
    }
}
