<?php


function getUSr($login, $passwd){
  try{
    // Prepare DB
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $db_directory = 'sqlite:../../db/db.sqlite';
    $db = new PDO($db_directory, '', '',  $pdo_options) or die("cannot open the database");

    //Select

    $query = $db->prepare("SELECT * from tblusr where fldlogin= ? and fldpasswd = ?");
    $query->bindParam(1, $login);
    $query->bindParam(2, $passwd);
    $query->execute();
    while($row=$query->fetch(PDO::FETCH_OBJ)) {
      //its getting data in line. And its an object
      echo $row;
    }
  }
  catch(PDOException $e){
    echo "ERR : " . $e;
  }
}
?>
