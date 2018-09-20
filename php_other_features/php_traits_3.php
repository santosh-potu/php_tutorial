<?php

trait Message{
    private $message;
    
    function alert(){
        $this->define();
        echo $this->message;
        echo $this->otherMessage;
    }
    
    abstract function define();
}

class Messenger{
    use Message;
    private $otherMessage = "Other Private member Message";
    function define(){
        $this->message = "Custom message";
    }
}

$messenger = new Messenger;
$messenger->alert();