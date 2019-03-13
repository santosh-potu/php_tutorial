<?php
interface Worker {
 
  public function takeBreak();
 
  public function code();
 
  public function callToClient();
 
  public function attendMeetings();
 
  public function getPaid();
}

/*
 * class Manager implements Worker {
  public function code() {
    return false;
  }
}
 */

/**
 * class Developer implements Worker {
  public function callToClient() {
    echo "I'll ask my manager.";
  }
}
 */