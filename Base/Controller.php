<?php
///**
// * Created by PhpStorm.
// * User: vladislavklimov
// * Date: 08/08/2019
// * Time: 17:44
// */
//
//
namespace Base;
//use App\Users\Model\DB as DB;

abstract class Controller
{
    public $tpl;
    /** @var View */
    public $view;

    function __construct()
    {
        $request = Context::getInstance()->getRequest();
        $this->tpl = strtolower($request->getRequestAction()) . '.phtml';
    }


    public function checkAuth()
    {
        $auth = false;
        if(isset($_SESSION['user_id'])){
            $auth = true;
        }
        return $auth;
    }
}
