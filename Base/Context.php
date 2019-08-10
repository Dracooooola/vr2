<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 08/08/2019
 * Time: 16:09
 */

namespace Base;

class Context
{
    private $_request;
    private $_user;
    private static $_instance;

    private function __construct(){}

    private function __clone() {}

    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
    /** @return Request */
    public function getRequest()
    {
        return $this->_request;
    }

    public function setRequest($request)
    {
        $this->_request = $request;
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function setUser($user)
    {
        $this->_user = $user;
    }
}
