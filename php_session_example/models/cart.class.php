<?php
namespace Models;

class cart{
    private $products;
    
    
    public function __construct() {
        if(isset($_SESSION['cart'])){
            $this->products = $_SESSION['cart']->getProducts();
        }else{
            $this->products = array();
            $_SESSION['cart']= $this;
        }
    }
    
    public function getProducts(){
        return $this->products;
    }
    
    public function addProducts($params){
        $products= $params['product_quantity'];
        if($products){
            foreach($params['products'] as $product_id){
                if(isset($products[$product_id]) && $products[$product_id] > 0){
                    $this->products[$product_id] = $this->products[$product_id] + $products[$product_id];
                }
            }
        }      
        
        $_SESSION['cart']= $this;
        return $this;
    }
    
    public function updateProducts($params){
        $products= $params['qty'];
        $delete_products = $params['delete'];
        
        if($products){
            foreach($products as $product_id => $qty){
                if($qty > 0){
                    $this->products[$product_id] = $qty;
                }else{
                    unset($this->products[$product_id]);
                }
            }
        }
        
        if($delete_products){
            foreach($delete_products as $product_id){
                unset($this->products[$product_id]);                
            }
        }
        
        $_SESSION['cart']= $this;
        return $this;
    }
    
    public  function getDetailedProducts(){
        $detailed_products = null;
        
        if($this->products){
            $db = \Kus\Application::getInstance()->getDbConnection();
            $place_holders = implode(',', array_fill(0, count(array_keys($this->products)), '?'));
            
            $stmt = $db->prepare("SELECT * from cart_products WHERE product_id IN ($place_holders)");
            if($stmt->execute(array_keys($this->products))){
                while($product = $stmt->fetch(\PDO::FETCH_ASSOC)){
                    $product['qty'] = $this->products[$product['product_id']];
                    $detailed_products[$product['product_id']] = $product;
                }
            }
        
        }
        return $detailed_products;
    }
}

