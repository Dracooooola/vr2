<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 09/08/2019
 * Time: 22:14
 */

namespace App\Users\Model;
use Base;
use Base\Eloquent\User as UserDB;
use Base\Eloquent\File as FileDB;

class User
{
    public function saveData($path, $login)
    {
        $data =[
            'user_email' => $login,
            'path' => $path
        ];
        FileDB::create($data);
    }

    public function getImagesList($login)
    {
        $result = FileDB::query()->where('user_email', '=', $login)->get();
        $result = $result->toArray();

        return $result;
    }

    public function getUsersDesc()
    {
        $user = UserDB::query()->orderBy('birthday', 'desc')->get();
        $resultArr = $user->toArray();

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
        $user = UserDB::query()->orderBy('birthday', 'desc')->get();
        $resultArr = $user->toArray();

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
