<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 09/08/2019
 * Time: 16:35
 */
namespace Base;
require_once 'confing.php';

class DBConnection
{
    private $_host;
    private $_port;
    private $_db_name;
    private $_db_user;
    private $_db_password;
    private $DB;

    public function __construct()
    {
        $this->_host = DATABASE['host'];
        $this->_port = DATABASE['port'];
        $this->_db_name = DATABASE['db_name'];
        $this->_db_user = DATABASE['db_user'];
        $this->_db_password = DATABASE['db_password'];
    }

    public function getDB()
    {
        try {
            $this->DB = new \PDO("mysql:host=$this->_host;dbname=$this->_db_name", $this->_db_user, $this->_db_password);
        } catch (PDOException $err) {
            echo $err->getMessage();
            die;
        }
        return $this->DB;
    }
}
