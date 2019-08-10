<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 09/08/2019
 * Time: 22:14
 */

namespace App\Users\Model;
use Base;

class User
{
    public function saveData($path, $login)
    {
        /** @var \PDO $db*/
        $db = new Base\DBConnection();
        $db = $db->getDB();

        $query = 'INSERT INTO `files` (user_email, path) VALUES (:user_email, :path)';

        $result = $db->prepare($query);
        $result->bindParam(':user_email', $login, \PDO::PARAM_STR);
        $result->bindParam(':path', $path, \PDO::PARAM_STR);
        $result->execute();
    }

    public function getImagesList($login)
    {
        /** @var \PDO $db*/
        $db = new Base\DBConnection();
        $db = $db->getDB();

        $query = 'SELECT * FROM `files` WHERE `user_email` = :user_email';

        $result = $db->prepare($query);
        $result->bindParam(':user_email', $login, \PDO::PARAM_STR);
        $result->execute();
        $resultArr = $result->fetchAll();
        return $resultArr;
    }

    public function getUsersDesc()
    {
        $db = new Base\DBConnection();
        $db = $db->getDB();

        $query = 'SELECT * FROM `users` ORDER BY `birthday` DESC';

        $result = $db->prepare($query);
        $result->execute();
        $resultArr = $result->fetchAll();

        for($i=0; $i<count($resultArr); $i++){
            $resultArr[$i]['birthday'] = $this->getFullYears($resultArr[$i]['birthday']);
            if($resultArr[$i]['birthday'] < 18){
                $resultArr[$i]['adulthood'] = 'Несовершеннолетний';
            } else {
                $resultArr[$i]['adulthood'] = 'Совершеннолетний';
            }
        }
        return $resultArr;
    }

    public function getUsersAsc()
    {
        $db = new Base\DBConnection();
        $db = $db->getDB();

        $query = 'SELECT * FROM `users` ORDER BY `birthday` ASC';

        $result = $db->prepare($query);
        $result->execute();
        $resultArr = $result->fetchAll();

        for($i=0; $i<count($resultArr); $i++){
            $resultArr[$i]['birthday'] = $this->getFullYears($resultArr[$i]['birthday']);
            if($resultArr[$i]['birthday'] < 18){
                $resultArr[$i]['adulthood'] = 'Несовершеннолетний';
            } else {
                $resultArr[$i]['adulthood'] = 'Совершеннолетний';
            }
        }
        return $resultArr;
    }

    function getFullYears($birthdayDate) {
        $datetime = new \DateTime($birthdayDate);
        $interval = $datetime->diff(new \DateTime(date("Y-m-d")));
        return $interval->format("%Y");
    }
}
