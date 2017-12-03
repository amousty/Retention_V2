<?php
  /* Includes */
  require_once('../db_Call.php');
  require_once('poco_player.php');

  /* Global variables */
  $db = initDB('../');

  /*
    1. insertMap
    2. updateMap
    3. deleteMap
    4. getListMap
    5. getMapById
  */

  /* 1. insertMap */
  function insertMap($login, $passwd){
    try{
      /* SELECT  */
      $query = $GLOBALS['db']->prepare("INSERT INTO tblMap (fldlogin, fldpasswd) VALUES (?, ?)");
      $query->bindParam(1, $login);
      $query->bindParam(2, $passwd);
      $query->execute();
      return "OK";
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }

  /* 2. updateMap */
  function updateMap($mapId, $x, $y, $newPlayer){
    try{
      /* SELECT  */
      $query = $GLOBALS['db']->prepare("UPDATE tblMap set fldplayer = ? WHERE fldmapid = ? AND fldx  = ? AND fldy = ? ");
      $query->excute(array($newPlayer, $mapId, $x, $y));
      return "OK";
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }

  /* 3. deleteMap */
  function deleteMap($id){
    try{
      /* SELECT  */
      $query = $GLOBALS['db']->prepare("DELETE FROM tblMap set WHERE fldmapid = ?");
      $query->excute(array($id));
      return "OK";
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }

  /* 4. getListMap */
  function getListMap(){
    return "ERR : Not implemented yet";
  }

  /* 5. getMapById */
  function getMapById($mapID){
    try{
      /* SELECT  */
      $query = $GLOBALS['db']->prepare("SELECT fldmapid, fldx, fldy, fldusr from tblMap M INNER JOIN tblPlayers P on P.fldplayerid = M.fldplayer where fldmapid= ? ORDER BY fldy, fldx");
      $query->bindParam(1, $mapID);
      $query->execute();

      /* Prepare arrays */
      $taby = array();
      $tabx = array();
      /* Array of instance of player */
      $tabplayer = array();
      while($row=$query->fetch(PDO::FETCH_ASSOC)) {
        /*its getting data in line. And its an object*/
        array_push($taby, $row["fldx"]);
        array_push($tabx, $row["fldy"]);
        $singlePlayer = getPlayerByUsrId($row["fldusr"]);
        array_push($tabplayer, $singlePlayer);
      }
      return new Map($mapID, $tabx, $taby, $tabplayer);
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }
?>
