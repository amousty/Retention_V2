<?php
  session_start();
  require_once('../poco/poco_map.php');
  require_once('../class/map.php');

  $mapid  = 1;

  $map = getMapById($mapid);
  var_dump($map);
?>
