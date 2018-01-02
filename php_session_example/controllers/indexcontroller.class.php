<?php
namespace Controllers;

class IndexController extends BaseController{
    
    public function indexAction($args = null, $optional = null) {
        if(\Kus\AuthenticationHelper::isAuthenticated()){
            $product = new \Models\Product();
            $products = $product->getAllProducts();
            $args['products'] = $products;
            $this->view->render('display_products',$args);
        }else{
            $loginController = LoginController::getInstance()->indexAction($args);
        }
    }
    
}
