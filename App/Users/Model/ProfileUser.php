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

class ProfileUser
{
    public function saveData($name, $birthday, $path)
    {
        $login = $_SESSION['login'];

        $user = UserDB::find($login);
        $user->name = $name;
        $user->birthday = $birthday;
        $user->avatar = $path;
        $user->save();
    }
}
