<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 09/08/2019
 * Time: 16:35
 */
namespace Base;
require_once 'confing.php';
use Illuminate\Database\Capsule\Manager as Capsule;

class DBConnection
{
    private $_host;
    private $_port;
    private $_db_name;
    private $_db_user;
    private $_db_password;
    private $DB;
    private $capsule;

    public function __construct()
    {
        $this->_host = DATABASE['host'];
        $this->_port = DATABASE['port'];
        $this->_db_name = DATABASE['db_name'];
        $this->_db_user = DATABASE['db_user'];
        $this->_db_password = DATABASE['db_password'];
        $this->capsule = new Capsule();
    }

    public function getDB()
    {
        $this->capsule->addConnection([
            'driver' => 'mysql',
            'host' => $this->_host,
            'database' => $this->_db_name,
            'username' => $this->_db_user,
            'password' => $this->_db_password,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' =>  ''
        ]);
        $this->capsule->bootEloquent();
    }

//    public function getDB()
//    {
//        try {
//            $this->DB = new \PDO("mysql:host=$this->_host;dbname=$this->_db_name", $this->_db_user, $this->_db_password);
//        } catch (PDOException $err) {
//            echo $err->getMessage();
//            die;
//        }
//        return $this->DB;
//    }
}
