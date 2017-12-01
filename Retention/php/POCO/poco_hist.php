<?php
  /* Includes */
  //require_once('sessionHelper.php');

  /*
    1. insertHistory
    2. updateHistory
    3. deleteHistory
    4. getListHistory
    5. getHistory
    6. getHistoryById
  */

  /* 1. insertHistory */
  function insertHistory($usrID){
    try{
      /* Prepare DB */
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      $db = new PDO('sqlite:../../../db/db.sqlite', '', '',  $pdo_options);

      /* Select  */
      $query = $db->prepare("tblHistory (fldusrid, fldcreatedon, fldlastupdateon, fldlastupdateby) values (?, ?, ?, ?)");
      $query->excute(array($usrID, date("d-m-Y"), date("d-m-Y"), $usrID));
      echo "OK";
    }
    catch(PDOException $e){
      echo "ERR : " . $e;
    }
  }

  /* 2. updateHistory */
  function updateHistory($historyID, $newPasswd, $oldLogin, $oldpasswd){

  }

  /* 3. deleteHistory */
  function deleteHistory($id){
    try{
      /* Prepare DB */
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      $db = new PDO('sqlite:../../../db/db.sqlite', '', '',  $pdo_options);

      /* Select  */
      $query = $db->prepare("delete from tblHistory set where fldhistoryid = ?");
      $query->excute(array($id));

      /* update session value */
      cleanSession();
      echo "OK";
    }
    catch(PDOException $e){
      echo "ERR : " . $e;
    }
  }

  /* 4. getListHistory */
  function getListHistory(){
    echo "ERR : Not implemented yet";
  }

  /* 5. getHistory */
  function getHistory($fldusrid){
    try{
      /* Prepare DB */
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      $db = new PDO('sqlite:../../../db/db.sqlite', '', '',  $pdo_options);

      /* Select  */
      $query = $db->prepare("select *  from tblHistory where fldusrid= ?");
      $query->excute(array($fldusrid));
      while($row=$query->fetch(PDO::FETCH_OBJ)) {
        /*its getting data in line. And its an object*/
        echo $row;
      }
    }
    catch(PDOException $e){
      echo "ERR : " . $e;
    }
  }

  /* 6. getHistoryById */
  function getHistoryById($id){
    echo "ERR : Not implemented yet";
  }
?>
