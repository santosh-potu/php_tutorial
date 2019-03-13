<?php
/**
 *  a class should have a single responsibility, but more than that,
 *  a class should only have one reason to change.
 */

class Page {
  protected $title;
 
  public function getPage() {
    return $this->title;
  }
  function setTitle($title) {
      $this->title = $title;
  }
}
 
class JsonPageFormatter {
    public function format(Page $page) {
        return json_encode($page->getTitle());
    }
}
