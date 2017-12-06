<?php
class Map {
  public $id;
  public $x = array();
  public $y = array();
  public $player = array();
  public $firstbuildon;
  public $firstbuildby;
  public $lastbuildon;
  public $lastbuildby;

  public function __construct($id, $x, $y, $p, $fbo, $fbb, $lbo, $lbb){
    $this->id = $id;
    $this->x = $x;
    $this->y = $y;
    $this->player = $p;
    $this->$firstbuildon = $fbo;
    $this->$firstbuildby = $fbb;
    $this->$lastbuildon = $lbo;
    $this->$lastbuildby = $lbb;
  }
}
?>
