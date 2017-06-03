<?php 
session_start();

// Allocation des valeurs 
$x = $_GET["x"];
$y = $_GET["y"];
$appartenanceVillage = 'oui';
$villageOuNon = 'Ce terrain est vide';
// Chargement des données
$dbh = new PDO("sqlite:../data/db.sqlite");

// Mis en place de la requête SQL
$query = 
"select  login, color, x, y, champ1, champ2, foret1, foret2, mine1, mine2, caserne, forge, archerie, maison1, maison2, maison3 from players P
 inner join map M on M.player  = P.plid
 outer left join usr U on P.usr = U.id 
 where y=? and x=? ";

$stm = $dbh->prepare($query);

// La valeur du ? sera donnée par array($x, $y)
$stm->execute(array($x, $y));

/* on sort tout sauf blé etc */
//Resultat ne vaut rien mais il prendra les valeurs par la suite
if ($res=$stm->fetch())
{
  header('Content-Type: text/xml');
  echo '<?xml version="1.0" encoding="utf-8"?>';
  // vérifie si un village existe sur la map
  if($res["login"] != null)
  {
    $villageOuNon = 'Village existant';
  }
  // on vérifie si c'est bien le village de la personne
  if($_SESSION["login"] != $res["login"])
  {
    $appartenanceVillage = 'non';
    echo'<vueVillage>
        <information>
          '.$villageOuNon.'&lt;br /&gt;
          Votre village : '. $appartenanceVillage.'&lt;br /&gt;
          Login : '.$res["login"].'&lt;br /&gt;
          Couleur : '.$res["color"].'&lt;br /&gt;
          ['.$res["x"] .', '. $res["y"].']&lt;br /&gt;
        </information>
        <batiment>
          Champ 1  : '.($res["champ1"]== 0 ? 'absent' : 'present') .'&lt;br /&gt;
          Champ 2  : '.($res["champ2"] == 0 ? 'absent' : 'present').'&lt;br /&gt;
          Foret 1  : '.($res["foret1"]== 0 ? 'absent' : 'present').'&lt;br /&gt;
          Foret 2  : '.($res["foret2"]== 0 ? 'absent' : 'present').'&lt;br /&gt;
          Mine 1   : '.($res["mine1"]== 0 ? 'absent' : 'present').'&lt;br /&gt;
          Mine 2   : '.($res["mine2"]== 0 ? 'absent' : 'present').'&lt;br /&gt;
          Caserne  : '.($res["caserne"]== 0 ? 'absent' : 'present').'&lt;br /&gt;
          Forge    : '.($res["forge"]== 0 ? 'absent' : 'present').'&lt;br /&gt;
          Archerie : '.($res["archerie"]== 0 ? 'absent' : 'present').'&lt;br /&gt;
          Maison 1 : '.($res["maison1"]== 0 ? 'absent' : 'present').'&lt;br /&gt;
          Maison 2 : '.($res["maison2"]== 0 ? 'absent' : 'present').'&lt;br /&gt;
          Maison 3 : '.($res["maison3"]== 0 ? 'absent' : 'present').'&lt;br /&gt;
        </batiment>
      </vueVillage>';
  }
  else
  {
    echo'<vueVillage>
        <information>
          '.$villageOuNon.'&lt;br /&gt;
          Votre village : '. $appartenanceVillage.'&lt;br /&gt;
          Login   : '.$res["login"].'&lt;br /&gt;
          Couleur : '.$res["color"].'&lt;br /&gt;
          ['.$res["x"] .', '. $res["y"].']&lt;br /&gt;
        </information>
        <batiment>
          Champ 1  : '.$res["champ1"].'&lt;br /&gt;
          Champ 2  : '.$res["champ2"].'&lt;br /&gt;
          Foret 1  : '.$res["foret1"].'&lt;br /&gt;
          Foret 2  : '.$res["foret2"].'&lt;br /&gt;
          Mine 1   : '.$res["mine1"].'&lt;br /&gt;
          Mine 2   : '.$res["mine2"].'&lt;br /&gt;
          Caserne  : '.$res["caserne"].'&lt;br /&gt;
          Forge    : '.$res["forge"].'&lt;br /&gt;
          Archerie : '.$res["archerie"].'&lt;br /&gt;
          Maison 1 : '.$res["maison1"].'&lt;br /&gt;
          Maison 2 : '.$res["maison2"].'&lt;br /&gt;
          Maison 3 : '.$res["maison3"].'&lt;br /&gt;
        </batiment>
      </vueVillage>';
  }
  //'&lt;br /&gt; = <br / >
}
/*
"<vueVillage>"
        .'<information id="login">Login : '.$res["login"].'</information>'
        .'<information id="couleur">Couleur : '.$res["color"].'</information>'
        .'<information id="pos">['.$res["x"].', '.$res["y"].']</information>'
        .'<batiment id ="champ">Champ 1 : '.$res["champ1"].'</batiment>'
        .'<batiment id ="champ">Champ 2 : '.$res["champ2"].'</batiment>'
        .'<batiment id ="foret">Foret 1 : '.$res["foret1"].'</batiment>'
        .'<batiment id ="foret">Foret 2 : '.$res["foret2"].'</batiment>'
        .'<batiment id ="mine">Mine 1 : '.$res["mine1"].'</batiment>'
        .'<batiment id ="mine">Mine 2 : '.$res["mine2"].'</batiment>'
        .'<batiment id ="caserne">Caserne : '.$res["caserne"].'</batiment>'
        .'<batiment id ="forge">Forge :'.$res["forge"].'</batiment>'
        .'<batiment id ="archerie">Archerie :'.$res["archerie"].'</batiment>'
        .'<batiment id ="maison">Maison 1 : '.$res["maison1"].'</batiment>'
        .'<batiment id ="maison">Maison 2 : '.$res["maison2"].'</batiment>'
        .'<batiment id ="maison">Maison 3 : '.$res["maison3"].'</batiment>'
      ."</vueVillage>";
*/
?>
