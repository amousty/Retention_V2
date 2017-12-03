<?php
class Map {
  public $id;
  public $x = array();
    public $y = array();
  public $player = array();

  public function __construct($id, $x, $y, $p){
    $this->id = $id;
    $this->x = $x;
    $this->y = $y;
    $this->player = $p;
  }
}
?>
