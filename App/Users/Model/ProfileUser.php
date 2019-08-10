<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 09/08/2019
 * Time: 22:14
 */

namespace App\Users\Model;
use Base;

class ProfileUser
{
    public function saveData($name, $birthday, $path)
    {
        /** @var \PDO $db*/
        $db = new Base\DBConnection();
        $db = $db->getDB();

        $login = $_SESSION['login'];

        $query = 'UPDATE `users` SET `name`=:username, `birthday`=:birthday, `avatar`=:avatar WHERE `email`=:login';

        $result = $db->prepare($query);
        $result->bindParam(':username', $name, \PDO::PARAM_STR);
        $result->bindParam(':birthday', $birthday, \PDO::PARAM_STR);
        $result->bindParam(':avatar', $path, \PDO::PARAM_STR);
        $result->bindParam(':login', $login, \PDO::PARAM_STR);
        $result->execute();


    }
}
