<?php
  session_start();

  $login  = $_POST["login"];
  $passwd = $_POST["passwd"];

  $dbh = new PDO("sqlite:../../db/db.sqlite");

  // on le compare aux personnes déjà dans la database
  $queryCompare = "select fldlogin from tblusr where fldlogin='$login'";
  $stmTwo     = $dbh->prepare($queryCompare);
  $stmTwo->execute();
  $res        = $stmTwo->fetch();
  $stringRep  = "";

  // Si le compte n'existe pas déjà et qu'il est différent de rien du tout ->
  if ($res == null && $login != "")
  {
      $query = "insert into  tblusr (fldlogin, fldpasswd) values ('$login', '$passwd')";
      $stmAdd = $dbh->prepare($query);
      $stmAdd->execute();
      $addAccount = $stmAdd->fetch();
      $stringRep         .= "OK";
      $_SESSION["id"]     = $addAccount["fldid"];
  }
  else
  {
    // Si on veut utiliser le compte "", il nous renvoie une erreur != que des mdps divergents.
    $stringRep .= "ERR";
  }

  // Renvoi des informations
  echo $stringRep;

?>
