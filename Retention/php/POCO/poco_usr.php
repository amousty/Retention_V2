<?php
  /* Includes */
  //  require_once('../helpers/sessionHelper.php');

  /* Global variables */
  $db_directory = 'sqlite:../../db/db.sqlite';
  $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

  /*
    1. insertUsr
    2. updateUsr
    3. deleteUsr
    4. getListUsr
    5. getUSr
    6. getUsrById
  */

  /* 1. insertUsr */
  function insertUsr($login, $passwd){
    try{
      /* Prepare DB */
      $db = new PDO($GLOBALS['db_directory'], '', '',  $GLOBALS['pdo_options']);

      /* SELECT  */
      $query = $db->prepare("INSERT INTO tblusr (fldlogin, fldpasswd) VALUES (?, ?)");
      $query->bindParam(1, $login);
      $query->bindParam(2, $passwd);
      $query->execute();
      return "OK";
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }

  /* 2. updateUsr */
  function updateUsr($newLogin, $newPasswd, $oldLogin, $oldpasswd){
    try{
      /* Prepare DB */
      $db = new PDO($GLOBALS['db_directory'], '', '',  $GLOBALS['pdo_options']);

      /* SELECT  */
      $query = $db->prepare("update tblusr set fldlogin = ?, fldpasswd = ? WHERE fldlogin = ? and fldpasswd ? ");
      $query->excute(array($newLogin, $newPasswd, $oldLogin, $oldpasswd));

      /* update session value */
      $_SESSION["login"]=$newLogin;
      $_SESSION["passwd"]=$newPasswd;

      return "OK";
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }

  /* 3. deleteUsr */
  function deleteUsr($id){
    try{
      /* Prepare DB */
      $db = new PDO($GLOBALS['db_directory'], '', '',  $GLOBALS['pdo_options']);

      /* SELECT  */
      $query = $db->prepare("delete FROM tblusr set WHERE fldid = ?");
      $query->excute(array($id));

      /* update session value */
      cleanSession();
      return "OK";
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }

  /* 4. getListUsr */
  function getListUsr(){
    return "ERR : Not implemented yet";
  }

  /* 5. getUSr */
  function getUSr($login, $passwd){
    try{
      /* Prepare DB */
      $db = new PDO($GLOBALS['db_directory'], '', '',  $GLOBALS['pdo_options']) or die("cannot open the database");

      /* SELECT  */
      $query = $db->prepare("SELECT * from tblusr where fldlogin= ? and fldpasswd = ?");
      $query->bindParam(1, $login);
      $query->bindParam(2, $passwd);
      $query->execute();
      while($row=$query->fetch(PDO::FETCH_ASSOC)) {
        /*its getting data in line. And its an object*/
        return $row["fldid"];
      }
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }

  /* 6. getUsrById */
  function getUsrById($id){
    try{
      /* Prepare DB */
      $db = new PDO($GLOBALS['db_directory'], '', '',  $GLOBALS['pdo_options']);

      /* SELECT  */
      $query = $db->prepare("SELECT *  FROM tblusr WHERE fldid= ?");
      $query->excute(array($id));
      while($row=$query->fetch(PDO::FETCH_OBJ)) {
        /*its getting data in line. And its an object*/
        return $row;
      }
    }
    catch(PDOException $e){
      return "ERR : " . $e;
    }
  }
?>
