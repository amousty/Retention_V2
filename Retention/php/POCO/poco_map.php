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
    6. getMapByPlayer
  */

  /* 1. insertMap */
  function insertMap($mapname){
    try{
      $today = date("Y-m-d H:i:s");
      /* SELECT  */
      $query = $GLOBALS['db']->prepare("INSERT INTO tblMap (fldmapname, fldmapcreatedon) VALUES (?, ?)");
      $query->bindParam(1, $mapname);
      $query->bindParam(2, $today);
      $query->execute();
      return "OK";
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }

  /* 2. updateMap */
  function updateMap($mapName, $mapId){
    try{
      /* SELECT  */
      $query = $GLOBALS['db']->prepare("UPDATE tblMap set fldmapname = ? WHERE fldmapid = ?");
      $query->excute(array($mapName, $mapId));
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
      $query = $GLOBALS['db']->prepare("SELECT * from tblMap M where fldmapid = ?");
      $query->bindParam(1, $mapID);
      $query->execute();

      /* Prepare arrays */
      if($row=$query->fetch(PDO::FETCH_ASSOC)) {
        /*its getting data in line. And its an object*/
        return new Map($row["fldmapid"], $row["fldmapname"], $row["fldmapcreatedon"]);
      }
      else{
        return "ERR : Empty map";
      }
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }

  /* 6. getMapByPlayer */
  function getMapByPlayer($playerid){
    try{
      /* SELECT  */
      $query = $GLOBALS['db']->prepare(
        "SELECT M.* from tblMap M
        INNER JOIN tblMapPlayerLink PMPL on PMPL.fldmapid = M.fldmapid
        where PMPL.fldplayerid = ?");
      $query->bindParam(1, $playerid);
      $query->execute();

      /* Prepare arrays */
      if($row=$query->fetch(PDO::FETCH_ASSOC)) {
        /*its getting data in line. And its an object*/
        return new Map($row["fldmapid"], $row["fldmapname"], $row["fldmapcreatedon"]);
      }
      else{
        return "ERR : Empty map";
      }
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }
?>
