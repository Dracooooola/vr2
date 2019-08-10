<?php
namespace Base;
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 08/08/2019
 * Time: 15:06
 */
class Request
{
    const DEFAULT_MODULE = 'Main';
    const DEFAULT_CONTROLLER = 'Index';
    const DEFAULT_ACTION = 'Index';

    private $_requestModule;
    private $_requestController;
    private $_requestAction;
    private $_requestUri;

    public function __construct()
    {
        $this->_requestUri = trim($_SERVER['REQUEST_URI'], '/');
    }

    public function handle()
    {
        $parts = explode('/', $this->_requestUri);

        if (!$parts || sizeof($parts) < 2) {
            $this->_requestModule = self::DEFAULT_MODULE;
            $this->_requestController = self::DEFAULT_CONTROLLER;
            $this->_requestAction = self::DEFAULT_ACTION;
        } else {
            foreach ($parts as $k => $part) {
                if (!$this->validate($part)) {
                    header("location:/error/index/index");
                }
            }

            $this->_requestModule = $parts[0] ?? self::DEFAULT_MODULE;
            $this->_requestController = $parts[1] ?? self::DEFAULT_CONTROLLER;
            $this->_requestAction = $parts[2] ?? self::DEFAULT_ACTION;
        }
    }

    private function validate($urlPart)
    {
        $ret = preg_match('/^[a-zA-Z0-9]+$/', $urlPart);
        return $ret;
    }

    public function getRequestModule()
    {
        return $this->_requestModule;
    }

    public function getRequestController()
    {
        return $this->_requestController;
    }

    public function getRequestAction()
    {
        return $this->_requestAction;
    }

    public function getRequestUri()
    {
        return $this->_requestUri;
    }
}
