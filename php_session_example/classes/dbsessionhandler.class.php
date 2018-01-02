<?php
namespace Kus;

class DbSessionHandler extends \SessionHandler{
   
   protected $exists;
   protected static $db;
   protected static $log_file;

    public function __construct() {
        if(!isset(self::$db)){
            self::$db = Application::getInstance()->getDbConnection();
        }    
        if(!isset(self::$log_file)){
            self::$log_file = '..'.DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR.'sessions.log';
        }    
        error_log("Constructor \n",3,self::$log_file);
    }
    public function open($save_path, $name) {       
        error_log( "opened \n",3,self::$log_file);
        return true;
    }

    public function close() {
        error_log( "Closed \n",3,self::$log_file);
        return true;    
    }

    public function destroy($session_id) {
        $sth = self::$db->prepare("DELETE FROM sessions WHERE session_id = ?");
        $sth->execute(array($session_id));
        error_log( "Destroyed \n",3,self::$log_file);
        return true;
    }

    public function gc($maxlifetime) {
        $sth = self::$db->prepare("DELETE FROM sessions WHERE session_lastaccesstime < ?");
        $sth->execute(array(time() - $maxlifetime)); 
        error_log( "Gc \n",3,self::$log_file);
        return true;    
    }

    public function read($session_id) {
        $sth = self::$db->prepare("SELECT session_data FROM sessions WHERE session_id = ?");
        $sth->execute(array($session_id));
        $rows = $sth->fetchALL(\PDO::FETCH_NUM);
        error_log( "Reading \n",3,self::$log_file);
        if (count($rows) == 0) {
            $this->exists = "n";
            return '';
        }
        else {
            $this->exists = "y";
            return $rows[0][0];
        }   

    }
    public function write($session_id, $session_data) {

        if ($this->exists == "y") {
            $sth = self::$db->prepare("UPDATE sessions SET session_data = ? WHERE session_id = ?");
            $sth->execute(array($session_data, $session_id));
        }
        if ($this->exists == "n") {

            $sth = self::$db->prepare("INSERT INTO sessions (session_id, session_data) VALUES (?, ?)");
            $sth->execute(array($session_id, $session_data));           
        }
       error_log( "Writing \n",3,self::$log_file);
        return true;
    }
}

