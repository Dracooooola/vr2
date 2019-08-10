<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 08/08/2019
 * Time: 17:30
 */

namespace Base;
class View
{
    private $_templatePath;

    public function __construct($path = '')
    {
        $this->_templatePath = $path;
    }

    public function setTemlatePath($path)
    {
        $this->_templatePath = $path;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function render($tplName = '')
    {
        $path = trim($this->_templatePath, DIRECTORY_SEPARATOR);
        $tplFileName = $path . DIRECTORY_SEPARATOR . $tplName;
        ob_start(null, null, PHP_OUTPUT_HANDLER_STDFLAGS);
        require $tplFileName;
        return ob_get_clean();
    }
}
