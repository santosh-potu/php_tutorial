<?php


namespace Kus;

/**
 * Description of request
 *
 * @author Santosh_Potu
 */
class Request {
    
    private static $self_inst = null;
    private $post = null;
    private $get = null;
    private $request = null;
    
    protected function __construct(){
        $this->get = (count(array_keys($_GET))) ? explode('/', trim(array_keys($_GET)[0],'/')):null;  
        $this->post = $_POST;
        $this->request = $_REQUEST;
    }
    
    public static function getInstance(){
         if (self::$self_inst){
            return self::$self_inst;
        }else{
            self::$self_inst = new static();
            return self::$self_inst;
        }
    }
    
    public function getRequest(){
        return $this->get;
    }
    
    public function getPost(){
        return $this->post;
    }
    
    public function getRequestParam($param=null){        
        return ($param)?$this->request[$param]:$param;
    }
    
    public function getRequestParams(){
        return $this->request;
    }
    
    public function getRequestType(){
        return $_SERVER['REQUEST_METHOD'];
    }
    
    public function getRequestUri(){
       return $_SERVER['REQUEST_URI'];
    }
}
