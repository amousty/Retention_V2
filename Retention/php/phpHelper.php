<?php
// #TODO : POCO
  /* RETURN OK OR ERR*/
  function executeBooleanQuery($query, $errMsg = "ERR"){
    $stringRep = $errMsg;
    $dbh = new PDO(
      'sqlite:../../db/db.sqlite',
      '',
      '',
      array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      )
    );

    $stm = $dbh->prepare($query);
    $stm->execute();

    //Resultat ne vaut rien mais il prendra les valeurs par la suite
    if ($res=$stm->fetch())
    {
      $stringRep = "OK";
    }

    echo $stringRep;
  }

  /* RETURN OK IF INSERT WORKS*/
  function executeVoidQuery($query, $errMsg = "ERR"){
    $stringRep = $errMsg;
    $dbh = new PDO(
      'sqlite:../../db/db.sqlite',
      '',
      '',
      array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      )
    );

    $stm = $dbh->prepare($query);
    if($stm->execute()){
      $stringRep = "OK";
    }

    echo $stringRep;
  }

?>
