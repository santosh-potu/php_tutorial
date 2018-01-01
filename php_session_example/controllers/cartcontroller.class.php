<?php
namespace Controllers;

class cartController extends \Controllers\BaseController{
    
    public function indexAction($args = null,$optional = null){
        $this->viewAction($args, $optional);        
    }
    
    public function viewAction($args = null,$optional =null){
        $cart = new \Models\cart();
        $args['cart'] = $cart;
        $args['detailed_products']= $cart->getDetailedProducts();
        
        $this->view->render('cart_view',$args);

    }
    
    public function addAction($args = null,$optional =null){       
        
        $cart = new \Models\cart();
        $cart->addProducts($this->request->getPost());
        $args['cart'] = $cart;
        $args['detailed_products']= $cart->getDetailedProducts();
        \Kus\UrlHelper::redirect('cart/view');
        //$this->view->render('cart_view',$args);
    }
    
    public function updateAction($args = null,$optional =null){
        $cart = new \Models\cart();
        $cart->updateProducts($this->request->getPost());
        $args['cart'] = $cart;
        $args['detailed_products']= $cart->getDetailedProducts();
        \Kus\UrlHelper::redirect('cart/view');
        //$this->view->render('cart_view',$args);
    }
    
    public function checkoutAction($args =null,$optional=null){
        $this->view->render('cart_checkout',$args);
    }
}
