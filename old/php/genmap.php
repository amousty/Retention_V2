<?php 
  $dbh = new PDO("sqlite:../data/db.sqlite");

  //Requête
  $query = 
  "select y, x, color from map M
  inner join players P on P.plid = M.player
  order by y, x";

  $stm = $dbh->prepare($query);
  $stm->execute();

  // On génère la map proprement dit
  $stringRep = "";
  // ici on fait un while car on a besoin de toutes les infos
  while($res = $stm->fetch())
  {
    // ATTENTION IL FAUT METTRE DES CROCHETS ET NON DES PARENTHESES
    $stringRep .= $res["color"]; // On récupère la couleur
    
    // Je fais ça sous un calcul car  0%9 donne le même res que 9%9 et ça fait bug
    if($res["x"] - 8  == 1)
    {
        $stringRep.= '|';
    }
    else
    {
      $stringRep.= ",";
    }
  }

  // on renvoie les données
  echo $stringRep;
?>