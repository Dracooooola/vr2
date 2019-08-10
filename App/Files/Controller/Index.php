<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 10/08/2019
 * Time: 02:32
 */

namespace App\Files\Controller;
use App\Files\Model\File as Model;

class Index extends \Base\Controller
{
    private $model;
    private $login;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Model();
        $this->login = $_SESSION['login'];

    }

    public function indexAction()
    {
        if(!$this->checkAuth()){
            header("Location:/files/index/auth");
        }
    }

    public function authAction()
    {
        if($this->checkAuth()){
            header("Location:/files/index/index");
        }
    }

    public function passFileList()
    {
        return $this->model->getFilesList();
    }
}
