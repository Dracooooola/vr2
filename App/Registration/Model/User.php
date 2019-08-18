<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 09/08/2019
 * Time: 17:23
 */
namespace App\Registration\Model;
use Base;
use Base\Eloquent\User as UserDB;

class User
{

    public function checkEmail($email)
    {
        $user = UserDB::query()->where('email', '=', $email)->get();
        $user = $user->toArray();

        var_dump($user[0]['email']);
        if($user[0]['email']) return true;
        else return false;
    }

    public static function register($login, $password)
    {

        /** @var  Base\Auth $getHash*/
        $getHash = new Base\Auth();
        $userPassword = $getHash->getHash($password);

        $data =[
            'email' => $login,
            'password' => $userPassword
        ];
        UserDB::create($data);
        return true;

    }
}
