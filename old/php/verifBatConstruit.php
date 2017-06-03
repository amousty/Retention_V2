<?php 
/* Envoie une chaine de caractère pour chaque élément construit ou non.*/
session_start();

// Allocation des valeurs 
$x = $_GET["x"];
$y = $_GET["y"];

// Chargement des données
$dbh = new PDO("sqlite:../data/db.sqlite");

// Mis en place de la requête SQL
$query = 
"select champ1, champ2, foret1, foret2, mine1, mine2, caserne, forge, archerie, maison1, maison2, maison3, login from players P
 inner join map M on M.player  = P.plid
 outer left join usr U on P.usr = U.id 
 where y=? and x=? ";
$stm = $dbh->prepare($query);

// La valeur du ? sera donnée par array($x, $y)
$stm->execute(array($x, $y));
$stringRep = "";

if ($res=$stm->fetch())
{
  // on vérifie si c'est bien le village de la personne
  if($_SESSION["login"] == $res["login"])
  {
    $stringRep.=$res["champ1"]  ."-";
    $stringRep.=$res["champ2"]  ."-";
    $stringRep.=$res["foret1"]  ."-";
    $stringRep.=$res["foret2"]  ."-";
    $stringRep.=$res["mine1"]   ."-";
    $stringRep.=$res["mine2"]   ."-";
    $stringRep.=$res["caserne"] ."-";
    $stringRep.=$res["forge"]   ."-";
    $stringRep.=$res["archerie"]."-";
    $stringRep.=$res["maison1"] ."-";
    $stringRep.=$res["maison2"] ."-";
    $stringRep.=$res["maison3"] ."-";
  }
  else
  {
    $stringRep = "ERR";
  }
  echo $stringRep;
}
?>