<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 08/08/2019
 * Time: 18:10
 */
namespace App\Admin\Controller;
use App\Admin\Model\Admin as Admin;
use Base;

class Index extends \Base\Controller
{
    public function indexAction()
    {
        $login = false;
        $password = false;

        if(!$this->checkAuth()){
            header("Location:/main/index/index");
        }

        if(isset($_POST['submit'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            $user = new User();
            $chekLogin = $user->checkEmail($login);

            if($chekLogin === true) {
                echo 'Пользователь с такой почтой уже есть';
            } else {
                User::register($login, $password);
                echo 'Пользвоатель успешно зарегестрирован';
            }
        }

        if(isset($_POST['submitUpdate'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $name = $_POST['name'];

            if (!empty($_FILES['avatar']['tmp_name'])) {
                $fileContent = file_get_contents($_FILES['avatar']['tmp_name']);
                file_put_contents($_SERVER['DOCUMENT_ROOT'].'/img/'. date('jS-n-Y-h:i:H') . '.jpg', $fileContent);
                $path = '/img/'. date('jS-n-Y-h:i:H') . '.jpg';
                echo 'lol';
            }

            Admin::updateData($login, $password, $name, $path);
        }

        if(isset($_POST['delete'])) {
            $login = $_POST['login'];

            Admin::deleteData($login);
        }
    }

    public function authAction()
    {
        if($this->checkAuth()){
            header("Location:/main/index/index");
        }
    }

    public function printList()
    {
        return Admin::getUsers();
    }
}

