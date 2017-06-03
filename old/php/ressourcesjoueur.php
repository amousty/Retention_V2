<?php
/*Le RPC qui retourne les ressources du joueur se contentera de retourner les trois valeurs pour le 
joueur connecté.*/

session_start();
$login = $_SESSION["login"];
$dbh = new PDO("sqlite:../data/db.sqlite");

$query = "select food, wood, stone from players P
          inner join  usr U on U.id = P.plid
          where login = '$login'";

  $stm = $dbh->prepare($query);
  $stm->execute();

  $stringRep = "";
  if ($res=$stm->fetch())
  {
    $stringRep.= $res["food"]."-".$res["wood"]."-".$res["stone"];
  }
  echo $stringRep;
?>