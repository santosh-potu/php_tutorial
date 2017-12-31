<?php
namespace Models;

class Product{
   private $db;
    
    public function  __construct($id=null){
       $this->db =  \Kus\Application::getInstance()->getDbConnection();    
    } 
    
    public function getAllProducts(){
        $stmt = $this->db->query('SELECT * from cart_products');
        if($stmt){
            while($product = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $products[] = $product;
            }
        }
        return $products;
    }
    
}
