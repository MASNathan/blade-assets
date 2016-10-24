<?php

namespace MASNathan\BladeAssets\View;

class Factory
{
    /**
     * Storage for our scripts.
     *
     * @var array
     */
    protected $scripts = [];

    /**
     * Storage for our styles.
     *
     * @var array
     */
    protected $styles = [];

    public function compileOutput($type)
    {
        if (!isset($this->$type)) {
            throw new \Exception('Invalid output Type');
        }

        echo implode(PHP_EOL, $this->$type);
    }

    public function compileScript($src = null, $type = 'text/javascript')
    {
        if (is_null($src)) {
            ob_start();
        } else {
            $this->scripts[$src] = "<script type=\"$type\" src=\"$src\"></script>";
        }
    }

    public function compileEndScript()
    {
        $this->scripts[] = ob_get_clean();
    }

    public function compileStyle($src = null, $type = 'text/css', $media = 'all', $rel = 'stylesheet')
    {
        if (is_null($src)) {
            ob_start();
        } else {
            $this->styles[$src] = "<link rel=\"$rel\" href=\"$src\" type=\"$type\" media=\"$media\" />";

        }
    }

    public function compileEndStyle()
    {
        $this->styles[] = ob_get_clean();
    }
}
