<?php

namespace Kus;

/**
 * Description of UrlHelper
 *
 * @author Santosh_Potu
 */
class UrlHelper {
   public static function getSiteUrl($path=''){
       $request_params = array_keys(Request::getInstance()->getRequestParams());
       $formed_url = isset($request_params[0])?$request_params[0]:null;
       $relative_url = str_replace($formed_url,'', self::getRequestUri());
       return rtrim($relative_url,'/').'/'.trim($path,'/');
   }
   
    public static function getRequestUri(){
       return $_SERVER['REQUEST_URI'];
    }
    
    public static function redirect($path=''){
        header("location:".self::getSiteUrl($path));
    }
    
    public static function redirectToUrl($url){
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            header("Location:$url");
        }
        return false;
    }
}
