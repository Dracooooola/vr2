<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 09/08/2019
 * Time: 18:40
 */
namespace Base;

class Auth
{
    private $salt = 'AvadraKedabra';

    public function getHash($password)
    {
        return sha1($password . $this->salt);
    }
}
