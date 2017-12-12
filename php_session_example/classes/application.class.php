<?php
namespace Kus;

class Application{
    
    private static $db = null;
    private static $self_inst = null;
    
    
    private function __construct()
    {
        try{
            $db = new \PDO(PDO_DSN, DB_USER,DB_PWD);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $db->query("SET CHARSET utf8"); //test query
            self::$db = $db;
        }catch(\PDOException $ex){
            echo 'Connection failed:'.$ex->getMessage();
        }           
    }
    
    public static function getInstance(){
        if (self::$self_inst){
            return self::$self_inst;
        }else{
            self::$self_inst = new Application();
            return self::$self_inst;
        }
    }
    
    public function getDbConnection(){
        return self::$db;
    }
}

