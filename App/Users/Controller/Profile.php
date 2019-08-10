<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 09/08/2019
 * Time: 22:14
 */

namespace App\Users\Controller;
use App\Users\Model\ProfileUser as Model;

class Profile extends \Base\Controller
{
    public function profileAction()
    {
        if(!$this->checkAuth()){
            header("Location:/users/profile/auth");
        }

        if(isset($_POST['submitavatar'])) {

            $date = $_POST['birthday'] ?? null;
            $name = $_POST['name'] ?? null;
            $path = null;
            if (!empty($_FILES['avatar']['tmp_name'])) {
                $fileContent = file_get_contents($_FILES['avatar']['tmp_name']);
                file_put_contents($_SERVER['DOCUMENT_ROOT'].'/img/'. date('jS-n-Y-h:i:H') . '.jpg', $fileContent);
                $path = '/img/'. date('jS-n-Y-h:i:H') . '.jpg';
            }

            $model = new Model();
            $model->saveData($name, $date, $path);
        }
    }

    public function authAction()
    {
        if($this->checkAuth()){
            header("Location:/users/profile/profile");
        }
    }
}
