<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 08/08/2019
 * Time: 18:10
 */
namespace App\Registration\Controller;
use App\Registration\Model\User as User;
use Base;

class Index extends \Base\Controller
{

    public function indexAction()
    {
        $login = false;
        $password = false;
        $repeatPassword = false;

        if(isset($_POST['submit'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $repeatPassword = $_POST['repeatpassword'];

            $user = new User();
            $chekLogin = $user->checkEmail($login);

            if($chekLogin === true) {
                echo 'Пользователь с такой почтой уже есть';
            } elseif($password !== $repeatPassword) {
                echo 'Пароли не совпадают';
            } else {
                User::register($login, $password);
                echo 'Пользвоатель успешно зарегестрирован';
            }
        }

        if($this->checkAuth()){
            header("location:/Main/index/auth");
        }
    }

    public function authAction()
    {

    }
}

