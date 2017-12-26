<?php
namespace Controllers;

class LoginController extends BaseController{


    public function indexAction($args = null, $optional = null) {
        $this->view->render('login', $args);
    }
    
}