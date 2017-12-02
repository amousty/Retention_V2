<?php
  function initDB(){
    try{
      // Prepare DB
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      $db_directory = 'sqlite:../../db/db.sqlite';
      $db = new PDO($db_directory, '', '',  $pdo_options) or die("cannot open the database");
      return $db;
    }
    catch(PDOException $e){
      echo "ERR : " . $e;
    }
  }
?>
