<?php
namespace Controllers;

class cartController extends \Controllers\BaseController{
    
    public function indexAction($args = null,$optional = null){
        
    }
    
    public function viewAction($args = null,$optional =null){
        
    }
    
    public function addAction($args = null,$optional =null){       
        
        $cart = new \Models\cart();
        $cart->addProducts($this->request->getPost());
        $args['cart'] = $cart;
        $args['detailed_products']= $cart->getDetailedProducts();
        
        $this->view->render('view_cart',$args);
    }
    
    public function updateAction($args = null,$optional =null){
        echo "<pre>";
        print_r($this->request->getPost());
        echo "</pre>";
        die();
        $this->view->render('view_cart',$args);
    }
}
