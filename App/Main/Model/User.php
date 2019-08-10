<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 09/08/2019
 * Time: 17:23
 */
namespace App\Main\Model;
use Base;

class User
{
    private function connectDB(){
        $db = new Base\DBConnection();
        /** @var Base\DBConnection $db */
        return $db = $db->getDB();
    }

    public function authorization($email, $password)
    {
        /** @var \PDO $db*/
        $db = $this->connectDB();
        /** @var  Base\Auth $getHash*/
        $getHash = new Base\Auth();
        $userPassword = $getHash->getHash($password);
        $query = 'SELECT * FROM `users` WHERE `password` = :password AND `email` = :email';

        $result = $db->prepare($query);
        $result->bindParam(':password', $userPassword, \PDO::PARAM_STR);
        $result->bindParam(':email', $email, \PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetch();

        if($user) return true;
        else return false;
    }
}
