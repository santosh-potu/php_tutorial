<?php
namespace Controllers;

class LoginController extends BaseController{
    protected $model = null;

    protected function __construct() {
        $this->model = new \Models\LoginModel();
        parent::__construct();
    }
    public function indexAction($args = null, $optional = null) {
        $this->view->render('login', $args);
    }
    
    public function outAction($args = null, $optional = null) {
        $this->model->logoutUser();
        $this->view->render('login', $args);
    }
    
    public function authenticateAction($args=null,$optional=null){
        $request = $this->request;
        if($this->model->validate($request->getPost())){
            $user = $this->model->loginUser($request->getPost());
            if($user){
                header('location: index.php');
            }else{
                $args['errors'] = array('login_error'=>'Invalid credentials');
            }
        }
        $this->view->render('login',$args);
    }
}