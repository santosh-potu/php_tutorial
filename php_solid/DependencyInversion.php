<?php
/**
 * classes should depend upon abstractions, not concretions.
 *  Essentially, don't depend on concrete classes, depend upon interfaces.
 * 
 * High-level modules should not depend on low-level modules. Both should depend on abstractions.
Abstractions should not depend on details. Details should depend on abstractions
 */
interface DbConnectionInterface {
    public function connect();
} 
 
class MySqlConnection implements DbConnectionInterface {
    public function connect() {}
}
 
class PageLoader {
    private $dbConnection;
    public function __construct(DbConnectionInterface $dbConnection) {
        $this->dbConnection = $dbConnection;
    }
}