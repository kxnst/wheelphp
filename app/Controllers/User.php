<?php


namespace app\Controllers;


use WheelPhp\Core\Config\Config;
use WheelPhp\Core\Controller\Controller;
use WheelPhp\Core\View\View;

class User extends Controller
{

    public function init()
    {
        $this->view = new View();
    }

    public function preDispatch()
    {
    }

    public function postDispatch()
    {
    }

    public function viewUserAction()
    {
        $userMapper = new \app\Models\Mappers\User();
        $this->view->setLayout("default");
        $this->view->setView("user");
        $user_id = \WheelPhp\Core\Config\Config::get("validator_regex")[1];
        $user = $userMapper->fetchById($user_id);
        $dataToAssign = [
            "title" => "UserPage",
            "user" => $user,
            "error" => $user===null
        ];
        $this->view->assign($dataToAssign);

        $application = Config::get("app");
        $cssPath = $application["css_path"];

        $this->view->addCssFile("https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css");
        $this->view->addCssFile($cssPath . "styles.css");
        $this->view->addJsFile("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js");
        $this->view->addJsFile("https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js");

        $this->view->render();
    }
}