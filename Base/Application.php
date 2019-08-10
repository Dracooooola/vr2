<?php

namespace Base;

class Application
{
    private $_config;
    /** @var Context */
    private $_context;
    /** @var Request */
    private $_request;

    public function __construct($config)
    {
        $this->_config = $config;
    }

    private function _init()
    {
        $this->_context = Context::getInstance();
    }

    public function run()
    {
        try {
            $this->_init();
            $this->_request = new Request();
            $this->_context->setRequest($this->_request);
            $this->_request->handle();

            $dispatcher = new Dispatcher();
            $dispatcher->dispatch();

            $controller = $dispatcher->getController();
            $action = $dispatcher->getActionName();

            if (!method_exists($controller, $action)) {
                header("location:/error/index/index");
            }

            $view = new View($this->_getDefaultTemplatePath());
            $controller->view = $view;
            $controller->$action();
            $content = $view->render($controller->tpl);
            echo $content;
        } catch (Exception $e) {
            echo 'Произошла ошибка: ' . $e->getMessage();
        }
    }

    private function _getDefaultTemplatePath()
    {
        return 'App' . DIRECTORY_SEPARATOR . ucfirst($this->_request->getRequestModule()) .
            DIRECTORY_SEPARATOR .
            'Templates' .
            DIRECTORY_SEPARATOR .
            ucfirst($this->_request->getRequestController());
//        include '../App/Main/Templates/Controller.php';
//        return 'App/Main/Templates/Controller.php';
    }
}
