<?php
  session_start();

  $login  = $_POST["login"];
  $passwd = $_POST["passwd"];

  $dbh = new PDO("sqlite:../../db/db.sqlite");

  // Mis en place de la requête SQL
  $query = "select id, login from usr where login='$login' and passwd='$passwd'";

  $stm = $dbh->prepare($query);
  $stm->execute();

  //Resultat ne vaut rien mais il prendra les valeurs par la suite
  $stringRep = "";
  if ($res=$stm->fetch())
  {
    $stringRep             .= "OK";
    $_SESSION["id"]         = $res["id"];
    $_SESSION["login"]      = $res["login"];
  }
  else
  {
    $stringRep .= "ERR + " . $login . " / " . $passwd;
  }

  // Renvoi des informations
  echo $stringRep;

?>
