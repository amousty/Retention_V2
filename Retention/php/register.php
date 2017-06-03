<?php 
  session_start();

  $login  = $_POST["login"];
  $passwd = $_POST["passwd"];
  $passverif = $_POST["passverif"];

  $dbh = new PDO("sqlite:../data/db.sqlite");

  // on le compare aux personnes déjà dans la database
  $queryCompare = "select login from usr where login='$login'";
  $stmTwo     = $dbh->prepare($queryCompare);
  $stmTwo->execute();
  $res        = $stmTwo->fetch();
  $stringRep  = "";

  // Si le compte n'existe pas déjà et qu'il est différent de rien du tout ->
  if ($res == null && $login != "")
  {
    if($passwd == $passverif && $passwd != "" )
    {
      $query = "insert into  usr (login, passwd) values ('$login', '$passwd')";
      $stmAdd = $dbh->prepare($query);
      $stmAdd->execute();
      $addAccount = $stmAdd->fetch();
      $stringRep         .= "OK";
      $_SESSION["id"]     = $addAccount["id"];
    }
    else
    {
      $stringRep .="MDP";
    }
  }
  else
  {
    // Si on veut utiliser le compte "", il nous renvoie une erreur != que des mdps divergents.
    $stringRep .= "ERR";
  }

  // Renvoi des informations
  echo $stringRep;

?>