<?php
  /* Includes */
  require_once('../db_Call.php');
  require_once('poco_player.php');

  /* Global variables */
  $db = initDB('../');

  /*
    1. insertVillage #TODO : MODIFY
    2. updateVillage
    3. deleteVillage
    4. getListVillage #TODO : MODIFY
    5. getVillageById
    6. getVillageByPostion
    7. getAllVillagesByMapId
  */

  /* 1. insertVillage */
  function insertVillage($login, $passwd){
    try{
      /* SELECT  */
      $query = $GLOBALS['db']->prepare("INSERT INTO tblVillage (fldlogin, fldpasswd) VALUES (?, ?)");
      $query->bindParam(1, $login);
      $query->bindParam(2, $passwd);
      $query->execute();
      return "OK";
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }

  /* 2. updateVillage */
  function updateVillage($mapId, $x, $y, $newPlayer){
    try{
      $today = date("Y-m-d H:i:s");
      /* SELECT  */
      $query = $GLOBALS['db']->prepare(
        "UPDATE tblVillage  V set fldlastbuildon = ?, fldlastbuildby = ? ,fldplayer = ?
        INNER JOIN tblmapvillagelink MVL
        ON MVL.fldvillageid = V.fldvillageid
        WHERE fldmapid = ? AND fldx  = ? AND fldy = ?");
      $query->excute(array($today, $newPlayer, $newPlayer, $mapId, $x, $y));
      return "OK";
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }

  /* 3. deleteVillage */
  function deleteVillage($id){
    try{
      /* SELECT  */
      $query = $GLOBALS['db']->prepare("DELETE FROM tblVillage set WHERE fldvillageid = ?");
      $query->excute(array($id));
      return "OK";
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }

  /* 4. getListVillage */
  function getListVillage(){
    return "ERR : Not implemented yet";
  }

  /* 5. getVillageById */
  function getVillageById($villageID){
    try{
      /* SELECT  */
      $query = $GLOBALS['db']->prepare(
        "SELECT *
        from tblVillage
        where fldvillageid= ?");
      $query->bindParam(1, $villageID);
      $query->execute();

      /* Prepare arrays */
      $taby = array();
      $tabx = array();
      /* Array of instance of player */
      $tabplayer = array();
      if($row=$query->fetch(PDO::FETCH_ASSOC)) {
        /*its getting data in line. And its an object*/
        return new Village(
          $row["fldvillageid"],
          $row["fldx"],
          $row["fldy"],
          $row["fldplayer"],
          $row["fldfirstbuildon"],
          $row["fldfirstbuildby"],
          $row["fldlastbuildon"],
          $row["fldlastbuildby"]);
      }
      }
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }

  /* 6. getVillageByPosition */
  function getVillageByPosition($x, $y, $mapid, $usrid){
    try{
      /* SELECT  */
      $query = $GLOBALS['db']->prepare(
        "SELECT fldmapid, fldx, fldy, fldusr
        from tblVillage v
        INNER JOIN tblmapvillagelink MVL
          ON MVL.fldvillageid = V.fldvillageid
        INNER JOIN tblPlayers P
          ON P.fldplayerid = V.fldplayer
        where fldmapid = ? AND fldy = ? AND fldx =  ? ");
      $query->bindParam(1, $mapID);
      $query->bindParam(2, $y);
      $query->bindParam(3, $x);
      $query->execute();

      /* Prepare arrays */
      if($row=$query->fetch(PDO::FETCH_ASSOC)) {
        return new Village(
          $row["fldvillageid"],
          $row["fldx"],
          $row["fldy"],
          $row["fldplayer"],
          $row["fldfirstbuildon"],
          $row["fldfirstbuildby"],
          $row["fldlastbuildon"],
          $row["fldlastbuildby"]);
      }
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }

  /* 7. getAllVillagesByMapId */
  function getAllVillagesByMapId($mapid){
    try{
      /* SELECT  */
      $query = $GLOBALS['db']->prepare(
        "SELECT V.*
        from tblVillage V
        INNER JOIN tblMapVillageLink MVL on MVL.fldVillageid = V.fldvVillageId
        where MVL.fldmapid= ?");
      $query->bindParam(1, $mapid);
      $query->execute();

      /* Prepare arrays */
      $tabVillageID = array();
      $tabX = array();
      $tabY = array();
      $tabPlayer = array();
      $tabFirstBuildOn = array();
      $tabFirstBuildBy = array();
      $tabLastBuildOn  = array();
      $tabLastByuildBy = array();
      
      while($row=$query->fetch(PDO::FETCH_ASSOC)) {
        /*its getting data in line. And its an object*/
        array_push(
        );
        array_push($tabx, $row["fldy"]);
        $singlePlayer = getPlayerByUsrId($row["fldusr"]);
        array_push($tabplayer, $singlePlayer);
      }
      return new Village($mapID, $tabx, $taby, $tabplayer);
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }
?>
