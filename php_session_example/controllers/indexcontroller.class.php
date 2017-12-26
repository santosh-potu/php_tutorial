<?php
namespace Controllers;

class IndexController extends BaseController{
    
    public function indexAction($args = null, $optional = null) {
        if(\Kus\AuthenticationHelper::isAuthenticated()){
            parent::indexAction($args);
        }else{
            $loginController = LoginController::getInstance()->indexAction($args);
        }
    }
    
}
