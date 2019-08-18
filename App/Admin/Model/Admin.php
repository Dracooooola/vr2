<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 09/08/2019
 * Time: 17:23
 */
namespace App\Admin\Model;
use Base;
use Base\Eloquent\User as UserDB;
use Base\Eloquent\File as FileDB;

class Admin
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

    public static function updateData($login, $password, $name, $avatar)
    {
        $getHash = new Base\Auth();
        $userPassword = $getHash->getHash($password);

        $user = UserDB::find($login);
        if(!empty($name)){
            $user->name = $name;
        }
        if(!empty($userPassword)){
            $user->password = $userPassword;
        }
        if(!empty($avatar)){
            $user->avatar = $avatar;
        }

        $user->save();
    }

    public static function deleteData($login)
    {
        FileDB::where('user_email', '=', $login)->delete();
        UserDB::where('email', '=', $login)->delete();
    }

    public static function getUsers()
    {
        $user = UserDB::all();
        $resultArr = $user->toArray();

        return $resultArr;
    }
}
