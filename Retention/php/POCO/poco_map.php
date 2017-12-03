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
  function updateMap($newLogin, $newPasswd, $oldLogin, $oldpasswd){
    try{
      /* SELECT  */
      $query = $GLOBALS['db']->prepare("update tblMap set fldlogin = ?, fldpasswd = ? WHERE fldlogin = ? and fldpasswd ? ");
      $query->excute(array($newLogin, $newPasswd, $oldLogin, $oldpasswd));

      /* update session value */
      updateSession("", $newLogin, $newPasswd);

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
      $query = $GLOBALS['db']->prepare("delete FROM tblMap set WHERE fldid = ?");
      $query->excute(array($id));

      /* update session value */
      cleanSession();
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
      $query = $GLOBALS['db']->prepare("SELECT fldmapid, fldy, fldx, fldusr from tblMap M INNER JOIN tblPlayers P on P.fldplayerid = M.fldplayer where fldmapid= ? ORDER BY fldy, fldx");
      $query->bindParam(1, $mapID);
      $query->execute();

      /* Prepare arrays */
      $taby = array();
      $tabx = array();
      /* Array of instance of player */
      $tabplayer = array();
      while($row=$query->fetch(PDO::FETCH_ASSOC)) {
        /*its getting data in line. And its an object*/
        array_push($taby, $row["fldy"]);
        array_push($tabx, $row["fldx"]);
        $singlePlayer = getPlayerByUsrId($row["fldusr"]);
        array_push($tabplayer, $singlePlayer);
      }
      return new Map($mapID, $taby, $tabx, $tabplayer);
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }
?>
