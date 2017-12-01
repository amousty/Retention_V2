<?php
  /* Includes */
  require_once('../helpers/sessionHelper.php');

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
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      $db = new PDO('sqlite:../../db/db.sqlite', '', '',  $pdo_options);

      /* Select  */
      $query = $db->prepare("tblusr (fldlogin, fldpasswd) values (?, ?)");
      $query->excute(array($login, $passwd));
      echo "OK";
    }
    catch(PDOException $e){
      echo "ERR : " . $e;
    }
  }

  /* 2. updateUsr */
  function updateUsr($newLogin, $newPasswd, $oldLogin, $oldpasswd){
    try{
      /* Prepare DB */
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      $db = new PDO('sqlite:../../db/db.sqlite', '', '',  $pdo_options);

      /* Select  */
      $query = $db->prepare("update tblusr set fldlogin = ?, fldpasswd = ? where fldlogin = ? and fldpasswd ? ");
      $query->excute(array($newLogin, $newPasswd, $oldLogin, $oldpasswd));

      /* update session value */
      $_SESSION["login"]=$newLogin;
      $_SESSION["passwd"]=$newPasswd;

      echo "OK";
    }
    catch(PDOException $e){
      echo "ERR : " . $e;
    }
  }

  /* 3. deleteUsr */
  function deleteUsr($id){
    try{
      /* Prepare DB */
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      $db = new PDO('sqlite:../../db/db.sqlite', '', '',  $pdo_options);

      /* Select  */
      $query = $db->prepare("delete from tblusr set where fldid = ?");
      $query->excute(array($id));

      /* update session value */
      cleanSession();
      echo "OK";
    }
    catch(PDOException $e){
      echo "ERR : " . $e;
    }
  }

  /* 4. getListUsr */
  function getListUsr(){
    echo "ERR : Not implemented yet";
  }

  /* 5. getUSr */
  function getUSr($login){
    try{
      /* Prepare DB */
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      $db = new PDO('sqlite:../../db/db.sqlite', '', '',  $pdo_options);

      /* Select  */
      $query = $db->prepare("select * from tblusr where fldlogin= :fldlogin");
      $query->excute(array('fldlogin' => $login));
      while($row=$query->fetch(PDO::FETCH_OBJ)) {
        /*its getting data in line. And its an object*/
        echo $row;
      }
    }
    catch(PDOException $e){
      echo "ERR : " . $e;
    }
  }

  /* 6. getUsrById */
  function getUsrById($id){

  }
?>
