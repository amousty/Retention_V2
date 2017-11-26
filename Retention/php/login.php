<?php
  session_start();

  $login  = $_POST["login"];
  $passwd = $_POST["passwd"];

  $dbh = new PDO("sqlite:../../db/db.sqlite", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  // Mis en place de la requête SQL
  $query = "select fldid, fldlogin from tblusr where fldlogin='$login' and fldpasswd='$passwd'";

  $stm = $dbh->prepare($query);
  $stm->execute();

  //Resultat ne vaut rien mais il prendra les valeurs par la suite
  $stringRep = "";
  if ($res=$stm->fetch())
  {
    $_SESSION["id"]         = $res["fldid"];
    $_SESSION["login"]      = $res["fldlogin"];

    /* If the user is successfully connected, we write it withtin the history tbl */
    $query =  "INSERT INTO tblhistory (fldusrid, fldcreatedon) VALUES (" . $res["fldid"] . ", " . date("d-m-Y H:i:s") . ");";

    $stm = $dbh->prepare($query);
    $stm->execute();
    $stringRep .= "OK";
  }
  else
  {
    $stringRep .= "ERR + " . $login . " / " . $passwd;
  }

  // Renvoi des informations
  echo $stringRep;

?>
