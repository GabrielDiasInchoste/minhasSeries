<?php

   /* Connect to a MySQL database using driver invocation */
   $dsn   = "mysql:host=localhost;dbname=minhasSeries";
   $user  = "root";
   $pass  = "root";

    try {
        $con = new PDO($dsn, $user, $pass);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
?>
