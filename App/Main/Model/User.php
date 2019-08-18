<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 09/08/2019
 * Time: 17:23
 */
namespace App\Main\Model;
use Base;
use Base\Eloquent\User as UserDB;

class User
{
    public function authorization($email, $password)
    {
        /** @var  Base\Auth $getHash*/
        $getHash = new Base\Auth();
        $userPassword = $getHash->getHash($password);

        $user = UserDB::query()->where('email', '=', $email)
                               ->where('password', '=', $userPassword)->get();
        $user->toArray();
        if(!empty($user[0]['email'])) return true;
        else return false;
    }
}
