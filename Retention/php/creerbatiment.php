<?php
  session_start();
  $indice = $_GET["i"];
  /*l'indice va permettre de savoir quel bouton a été cliqué et donc de savoir quel élément veut être modifié. */
  $tabValue = array("champ1", "champ2", "foret1", "foret2", "mine1", "mine2", "caserne", "forge", "archerie", "maison1", "maison2", "maison3");

  $dbh = new PDO("sqlite:../data/db.sqlite");

  // Mis en place de la requête SQL
  $query = 
  "select ".$tabValue[$indice]." from players P
   inner join map M on M.player  = P.plid
   outer left join usr U on P.usr = U.id
   where login = ".$_SESSION['login'];
  $stm = $dbh->prepare($query);

  // La valeur du ? sera donnée par array($x, $y)
  $stm->execute();
  $stringRep = "";

  if ($res=$stm->fetch())
  {
    /*switch($tabValue[$indice])
    {
      case "champ1"
    }
    if($_SESSION["login"] == $res["login"])
    {
      $stringRep.=$res["champ1"]."-";
      $stringRep.=$res["champ2"]."-";
      $stringRep.=$res["foret1"]."-";
      $stringRep.=$res["foret2"]."-";
      $stringRep.=$res["mine1"]."-";
      $stringRep.=$res["mine2"]."-";
      $stringRep.=$res["caserne"]."-";
      $stringRep.=$res["forge"]."-";
      $stringRep.=$res["archerie"]."-";
      $stringRep.=$res["maison1"]."-";
      $stringRep.=$res["maison2"]."-";
      $stringRep.=$res["maison3"]."-";
    }
    else
    {
      $stringRep = "ERR";
    }
    echo $stringRep;*/
    echo $res;
  }

?>