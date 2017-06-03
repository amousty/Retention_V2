/**********************************************************************************/
/*                               VARIABLES                                        */
/**********************************************************************************/
var isDisplayGameScreen;
var isDisplayLoginScreen;
var x = 8; // TAILLE VERTICALE   DE LA MAP IMPORTANT
var y = 10;// TAILLE HORIZONTALE DE LA MAP IMPORTANT


/**********************************************************************************/
/*                               FONCTIONS                                        */
/**********************************************************************************/

////////////////////////////////////////////////////////////////////////////////////
// init() : se boot au démarrage
////////////////////////////////////////////////////////////////////////////////////
/// Entrées: Rien
////////////////////////////////////////////////////////////////////////////////////
function init()
{
  isDisplayGameScreen   = false;
  isDisplayLoginScreen  = true;
  $('village').hide();
  $('gamescreen').hide();
  $('return').hide();/*bouton retour qui apparait quand on affiche la vue village*/
  $('registerForm').hide();

  /* AJOUTE DES EVENEMENTS AUX BOUTONS */
  $('logout').onclick   = LogoutRPC;
  $('login').onclick    = VerifLoginRPC;
  $('reset').onclick    = refresh;
  $('return').onclick   = CacherVueVillage;
  $('register').onclick = AfficherRegister;
  $('registerR').onclick = RegisterRPC;
  $('loginR').onclick   = refresh;
}

/**********************************************************************************/
/*                        FONCTIONS RPC                                           */
/**********************************************************************************/

////////////////////////////////////////////////////////////////////////////////////
// GenererMapRPC() : Reprend les informations sur la map dans la BD et les réenvoies
////////////////////////////////////////////////////////////////////////////////////
function GenererMapRPC()
{
  var xhttp = getXHR();
  // -> fonction de common.js
  xhttp.onreadystatechange = function()
  {
    if (xhttp.readyState == 4 && xhttp.status == 200)
      {
        // Quand il est pret le responseText est envoyé à la fonction d'affichage
        AffichageMap(xhttp.responseText);
      }
  };
  xhttp.open("GET","php/genmap.php", true);
  xhttp.send(null);
}

////////////////////////////////////////////////////////////////////////////////////
// GenInfoVillageRPC() : Permet de savoir qui se trouve sur la case cliquée ////////////////////////////////////////////////////////////////////////////////////
/// Entrées: la position x et y cliquée
////////////////////////////////////////////////////////////////////////////////////
function GenInfoVillageRPC(posx, posy)
{
  var xhr=getXHR();
  var urlMap = "php/genuser.php";
  var params = "x=" + posx + "&y=" + posy;
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        DisplayGenInfoVillage(xhr.responseXML);//posx, posy
      }
    }
  };
  xhr.open("GET",urlMap+'?'+params,true);
  xhr.send(null);
}

////////////////////////////////////////////////////////////////////////////////////
// RessourcesJoueurRPC() : Permet de savoir La quantité de ressources du joueur
// connecté ////////////////////////////////////////////////////////////////////////////////////
/// Sorties : La quantité de ressources du joueur connecté (nourriture-bois-pierre)
////////////////////////////////////////////////////////////////////////////////////
function RessourcesJoueurRPC()
{
  var xhttp=getXHR();
  var url       ="php/ressourcesjoueur.php";
  xhttp.onreadystatechange = function()
  {
    if (xhttp.readyState == 4 && xhttp.status == 200)
      {
        // On peut utiliser AfficherGameScreen car les 2 boutons afficheraient la même chose.
        AfficherRessources(xhttp.responseText);
      }
  };
  xhttp.open("GET",url,true);
  xhttp.send(null)
}

////////////////////////////////////////////////////////////////////////////////////
// AjoutBoutonConstrucRPC() : Permet de savoir qui se trouve sur la case cliquée ////////////////////////////////////////////////////////////////////////////////////
/// Entrées: la position x et y cliquée
/// Sortie : La valeur des batiments si c'est son village, sinon ERR
////////////////////////////////////////////////////////////////////////////////////
function AjoutBoutonConstrucRPC(posx, posy)
{
  var xhr=getXHR();
  var urlMap = "php/verifBatConstruit.php";
  var params = "x=" + posx + "&y=" + posy;
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        AjoutBoutonConstruc(xhr.responseText);//posx, posy
      }
    }
  };
  xhr.open("GET",urlMap+'?'+params,true);
  xhr.send(null);
}

