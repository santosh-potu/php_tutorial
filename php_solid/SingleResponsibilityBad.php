<?php
class Page {
  protected $title;
 
  public function getPage() {
    return $this->title;
  }
  function setTitle($title) {
      $this->title = $title;
  }

    public function formatJson() {
    return json_encode($this->getTitle());
  }
}
