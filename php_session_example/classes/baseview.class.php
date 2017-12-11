<?php
namespace Kus;

class BaseView{
    public function __construct() {
        ;
    }
    
    public function render($template,$args){
        $view_params = $args;
        $template_path = '..'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.
                $template.'.php';
        require_once $template_path;
    }
}