////////////////////////////////////////////////////////////////////////////////////
// VerifLoginRPC() : Regarde si les informations de la personne voulant se connecter sont corrects et existants.////////////////////////////////////////////////////////////////////////////////////
function VerifLoginRPC()
{
  var xhttp=getXHR();
  var url     ="php/login.php";
  // On récupère les valeurs du pseudo et du mdp et on les envoie à la requête
  var pseudo  = $('pseudoLogin').value;
  var pass    = $('passwordLogin').value;
  var param   ="login="+ pseudo + "&passwd=" + pass;
  // -> fonction de common.js
  xhttp.onreadystatechange = function()
  {
    if (xhttp.readyState == 4 && xhttp.status == 200)
      {
        // Quand il est pret le responseText est envoyé à la fonction d'affichage
        AfficherGameScreen(xhttp.responseText);
      }
  };
  xhttp.open("POST",url,true);
  xhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhttp.send(param);
}

////////////////////////////////////////////////////////////////////////////////////
// LogoutRPC() : Vide $_SESSION ////////////////////////////////////////////////////////////////////////////////////
function LogoutRPC()
{
  var xhttp=getXHR();
  var url ="php/logout.php";
  CacherGameScreen();
  xhttp.open("GET",url,true);
  xhttp.send(null);
}

////////////////////////////////////////////////////////////////////////////////////
// RegisterRPC() : Vérifie si la personne peut créer un compte ////////////////////////////////////////////////////////////////////////////////////
function RegisterRPC()
{
  var xhttp=getXHR();
  var url       ="php/register.php";
  var pseudo    = $('pseudoRegister').value;
  var pass      = $('passwordRegister').value;
  var passVerif = $('passwordRegisterTwo').value;
  var param     ="login="+ pseudo + "&passwd=" + pass + "&passverif=" + passVerif;
  xhttp.onreadystatechange = function()
  {
    if (xhttp.readyState == 4 && xhttp.status == 200)
      {
        // On peut utiliser AfficherGameScreen car les 2 boutons afficheraient la même chose.
        AfficherGameScreen(xhttp.responseText);
      }
  };
  xhttp.open("POST",url,true);
  xhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhttp.send(param);
}

////////////////////////////////////////////////////////////////////////////////////
// GenBatimentRPC() : Permet de créer un nouveau batiment ////////////////////////////////////////////////////////////////////////////////////
/// Entrées: le bouton "trigger" + sa position
/// Sortie : Les nouvelles valeurs si ça a fonctionné, sinon "ERR"
////////////////////////////////////////////////////////////////////////////////////
function GenBatimentRPC(i)
{
  var xhr=getXHR();
  var urlMap = "php/creerbatiment.php";
  var params = "i=" + i;
  xhr.open("GET",urlMap+'?'+params,true);
  xhr.send(null);
}
/**********************************************************************************/
/*                        FONCTIONS GEN CALL BACK                                 */
/**********************************************************************************/

////////////////////////////////////////////////////////////////////////////////////
// VueVillageGCB() : Permet d'éviter le phénomène de closure, permet en outre de générer la map   ////////////////////////////////////////////////////////////////////////////////////
/// Entrées: L'id du village ainsi que sa position x et y
////////////////////////////////////////////////////////////////////////////////////
function VueVillageGCB(villageAttr, i, j)
{
  /* return fonction (event) { $('').innerHTML = i; }
  -> appelé dans la fonction mère el.onclick = fonction(i);*/
  return function()
  {
    $('carte').hide();
    $('reset').hide();
    $('logoJeu').hide();
    $('return').hide();
    $('ressources').hide();
    $('village').hide();

    ref_villageAttr = $(villageAttr);

    $('vueVillage').style.backgroundImage = ref_villageAttr.style.backgroundImage;

    // Affiche les informations du village
    GenInfoVillageRPC(i,j);
    AjoutBoutonConstrucRPC(i,j);
  }
}

////////////////////////////////////////////////////////////////////////////////////
// AjoutBoutonConstrucGCB() : Permet d'éviter le phénomène de closure, permet en outre de générer les boutons nécéssaires à la consruction de batiments  ////////////////////////////////////////////////////////////////////////////////////
/// Entrées: L'id du village ainsi que sa position x et y
////////////////////////////////////////////////////////////////////////////////////
function CreerBatimentGCB(i)
{
  return function()
  {
    alert("Tu as cliqué sur le "+ i);
    GenBatimentRPC(i);
  }
}

/**********************************************************************************/
/*                        FONCTIONS AUTRES                                        */
/**********************************************************************************/

