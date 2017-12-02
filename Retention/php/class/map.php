<?php
class Map {
  public $id;
  public $y = array();
  public $x = array();
  public $player = array();

  public function __construct($id, $y, $x, $p){
    $this->id = $id;
    $this->y = $y;
    $this->x = $x;
    $this->p = $p;
  }
}
?>
