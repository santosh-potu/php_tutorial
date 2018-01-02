<?php
namespace Controllers;

class BaseController{
    protected static $self_inst;
    protected $view;
    protected $request;


    protected function __construct(){
        $this->view = new \Kus\BaseView();
        $this->request = \Kus\Request::getInstance();
    }
    
    public static function getInstance(){
        
        if (self::$self_inst instanceof static){
            return self::$self_inst;
        }else{
            self::$self_inst = new static();
            return self::$self_inst;
        }
    }


    public function indexAction($args = null,$optional=null){
        $this->view->render('index', $args);
    }
}