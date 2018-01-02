<?php
namespace Kus;

class BaseView{
    protected  $router;
    protected $request;
    protected $params ;
    
    public function __construct() {
        $this->router = \Kus\Router::getInstance();
        $this->request = Request::getInstance();
    }
    
    public function render($template,$args){
        $this->params = $args;
        $template_path = '..'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.
                $template.'.php';
        require_once $template_path;
    }
    
    public function getRouter(){
        return $this->router;
    }
}