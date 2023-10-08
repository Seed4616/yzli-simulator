<?php
/*
 *Connexion à la base de donnée
 */

   $host = 'postgresql-yzli.alwaysdata.net';
   $dbname = 'yzli_database';
   $username = 'yzli';
   $password = 'cybdreseau2223';

  
   $dsn="pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
   try{
      $db = new PDO($dsn);

   }
   catch (PDOException $e){
      echo $e->getMessage();
   }


?>