////////////////////////////////////////////////////////////////////////////////////
// DisplayGenInfoVillage() : Récupère une longue chaine de string issue du xml et la divise selon les informations envoyée par genuser.////////////////////////////////////////////////////////////////////////////////////
/// Entrées: les informations sur le village, la position précise x et y
////////////////////////////////////////////////////////////////////////////////////
function DisplayGenInfoVillage(xml)
{
  var listelem,listRessources,i;
  $('infoPersonnage').innerHTML ="";
  $('infoVillage').innerHTML ="";
  listelem=xml.getElementsByTagName("information");
  listRessources = xml.getElementsByTagName("batiment");
  if (listelem[0])
  {
    if (listelem[0].firstChild)
    {
      for(i = 0; i < listelem.length; i++ )
      {
        $('infoPersonnage').innerHTML +=listelem[i].childNodes[0].nodeValue;
      }
      for(i = 0; i < listRessources.length; i++ )
      {
        $('infoVillage').innerHTML+=listRessources[i].childNodes[0].nodeValue;
      }
    }
  }
  //var subtree,listInfo,elem,i,listRessources,nom;
  //$('infoHexagone').innerHTML ="";
  /*elem = xml.getElementsByTagName("vueVillage").nextSibling;
  while(elem)
  {
    alert(xml.getResponseHeader());
    $('infoHexagone').innerHTML += elem.nodeName;
    elem = xml.getElementsByTagName("information").nextSibling;
  }*/
  //listInfo=xml.getElementsByTagName("information");
  //listRessources = xml.getElementsByTagName("batiment");
  //listInfo = elem.getElementsByTagName("information")[0];
  //childNodes[0] et firstChild sont des synonymes.childNodes[0].nodeValue;
  //var tmp = xml.getElementsByTagName();
  /*$('infoHexagone').innerHTML =subtree[i].getElementsByTagName("login")[0].childNodes[0].nodeValue;
          //elem=subtree[i];
  listInfo=elem.getElementsByTagName("information")[0];
  nomel=elem.getElementsByTagName(information);
  $('infoHexagone').innerHTML = subtree[i].getElementsByTagName("information")[0].childNodes[0].nodeValue;
  $('infoHexagone').innerHTML =subtree.childNodes[0].nodeValue;
  $('infoHexagone').innerHTML = getvalfromxml(elem,"information");
  nomel[i].childNodes[0].nodeValue*/
}

////////////////////////////////////////////////////////////////////////////////////
// AfficherRessources() : Affiche les ressources du joueur ////////////////////////////////////////////////////////////////////////////////////
/// Entrées: le nombre de ressources (nourriture-bois-pierre)
////////////////////////////////////////////////////////////////////////////////////
function AfficherRessources(str)
{
  $recup = str.split("-");
  $('nourriture').innerHTML = $recup[0];
  $('bois').innerHTML       = $recup[1];
  $('pierre').innerHTML     = $recup[2];
}

////////////////////////////////////////////////////////////////////////////////////
// AjoutBoutonConstruc() : Ajoute les boutons si il n'y a pas encore batiment
// construit de ce type ////////////////////////////////////////////////////////////////////////////////////
/// Entrées: un string contenant soit la valeur des batiments ou ERR
////////////////////////////////////////////////////////////////////////////////////
function AjoutBoutonConstruc(str)
{
  var btnBat, recupBat;
  if(str != "ERR")
  {
    $recupBat = str.split("-");
    alert(recupBat);
    for(var i = 0; i < recupBat.length; i++)
    {
      if(recupBat[i] == 0)
      {
        /* fonction genCallBack */
        btnBat = document.createElement("button");
        btnBat.id=i;
        btnBat.onclick = CreerBatimentGCB(i);
        $('btnCreerBat').innerHTML = 'Créer';
        $('btnCreerBat').appendChild(btnBat);
      }
    }
  }
}
////////////////////////////////////////////////////////////////////////////////////
// ChangerCouleur() : Affiche une certaine couleur selon les éléments envoyés ////////////////////////////////////////////////////////////////////////////////////
/// Entrées: Le village pour savoir quelle case modifier ainsi que la couleur de cette case.
////////////////////////////////////////////////////////////////////////////////////
function ChangerCouleur(village, lettre)
{
  // GenLettre n'a plus lieu d'être vu que la map est chargée depuis la DB et renvoie la couleur.
  var chaineConcatURL  = "url('img/hex" + lettre + ".png')";
  ref_posVillage  = $(village);
  ref_posVillage.style.backgroundImage  = chaineConcatURL;
}

/**********************************************************************************/
/*                        FONCTIONS D'AFFICHAGE - MASQUAGE                        */
/**********************************************************************************/

