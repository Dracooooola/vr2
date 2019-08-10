<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 08/08/2019
 * Time: 18:10
 */
namespace App\Main\Controller;
use App\Main\Model\User as User;
use Base;

class Index extends \Base\Controller
{
    public function indexAction()
    {
        $login = false;
        $password = false;

        if($this->checkAuth()){
            header("Location:/Main/index/auth");
        }

        if(isset($_POST['submit'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            $user = new User();
            $chekUser = $user->authorization($login, $password);

            if($chekUser === true) {
                $_SESSION['user_id'] = sha1($login);
                $_SESSION['login'] = $login;
                header("Location:/Main/index/auth");
            } else {
                $error[] = 'Неверный логин или пароль';
                echo $error[0];
            }
        }
    }

    public function authAction()
    {
        if(!$this->checkAuth()){
            header("Location:/Main/index/index");
        }
    }
}

