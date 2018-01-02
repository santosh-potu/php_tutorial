<?php
namespace Models;

class LoginModel{
    private $db;
    
    public function  __construct(){
       $this->db =  \Kus\Application::getInstance()->getDbConnection();    
    }
    
    public function validate($params){
        return strlen(trim($params['user_name'])) && strlen(trim($params['pwd']));
    }
    
    public function logoutUser(){
        session_destroy();
    }
    
    public function loginUser($params){
        $user_name = $params['user_name'];
        $pwd = $params['pwd'];
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_name = ? AND"
                . " pwd = MD5(?)");
        $stmt->bindParam(1,$user_name);
        $stmt->bindParam(2,$pwd);
        
        if($stmt->execute()){
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            if($user){
                $_SESSION['user_id'] = $user['user_id'];
                return $user;
            }
        }
        return false;
    }
    
    
}