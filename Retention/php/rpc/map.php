<?php
  session_start();
  /*require_once('../poco/poco_map.php');
  require_once('../class/map.php');

  $mapid  = 1;
  $map = getMapById($mapid);
  echo buildstring($map);

  function buildstring($map){
    $mapInLine = "";
    $i = 1;
    // $map contain array of instance of players -> need to iterate on it
    // https://stackoverflow.com/questions/30680938/how-can-i-access-an-array-object
    foreach ($map->player as $singlePlayer ){
      if(is_null($singlePlayer)){
        $mapInLine .= 'W';
      }
      else{
        $mapInLine .= $singlePlayer->color;
      }

      if($i % 10 == 0){
        $mapInLine .= "|";
      }
      else{
        $mapInLine .= ",";
      }
      $i++;
    } // end foreach
    return $mapInLine;
}*
?>