////////////////////////////////////////////////////////////////////////////////////
// AffichageMap() : Affiche une certaine couleur selon les éléments envoyés ////////////////////////////////////////////////////////////////////////////////////
/// Entrées: Les couleurs de la map afin de l'envoyer à ChangerCouleur()
////////////////////////////////////////////////////////////////////////////////////
function AffichageMap(str)
{
  var hexagone;
  var top   = 0;
  var left  = 0;

  $('carte').innerHTML = ""; // On vide la map.
  var recup = str.split("|");
  // -> séparer une première fois les groupes entre pipe (|) en x éléments
  for(var k = 0; k < recup.length; k++)
  {
    recup[k] = recup[k].split(",");
    //-> on choppe un tableau double dimension recup[i][j] car on a sépare à nouveau en y éléments
  }
  for (var i = 0; i < x; i++)
  {
    for(var j = 0; j < y; j++)
    {
      posVillage = 'h';
      posi = i + "";
      posj = j + "";
      posVillage+= i;
      posVillage+= j;
      hexagone = document.createElement("div");
      hexagone.id=posVillage;
      ChangerCouleur(hexagone, recup[i][j])

      /* PLACEMENT DES ELEMENTS */
      top   = i*86+(j%2)*43;
      left  = j*75;
      hexagone.style.top  = top   + 'px';
      hexagone.style.left = left  + 'px';
      hexagone.onclick = VueVillageGCB(hexagone, i, j);
      posyTmp = i;
      posxTmp = j;
      $('carte').appendChild(hexagone);
      /* -> on ajoute l'element qu'on a crée à la fin d'un élement, ici map.*/
    }
  }
  /* pour gérer les coordonnées impaires*/
  $('carte').style.width   = (y*73 + 43) + 'px';
  $('carte').style.height  = (x*86 + 43) + 'px';
}

////////////////////////////////////////////////////////////////////////////////////
// CacherVueVillage() : Excplicite  ////////////////////////////////////////////////////////////////////////////////////
function CacherVueVillage()
{
    $('carte').show();
    $('reset').show();
    $('return').hide();
    $('village').hide();
}

////////////////////////////////////////////////////////////////////////////////////
// CacherGameScreen() : Il permet d'enlever aussi la valeur entrée dans le login/mdp////////////////////////////////////////////////////////////////////////////////////
function CacherGameScreen()
{
  if (isDisplayGameScreen == true){
    // pour quand on se déconnecte vide les infos de la personne
    $('pseudoLogin').value    = "";
    $('passwordLogin').value  = "";

    // Suite de la fonction basique
    $('gamescreen').hide();
    $('logout').hide();
    // -> à modifier peut être
    $('registerForm').hide();
    $('loginscreen').show();
    $('loginForm').show();
    $('logoJeu').show();
    $('logoJeu').style.maxHeight  = "350px";
    $('logoJeu').style.width      = "auto";
    $('logoJeu').style.top        = "120px";
    $('logoJeu').style.left       = "150px";
    isDisplayLoginScreen  = true;
    isDisplayGameScreen   = false;
  }
}

////////////////////////////////////////////////////////////////////////////////////
// AfficherGameScreen() : Excplicite
/////////////////////////////////////////////////////////////////////////////////// // Entrées: Le code pour savoir si tout s'est bien passé
////////////////////////////////////////////////////////////////////////////////////
function AfficherGameScreen(verifMdp)
{
  if (isDisplayLoginScreen == true && verifMdp == "OK")
  {
    $('gamescreen').show();
    $('logout').show();
    $('loginscreen').hide();
    $('logoJeu').hide();
    isDisplayGameScreen   = true;
    isDisplayLoginScreen  = false;

    GenererMapRPC();       /*genere la map avec des couleurs du serveur */
    AjoutBoutonConstrucRPC(); /* ajoute les boutons de construction */
  }
  else if(verifMdp == "ERR")
  {
    alert("Mauvaises valeurs");
  }
  else if(verifMdp == "MDP")
  {
    alert("Vérifiez le(s) mot(s) de passe");
  }
  else
  {
    alert("Erreur inconnue");
  }

  //Chargement des ressources
  RessourcesJoueurRPC();
}

////////////////////////////////////////////////////////////////////////////////////
// AfficherRegister() : Excplicite
///////////////////////////////////////////////////////////////////////////////////
function AfficherRegister()
{
  $('registerForm').show();
  $('loginForm').hide();
}

////////////////////////////////////////////////////////////////////////////////////
// refresh() : Il sera enlevé à la fin du projet
///////////////////////////////////////////////////////////////////////////////////
function refresh()
{
  location.reload();
}

/**********************************************************************************/
/*                        FIN DE PAGE                                             */
/**********************************************************************************/
/*  - body          : se declenche quand on a fini de charger le body.
    - document      : arbre DOM crée et body chargé.
    - window.onlad  : - se déclenche quand toutes les ressources sont chargées
                      - il peut se déclencher AVANT le document.onlad)
                      - possible pour onload */
window.onload = init;
