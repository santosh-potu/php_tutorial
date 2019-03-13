<?php
/**
 * many client-specific interfaces are better than one general-purpose interface. 
 * In other words, classes should not be forced to implement interfaces 
 * they do not use.
 *  
 */
interface Worker {
  public function takeBreak();
  public function getPaid();
}
 
interface Coder {
  public function code();
}
 
interface ClientFacer {
  public function callToClient();
  public function attendMeetings();
}

 /** class Developer implements Worker, Coder {
    
}*/
 /* 
  * class Manager implements Worker, ClientFacer {
  *
} */