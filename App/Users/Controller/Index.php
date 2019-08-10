<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 09/08/2019
 * Time: 22:14
 */

namespace App\Users\Controller;
use App\Users\Model\User as Model;

class Index extends \Base\Controller
{
    private $model;
    private $login;
    private $sort;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Model();
        $this->login = $_SESSION['login'];
    }

    public function indexAction()
    {

        if(!$this->checkAuth()){
            header("Location:/users/index/auth");
        }

        if(isset($_POST['submitimage'])) {
            $path = null;
            if (!empty($_FILES['image']['tmp_name'])) {
                $fileContent = file_get_contents($_FILES['image']['tmp_name']);
                file_put_contents($_SERVER['DOCUMENT_ROOT'].'/img/'. date('jS-n-Y-h:i:H') . '.jpg', $fileContent);
                $path = '/img/'. date('jS-n-Y-h:i:H') . '.jpg';
            }

            $this->model->saveData($path, $this->login);
        }
    }

    public function authAction()
    {
        if($this->checkAuth()){
            header("Location:/users/index/index");
        }
    }

    public function getSort()
    {
        if(isset($_POST['submit'])) {
            $this->sort = !$_POST['sort'];
        } else {
            $this->sort = 0;
        }
        return $this->sort;
    }

    public function printImage()
    {
        $arrayImage = $this->model->getImagesList($this->login);
        foreach ($arrayImage as $key=>$value) {
            $array[] = $value['path'];
        }
        return $array;
    }

    public function printList($sort = false)
    {
        if($sort) {
            return $this->model->getUsersAsc();
        } else {
            return $this->model->getUsersDesc();
        }
    }
}
