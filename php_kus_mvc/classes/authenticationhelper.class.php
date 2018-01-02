<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Kus;

/**
 * Description of AuthenticationHelper
 *
 * @author Santosh_Potu
 */
class AuthenticationHelper {

    public static function isLogged($id=null){
        if ($id == null){
            $id = $_SESSION['user_id'];
        }
        return ($id!=null)?true:false;
    }
    
    public static function isAuthenticated($id=null,$controler=''){
        global $auth_required;
        if(!$controler) {
            $controler = strtolower(Router::getInstance()->getControllerParam());
        }
        
        return self::isLogged($id) && in_array($controler,$auth_required);
    }
}
