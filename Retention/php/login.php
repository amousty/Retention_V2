<?php
  session_start();
  include 'phpHelper.php';

  $login  = isset($_GET["login"]) ? $_GET["login"] : "";
  $passwd = isset($_GET["passwd"]) ? $_GET["passwd"] : "";

  $query = "select top 1 *  from tblusr where fldlogin='$login' and fldpasswd='$passwd'";
 /* Check if the user could be connected */
  $loginResult = executeBooleanQuery($query, "ERR WITH LOGIN");
  if (  $loginResult = "OK"){
    /* If the user is successfully connected, we write it withtin the history tbl */
    $queryHistory =  "INSERT INTO tblhistory (fldusrid, fldcreatedon) VALUES (" . "10"/*$res["fldid"]*/ . ", " . date("d-m-Y") . ");";
    echo executeVoidQuery($queryHistory, "ERR WITH HISTORY LOGIN");
  }
  else{
      echo $loginResult;
  }

?>
