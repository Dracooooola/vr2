<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 09/08/2019
 * Time: 17:23
 */
namespace App\Registration\Model;
use Base;

class User
{

    public function checkEmail($email)
    {
        /** @var \PDO $db*/
        $db = new Base\DBConnection();
        $db = $db->getDB();

        $query = 'SELECT * FROM `users` WHERE `email` = :email';

        $result = $db->prepare($query);
        $result->bindParam(':email', $email, \PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetch();

        if($user) return true;
        else return false;
    }

    public static function register($login, $password)
    {
        $db = new Base\DBConnection();
        /** @var \PDO $db*/
        $db = $db->getDB();


        /** @var  Base\Auth $getHash*/
        $getHash = new Base\Auth();
        $userPassword = $getHash->getHash($password);

        $query = 'INSERT INTO `users` (email, password) VALUES (:email, :password)';

        $result = $db->prepare($query);
        $result->bindParam(':email', $login, \PDO::PARAM_STR);
        $result->bindParam(':password', $userPassword, \PDO::PARAM_STR);

        return $result->execute();
    }
}
