<?php
  session_start();
  require_once('helpers/sessionHelper.php');
  require_once('POCO/poco_usr.php');
  require_once('POCO/poco_hist.php');

  $login  = isset($_GET["login"]) ? $_GET["login"] : "";
  $passwd = isset($_GET["passwd"]) ? $_GET["passwd"] : "";

  $objUsr = getUsr($login);
  echo $objUsr;
  if (stristr($objUsr, 'ERR') === FALSE){
    /* If the user is successfully connected, we write it withtin the history tbl */
    updateSession($objUSR["fldid"], $objUSR["fldlogin"], $objUSR["fldpasswd"]);
    echo insertHistory($objUSR["fldid"]);

  }
  else{
    echo $loginResult;
  }
?>
