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

    public static function isLogged($id){
        if ($id == NULL){
            $id = $_SESSION['user_id'];
        }
        return ($id!=NULL)?true:false;
    }
    
    public static function isAuthenticated($id){
        
    }
}
