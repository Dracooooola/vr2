<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 08/08/2019
 * Time: 16:07
 */

namespace Base;
use App\Main\Controller\Index;
use http\Exception;

class Dispatcher
{
    /** @var Request */
    private $_request;

    private $_moduleName;
    private $_controllerName;
    private $_actionName;

    public function __construct()
    {
        $this->_request = Context::getInstance()->getRequest();
    }

    public  function dispatch()
    {
        $module = ucfirst(strtolower($this->_request->getRequestModule()));
        $controller = ucfirst(strtolower($this->_request->getRequestController()));
        $action = ucfirst(strtolower($this->_request->getRequestAction()));

        $this->_moduleName = $module;
        $this->_controllerName = $controller;
        $this->_actionName = $action . 'Action';
    }
    /** @return Index */
    public function getController()
    {
        $controllerClassName = "App\\" . $this->_moduleName . "\\Controller\\" . $this->_controllerName;
        if(!class_exists($controllerClassName)) {
            header("location:/error/index/index");
        }

        $controller = new $controllerClassName();

        return $controller;
    }

    public function getModuleName()
    {
        return $this->_moduleName;
    }

    public function getControllerName()
    {
        return $this->_controllerName;
    }

    public function getActionName()
    {
        return $this->_actionName;
    }
}
